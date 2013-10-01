<?php
/**
 * Created by Trio Design (trio@tgitriodesign.com).
 * Date: 2/27/13
 * Time: 2:52 PM
 * Description: The application class. You could say this is the factory for Controllers and Helpers.
 *              This class needs to be static (Singleton Pattern) to allow its methods and properties
 *              to be accessed from anywhere in the app.
 * Usage: Instantiate this with Application::instantiate($config) only.
 *        Then use the instance to do various things.
 *        app() method is provided to quickly call the instance.
 */
namespace App;
class Application {
	// All created instances of helpers and controllers are stored here.
	// They are stored so they will not be re-initiated.
	private $_helpers = array();
	private $_controllers = array();
	private $_user = null;

	private $_currentController; // To get current controller from anywhere, do app()->currentController or app()->controller();

	public $config = array();
	public $clientConfig = array();
	public $db = null;

	// Tables Mapping
	public $tableNames = array();

	public $lang = array(); // Loaded lang variables.

	private $_encryptor = null; // Encryptor class for reversible encryption, used in smtp auth password;
	private $_mailer = null;

	public function config($key = null) {
		// list of url configs to change http to https when site is accessed in https.
		$urlConfigs = array('baseUrl');
		if (empty($key)) {
			$results = array();
			foreach($this->config as $key=>$value) {
				if (in_array($key, $urlConfigs) && isHttps()) {
					$value = str_replace('http:', 'https:', $this->config[$key]);
				}
				$results[$key] = $value;
			}
			return $results;
		}
		else {
			$answer = $this->config[$key];
			if (in_array($key, $urlConfigs) && isHttps()) {
				$answer = str_replace('http:', 'https:', $this->config[$key]);
			}
			return $answer;
		}
	}

	public function clientConfig($key = null) {
		// list of url configs to change http to https when site is accessed in https.
		$urlConfigs = array('baseUrl');
		if (empty($key)) {
			$results = array();
			foreach($this->clientConfig as $key=>$value) {
				if (in_array($key, $urlConfigs) && isHttps()) {
					$value = str_replace('http', 'https', $this->clientConfig[$key]);
				}
				$results[$key] = $value;
			}
			return $results;
		}
		else {
			$answer = $this->clientConfig[$key];
			if (in_array($key, $urlConfigs) && isHttps()) {
				$answer = str_replace('http', 'https', $this->clientConfig[$key]);
			}
			return $answer;
		}
	}

	// Application's root directory, used in BaseController to get template
	public function basePath() {
		return BASE_PATH . $this->namespaceToPath() . DS;
	}

	public function themePath() {
		return BASE_PATH . 'themes' . DS . app()->config('theme') . DS . $this->namespaceToPath() . DS;
	}

	public function namespaceToPath() {
		$namespace = strtolower(__NAMESPACE__);
		if (substr($namespace, 0, 1) == '\\') {
			$namespace = substr($namespace, 1);
		}
		return str_replace('\\', DS, $namespace);
	}

	public function setTableNames(){
		$sth = $this->db->execute("SHOW TABLES FROM " . $this->config['db']['database']);
		while ($row=mysqli_fetch_array($sth, MYSQLI_ASSOC)) {
			$temp = $row["Tables_in_" . $this->config['db']['database']];
			$temp = str_replace($this->config['tablePrefix'], '', $temp);
			$temp = lcfirst($temp);
			$this->tableNames[$temp] = $row["Tables_in_" . $this->config['db']['database']];
		}
	}

	public function table($tableName) {
		if(empty($this->tableNames))$this->setTableNames();
		if(!empty($this->tableNames[$tableName]))return $this->tableNames[$tableName];
		else return $this->config['tablePrefix'].$tableName;
	}

	// Get current language based on session.
	// Setup session from get parameter when needed
	public function getLanguage() {
		if (!empty($_GET['_language'])) {
			$_SESSION['language'] = $_GET['_language'];
		}
		if (empty($_SESSION['language'])) {
			$_SESSION['language'] = app()->config('language');
		}
		return $_SESSION['language'];
	}

	// Get current xmlLang based on session.
	// Setup session from get parameter when needed
	public function getXmlLang() {
		if ($this->language == 'indonesian') {
			return 'id';
		}
		else {
			return 'en_us';
		}
	}

	// Get currently active user.
	// http://developers.facebook.com/docs/appsonfacebook/tutorial/
	public function getUser() {
		if (empty($this->_user)) {
			// $fbId = THE_CURRENT_USER_ID;
			$fbId = $this->facebook()->getUser();
			if (!empty($fbId) && !empty($_SESSION["userId"])) {
				$this->_user = \App\Models\User::model()->findByFacebookId($fbId);
			}
		}
		return $this->_user;
	}

	// Get user in admin app. Separate this with getUser since
	// in admin the app is independent of facebook.
	public function getAdmin() {
		if (!empty(app()->config['localTest']) && app()->config('localTest') == true) {
			return \App\Models\User::model()->find()->first();
		}
		else {
			if (empty($this->_user)) {
				$this->_user = \App\Models\Authentication::model()->find();
			}
			return $this->_user;
		}
	}

	public function unsetUser() {
		unset($this->_user);
	}

	// Get currently active user's id or return empty if no user exists
	public function getUserId() {
		if (!empty($this->user)) {
			return $this->user->attributes['id'];
		}
		else {
			return null;
		}
	}

	public function unsetUserId() {
		unset($this->_user);
	}

	public function getUserAttributes() {
		if (!empty($this->user)) {
			return $this->user->attributes;
		}
		else {
			return array();
		}
	}

	// Get controller from raw url e.g. thisurl/is/good
	// Rules will be applied to the url before controller is called.
	public function runControllerFromRawUrl($rawUrl, $additionalParams = array()) {
		$controller = null;
		$urlHelper = $this->helper('UrlHelper');

		$url_r = $urlHelper->prepareUrl($rawUrl);
		$url = $url_r[0];

		// Path is something like controller/action or prefix/controller/action
		$path_r = explode('/', $url);
		if (count($path_r) == 2) {
			list($controllerStr, $actionStr) = $path_r;
		}
		elseif (count($path_r) == 3) {
			$controllerStr = $path_r[0].'\\'.$path_r[1];
			$actionStr = $path_r[2];
		}
		elseif (count($path_r) == 4) {
			$controllerStr = $path_r[0].'\\'.$path_r[1].'\\'.$path_r[2];
			$actionStr = $path_r[3];
		}

		if (!empty($controllerStr)) {
			$controller = $this->controller($controllerStr, $url_r[1]);
			$controller->addParams($additionalParams);

//			errorLog("Running controller ".$controllerStr." action " . $actionStr);
			// Run controller's action
			$controller->runAction($actionStr);
		}

		return $controller;
	}

	// Get controller from system path e.g. controller/action.
	// Add additionalParams for well.. additional parameters.
	public function controller($controllerStr = '', $additionalParams = array()) {
		if (empty($controllerStr)) {
			return $this->currentController;
		}
		if (!isset($this->_controllers[$controllerStr])) {
			$str_r = explode('\\', $controllerStr);
			if (!empty($str_r)) {
				foreach ($str_r as $index=>$str) {
					$str = ucfirst($str);
					$str_r[$index] = $str;
				}
				$controllerStr = implode('\\', $str_r);
			}
			$controllerStrComplete = __NAMESPACE__.'\Controllers\\'.ucfirst($controllerStr).'Controller';
			$this->_controllers[$controllerStr] = new $controllerStrComplete();
		}
		$this->_controllers[$controllerStr]->addParams($additionalParams);
		$this->_currentController = $this->_controllers[$controllerStr];

		// Common lang was defined in method instantiate()
		$langPath_r = explode('\\', $controllerStr);
		if (!empty($langPath_r)) {
			$pathSoFar = '';
			foreach($langPath_r as $index => &$pathItem) {
				$pathItem = lcfirst($pathItem);
				$pathSoFar .= $pathItem . DS;

				// Gets language for each descendant.
				// For example if path is a/b/c
				// Then get a/aLang.json, a/b/bLang.json, and a/b/c/cLang.json.
				$defaultLangPath = $this->themePath().'languages'.DS.'english'.DS.$pathSoFar.$pathItem.'Lang.json';
				if (file_exists($defaultLangPath)) {
					$additionalLang = file_get_contents($defaultLangPath,true);
					if (!empty($additionalLang)) {
						// $this->lang was first set in method instantiate().
						if (is_array(json_decode($additionalLang, true))) {
							$this->lang = array_merge($this->lang, json_decode($additionalLang, true));
						}
						else {
							errorLog('Invalid language file: '. $defaultLangPath);
						}
					}
				}

				$langPath = $this->themePath().'languages'.DS.app()->language.DS.$pathSoFar.$pathItem.'Lang.json';
				if (file_exists($langPath)) {
					$additionalLang = file_get_contents($langPath,true);
					if (!empty($additionalLang)) {
						// $this->lang was first set in method instantiate().
						$additionalLang = json_decode($additionalLang, true);
						if(!empty($additionalLang))
							$this->lang = array_merge($this->lang, $additionalLang);
					}
				}
			}
		}

		return $this->_controllers[$controllerStr];
	}

	public function getCurrentController() {
		return $this->_currentController;
	}

	// Creates a helper instance or uses an existing one.
	public function helper($helperClass) {
		if (!isset($this->_helpers[$helperClass])) {
			$helperClass = __NAMESPACE__.'\Helpers\\'.$helperClass;
			$this->_helpers[$helperClass] = new $helperClass();
		}
		return $this->_helpers[$helperClass];
	}

	public function closeDb() {
		$this->db->close();
	}

	private function __construct($config=array()) {
		if (!empty($config)) {
			foreach ($config as $key => $value) {
				$this->config[$key] = $value;
			}

			// Setup db
			$this->db = new \Library\Database\DB($this->config['db']['server'], $this->config['db']['username'], $this->config['db']['password'], $this->config['db']['database']);
			if ($this->db->error_code<0) {
				echo "Failed to connect to database";
				die;
			}
		}
	}

	// Use this instead
	public static function instantiate($config=array()) {
		static $instance = null;
		if ($instance === null) {
			$instance = new Application($config);

			$defaultLangPath = app()->themePath().'languages'.DS.'english'.DS.'commonLang.json';
			$instance->lang = json_decode(file_get_contents($defaultLangPath), true);
			if (empty($instance->lang)) {
				trigger_error("Please fix commonLang.json file ($defaultLangPath).", E_USER_ERROR);
			}

			$langPath = app()->themePath().'languages'.DS.app()->language.DS.'commonLang.json';
			if (file_exists($langPath)) {
				$instance->lang = array_merge($instance->lang, json_decode(file_get_contents($langPath), true));
				if (empty($instance->lang)) {
					trigger_error("Please fix commonLang.json file ($langPath).", E_USER_ERROR);
				}
			}
		}
		return $instance;
	}

	public function __set($name, $value)
	{
	}

	// This is a magic function so that app()->configParam may get
	// app()->config('configParam') and app()->user may get app()->getUser()
	public function __get($name)
	{
		if (method_exists($this, 'get'.ucfirst($name))) {
			return call_user_func(array($this, 'get'.ucFirst($name)));
		}
		else {
			$trace = debug_backtrace();
			trigger_error(
				'Undefined property via __get(): ' . $name .
					' in ' . $trace[0]['file'] .
					' on line ' . $trace[0]['line'],
				E_USER_NOTICE);
			return null;
		}
	}

	// This should return true for every magic property so
	// that empty(app()->magicProperty) would work.
	public function __isset($name)
	{
		if (method_exists($this, 'get'.ucfirst($name))) {
			return true;
		}
	}

	public function __unset($name)
	{
		if (method_exists($this, 'unset'.ucfirst($name))) {
			return call_user_func(array($this, 'unset'.ucFirst($name)));
		}
	}

	public function isAjax(){
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}

	public function mailer() {
		if (empty($this->_mailer)) {
			$this->_mailer = new Mailer();
		}
		return $this->_mailer;
	}
}