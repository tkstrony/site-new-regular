<?php namespace ProcessWire;

/**
 * Session messages
 */
class FlashMessage {

    private $sessionSuccess = '_successMessage';
    private $sessionWarning = '_warningMessage';
    private $sessionError = '_errorMessage';

    /**
     * @param array $t Translation strings
     */
    public function __construct(
        public array $opt = [], // options
    ) {
        $this->opt = [
            'redirectTo' => '',
        ];
        // set main options
        $this->opt = array_merge($this->opt, $opt);
    }

    /**
     * Get session message
     * @return string The session message if any
     */
    public function render() {

        // get session mesages
        $success = session()->get($this->sessionSuccess);
        $warning = session()->get($this->sessionWarning);
        $error = session()->get($this->sessionError);

        /** @var Alpine @alpine */
        $alpine = new Alpine;

        // set empty message
        $message = '';

        $opt = [
            'z-index' => time(),
            'position' => 'fixed',
            'hideOnClickOutside' => true,
            'autoHide' => true,
            'autoHideTime' => 5000,
        ];

        if($success) {
            $message = $alpine->alert($success, 'success', $opt);
        }

        if($warning) {
            $message = $alpine->alert($warning, 'warning', $opt);
        }

        if($error) {
            $message = $alpine->alert($error, 'error', $opt);
        }

        if(!$message) return '';

        return $message;
    }

    /**
     * set session && redirect
     *
     * @param null|string $content
     * @param string $to / redirect to page
     * @param string $type
     * @param array $opt
     */
    public function sessionRedirect($content = '', $to = './', $type = '', $opt = array()) {

        if(!$content) return 'Set Flash message content';

        if($this->opt['redirectTo']) {
            $to = $this->opt['redirectTo'];
        }

        $default = [
            'log' => false
        ];
        $opt = array_merge($default, $opt);

        if($opt['log'] == true && $type == $this->sessionSuccess || $type == $this->sessionWarning) {
            wire()->log->message($content);
        }

        if($opt['log'] == true && $type == $this->sessionError) {
            wire()->log->error($content);
        }

        session()->set($type, $content);
        session()->redirect($to);
    }

    /**
     * Set success sesssion
     * @param null|string $content
     * @param string $to - Redirect to page
     * @param array $opt - Default options
     */
    public function success($content = '', $to = './', $opt = array()) {
        return $this->sessionRedirect($content, $to, $this->sessionSuccess, $opt);
    }

    /** Set warning sesssion */
    public function warning($content = '', $to = './', $opt = array()) {
        return $this->sessionRedirect($content, $to, $this->sessionWarning, $opt);
    }

    /** Set error sesssion */
    public function error($content = '', $to = './', $opt = array()) {
        return $this->sessionRedirect($content, $to, $this->sessionError, $opt);
    }

    /**
     * remove sessions
     */
    public function remove() {
        session()->remove($this->sessionSuccess);
        session()->remove($this->sessionWarning);
        session()->remove($this->sessionError);
    }

}

