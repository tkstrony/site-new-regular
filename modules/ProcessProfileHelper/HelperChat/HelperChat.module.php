<?php namespace ProcessWire;

/**
 * ChcatGpt helper
 * ```php
 * // usage
    $chat = modules()->getModule('HelperChat');
    // Set the system prompt for the chat session ( If you want to change this system prompt, you need to end old sessions )
    // $chat->systemPrompt("This website was founded in 2019 and specializes in e-commerce.");
    $chat->render();
 *```
 * 
 */

class HelperChat extends ProcessProfileHelper {

    public static function getModuleInfo() {
        return [
            'title'    => __('Helper Chat'),
            'summary'  => __('Simple chat based on ChatGpt.'),
            'author'   => 'rafaoski',
            'version'  => '1',
            'icon'     => 'smile-o',
            'requires' => ['ProcessProfileHelper'],
            'autoload' => true,
        ];
    }

    public function __construct(
        public $enableChat = null,
        public $welcomeMessage = '',
        public $apiKey = '',
        public $aiModel = '',
        public $defaultSystemPrompt = '',
        public $maxRequestPerDay = '',
        public $maxRequestPerSession = '',
        public $limitHistory = '', // last chats will be stored in the session
        public $messageCharacterLimit = '', // Message characters limit (500 characters ≈ 125 input tokens)
        public $maxTokens = '', // Reply limit to ~300 tokens
        public $sessionName = '',
        private $sessionHistoryName = '',
        private $sessionCountName = '',
        private $sessionPromptName = '',
    ) {
        $this->set('enable_chat', $this->enableChat);
        $this->set('api_key', $this->apiKey ? trim($this->apiKey) : '');
        $this->set('welcome_message', $this->welcomeMessage);
        $this->set('ai_model', $this->aiModel ? trim($this->aiModel) : '');
        $this->set('default_system_prompt', $this->defaultSystemPrompt); 
        $this->set('max_request_per_day', $this->maxRequestPerDay);
        $this->set('max_request_per_session', $this->maxRequestPerSession);
        $this->set('limit_history', $this->limitHistory);
        $this->set('message_character_limit', $this->messageCharacterLimit);
        $this->set('max_tokens', $this->maxTokens);
    }
    
    /**
     * Initializes the module settings and prepares the chat configuration.
     * This method is called when the module is loaded.
     */
    public function init() {
        $input = $this->wire()->input;

        // var_dump(page()->template);

        if(_isAdmin() && $input->get('name') != 'HelperChat') return '';

        // Load chat settings from module configuration
        $this->enableChat = $this->enableChat ? 1 : $this->get('enable_chat');
        $this->apiKey = $this->apiKey ?: $this->get('api_key');

        if($input->get('name') == 'HelperChat') {
            if(!$this->enableChat && $input->post('enable_chat') == null) {
                $this->warning($this->_('If you want to use the Chat function you need to enable it first :)'));
            }
            if(!$this->apiKey && $input->post('api_key') == null) {
                $this->warning($this->_('You need to add an API key for the chatbot to work properly'));
            }
        }

        // Set welcome message for the chat
        $this->welcomeMessage = $this->welcomeMessage ?: $this->get('welcome_message') ?: $this->_("Hey, I'm your assistant. How can I help you?");

        // Load AI model configuration
        $this->aiModel = $this->aiModel ?: $this->get('ai_model') ?: 'gpt-4o-mini';

        // set page links for defaultSystemPrompt
        $pageLinks = pages()->find("template!=admin,has_parent!=2,status!=hidden,limit=20")
        ->each(function($page) { return "$page->title  $page->httpUrl \n"; });
        
        // Set default system prompt
        $this->defaultSystemPrompt = $this->defaultSystemPrompt ?: $this->get('default_system_prompt') ?: 
        $this->_('You are a helpful assistant for this website.') . 
        $this->_('Your main task is to assist users by presenting relevant pages and providing direct links to them when needed.') . "\n$pageLinks";

        // Set request limits
        $this->maxRequestPerDay = $this->maxRequestPerDay ?: $this->get('max_request_per_day') ?: 120;
        $this->maxRequestPerSession = $this->maxRequestPerSession ?: $this->get('max_request_per_session') ?: 40;

        // limit history
        $this->limitHistory = $this->limitHistory ?: $this->get('limit_history') ?: 10;
       
        // limit message character
        $this->messageCharacterLimit = $this->messageCharacterLimit ?: $this->get('message_character_limit') ?: 500;

        // limit output tokens
        $this->maxTokens = $this->maxTokens ?: $this->get('max_tokens') ?: 300;

        // set basic session names
        $this->sessionName = $this->sessionName ? trim($this->sessionName) : 'chgpt-default';
        $this->sessionHistoryName = $this->sessionName . '_sessionHistory';
        $this->sessionCountName = $this->sessionName . '_sessionCount';
        $this->sessionPromptName = $this->sessionName . '_sessionPrompt';
    }

    /**
     * Called when ProcessWire is fully initialized and ready.
     * This method sets up the necessary hooks for chat functionality.
     */
    public function ready() {

        // Ensure hooks are only applied on the frontend
        if (_isAdmin()) return '';

        // If chat is disabled or no API key is set, stop execution        
        if(!$this->enableChat || !$this->apiKey) return '';

        // Get language prefix for multilingual support
        $prefix = _langPrefix(page());

        /**
         * Hook to handle incoming chat requests.
         * Endpoint: /{prefix}_chat
         */
        wire()->addHook("/{$prefix}_chat", function($event) {
            // Validate the request before processing
            if (!$this->validateChatRequest()) return 'Unauthorized request';

            // Process the chat request
            return $this->handleChatRequest($event);
        });

        /**
         * Hook to reset the chat session.
         * Endpoint: /{prefix}_chat-reset
         */
        wire()->addHook("/{$prefix}_chat-reset", function($event) {
            // Validate the request before proceeding
            if (!_isHxRequest()) return 'Unauthorized request';

            // Reset the chat session
            return $this->resetChat();
        });

        /**
         * Hook to chat views.
         * Endpoint: /{prefix}_chat-load
         */
        wire()->addHook("/{$prefix}_chat-view", function($event) {

            // Validate the request before proceeding
            if (!_isHxRequest()) return 'Unauthorized request';

            return _modal($this->view());
        });
    }

    /**
     * Processes the incoming chat request, validates the message, generates a response, 
     * and returns the chat reply. Handles message character limits, error handling, 
     * and logging the conversation.
     *
     * @param mixed $event The event that triggered the chat request (e.g., a user action).
     * @return string The chat response rendered as HTML or an error message if validation fails.
     */
    private function handleChatRequest($event) {
    
        // Retrieve the user's message from the POST data
        $message = wire('input')->post('message', 'textarea');
        
        // Apply character limit to the message
        $message = substr($message, 0, $this->messageCharacterLimit); // Message character limit

        // Check if the message is empty
        if (!$message) {
            return $this->emptyMessageError(); // Return error if message is empty
        }

        // Check if any request limits are exceeded
        if ($this->exceededLimits()) {
            return $this->limitExceededError(); // Return error if limits are exceeded
        }

        // Get the GPT response based on the user's message
        $response = $this->getGptResponse($message);
        
        // Return an error message if no response is found
        if ($response == false) return $this->_('Response not found');

        // Convert the response from Markdown to HTML
        $reply = $this->markdownText($response);

        // Log the user's message and the system's reply
        $this->logChat($message, $reply);

        // Render and return the chat response (formatted message and reply)
        return $this->renderChatResponse($message, $reply);
    }

    /**
     * Converts Markdown text to safe HTML.
     * This method uses Parsedown to convert Markdown text to HTML,
     * then uses HTMLPurifier to ensure the output is safe and free from any malicious content.
     *
     * @param string $text The Markdown text to convert.
     * @return string The purified HTML output.
     */
    private function markdownText($text = '') {
        // If no text is provided, return an empty string
        if(!$text) return '';

        // Create a new Parsedown instance for Markdown parsing
        $parsedown = new \Parsedown();

        // Enable safe mode in Parsedown to limit certain HTML elements for security reasons
        $parsedown->setSafeMode(true);

        // Parse the Markdown text to HTML
        $text = $parsedown->text($text);

        /** @var MarkupHTMLPurifier $purifier */
        // Get the HTML purifier module to clean and sanitize the generated HTML
        $purifier = modules()->get('MarkupHTMLPurifier');

        // Purify the HTML output to remove any potential harmful or unsafe content
        return $purifier->purify($text);
    }

    /**
     * Renders the chat response as HTML.
     *
     * @param string $message The user's message.
     * @param string $reply The assistant's reply.
     * @return string The formatted HTML response.
     */
    private function renderChatResponse($message, $reply) {
        $sessionCount = session()->get($this->sessionCountName);
        $copyToclipBoard = $this->copyToclipboard($reply);
        $icon = _spin(50);
        return <<<HTML
            <div class='card mw-xs'>$message</div> 
            <div class='assistant as_{$sessionCount} card' hx-boost='false'>{$copyToclipBoard} {$icon} {$reply}</div>
        HTML;
    }

     /**
     * Method to send a message to OpenAI and retrieve a response.
     * @param string $message User's message.
     * @return string|null OpenAI's response or null if no response is received.
     */
    private function getGptResponse($message) {
        
        // 🔹 Create OpenAI client https://github.com/openai-php/client
        $client = \OpenAI::client($this->apiKey);
        $session = wire('session');

        // 🔹 Get chat history from session (if available)
        $chatHistory = $session->getFor($this->sessionHistoryName, 'messages') ?? [];

        // 🔹 If this is the first message in the session, add system instructions
        if (empty($chatHistory)) {
            // 🔹 Retrieve chatbot instructions once per chat
            $systemPrompt = $this->systemPrompt();
            if(!$systemPrompt) return 'No instructions found';

            // set history
            $chatHistory[] = ['role' => 'system', 'content' => $systemPrompt];
        }

        // 🔹 Add the user's message to chat history
        $chatHistory[] = ['role' => 'user', 'content' => $message];

        // 🔹 Limit chat history to the last 10 messages
        $chatHistory = array_slice($chatHistory, -$this->limitHistory);

        /**
         * 🔹 Send the conversation to OpenAI and get the response
         *
         * @param string $model The AI model to use (e.g., "gpt-4", "gpt-4o-mini").
         * @param array $messages The conversation history, structured as an array of message objects.
         * @param int $max_tokens The maximum number of tokens in the response to control length.
         *
         * Additional parameters:
         * - temperature: Controls randomness (0 = more deterministic, 1 = more creative) [Default: 1.0]
         * - top_p: Alternative to temperature, limits token probability distribution [Default: 1.0]
         * - frequency_penalty: Reduces repetition of similar phrases (0-2) [Default: 0.0]
         * - presence_penalty: Encourages introducing new topics (0-2) [Default: 0.0]
         * - n: Number of responses to generate [Default: 1]
         */
        $response = $client->chat()->create([
            'model' => $this->aiModel, // Select the AI model to use
            'messages' => $chatHistory, // Provide the conversation history
            'max_tokens' => $this->maxTokens, // Set the response length limit
            // 'temperature' => 1.0, // Default: higher randomness
            // 'top_p' => 1.0, // Default: considers all tokens in probability distribution
            // 'frequency_penalty' => 0.0, // Default: no penalty for repetition
            // 'presence_penalty' => 0.0, // Default: no encouragement for introducing new topics
            // 'n' => 1, // Default: generates only one response
        ]);

        // 🔹 Extract OpenAI's response
        $reply = $response ? $response['choices'][0]['message']['content'] : null;

        if ($reply) {
            // 🔹 Add the AI's response to chat history
            $chatHistory[] = ['role' => 'assistant', 'content' => $reply];

            // 🔹 Save updated chat history in session
            $session->setFor($this->sessionHistoryName, 'messages', $chatHistory);
        }

        return $reply; // 🔹 Return the AI's response
    }

    /**
     * Retrieves or sets the system prompt for the chat session.
     * 
     * This function checks if a system prompt is already stored in the session.
     * If it exists, it returns the stored value. If not, it sets and returns the
     * provided prompt or falls back to the default system prompt.
     * 
     * Note: If you want to change this system prompt, you need to end old sessions,
     * as the prompt is stored persistently in the session.
     * 
     * @param string $prompt The new system prompt to set (optional).
     * @return string The active system prompt.
     */
    public function systemPrompt($prompt = '') {

        $sessionName = $this->sessionPromptName;

        if(session()->get($sessionName)) {
            return session()->get($sessionName);
        }
        if(!$prompt) {
            $prompt = $this->defaultSystemPrompt;
        }
        session()->set($sessionName, $prompt);
        return $prompt;
    }

    /**
     * Resets the chat session by clearing session history and message count.
     *
     * @return string HTML message indicating the chat has been reset.
     */
    private function resetChat() {
        wire('session')->removeFor($this->sessionHistoryName, 'messages');
        wire('session')->remove($this->sessionCountName);
        return "<p class='alert -success'>{$this->_('New chat')}</p>";
    }

    /**
     * Renders the chat button.
     * @param int $spinSize Thje size of spin effect.
     * @return string HTML content of the chat interface.
     */
    public function render($spinSize = 60, $class = '') {
        if(!$this->enableChat || !$this->apiKey) return '';

        $class = $class ?: page()->template->name;

        $dataTooltip = [];
        if(_isHome()) {
            $dataTooltip = [
                'data-show' => 5,
                'data-start' => 1,
            ];
        }
        // return htmx button
        return _alpine()->lightbox(_spin($spinSize), $this->view(),[
            'class' => "btn-chat {$class} -icon tooltip-button --2xs -bg-none",
            'data-tooltip' => html_entity_decode($this->welcomeMessage),
            ...$dataTooltip
        ]);
    }

    /**
     * Return the chat view including chat history, input form, and controls.
     * @return string HTML content of the chat interface.
     */
    public function view() {

        if(!$this->enableChat || !$this->apiKey) return '';

        // spinner
        $spinner = _spin(70,'indicator','htmx-indicator');

        // render csrf
        $csrfInput = _renderCSRF();

        if(_isEnabledFilesBooster()) {
            $csrfInput = _htmx([
                'elType' => 'p',
                'text' => '',
                'class' => '',
                'hx-trigger' => 'intersect once',
                'hx-swap' => 'outerHTML',
            ])->loadHook('_render-csrf');
        }

        $t_setMessage = __('Set message...');
        $t_submit = __('Submit');
        $t_clear = __('Clear');   

        $style = $this->style();
   
         // Welcome Header
        $header = "<p class='chat-header glowing-corners'>👋 {$this->welcomeMessage}</p>";

        // Downloading chat history from a session
        $session = wire('session');
        $chatHistory = $session->getFor($this->sessionHistoryName, 'messages') ?? [];
        $chatOutput = '';
    
        // Generating HTML from history
        foreach ($chatHistory as $index => $entry) {
            $roleClass = $entry['role'] === 'user' ? 'card mw-xs' : "assistant as_{$index} card";

            // var_dump($entry['role']);
            if($entry['role'] == 'user') {
                $chatOutput .= "<p class='{$roleClass}' hx-boost='false'>{$entry['content']}</p>";
            } else if($entry['role'] != 'system') {
                $spinChat = _spin(50);
                $content = $this->markdownText($entry['content']);
                $copyToclipBoard = $this->copyToclipboard($content);
                $chatOutput .= "<div class='{$roleClass}' hx-boost='false'>{$copyToclipBoard} {$spinChat} $content</div>"; 
            }
        }

        return <<<HTML
            <div class="chat mw-sm">
                {$spinner}
                {$header}
                <div id="chat-output">
                    {$chatOutput} <!-- HTML Chat History -->
                </div>
    
                <form hx-post="/_chat" 
                    hx-target="#chat-output" 
                    hx-swap="beforeend" 
                    hx-indicator="#indicator" 
                    hx-on::after-request="this.reset(); this.querySelector('[name=message]').focus()"
                    hx-headers="{'X-Internal-Request': 'true', 'X-Robots-Tag': 'noindex, nofollow'}"
                >
                    {$csrfInput}
                    <textarea class='message fsc' wrap="soft" name="message" placeholder="{$t_setMessage}" required autofocus></textarea>
                    <button type="submit" class='-primary'>{$t_submit}</button>
                </form>
                
                <button 
                    class='-warning'
                    hx-post="/_chat-reset" 
                    hx-target="#chat-output" 
                    hx-swap="innerHTML" 
                    hx-indicator="#indicator"
                    hx-headers="{'X-Internal-Request': 'true', 'X-Robots-Tag': 'noindex, nofollow'}"
                >
                    {$t_clear}
                </button>
                {$style}
            </div>
        HTML;
    }

    /**
     * Generates and returns the CSS styles for chat elements.
     *
     * @return string HTML style tag containing the chat-related CSS.
     */
    private function style() {
        return Html::styleTag(
        <<<CSS
            .chat {
                font-size: var(--fs-sm);
                @media (min-width: 32rem) {
                    min-width: 30rem;
                }
                .copy-clipboard {
                    width: 30px;
                    height: 30px;
                    float: right;
                    button {
                        margin: 0;
                    }
                }
            }
            .htmx-indicator {
                opacity: 0;
                transition: opacity 700ms ease-in;
                position: fixed;
                top: 0;
                left: 50%;
                width: 220px;
                height: 220px;
            }
            .htmx-request .htmx-indicator {
                opacity:1;
                z-index: 1999;
            }
        CSS);
    }

    /**
     * Loads and renders a Lottie animation.
     *
     * @param string $animation Name of the Lottie animation file.
     * @param int $maxWidth Maximum width of the animation.
     * @param string $class Additional CSS class for styling.
     * @return string Rendered Lottie animation HTML.
     */
    // private function renderLottie($animation, $maxWidth = 80, $class = '') {
    //     return _lottie()->load("{$animation}.lottie",[
    //         'loop' => true,
    //         'controls' => false,
    //         'maxWidth' => $maxWidth,
    //         'autoplay' => true,
    //     ])->render($animation, [
    //         'class' => $class,
    //     ]);
    // }


    /**
     * Copy to clipboard
     * @param string $content
     * @return string 
     */
    public function copyToclipboard($content) {
        return _alpine()->copyToClipboard($content) . 
        _alpine()->copyToClipboard(strip_tags($content),['icon' => 'clipboard-text', 'tooltipText' => _t('copyToClipboardRaw')]); 
    }
    
    /**
     * Checks if the chat request limits have been exceeded.
     *
     * This method counts the number of chat attempts from the current IP 
     * and session, comparing them against the allowed daily and session limits.
     *
     * @return bool True if the limits are exceeded, false otherwise.
     */
    private function exceededLimits() {
        $ip = _getIP();

        // set session name
        $sessionName = $this->sessionCountName;

        $sessionCount = session()->$sessionName;
        session()->$sessionName = ($sessionCount ?? 0) + 1;

        $chatAttempts = 'chat-attempts-' . date('Y-m-d');
        $entries = _getLogEntries($chatAttempts, 'text', ['limit' => 2000]);
    
        if(!$entries || !count($entries)) return '';
        $attempts = $this->filterAttemptsByIp($entries, $ip);

        return count($attempts) > $this->maxRequestPerDay || session()->$sessionName > $this->maxRequestPerSession;
    }

    /**
     * Filters chat log entries by a specific IP address.
     *
     * This method processes log entries to find attempts made by the given IP.
     *
     * @param array $entries List of log entries.
     * @param string $ip The IP address to filter by.
     * @return array|null Filtered attempts or null if no entries exist.
     */
    private function filterAttemptsByIp($entries, $ip) {
        if(!$entries || !count($entries)) return null;
        return array_filter($entries, function ($entry) use ($ip) {
            $logData = json_decode($entry, true);
            return isset($logData['IP']) && $logData['IP'] === $ip;
        });
    }
    
    /**
     * Logs a chat message and response.
     *
     * This method stores chat interactions along with metadata such as IP,
     * user agent, timestamp, and country.
     *
     * @param string $message The user's message.
     * @param string $reply The assistant's reply.
     * @return void
     */
    private function logChat($message, $reply) {
        $message = sanitizer()->textarea($message);
        $reply = sanitizer()->textarea($reply);
        $ip = _getIP();
        $logData = [
            'IP'        => $ip,
            'UserAgent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
            'Timestamp' => date("Y-m-d H:i:s"),
            'Country'   => _getCountryFromIP($ip),
            'Message'   => $message, 
            'Reply'     => $reply,
        ];
        $chatAttempts = 'chat-attempts-' . date('Y-m-d');
        _log($chatAttempts, $logData);
    }

    /**
     * Returns an error message for empty chat messages.
     *
     * @return string HTML-formatted error message.
     */
    private function emptyMessageError() {
        return "<p class='error'>{$this->_('Empty message!')}</p>";
    }

    /**
     * Returns an error message when the request limit is exceeded.
     *
     * @return string HTML-formatted error message.
     */
    private function limitExceededError() {
        return "<p class='card -error'>{$this->_('Request limit reached')}</p>";
    }

    /**
     * Validates if the current request is authorized.
     * Ensures that:
     * - Chat is enabled
     * - API key is set
     * - CSRF token is valid
     * - Request type is allowed (HTMX, Fetch/XHR, POST, or AJAX)
     *
     * @return bool Returns true if the request is valid, false otherwise.
     */
    private function validateChatRequest() {
        if (!$this->enableChat || !$this->apiKey) return false;
        if (!_isValidCSRF()) return false;
        if (!_isHxRequest()) return false;
        return true;
    }

    public function ___execute() {}

    public function ___install() {
        parent::___install();
    }

    public function ___uninstall() {
        parent::___uninstall();
    }

    public function getModuleConfigInputfields(InputfieldWrapper $inputfields) {        
        $this->setEnablechat($inputfields);
        $this->addTextField($inputfields,'api_key',$this->_('ChatGpt API KEY.'),
        "[{$this->_('Get API key')}](https://platform.openai.com/api-keys)", $this->apiKey);
        $this->setSystemPrompt($inputfields);
        $this->addTextField($inputfields,'ai_model',$this->_('Set AI model.'),
        $this->_('gpt-4o-mini, o3-mini, o1-mini, gpt-3.5-turbo, gpt-4o, o1, gpt-4, gpt-4.5'), $this->aiModel);
        $this->addIntegerField($inputfields, 'max_request_per_day', $this->_('Max request per Day'), '', $this->maxRequestPerDay);
        $this->addIntegerField($inputfields, 'max_request_per_session', $this->_('Max request per Session'), '', $this->maxRequestPerSession);

        $this->addIntegerField($inputfields, 'limit_history', $this->_('Limit history'),
        sprintf($this->_('Limit chat history to the last %s messages'), $this->limitHistory), $this->limitHistory);

        $this->addIntegerField($inputfields, 'message_character_limit', $this->_('Message character limit (input tokens) '),
        $this->_('If the message exceeds this limit, it will be truncated, but most of it will still be processed.') . 
        $this->_(' 500 characters ≈ 125 input tokens'), $this->messageCharacterLimit);
        $this->addIntegerField($inputfields, 'max_tokens', $this->_('Max otput tokens per reply'), 
        $this->_('1 token is approximately ¾ of a word in English, so 300 tokens equal about 225 words.'), $this->maxTokens);
    }

    private function setEnablechat($inputfields) {
        /** @var InputfieldCheckbox $f */
        $f = $this->wire()->modules->get('InputfieldCheckbox');
        $f->attr('name', 'enable_chat');
        $f->label = $this->_('Enable Chat');
        if ($this->get('enable_chat')) $f->attr('checked', 'checked');
        $inputfields->add($f);
    }

    private function setSystemPrompt($inputfields) {
        /** @var InputfieldTextArea $f */
        $f = $this->wire()->modules->get('InputfieldTextArea');
        $f->attr('name', 'default_system_prompt');
        $f->label = $this->_('System Prompt.');
        $f->description = "{$this->_('Set default System Prompt.')}";
        $f->attr('value', $this->defaultSystemPrompt);
        $inputfields->add($f);
    }

    private function addTextField($inputfields, $name = '', $label = '', $description = '', $value = '') {
        /** @var InputfieldText $f */
        $f = $this->wire()->modules->get('InputfieldText');
        $f->attr('name', $name);
        $f->label = $label;
        if($description) {
            $f->description = $description;
        }
        $f->attr('value', $value);
        $inputfields->add($f);
    }

    private function addIntegerField($inputfields, $name = '', $label = '', $description = '', $value = '') {
        /** @var InputfieldInteger $f */
        $f = $this->wire()->modules->get('InputfieldInteger');
        $f->attr('name', $name);
        $f->label = $label;
        if($description) {
            $f->description = $description;
        }
        $f->attr('value', $value);
        $inputfields->add($f);
    }

}
