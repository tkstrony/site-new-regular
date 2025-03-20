<?php namespace ProcessWire;

/**
 * Maintenance mode
 */

class HelperMaintenance extends ProcessProfileHelper {

	// A static method that returns an array of module information.
    public static function getModuleInfo() {

		return [
			'title'    => __('Helper Maintenance'),
			'summary'  => __('Maintenance mode.'),
			'author'   => 'rafaoski',
			'version'  => '1',
			'icon' 	   => 'lock',
			'requires' => ['ProcessProfileHelper'],
			'autoload' => false,
		];
    }

	/**
	 * Construct
	 *
	 * Here we set defaults for any configuration settings
	 *
	 */
	public function __construct() {
		// parent::__construct(); // remember to call the parent
		// set maintenance mode
		$this->set('maintenance_mode', '');
		$this->set('maintenance_mode_label', $this->maintenance_mode_label ?: _t('maintenance'));
		$this->set('maintenance_mode_user_message', '');
	}

	/**
	 * This is an optional initialization function called before any execute functions.
	 *
	 * If you don't need to do any initialization common to every execution of this module,
	 * you can simply remove this init() method.
	 *
	 */
	public function init() {
		// parent::init(); // always remember to call the parent init

		$input = $this->wire()->input;

		if($this->maintenance_mode) {

			setting(['maintenanceMode' => true]);

			$this->addHookAfter('Page::render', $this, 'maintenanceMode');

			if(!$input->post('send_form_' . $input->name)) {
				$this->warning($this->maintenance_mode_label);
			}
		}
		if($input->post('maintenance_mode')) {
			$this->warning($this->maintenance_mode_label);
		}
	}

	/**
	 * Called after init(), after API ready. Note that ready() applies to 'autoload' modules only.
	 */
	public function ready() {}

	/**
	 * Method for maintenance mode view
	 */
	public function maintenanceMode($event) {
		// Get page
		$page = $event->object;

		// we'll only apply this to the front-end of our site
		if($page->template == 'admin' || $page->editable) return '';

		// tell ProcessWire we are replacing the method we've hooked
		// $event->replace = true;

		$vars = [
			'content' => $this->maintenance_mode_user_message,
		];
		$event->return = files()->render('ProcessProfileHelper/HelperMaintenance/_maintenance-html-content.php',$vars,['defaultPath' => paths()->siteModules]);	
	}


	/**
	 * Execute admin page
	 */
    public function ___execute() {}

	/**
	 * Called only when your module is installed
	 *
	 * If you don't need anything here, you can simply remove this method.
	 *
	 */
	public function ___install() {
		parent::___install(); // Process modules must call parent method
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
		$input = $this->wire()->input;

		/** @var InputfieldCheckbox $f */
		$f = $modules->get('InputfieldCheckbox');
		$f->attr('name', 'maintenance_mode');
		$f->label = $this->_('Maintenance Mode');
		if($this->get('maintenance_mode')) $f->attr('checked', 'checked');
		$inputfields->add($f);

		/** @var InputfieldText $f */
		// $f = $modules->get('InputfieldText');
		$f = $modules->get('InputfieldTinyMCE');
		$f->attr('name', 'maintenance_mode_user_message');
		$f->label = $this->_('Message for users.');
		// $f->description = $this->_('Description');
		$f->attr('value', $this->maintenance_mode_user_message);
		$inputfields->add($f);

		/** @var InputfieldText $f */
		$f = $modules->get('InputfieldText');
		$f->attr('name', 'maintenance_mode_label');
		$f->label = $this->_('Maintenance text label.');
		$f->attr('value', $this->maintenance_mode_label);
		$inputfields->add($f);

		/** @var InputfieldHidden $f */
		$f = $modules->get('InputfieldHidden');
		$f->attr('name', 'send_form_' . $input->name);
		$f->attr('value', 1);
		$inputfields->add($f);
	}

}
