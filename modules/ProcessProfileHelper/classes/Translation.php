<?php namespace ProcessWire;

/**
 * class for manage translations
 */
class Translation {

    public function __construct(
        public $defaultLanguage = '',
    ) {
        $this->defaultLanguage = $this->defaultLanguage ?: 'default';
    }

    /**
     * set translations 
     * @var string $item Get default translation item name
     * @var string $defaultLanguage
     */
    public function get($item, $defaultLanguage = '') {

        $t = [];

        $langFolderPath = 'lang/';
        
        // set language path
        config()->setPath('langPath', config()->paths->templates . $langFolderPath);

        // set default language folder name
        $defaultLanguage = $defaultLanguage ?: $this->defaultLanguage;

        // set file
        $translationFile = config()->paths->langPath . '_' . $defaultLanguage . '.php';

        // Set translations
        if(files()->exists($translationFile)) {
            $t = files()->render("lang/_{$defaultLanguage}.php",[],[
                'cache' => config()->debug ? 0 : 2419200 // No cache in debug mode, 28 days in production
            ]);
        }

        return $t[$item] ?? '';
    }
}
