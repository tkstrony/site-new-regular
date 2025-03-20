<?php namespace ProcessWire;

/**
 * HelperBackup Module for ProcessWire 3.x
 * @link https://processwire.com/docs/modules/development/
 * @link https://processwire.com/api/ref/module/
 */

class HelperBackup extends ProcessProfileHelper {

	// A static method that returns an array of module information.
    public static function getModuleInfo() {

		return [
			'title'    => __('Helper site Backup'),
			'summary'  => __('Creates a copy of your site.'),
			'author'   => 'rafaoski',
			'version'  => '1',
			'icon' => 'database',
			'requires' => ['ProcessProfileHelper','LazyCron'],
			'autoload' => true,
			'page' => array(
				'name' => 'helper-backup',
				'parent' => 'setup',
				'title' => 'Helper Backup'
			),
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

		// set backup path
		config()->setPath('backupFolderPAth', config()->paths->site . 'assets/backups/site-helper');
		$this->set('backupFolderPAth', config()->paths->backupFolderPAth);
		$this->set('countBackupFiles',count(files()->find($this->backupFolderPAth)));
		$this->set('limitBackupFiles', $this->limitBackupFiles ?: 10);
		$this->set('backupDbPAth', $this->backupFolderPAth);
		$this->set('excludeWireFolder', $this->excludeWireFolder);
		$this->set('onlyCronDatabase', $this->onlyCronDatabase);
		$this->set('cronInterval', false);
		$this->set('sendCronFiles', false);
		$this->set('backupEmail', false);
		// $this->remove('removeSomeSettings');
	}

	/**
	 * This is an optional initialization function called before any execute functions.
	 *
	 * If you don't need to do any initialization common to every execution of this module,
	 * you can simply remove this init() method.
	 *
	 */
	public function init() {

		// bd(config()->paths->backupFolderPAth);
		// bd($this->backupFolderPAth);
		if(files()->mkdir($this->backupFolderPAth, true)) {
			// directory created: /site/assets/backups/site-helper/
		}
	}

	/**
	 * This is a method that ProcessWire automatically calls on all autoload modules as soon as the API is ready.
	 */
	public function ready() {

		// If the user is logged in, prevent a new backup via Cron from being created
		if(user()->isLoggedin()) return '';

		$interval = $this->cronInterval;

		if( $interval ) {
			$this->addHook("LazyCron::$interval", $this, 'backupSite');
		}
	}

	/**
	 * This method is executed when a page with your Process assigned is accessed.
 	 *
	 * This can be seen as your main or index function. You'll probably want to replace
	 * everything in this function.
 	 *
	 * Return value is typically direct HTML markup. But it can also be an associative
	 * array of variables to pass to a view file named either 'ProcessHello.view.php'
	 * or 'views/execute.php' (demonstrated here).
	 *
	 * @return string|array
	 *
	 */
	public function ___execute() {

		if (!extension_loaded('zip')) {
			$this->error($this->_('You need the PHP zip extension to create copies of the site. Please install this extension on your PHP server.'));
			return;
		}

		// set headline
		$this->headline($this->_('Backup your site!'));

		// set subhead
		$checkCronInterval = $this->cronInterval ? $this->_('The cron backup job is set to: ') . $this->cronInterval  . '<br>': '';
		$checkCountBackupFiles = $this->countBackupFiles >= $this->limitBackupFiles ?
		sprintf($this->_('Sorry Limit Backup ( db+files ) = %s, you have %s backups in the backup folder ( %s )'),
		$this->limitBackupFiles,$this->countBackupFiles, $this->backupFolderPAth) . $checkCronInterval = '' : __('Limit backup files ( db+files ) is set to ') . $this->limitBackupFiles;

		// send variables to our backup.php view file:
		return [
			// subhead
			'subhead' => $checkCronInterval . ' ' . "<small>$checkCountBackupFiles</small>",
			'strFiles' => $this->_('Zip Files'),
			'strDbFiles' => $this->_('DB Files'),
			'backupFilesForm' => $this->backupFilesForm(),
			'backupAllForm' => $this->backupAllForm(),
			'backupDbFiles' => $this->backupDbFiles(),
			'backupDbForm' => $this->backupDbForm(),
			'backupSiteFiles' => $this->backupSiteFiles(),
			'limitBackupFiles' => $this->countBackupFiles >= $this->limitBackupFiles ? true : false
		];
	}

	/**
	 * Backup the site if LazyCron starting
	 */
	public function backupSite(HookEvent $e) {

		if ($this->countBackupFiles >= $this->limitBackupFiles) {

			// set count files to remove
			$countFilesToRemove = $this->onlyCronDatabase ? 1 : 2;
			$extensions = $countFilesToRemove == 1 ? 'sql' : ['sql','zip'];

			// Find all files
			$getFiles = files()->find($this->backupFolderPAth, ['extensions' => $extensions]);

			if( count($getFiles) ) {

				// Create an array to store file information
				$filesInfo = array();

				foreach ($getFiles as $key => $item) {
					// Get files time
					$fileTime = filemtime($item);

					// Store file information in the array
					$filesInfo[] = array('path' => $item, 'time' => $fileTime);
				}

				// Extract time column to sort by
				$sortColumn = array_column($filesInfo, 'time');

				// Sort filesInfo array based on file modification time in ascending order
				array_multisort($sortColumn, SORT_ASC, $filesInfo);

				// Delete the 2 oldest files
				foreach (array_slice($filesInfo, 0, $countFilesToRemove) as $fileInfo) {
					files()->unlink($fileInfo['path']);
					$this->wire('log')->save('remove-backup', $fileInfo['path']);
				}
			}

		}

		// Set backup to email
		$backupToEmail = $this->sendCronFiles ? true : '';

		// run backup db
		$this->processBackupDb($form = '',['backupToEmail' => $backupToEmail]);

		$backupFiles = true;

		if(!user()->isLoggedin() && $this->cronInterval && $this->onlyCronDatabase) {
			$backupFiles = false;
		}

		if($backupFiles) {
			// run backup files
			$this->processBackupFiles($form = '',['backupToEmail' => $backupToEmail]);
		}
	}

	/**
	 * backup DB form
	 */
	public function backupAllForm() {

		$modules = $this->wire()->modules;
		$backupUrl = $this->input->url;
		$bacupLabelInfo = $this->backupEmail ?: $this->_('You must Set email adress in the module config page!!!');

		/** @var InputfieldForm $form */
		$form = $modules->get('InputfieldForm');
		$form->action = $this->input->url;
		$form->description = $this->_('Backup All');
		$input = $this->wire()->input;

		/** @var InputfieldCheckbox $sendToEmail */
		$sendToEmail = $modules->get('InputfieldCheckbox');
		$sendToEmail->attr('name', 'sendToEmail');
		$sendToEmail->label = $this->_('Additionally, send by e-mail to: ') . $bacupLabelInfo;
		$form->add($sendToEmail);

		/** @var InputfieldSubmit $submit */
		$submit = $modules->get('InputfieldSubmit');
		$submit->attr('name', 'backup_all');
		$submit->val($this->_('Backup All'));
		$submit->class = 'uk-button uk-button-primary uk-button-large';
		$submit->icon = 'life-ring';
		$form->add($submit);

		// check if send files ( to e-mail ) input has been submitted
		$backupToEmail = $input->post($sendToEmail->name) ? true : false;

		// check if form has been submitted
		if($input->post($submit->name)) {
			$this->processBackupFiles($form, ['backupToEmail' => $backupToEmail]);
			$this->processBackupDb($form, ['backupToEmail' => $backupToEmail]);
			session()->redirect($backupUrl);
		}

		// Render form
		return $form->render();
	}

	/**
	 * backup DB form
	 */
	public function backupDbForm() {

		$modules = $this->wire()->modules;

		/** @var InputfieldForm $form */
		$form = $modules->get('InputfieldForm');
		$form->action = $this->input->url;
		$form->description = $this->_('Backup DB');
		$input = $this->wire()->input;
		$bacupLabelInfo = $this->backupEmail ?: $this->_('You must Set email adress in the module config page!!!');

		/** @var InputfieldCheckbox $sendDB */
		$sendDB = $modules->get('InputfieldCheckbox');
		$sendDB->attr('name', 'sendBackupDB');
		$sendDB->label = $this->_('Additionally, send by e-mail to: ') . $bacupLabelInfo;
		$form->add($sendDB);

		/** @var InputfieldSubmit $submit */
		$submit = $modules->get('InputfieldSubmit');
		$submit->attr('name', 'backupDB');
		$submit->val($this->_('Backup'));
		$submit->class = 'uk-button uk-button-primary uk-button-large';
		$submit->icon = 'database';
		$form->add($submit);

		// check if send files ( to e-mail ) input has been submitted
		$backupToEmail = $input->post($sendDB->name) ? true : false;

		// check if form has been submitted
		if($input->post($submit->name)) $this->processBackupDb($form,['backupToEmail' => $backupToEmail]);

		// Render form
		return $form->render();
	}

	/**
	 * backup files form
	 */
	public function backupfilesForm() {

		$modules = $this->wire()->modules;
		$backupUrl = $this->input->url;
		$input = $this->wire()->input;
		$bacupLabelInfo = $this->backupEmail ?: $this->_('You must Set email adress in the module config page!!!');

		/** @var InputfieldForm $form */
		$form = $modules->get('InputfieldForm');
		$form->action = $backupUrl;
		$form->description = $this->_('Backup site files');

		/** @var InputfieldCheckbox $updateDb */
		$updateDb = $modules->get('InputfieldCheckbox');
		$updateDb->attr('name', 'change_db');
		$updateDb->label = $this->_('Check the box to change the access data to the database');

		/** @var InputfieldCheckbox $setDebug */
		$setDebug = $modules->get('InputfieldCheckbox');
		$setDebug->attr('name', 'debug');
		$setDebug->label = $this->_('Debug');

		// Basic input fields
		$inputs = [
			'dbHost'        => config()->dbHost,
			'dbName'        => config()->dbName,
			'dbUser'        => config()->dbUser,
			'dbPass'        => config()->dbPass,
			'dbPort'        => config()->dbPort,
			'timezone'      => config()->timezone,
			'httpHosts'     => WireArray(config()->httpHosts)->implode(','),
		];

		// Advanced inputs are hidden ( changing these options may cause your website to crash )
		$hiddenInputs = [
			'dbEngine'      => config()->dbEngine,
			'userAuthSalt'  => config()->userAuthSalt,
			'tableSalt'     => config()->tableSalt,
			'installed'     => config()->installed,
		];

		$fieldset = $this->wire('modules')->get("InputfieldFieldset");
		$fieldset->attr('name+id', 'dbSetup');
		$fieldset->class = 'toggle-db-config';
		$fieldset->label = $this->_('Custom database connection');
		$fieldset->collapsed = true;

		$form->add($fieldset);

		// Append update DB checkbox
		$fieldset->add($updateDb);

		// Append basic inputs
		foreach ($inputs as $name => $value) {

			/** @var InputfieldText $inputField */
			$inputField = $modules->get('InputfieldText');

			if($name == 'httpHosts') {
				$inputField->description = $this->_('Separate with a comma like: ') . "yourdomain.com, www.yourdomain.com";
			}

			$inputField->label = $name;
			$inputField->attr('name', $name);
			$inputField->attr('value', $value);
			$fieldset->add($inputField);
		}

		// Append debug checkbox
		$fieldset->add($setDebug);

		// Append hidden inputs
		foreach ($hiddenInputs as $name => $value) {
			/** @var InputfieldText $inputField */
			$inputField = $modules->get('InputfieldText');
			$inputField->attr('name', $name);
			$inputField->attr('type', 'hidden');
			$inputField->attr('value', $value);
			$inputField->label = $name;
			$inputField->description = $value;
			$fieldset->add($inputField);
		}

		/** @var InputfieldCheckbox $sendFiles */
		$sendFiles = $modules->get('InputfieldCheckbox');
		$sendFiles->attr('name', 'sendBackupFiles');
		$sendFiles->label = $this->_('Additionally, send by e-mail to: ') . $bacupLabelInfo;
		$form->add($sendFiles);

		/** @var InputfieldSubmit $submit */
		$submit = $modules->get('InputfieldSubmit');
		$submit->attr('name', 'backupFiles');
		$submit->val($this->_('Backup'));
		$submit->class = 'uk-button uk-button-primary uk-button-large';
		$submit->icon = 'clone';
		$form->add($submit);

		// check if send files ( to e-mail ) input has been submitted
		$backupToEmail = $input->post($sendFiles->name) ? true : false;

		// check if send files input has been submitted
		if($input->post($submit->name)) $this->processBackupFiles($form,['backupToEmail' => $backupToEmail]);

		// render form
		return $form->render();
	}

	/**
	 * backup database
	 * @param InputfieldForm $form
	 */
	public function processBackupDb($form = '', $opt = []) {

		// Default options
		$default = [
			'backupToEmail' => false,
		];

		// Merge with default options.
		$opt = array_merge($default, $opt);

		$input = $this->wire()->input;
		$backupUrl = $this->input->url;
		$files = $this->wire()->files;

		// determine where backup will go (should NOT be web accessible)
		$backupDbPath = $this->backupDbPAth;

		// If sumbit form
		if($form) {
			$form->processInput($input->post);
			$errors = $form->getErrors();

			// If errors
			if(count($errors)) {
				$this->message($this->_('There were errors, please fix'));
				session()->redirect($backupUrl);
			}
		}

		// Create a new db backup directory if it does not exist
		if($files->mkdir($backupDbPath,true)) {
			// directory created: /site/backup/db/
		}

		// create a new WireDatabaseBackup instance
		$backup = new WireDatabaseBackup($backupDbPath);

		// Option 1: set the already-connected DB connection
		$backup->setDatabase($this->database);

		// run backup
		$file = $backup->backup();

		if(!$file) {
			$errorNotice = $form ? 'Notice::allowMarkup' : 'Notice::logOnly';
			$this->error($this->_('Backup failed') . ": " . implode("<br>", $backup->errors()), $errorNotice);
		}

		if($opt['backupToEmail']) {
			$this->sendFile($file, $this->_('DB'));
		}

		// If load this function via hook or something else return result
		if(!$form) {
			return $this->wire('log')->save('create-backup', $this->_('Backed up to') . ' - ' . $file);
		}

		// Set message
		$this->message($this->_('Backed up to') . ": $file", Notice::allowMarkup);

		// redirect
		if(!$input->post('backup_all')) {
			session()->redirect($backupUrl);
		}
	}

	/**
	 * backup site files
	 * @param InputfieldForm $form
	 */
	public function processBackupFiles($form = '', $opt = array()) {

		// Default options
		$default = [
			'backupToEmail' => false,
		];

		// Merge with default options.
		$opt = array_merge($default, $opt);

		$input = $this->wire()->input;
		$files = $this->wire()->files;
		$root = $this->wire()->config->paths->root;
		$httpHost = $this->wire()->config->httpHost;
		$date = wireDate('Y-m-d_H-i-s');
		$hostName = pathinfo($httpHost, PATHINFO_FILENAME);
		$backupFolderPAth = $this->backupFolderPAth;
		$zipBackupFile = $backupFolderPAth."{$hostName}_{$date}.zip";
		$backupUrl = $this->input->url;

		// determine where backup will go (should NOT be web accessible)

		if($form) {
			$form->processInput($input->post);
			$errors = $form->getErrors();
			// If errors
			if(count($errors)) {
				$this->error($this->_('There were errors, please fix'));
				session()->redirect($backupUrl);
			}
		}

		// Create a new files backup directory if it does not exist
		if($files->mkdir($backupFolderPAth,true)) {
			// directory created: /site/backup/files/
		}

		// Get all files to backup
		$zipPackage = $files->zip($zipBackupFile, $root, [
			'allowHidden' => true,
			'exclude' => [
				basename($root) .'/.vscode',
				basename($root) . '/site/node_modules',
				basename($root) . '/site/assets/cache/',
				basename($root) . '/site/assets/sessions/',
				basename($root) . '/site/assets/backups/',
				$this->excludeWireFolder ?  basename($root) . '/wire' : '',
			]
		]);

		if(count($zipPackage['errors'])) {
			$message = '';
			$strMessage = $this->_('Problems while creating a zip package with site files');
			foreach($zipPackage['errors'] as $error) {
				$message .= "<li>" . sanitizer()->entities($error) . "</li>";
			}

			$errorNotice = $form ? 'Notice::allowMarkup' : 'Notice::logOnly';
			$this->error($strMessage . ': ' . $message, $errorNotice);

			if($form) {
				session()->redirect($backupUrl);
			}

			return '';
		}

		if($opt['backupToEmail']) {
			$this->sendFile($zipBackupFile, $this->_('Backup Files'));
		}

		// If load this function via hook or something else return result
		if(!$form) {
			return $this->wire('log')->save('create-backup', $this->_('Backed up to') . ' - ' . $zipBackupFile);
		}

		// check if form has been submitted
		if($input->post('change_db')) {
			$this->processCustomDbConfig($zipBackupFile);
		}

		// Set success message
		$this->message($this->_('Backed up to') . ": $zipBackupFile", Notice::allowMarkup);

		// redirect
		if(!$input->post('backup_all')) {
			session()->redirect($backupUrl);
		}
	}

	/**
	 * update site config file ( config.php ) with custom db connection
	 */
	public function processCustomDbConfig($zipBackupFile = '') {

		if(!$zipBackupFile) return '';

		// set module path
		config()->setPath('modulePAth', config()->paths->siteModules . 'ProcessProfileHelper');
		$modulePAth = config()->paths->modulePAth;

		// set custom config path
		config()->setPath('customConfigPath', $modulePAth . 'inc/config-dev.php');
		$customConfigPath = config()->paths->customConfigPath;

		// set backup url
		$backupUrl = $this->input->url;

		// Create new zip instance
		$zip = new \ZipArchive;

		// Open zip file to edit
		if ($zip->open($zipBackupFile) === TRUE) {
		// Basic db options
		$inputDbHost = sanitizer()->removeWhitespace(input()->post('dbHost'));
		$inputDbName = sanitizer()->removeWhitespace(input()->post('dbName'));
		$inputDbUser = sanitizer()->removeWhitespace(input()->post('dbUser'));
		$inputDbPass = sanitizer()->removeWhitespace(input()->post('dbPass'));
		$inputDbPort = sanitizer()->removeWhitespace(input()->post('dbPort'));
		$inputDbEngine = sanitizer()->removeWhitespace(input()->post('dbEngine'));
		$inputHttpHosts = explode(",", input()->post('httpHosts'));
		$inputHttpHosts = "'" . implode("','", $inputHttpHosts) . "'";
		$inputHttpHosts = sanitizer()->removeWhitespace($inputHttpHosts);
		$inputTimezone  = sanitizer()->removeWhitespace(input()->post('timezone'));
		$inputDebug    = input()->post('debug') ? 'true' : 'false';
		// Advanced DB options
		$inputUserAuthSalt = sanitizer()->removeWhitespace(input()->post('userAuthSalt'));
		$inputTableSalt = sanitizer()->removeWhitespace(input()->post('tableSalt'));
		$inputInstalled = sanitizer()->removeWhitespace(input()->post('installed'));
		// Custom Config for put contents
		$customConfig = files()->fileGetContents($customConfigPath);
		$customConfig = str_replace(
			[
				'$dbHost',
				'$dbName',
				'$dbUser',
				'$dbPass',
				'$dbPort',
				'$dbEngine',
				'$httpHosts',
				'$userAuthSalt',
				'$tableSalt',
				'$timezone',
				'$installed',
				'$debug',
			],
			[
				"'$inputDbHost'",
				"'$inputDbName'",
				"'$inputDbUser'",
				"'$inputDbPass'",
				"'$inputDbPort'",
				"'$inputDbEngine'",
				$inputHttpHosts,
				"'$inputUserAuthSalt'",
				"'$inputTableSalt'",
				"'$inputTimezone'",
				$inputInstalled,
				$inputDebug,
			],
			$customConfig);
			// Delete old config.php from zip package
			$zip->deleteName("config.php");
			// Put new content file `config.php` generated from file `config-dev.php`
			$tempDir = files()->tempDir();
			$path = $tempDir->get();
			files()->filePutContents($path . 'config.php', $customConfig);
			// Add custom config to zip package
			$firstFolderName = $zip->getNameIndex(0);
			$zip->addFile($path . 'config.php', $firstFolderName . 'site'.DIRECTORY_SEPARATOR.'config.php');
			$zip->close();
			// Set success message
			$this->message($this->_('Backed up ( witch change DB Configuration ) to') . ": <br>$zipBackupFile <br>", Notice::allowMarkup);
			session()->redirect($backupUrl);

		} else {
			// error message
			$this->error($this->_('Not update corectly db connection'));
			session()->redirect($backupUrl);
		}
	}

	/**
	 * Get list of site files
	 */
	public function backupSiteFiles() {

		$modules = $this->modules;
		$input = $this->input;
		$backupUrl = $input->url;
		$backupSiteFiles = files()->find($this->backupFolderPAth,['extensions' => 'zip']);

		if( !$backupSiteFiles ) return '';

		/** @var InputfieldForm $form */
		$form = $modules->get('InputfieldForm');
		$form->action = $backupUrl;

		foreach ($backupSiteFiles as $key => $zipFile) {
			$file = "zip-file-$key";

			/** @var InputfieldSubmit $getFile */
			$getFile = $modules->get('InputfieldSubmit');
			$getFile->attr('name', "get-$file");
			$getFile->attr('value', $this->_('Get file') . ' ' . $this->humanFilesize($zipFile));
			$getFile->icon = 'download';

			/** @var InputfieldSubmit $removeFile */
			$removeFile = $modules->get('InputfieldSubmit');
			$removeFile->attr('name', "remove-$file");
			$removeFile->attr('value', $this->_('Remove file'));
			$removeFile->class = 'uk-button uk-button-danger';
			$removeFile->icon = 'trash';

			$getFile = $getFile->render();
			$removeFile = $removeFile->render();

			$markup = $modules->get('InputfieldMarkup');
			$markup->value = "<p>$getFile $removeFile <br> $zipFile</p> <hr class='uk-divider-icon'>";
			$form->add($markup);

			if( $input->post("get-$file") ) {
				files()->send($zipFile);
			}

			if( $input->post("remove-$file") ) {
				$removeFile = files()->unlink($zipFile);
				if($removeFile) {
					$this->message($this->_('Remove file') . ": $zipFile");
					session()->redirect($backupUrl);
				}
			}
		}
		// render form
		return $form->render();
	}

	/**
	 * Get list of DB files
	 */
	public function backupDbFiles() {

		$input = $this->input;
		$backupUrl = $input->url;
		$backupDbFiles = files()->find($this->backupDbPAth,['extensions' => 'sql']);
		$modules = $this->modules;

		if( !$backupDbFiles ) return '';

		/** @var InputfieldForm $form */
		$form = $modules->get('InputfieldForm');
		$form->action = $backupUrl;

		foreach ($backupDbFiles as $key => $sqlFile) {
			$file = "sql-file-$key";

			/** @var InputfieldSubmit $getFile */
			$getFile = $modules->get('InputfieldSubmit');
			$getFile->attr('name', "get-$file");
			$getFile->attr('value', $this->_('Get file') . ' ' . $this->humanFilesize($sqlFile));
			$getFile->icon = 'download';

			/** @var InputfieldSubmit $removeFile */
			$removeFile = $modules->get('InputfieldSubmit');
			$removeFile->attr('name', "remove-$file");
			$removeFile->attr('value', $this->_('Remove file'));
			$removeFile->class = 'uk-button uk-button-danger';
			$removeFile->icon = 'trash';

			$getFile = $getFile->render();
			$removeFile = $removeFile->render();

			$markup = $modules->get('InputfieldMarkup');
			$markup->value = "<p>$getFile $removeFile <br> $sqlFile</p><hr class='uk-divider-icon'>";
			$form->add($markup);

			if( $input->post("get-$file") ) {
				files()->send($sqlFile);
			}

			if( $input->post("remove-$file") ) {
				$removeFile = files()->unlink($sqlFile);
				if($removeFile) {
					$this->message($this->_('Remove file') . ": $sqlFile");
					session()->redirect($backupUrl);
				}
			}
		}
		// render form
		return $form->render();
	}

	// Send File via email
	public function sendFile($file = '', $what = '') {

		if( !$this->backupEmail ) {
			return $this->error($this->_('Set the E-Mail adress in the Backup module!'), Notice::logOnly);
		}
		$m = wireMail();
		$m->to($this->backupEmail);
		// ->from('hello@world.com');
		$m->subject($this->_("Send Copy ") . $what);
		// $m->body('This is just a test of a file attachment');
		$m->attachment($file);
		$m->send();
	}

	/**
	 * Get file size
	 * @link https://thisinterestsme.com/php-get-file-size/
	 */
	public function humanFilesize($file) {
		//Get the file size in bytes.
		$fileSizeBytes = filesize($file);
		//Convert the bytes into MB.
		$fileSizeMB = ($fileSizeBytes / 1024 / 1024);
		//269,708 bytes is 0.2572135925293 MB
		//Format it so that only 2 decimal points are displayed.
		return number_format($fileSizeMB, 2) . ' MB';
	}

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
	 * @param InputfieldWrapper $inputfields
	 *
	 */
	public function getModuleConfigInputfields(InputfieldWrapper $inputfields) {
		$modules = $this->wire()->modules;


		/** @var InputfieldCheckbox $f */
		$f = $modules->get('InputfieldCheckbox');
		$f->attr('name', 'excludeWireFolder');
		$f->label = $this->_('Exclude Core Folder ( wire )');
		if($this->get('excludeWireFolder')) $f->attr('checked', 'checked');
		$inputfields->add($f);

		/** @var InputfieldInteger $f */
		$f = $modules->get('InputfieldInteger');
		$f->attr('name', 'limitBackupFiles');
		$f->label = $this->_('Set limit backup files.');
		// $f->description = $this->_('Description');
		$f->notes = $this->_('All files ( zip + sql )');
		$f->attr('value', $this->limitBackupFiles ?: 10);
		$inputfields->add($f);

		/** @var InputfieldRadios $f */
		$f = $modules->get('InputfieldRadios');
		$f->attr('name', 'cronInterval');
		$f->label = $this->_('Set interval');
		$f->addOption('everyMinute', $this->_('every minute'));
		$f->addOption('everyHour', $this->_('every hour'));
		$f->addOption('every2Hours', $this->_('every 2 hours'));
		$f->addOption('every6Hours', $this->_('every 6 hours'));
		$f->addOption('every12Hours', $this->_('every 12 hours'));
		$f->addOption('everyDay', $this->_('every day'));
		$f->addOption('every2Days', $this->_('every 2 days'));
		$f->addOption('every4Days', $this->_('every 4 days'));
		$f->addOption('everyWeek', $this->_('every week'));
		$f->addOption('every2Weeks', $this->_('every 2 weeks'));
		$f->addOption('every4Weeks', $this->_('every 4 weeks'));
		$f->addOption('', $this->_('none'));
		$f->optionColumns = 1; // make it display options on 1 line
		$f->notes = $this->_('Choose wisely'); // like description but appears under field
		$f->attr('value', $this->cronInterval);
		$inputfields->add($f);

		/** @var InputfieldCheckbox $f */
		$f = $modules->get('InputfieldCheckbox');
		$f->attr('name', 'onlyCronDatabase');
		$f->label = $this->_('Task (Cron Interval) only for the database (without Page files)');
		if($this->get('onlyCronDatabase')) $f->attr('checked', 'checked');
		$inputfields->add($f);

		/** @var InputfieldCheckbox $f */
		$f = $modules->get('InputfieldCheckbox');
		$f->attr('name', 'sendCronFiles');
		$f->label = $this->_('Send files to email address if Cron interval is enabled');
		if($this->get('sendCronFiles')) $f->attr('checked', 'checked');
		$inputfields->add($f);

		/** @var InputfieldEmail $f */
		$f = $modules->get('InputfieldEmail');
		$f->attr('name', 'backupEmail');
		$f->label = $this->_('Backup will be send to this email adress');
		if($this->get('backupEmail')) $f->attr('value', $this->backupEmail);
		$inputfields->add($f);
	}
}
