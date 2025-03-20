<?php namespace ProcessWire;

if (!class_exists('\FlatFilesBooster\EnvManager')) {
	if(files()->exists(__DIR__.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'EnvManager.php')) {
		try {
			require_once(__DIR__.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'EnvManager.php');
		} catch (\Exception $e) {
			echo "Error: " . $e->getMessage();
		}
	}
}

/**
 * Flat Files Booster
 */
class HelperFlatFilesBooster extends ProcessProfileHelper {

	// A static method that returns an array of module information.
    public static function getModuleInfo() {

		return [
			'title'    => __('Flat Files Booster'),
			'summary'  => __('This module helps in rendering flat html files instead of connecting to database.'),
			'author'   => 'rafaoski',
			'version'  => '1',
			'icon' 	   => 'file-code-o',
			'requires' => ['ProcessProfileHelper'],
			'autoload' => false,
			'page' => array(
                'name' => 'helper-flat-files-booster',
                'parent' => 'setup',
                'title' => 'Flat Files Booster'
            ),
		];
    }

	/**
	 * Construct
	 *
	 * Here we set defaults for any configuration settings
	 *
	 */
	public function __construct(

	// Base URL for the Flat files
    private string $flatFilesPath = '',

	// Base URL for the .envFlatFiles
    private string $envFlatFilesPath = '',

	// check file booster
	public bool $checkBoost = false,
 
	) {
		parent::__construct(); // remember to call the parent

		// set files path
		$this->flatFilesPath = config()->paths->root.'flat-files';
		$this->envFlatFilesPath = config()->paths->root.'.envFlatFiles';

		// enable booster
		$this->set('enableFileBooster', '');
		//  Duration of the cache in seconds, for example: 60 = 1 minute, 600 = 10 minutes, 3600 = 1 hour, 86400 = 1 day, 604800 = 1 week, 2419200 = 1 month.
		$this->set('fl_duration', 3600);
	
	}

  	// Initialization function called before any execute functions
	public function init() {

		if($this->get('enableFileBooster')) {
			$this->checkBoost = true;
		}

		// parent::init(); // always remember to call the parent init
	
		// Add hook before processing InputfieldCheckbox
		$this->addHookBefore('InputfieldCheckbox::processInput', function(HookEvent $event) {

			if ($this->input->get('name') !== 'HelperFlatFilesBooster') {
				return; // Exit if not on your module's page
			}

			if (!files()->exists($this->envFlatFilesPath)) {
				return $this->error(__("No found .envFlatFiles"));
			}

			$env = new \FlatFilesBooster\EnvManager(paths()->root . '.envFlatFiles');

			$input = $event->arguments(0);
			$files = $this->wire()->files;

			if($input->clearCache && $input->clearCache == 1) {
				$input->clearCache = 0;
				// clear all files
				if($files->rmdir($this->flatFilesPath, true)) {
					$this->message(__("Delete old files"));
				}
			}

			if($input->fl_duration && $input->fl_duration != $this->fl_duration) {
				$env->set('CACHE_TIME', $input->fl_duration);
				$env->save();
				$this->message(__("Duration time - ") . _secondsToReadableTime($env->get('CACHE_TIME')));
			}

			// clear all files
			if($input->get('enableFileBooster')) {
				$env->set('BOOST', true);
				$env->save();
				return $this->message(__("Enable flat files Boosteer"));
			}

			if($input->get('enableFileBooster') == null) {
				$env->set('BOOST', false);
				$env->save();
				return $this->message(__("Disable flat files Booster"));
			}

			// Populate back arguments (if you have modified them)
			$event->arguments(0, $input);
		});
	}

	// Ready function for additional hooks
	public function ready() {}

	// Execute admin page in menu
    public function ___execute() {
		return null;
	}

	public function removeFlatFiles() {

		$files = $this->wire()->files;
		$root = config()->paths->root;


		if($files->rmdir($this->flatFilesPath, true)) {
			$this->message(__("Remove flat-files folder"));
		}

		// File paths
		$sourceFile = $root . '_bootstrap.php';
		$indexFile = $root . 'index.php';

		// Check if the source file exists
		if (!$files->exists($sourceFile))  return '';

		// Get the content of _bootstrap.php
		$bootstrapContent = $files->fileGetContents($sourceFile);

		// Completely overwrite index.php with the content from _bootstrap.php
		$files->filePutContents($indexFile, $bootstrapContent);

		// Delete _bootstrap.php if the overwrite was successful
		$files->unlink($sourceFile);
		$this->message(__("File - _bootstrap.php was successfully moved to index.php and deleted."));

		// remove other files
		if($files->exists($root . '_flatFileBooster.php')) {
			$files->unlink($root . '_flatFileBooster.php');
			$this->message(__("File - _flatFileBooster.php was successfully deleted."));
		}
		if($files->exists($root . 'Logger.php')) {
			$files->unlink($root . 'Logger.php');
			$this->message(__("File - Logger.php was successfully deleted."));
		}
		if($files->exists($root . 'EnvManager.php')) {
			$files->unlink($root . 'EnvManager.php');
			$this->message(__("File - EnvManager.php was successfully deleted."));
		}
		if($files->exists($root . '.envFlatFiles')) {
			$files->unlink($root . '.envFlatFiles');
			$this->message(__("File - .envFlatFiles was successfully deleted."));
		}

		if($files->exists($root . '_func.php')) {
			$files->unlink($root . '_func.php');
			$this->message(__("File - _func.php was successfully deleted."));
		}
	}

	/**
	 * Called only when your module is installed
	 *
	 * If you don't need anything here, you can simply remove this method.
	 *
	 */
	public function ___install() {
		parent::___install(); // Process modules must call parent method

		$files = $this->wire()->files;
		$root = config()->paths->root;

		if($files->mkdir($this->flatFilesPath,true)) {
			$copyFrom = __DIR__ . DIRECTORY_SEPARATOR ."files";
			if($files->copy($copyFrom, $root)) {
				$this->message(__("Create Flat Files Booster && Enable"));
			}
		}
	}

	/**
	 * Called only when your module is uninstalled
	 *
	 * This should return the site to the same state it was in before the module was installed.
	 *
	 * If you don't need anything here, you can simply remove this method.
	 *
	 */
	public function ___uninstall() {
		parent::___uninstall(); // Process modules must call parent method
		$this->removeFlatFiles();
	}

	/**
	 * Get module configuration inputs
	 *
	 * As an alternative, configuration can also be specified in an external file
	 * with a PHP array. See an example in the /extras/ProcessHello.config.php file.
	 *
	 * @param InputfieldWrapper $inputfields
	 *
	 */
	public function getModuleConfigInputfields(InputfieldWrapper $inputfields) {
		$modules = $this->wire()->modules;

		/** @var InputfieldCheckbox $f */
		$f = $modules->get('InputfieldCheckbox');
		$f->attr('name', 'enableFileBooster');
		$f->label = $this->_('Enable File Booster');
		if($this->get('enableFileBooster')) $f->attr('checked', 'checked');
		$inputfields->add($f);

		/** @var InputfieldRadios $f */
		$f = $modules->get('InputfieldRadios');
		$f->attr('name', 'fl_duration');
		$f->label = $this->_('Set cache time');
		$f->addOption(60, $this->_('every minute'));
		$f->addOption(3600, $this->_('every hour'));
		$f->addOption(3600, $this->_('every 2 hours'));
		$f->addOption(14400, $this->_('every 4 hours'));
		$f->addOption(21600, $this->_('every 6 hours'));
		$f->addOption(43200, $this->_('every 12 hours'));
		$f->addOption(86400, $this->_('every day'));
		$f->addOption(172800, $this->_('every 2 days'));
		$f->addOption(345600, $this->_('every 4 days'));
		$f->addOption(604800, $this->_('every week'));
		$f->addOption(1209600, $this->_('every 2 weeks'));
		$f->addOption(2419200, $this->_('every 4 weeks'));
		$f->optionColumns = 1; // make it display options on 1 line
		$f->notes = $this->_('Choose wisely'); // like description but appears under field
		$f->attr('value', $this->fl_duration);
		$inputfields->add($f);

		/** @var InputfieldCheckbox $f */
		$f = $modules->get('InputfieldCheckbox');
		$f->attr('name', 'clearCache');
		$f->label = $this->_('Clear Cache');
		if($this->get('clearCache')) $f->attr('checked', 'checked');
		$inputfields->add($f);
	}

}
