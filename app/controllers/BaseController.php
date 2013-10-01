<?php
/**
 * Created by Trio Design (trio@tgitriodesign.com).
 * Date: 2/27/13
 * Time: 9:24 AM
 * Description: This is the base of all controllers. Responsible for setting up user sessions etc.
 */
namespace App\Controllers;

class BaseController {

	// free actions: actions without needing user logged in
	protected $freeActions = array();

	public $params;
	private $_smarty = null;
	public $currentAction = null;

	public function runAction($action) {
		$this->currentAction = $action;
		$this->beforeAction($action);
		if (method_exists($this, $action)) {
			$this->$action();
		}
	}

	// To be overriden in controllers.
	protected function beforeAction($action = '') {
		if (!empty($this->params['_language'])) {
			$_SESSION['language'] = $this->params['_language'];
		}
	}
	public function __construct() {
		$this->params = $this->prepareParams();
	}

	public function pageTitle(){
		return "";
	}

	public function layout(){
		return "default";
	}

	// Use this to set notification messages before redirect.
	// To show message / error in this page right away,
	// use showMessage
	public function setMessage($message, $as = 'message') {
		$_SESSION[$as] = $message;
	}

	// Display message / error in this page.
	public function showMessage($message, $as = 'message') {
		$this->smarty()->assign(array($as => $message));
	}

	// SubscribeController will return 'subscribe'
	// Admin\HomeController will return 'admin/home'
	public function baseName() {
		$className = get_class($this);
		$className = str_replace(array(__NAMESPACE__ . '\\', 'Controller'), '', $className);
		$r = explode('\\', $className);
		$values = array();
		if (!empty($r)) {
			foreach($r as $item) {
				$values []= lcfirst($item);
			}
		}
		return implode('/', $values);
	}

	public function redirect($path='', $params=array()) {
		header('Location: '. url($path, $params));
		exit;
	}

	public function aRedirect($path) {
		header('Location: '. $path);
		exit;
	}

	public function smarty() {
		if (empty($this->_smarty)) {
			$this->_smarty = new \Smarty();
			$this->_smarty->setCompileDir(BASE_PATH . 'app/smarty/templates_c/');
			$this->_smarty->setConfigDir(BASE_PATH . 'app/smarty/configs/');
			$this->_smarty->setCacheDir(BASE_PATH . 'app/smarty/cache/');
			$this->_smarty->setTemplateDir(app()->themePath().'views/');
			$this->_smarty->setPluginsDir(array(BASE_PATH . 'library/smarty-3.1.13/libs/plugins/',BASE_PATH . 'app/smarty/plugins/'));
		}
		return $this->_smarty;
	}

	// Add parameters to $this->params
	public function addParams($params) {
		$this->params = array_merge($this->params, $params);
	}

	// Combines post and get parameters, and for ajax requests used in lists, take cares of filters and sorting.
	// To decide post or get params, use $_SERVER['REQUEST_METHOD'] (value could be 'GET', 'POST', 'PUT', 'HEAD', 'DELETE', 'OPTIONS')
	private function prepareParams() {
		$params = $_GET;
		$phpinput_params = json_decode(file_get_contents( "php://input" ));
		// combine $_GET with php://input
		if (empty($params) && !empty($phpinput_params)) {
			$params = app()->helper('CommonHelper')->object_to_array($phpinput_params);
		}
		elseif (!empty($params) && !empty($phpinput_params)){
			$phpinput_params = app()->helper('CommonHelper')->object_to_array($phpinput_params);
			$params = array_merge($params, $phpinput_params);
		}

		// combine params with $_POST
		if (empty($params) && !empty($_POST)) {
			$params = $_POST;
		}
		elseif (!empty($params) && !empty($_POST)) {
			// convert to array so returned params are the same with $_POST
			$params = array_merge($params, $_POST);
		}

		// filtering
		$filters = array();
		if (!empty($_GET['filter'])) {
			// example of filter params:
			// [filter] => [{"property":"template_category_id","value":1}]
			$filters_raw = json_decode($_GET['filter']);
			foreach ($filters_raw as $filter_raw) {
				$filters[$filter_raw->property] = $filter_raw->value;
			}
			// $filters variable is going to be ["template_category_id" => 1]
			$params['filters'] = $filters;
		}

		// sorting and pagination
		if (!isset($params['start'])) {
			$params['start'] = null;
		}
		if (!isset($params['limit'])) {
			$params['limit'] = null;
		}

		$sorts = array();
		if (!empty($params['sort'])) {
			// example of sort params:
			// [sort] => [{"property":"id","direction":"ASC"}]
			// in mysql syntax like id ASC, type DESC, others DESC is ok
			$sorts_raw = json_decode($params['sort']);
			foreach ($sorts_raw as $sort_raw) {
				$sorts[] = $sort_raw->property . " " . $sort_raw->direction;
			}
		}

		if (!empty($sorts)) {
			$params['sort_text'] = implode(',', $sorts);
		}
		else {
			$params['sort_text'] = "id ASC";
		}

		return $params;
	}

	// Render a template page along with its wrapper.
	// $dirPath defaults to baseName() method in fetch() method.
	// $template can be string or array of options. Pass array when you need to use different wrappers, for example:
	// array('template' => 'index.tpl', 'wrappers' => array('main' => 'default', 'header' => 'adminHeader', 'footer' => 'adminFooter', 'dir' => 'wrappers/admin/'))
	public function render($template = '', $assign = array(), $dirPath = null) {
		$path = $this->beforeProcessSmarty($template, $assign, $dirPath);
		$this->smarty()->display($path);
	}

	// Before processing smarty template
	protected function beforeProcessSmarty($template = '', $assign = array(), $dirPath = null) {
		if(is_null($dirPath)) $dirPath = $this->baseName() . DS;
		if (empty($template)) {
			$template = 'index.tpl';
		}

		$this->setDefaultAssign();

		$this->smarty()->assign($assign);

		$curExt = explode('.', $template);
		$ext = empty($curExt[1]) ? '.tpl' : '';

		// When given "/some/path", checks "/views/some/path"
		// This is the reason why giving "/" for absolute path is (a tiny weeny bit) faster.
		if (substr($template . $ext, 0,1) == '/') {
			$path = app()->themePath() . 'views' . $template . $ext;
		}
		else {
			// when given "some/path", first checks "/views/[ControllerDir]/some/path"
			$path = app()->themePath() . 'views' . DS . $dirPath . $template . $ext;
			if (!file_exists($path)) {
				// if not found, try to find "/views/some/path"
				$path = app()->themePath() . 'views' . DS . $template . $ext;
			}
		}
		return $path;
	}

	// Fetch a template page into a string.
	public function fetch($template = '', $assign = array(), $dirPath = null){
		$this->setDefaultAssign();
		$path = $this->beforeProcessSmarty($template, $assign, $dirPath);
		return $this->smarty()->fetch($path);
	}

	// Override this in admin site.
	protected function getUser() {
		return app()->getUser();
	}

	// Following code is used to support setting message and error before redirect.
	protected function setupMessages() {
		if (!empty($_SESSION['message'])) {
			$this->smarty()->assign(array('message' => $_SESSION['message']));
			unset($_SESSION['message']);
		}
//		errorLog("is error session empty?");
		if (!empty($_SESSION['error'])) {
			$this->smarty()->assign(array('error' => $_SESSION['error']));
			unset($_SESSION['error']);
		}

	}
	protected function setDefaultAssign(){
		$this->setupMessages();

		if (!empty(app()->config['localTest'])) {
			$this->smarty()->assign(array('localTest' => app()->config('localTest')));
		}

		$this->smarty()->assign(array(
			'isLogin' => false,
			'baseUrl' => app()->config('baseUrl'),
			'themeUrl' => app()->config('baseUrl').'themes/'.app()->config('theme').'/',
			'xmlLang' => app()->xmlLang,
			'language' => app()->language,
			'clientConfig' => app()->clientConfig(),
			'isAjax' => app()->isAjax(),
			'currentUrl' => app()->helper("UrlHelper")->prepareUrl($_GET["_url"]),
			'pageTab' => 0
		));
	}

	public function notFound(){
		$this->aRedirect(app()->config('baseUrl')."404.html");
	}
}
