<?php namespace ProcessWire;

/**
 * class for manage site settings
 */
class Site {

    public function __construct(

        public $home = null,
        public $personalDataPage = null,
        public $contactPage = null,
        public $blogPage = null,
        public $contactInfo = null,
        public $socialProfiles = null,
        public $usefulLinks = null,
        public $guestNotification = null,

        public $url = '',
        public $name = '',
        public $description = '',
        public $email = '',
        public $phone = '',
        public $map = '',
        public $address = '',
        public $logo = null,
        public $favicon = null,

        public $copyright = '',
        public $gaCode = '', // Google analytics tracking code
        public $gvCode = '', // Google Webmaster code
        public $enable_csp = false, // content security policy
        public $saveGuestVisitLogs = false,
        public $disableComments = false,
        public $disableContactForm = false,
        public $saveContactLogs = false,
        public $hxBoost = false, // htmx boost
    ) {

        $this->home = pages()->get(1);
        $home = $this->home;

        if (!$home || !$home->opt || !$home->adv_opt) {
            return;
        }

        $this->personalDataPage = pages()->get("template=personal-data");
        $this->contactPage = pages()->get("template=contact");
        $this->blogPage = pages()->get("template=blog");
        $this->contactInfo = $this->contactPage->contact_info;
        $this->socialProfiles = $home->social_profiles;
        $this->usefulLinks = $home->useful_links;
        
        $opt = $home->opt;
        $advOpt = $home->adv_opt;
        
        $this->guestNotification = page()->guest_notification && page()->guest_notification->cbox_1 ? page()->guest_notification : $home->guest_notification;
        $this->url = $home->httpUrl() ?? $this->url;
        $this->name = $opt->txt_1 ?? $this->name;
        $this->description = $opt->txtarea_1 ?: '';
        $this->email = $this->contactInfo->get('email');
        $this->phone = $this->contactInfo->get('txt_1');
        $this->map = $this->contactInfo->get('txtarea_1');
        $this->address = $this->contactInfo->get('txt_2');

        $this->logo = $opt->images?->getTag('logo') ?: $this->logo;
        $this->favicon = $opt?->images?->getTag('favicon') ?: $this->favicon;

        $this->copyright = $advOpt->get('copyright') ? $advOpt->get('copyright')->txt_1 : '';
        $this->gaCode = $advOpt->get('ga_code') ? $advOpt->get('ga_code')->txt_1 : '';
        $this->gvCode = $advOpt->get('gv_code') ? $advOpt->get('gv_code')->txt_1 : '';;
        $this->saveGuestVisitLogs = $advOpt->get('sgv_logs') ? true : false;
        $this->enable_csp = $advOpt->get('enable_csp') ? true : false;
        $this->disableComments = $advOpt->get('disable_comments') ? true : false;
        $this->disableContactForm = $advOpt->get('disable_cf') ? true : false;
        $this->saveContactLogs = $advOpt->get('save_cf-logs') ? true : false;
        $this->hxBoost = $advOpt->get('hx_boost') ? true : false;
    }

    /**
     * Retrieves and displays a guest message as an alert.
     *
     * This method determines whether a guest message should be shown based on the `showGuestMessage` property.
     * If the message is to be shown, it retrieves the message details from the `opt` property and generates an alert.
     * The type of alert is set based on whether the message includes a `cbox` (error if `cbox` is present, otherwise success).
     * The alert content is generated using the `Alpine::alert` method with specific HTML element, position, and visibility options.
     *
     * If the message contains internal links, the method checks if the current page matches any of these links.
     * The message is only returned if a match is found, otherwise it is returned regardless of the page check.
     *
     * @return string The HTML markup for the guest message alert if conditions are met; otherwise, an empty string.
     */
    public function guestNotification() {
        // Check if guest message display is enabled
        if (!$this->guestNotification->get('cbox_1')) {
            return ''; // Return an empty string if the guest message should not be shown
        }

        // Retrieve the guest message details from the options
        $notification = $this->guestNotification;

        // Determine the type of alert based on the presence of the 'cbox' property in the message
        $type = $notification->get('alerts')->title ?: 'success';

        // notification body
        $body = $notification->get('body');

        if(!$body) return '';

        // Generate the alert content using Alpine's alert method with specified options
        $content = _alpine()->alert($body, $type, [
            'htmlElement' => 'div', // Use a 'div' element for the alert
            'margin' => 'var(--sp-xl) var(--sp-xs)',
            'hideOnClickOutside' => false // Do not hide the alert when clicking outside of it
        ]);

        // If the message contains internal links, check if the current page matches any of them
        if ($notification->site_pages && $notification->site_pages->count) {
            $page = wire()->page; // Get the current page

            // Find internal links that match the current page ID
            $find = $notification->site_pages->find("id=$page->id");

            // Return the alert content if a matching internal link is found
            if ($find->count) {
                return $content;
            }
        } else {
            // Return the alert content if there are no internal links or if the page check does not apply
            return $content;
        }

    }

    /**
     * Get social profiles
     * @param PageArray $socialProfiles
     */
    public function socialProfiles($socialProfiles = null) {
        if(!$socialProfiles || !$socialProfiles instanceof PageArray) {
            $socialProfiles = $this?->socialProfiles;
        }

        if(!$socialProfiles && !$socialProfiles->count) return '';

        $out = '';
        $socialProfLabel = _t('socialProfiles');
        foreach ($socialProfiles as $item) {
            $icon = _icon($item->name.'-logo');
            if($item->txt_1) {
                $out .= Html::li(Html::a($item->txt_1, $icon . '&nbsp;-&nbsp;' . $item->title, [
                    'class' => "social-{$item->name}",
                    'blank' => true
                ]));
            }
        }
        $out = Html::ul($out, ['class' => 'card']);

        return Html::div(Html::h3($socialProfLabel,['class' => 'glowing-corners -red','x-intersect' => "animate(\$el, 'fade-slide-left')"]) . $out, ['class' => _basename(__FUNCTION__)]);
    }

    /**
     * Site Links
     * @param PageArray $usefulLinks
     */
    public function usefulLinks() {

        // Define the CSS class for this section based on the method name
        $class = _basename(__FUNCTION__);

        $label = _t('usefLinks');

        $usefulLinks = $this->usefulLinks;
        
        $out = '';
        if($usefulLinks && $usefulLinks->count) {
            foreach ($usefulLinks as $item) {
                $link = $item->link;
                if($link->txt_1 && $link->url_1) {
                    $target = $link->cbox_1 ? " target='_blank'" : '';
                    $out .= <<<HTML
                        <li><a href='{$link->url_1}'{$target}>{$link->txt_1}</a></li>
                    HTML;
                }
            }
        }

        if($this->home->site_pages && $this->home->site_pages->count) {
            $out .= $this->home->site_pages->each(<<<HTML
                <li><a href='{url}'>{title}</a></li>
              HTML);
        }

        // Return the HTML markup for the links
        return
        <<<HTML
            <div class='{$class}'>
                <h3 class='glowing-corners -indigo' x-intersect="animate(\$el, 'fade-slide-right')">$label</h3>
                <ul class=''>$out</ul>
            </div>
        HTML;
    }

     /**
     * Generates HTML markup for displaying contact information.
     * 
     * @param Site $site
     *
     * This method constructs an HTML snippet that displays contact details such as email, phone, and address.
     * It also optionally includes a map and a contact form, based on the configuration and conditions.
     *
     * The contact information is retrieved from the `contactInfo` property, and the details are formatted into an unordered list.
     * Additionally, if a map is available, a button to open the map in a modal is included. Similarly, if the contact form is enabled,
     * a button to open the contact form in a modal is also included.
     *
     * Conditions:
     * - If there is no map information, the map button is hidden.
     * - If the contact form is disabled (as determined by the `Site` object), the contact form button is hidden.
     * - If the current page is the contact page, both the map and contact form buttons are hidden.
     *
     * @return string The HTML markup for the contact information, including the list of contact details, and optionally map and contact form modals.
     */
    function contactInfo($site = null) {
 
        if(!$site) {
            $site = $this;
        }

        // Define the CSS class for this section based on the method name
        $class = _basename(__FUNCTION__);

        // Retrieve the label for the contact info section from the options
        $cinfoLabel = _t('contactUs');

        // Generate the HTML list items for email, phone, and address
        $list = $site->email ? Html::li(_t('email') . ': ' . $site->email) : '';
        $list .= $site->phone ? Html::li(_t('phone') . ': ' . $site->phone) : '';
        $list .= $site->address ? Html::li(_t('address') . ': ' . $site->address) : '';

        // Generate the map button if map information is available
        $map = $site->map ? _htmx([
            'modal' => true,
            'text' => _icon('map-pin'),
            'class' => 'btn -icon',
            'title' => _t('companyMap'),
            'requestVariable' => '?disable_lozad=1',
        ])->getPartial('_companyMap') : '';

        $contactForm = !$site->disableContactForm ? _htmx([
            'modal' => true,
            'text' => _icon('envelope'),
            'class' => 'btn -icon',
            'title' => _t('formLegend'),
            'requestVariable' => '?pageID=' . page()->id
        ])->getPartial('_contactForm') : '';

        // If the current page is the contact page, hide both map and contact form buttons
        if (page()->id == _site()->contactPage->id) {
            $map = $contactForm = '';
        }

        if(!$list) return '';

        // Return the HTML markup for the contact information section
        return
        <<<HTML
            <div class='{$class}'>
                <h3 class='glowing-corners -orange' x-intersect="animate(\$el, 'fade-slide-left')">$cinfoLabel</h3>
                <ul class='card -list-none'>
                    $list
                    <li>$map $contactForm</li>
                </ul>
                
        
            </div>
        HTML;
    }

    /**
     * return copyright info
     * @param string $copyText
     */
    function copyright($copyText = '') {
        $siteLink = Html::a($this->url, $this->name);
        $procLink = Html::a('https://processwire.com/', 'ProcessWire CMS');
        $text = sprintf(_t('copyright'), $siteLink, $procLink);
        $text = $this->copyright ? $siteLink . '. ' . $this->copyright : $text;
        if($copyText) {
            $text = $copyText;
        }
        return Html::p('&copy; ' .datetime('Y'). ' - ' .$text, ['id' => 'copyright', 'class' => 'copyright']);
    }

}
