<?php
/**
 * Created by Jay from Trio Design (jay@tgitriodesign.com).
 * Date: 10/12/13
 * Time: 10:01 AM
 * Description: For use with Skully MVC - Setup a lang files editor quickly by
 * extending this class into a controller.
 */

namespace Library\LangEditor;

class LangEditor
{
	private $_smarty = null;
	public $config = null;
	public $languages = array();
	private $mode = ''; // file or dir
	private $itemCompletePath = ''; // complete path to currently edited item

	function __construct($config = array()) {
		include_once('http_build_url.php');
		include_once('config.php');
		$this->config = new LangEditorConfig($config);
		// get choice of languages from the dirs.
		$langPaths = glob($this->config->langBasePath.'*');
		foreach($langPaths as $path) {
			$this->languages[] = str_replace($this->config->langBasePath, '', $path);
		}
	}

	// Get all directories / files ("items") of given path (path could be dir or file).
	// An item follows this format:
	// array(
	//   'type' => ['dir' or 'file' or 'entry'],
	//   'name' => ['admin' or '_adminLang.json' or 'title'],
	//   'value' => [only give a value when type is 'entry'],
	//   'path' => [path to dir or file, entry does not need this],
	//   'languages' => [for files, array of path to files with on different languages]
	// )
	// path is 'stuff/morestuff' for dir, or '[language]/stuff/morestuff/file.json' for file.
	function getItems($path = '') {
		$path = $this->sanitizePath($path);
		$this->prepareMode($path);
		$items = array();
		$completePath = $this->itemCompletePath;
		// If path is dir, glob it.
		if ($this->mode == 'dir') {
			if (substr($completePath,-1,1) != '/') {
				$completePath.='/';
			}
			$filepaths = glob($completePath.'*');
			foreach($filepaths as $filepath) {
				if (is_dir($filepath)) {
					$items []= array('type' => 'dir', 'name' => substr($filepath,strrpos($filepath, '/')+1), 'path' => str_replace($this->config->langBasePath.$this->config->mainLanguage.'/', '', $filepath));
				}
				elseif(is_file($filepath)) {
					$item = array('type' => 'file', 'name' => substr($filepath,strrpos($filepath, '/')+1), 'languages' => array(), 'path' => str_replace($this->config->langBasePath.$this->config->mainLanguage, '', $filepath));
					foreach($this->languages as $language) {
						$langPath = $this->config->langBasePath.$language.$item['path'];
						$pathDisp = $language.$item['path'];
						if (file_exists($langPath)) {
							$item['languages'] []= array('path' => $pathDisp, 'name' => $language);
						}
					}
					$items []= $item;
				}
			}
		}
		else {
			if (is_file($completePath)) {
				$entries = $this->readFile($completePath);
				foreach($entries as $key=>$value) {
					$items []= array('type' => 'entry', 'name' => $key, 'value' => $value, 'path' => $path);
				}
			}
		}
		return $items;
	}

	private function prepareMode($path) {
		$this->itemCompletePath = $this->config->langBasePath.$this->config->mainLanguage.'/'.$path;
		if (is_dir($this->itemCompletePath)) {
			$this->mode = 'dir';
		}
		else {
			$this->itemCompletePath = $this->config->langBasePath.$path;
			if (file_exists($this->itemCompletePath)) {
				$this->mode = 'file';
			}
		}
	}

	function getItem($path = '', $key = '') {
		$item = array();
		$entries = $this->readFile($this->config->langBasePath.$path);
		if (!empty($entries)) {
			$item['key'] = $key;
			$item['value'] = $entries[$key];
			$item['path'] = $path;
		}
		return $item;
	}
	private function readFile($path = '') {
		$entries = array();
		if (file_exists($path)) {
			$entriesJson = file_get_contents($path);
			$entries = json_decode($entriesJson, true);

			if (!is_array($entries)) {
				echo "Invalid json format";
				$entries = array();
			}
		}
		return $entries;
	}

	protected function sanitizePath($path) {
		// Removing '/' suffix and prefix.
		if (substr($path,-1,1) == '/') {
			$path=substr($path,0,-1);
		}
		if (substr($path,0,1) == '/') {
			$path = substr($path, 1);
		}
		return $path;
	}

	// Array of array('label' => string, 'url' => string, 'active' => boolean)
	function getBreadcrumbs($path = '', $key = '') {
		$path = $this->sanitizePath($path);
		$breadcrumbs = array(array('label' => 'root', 'url' => $this->config->indexUrl, 'active' => ($path == '')));
		$path_r = explode('/', $path);
		// If CURRENT path is file, remove the language file at first path (i.e. english/path/nameLang.json)
		$language = '';
		if (file_exists($this->config->langBasePath.$path)) {
			$language = array_shift($path_r);
			$path = implode('/', $path_r);
		}
		if (!empty($path_r)) {
			$curUrl = '';
			foreach ($path_r as $pathItem) {
				$curUrl = $curUrl.'/'.$pathItem;
				if (substr($curUrl,0,1) == '/') {
					$curUrl = substr($curUrl, 1);
				}
				$active = ($curUrl == $path && empty($key));
				if (!empty($language) && is_file($this->config->langBasePath.$language.'/'.$curUrl)) {
					$curUrl = $language.'/'.$curUrl;
					$pathItem = $pathItem . " ($language)";
				}
				$this->smarty()->loadPlugin('smarty_function_addUrlParams');
				$url = smarty_function_addUrlParams(array('url' => $this->config->indexUrl, 'path' => $curUrl), $this->smarty());
				$breadcrumbs []= array('label' => $pathItem, 'url' => $url, 'active' => $active);
			}
		}

		if (!empty($key)) {
			$breadcrumbs []= array('label' => $key, 'url' => '', 'active' => true);
		}

		return $breadcrumbs;
	}

	protected function beforeAction() {
		$message = '';
		if (!empty($_GET['message'])) {
			$message = $_GET['message'];
		}
		$this->smarty()->assign(array(
			'message' => $message,
		));
	}

	// Setup links to other languages while file / entry of a language is displayed.
	public function getOtherLanguages($path = '', $key = '') {
		$path = $this->sanitizePath($path);
		$this->prepareMode($path);
		$results = array();
		if ($this->mode =='file') {
			$path_r = explode('/', $path);
			$currentLanguage = $path_r[0];
			foreach($this->languages as $language) {
				if ($language != $currentLanguage) {
					$this->smarty()->loadPlugin('smarty_function_addUrlParams');
					$path_r[0] = $language;
					if (!empty($key)) {
						$url = smarty_function_addUrlParams(array('url' => $this->config->editUrl, 'path' => implode('/', $path_r), 'key' => $key), $this->smarty());
					}
					else {
						$url = smarty_function_addUrlParams(array('url' => $this->config->indexUrl, 'path' => implode('/', $path_r)), $this->smarty());
					}
					$results []= array('name' => $language, 'url' => $url);
				}
			}
		}
		return $results;
	}

	function actionIndex() {
		if ($this->config->active) {
			$this->beforeAction();
			$styles = file_get_contents($this->config->libBasePath.'frontend/css/main.css');
			$scripts = file_get_contents($this->config->libBasePath.'frontend/js/main.js');
			$path = '';
			if (!empty($_GET['path'])) {
				$path = urldecode($_GET['path']);
			}
			$items = $this->getItems($path);

			$this->smarty()->loadPlugin('smarty_function_addUrlParams');
			$updateUrl = smarty_function_addUrlParams(array('url' => $this->config->updateUrl, 'path' => $path), $this->smarty());

			$otherLanguages = $this->getOtherLanguages($path);
			$this->smarty()->assign(array(
				'otherLanguages' => $otherLanguages,
				'mode' => $this->mode,
				'styles' => $styles,
				'bootstrapBaseUrl' => $this->config->bootstrapBaseUrl,
				'bootstrapThemeUrl' => $this->config->bootstrapThemeUrl,
				'ckEditorUrl' => $this->config->ckEditorUrl,
				'jqueryUrl' => $this->config->jqueryUrl,
				'scripts' => $scripts,
				'items' => $items,
				'indexUrl' => $this->config->indexUrl,
				'editUrl' => $this->config->editUrl,
				'updateUrl' => $updateUrl,
				// todo: create & destroy feature
				'addUrl' => $this->config->addUrl,
				'createUrl' => $this->config->createUrl,
				'destroyUrl' => $this->config->destroyUrl,
				'breadcrumbs' => $this->getBreadcrumbs($path)
			));
			$this->smarty()->display('index.tpl');
		}
	}

	public function actionEdit() {
		if ($this->config->active) {
			$this->beforeAction();
			$styles = file_get_contents($this->config->libBasePath.'frontend/css/main.css');
			$scripts = file_get_contents($this->config->libBasePath.'frontend/js/main.js');
			$path = '';
			$key = '';
			if (!empty($_GET['path'])) {
				$path = urldecode($_GET['path']);
			}
			if (!empty($_GET['key'])) {
				$key = $_GET['key'];
			}
			$item = $this->getItem($path, $key);

			$this->smarty()->loadPlugin('smarty_function_addUrlParams');
			$updateUrl = smarty_function_addUrlParams(array('url' => $this->config->updateUrl, 'path' => $path, 'key' => $key), $this->smarty());
			$previewUrl = smarty_function_addUrlParams(array('url' => $this->config->editUrl, 'path' => $path, 'key' => $key, 'preview' => true), $this->smarty());

			$otherLanguages = $this->getOtherLanguages($path, $key);

			$this->smarty()->assign(array(
				'otherLanguages' => $otherLanguages,
				'styles' => $styles,
				'bootstrapBaseUrl' => $this->config->bootstrapBaseUrl,
				'bootstrapThemeUrl' => $this->config->bootstrapThemeUrl,
				'ckEditorUrl' => $this->config->ckEditorUrl,
				'jqueryUrl' => $this->config->jqueryUrl,
				'scripts' => $scripts,
				'item' => $item,
				'indexUrl' => $this->config->indexUrl,
				'updateUrl' => $updateUrl,
				'previewUrl' => $previewUrl,
				// todo: create & destroy feature
				'destroyUrl' => $this->config->destroyUrl,
				'breadcrumbs' => $this->getBreadcrumbs($path, $key)
			));
			if (!empty($_GET['preview']) && $_GET['preview']) {
				$this->smarty()->display('preview.tpl');
			}
			else {
				$this->smarty()->display('edit.tpl');
			}
		}
	}

	public function actionUpdate() {
		if ($this->config->active) {
			$path = $_GET['path'];
			$entries = $this->readFile($this->config->langBasePath.$path);
			$this->smarty()->loadPlugin('smarty_function_addUrlParams');
			if ($_POST['data']) {
				// bulk update
				$entries = json_decode(html_entity_decode($_POST['data']));
				file_put_contents($this->config->langBasePath.$path, json_encode($entries));
				$url = smarty_function_addUrlParams(array('url' => $this->config->indexUrl, 'path' => $path, 'message' => 'updated'), $this->smarty());
			}
			else {
				$key = $_GET['key'];
				$value = $_POST['value'];
				$entries[$key] = html_entity_decode($value);
				file_put_contents($this->config->langBasePath.$path, json_encode($entries));
				if (!empty($entries)) {
					$url = smarty_function_addUrlParams(array('url' => $this->config->editUrl, 'path' => $path, 'key' => $key, 'message' => 'updated'), $this->smarty());
				}
				else {
					$url = smarty_function_addUrlParams(array('url' => $this->config->editUrl, 'path' => $path, 'key' => $key, 'message' => 'failed'), $this->smarty());
				}
			}
			header('Location: '.$url);
		}
	}

	public function smarty() {
		include_once($this->config->smartyBasePath.'libs/Smarty.class.php');
		if (empty($this->_smarty)) {
			$this->_smarty = new \Smarty();
			$this->_smarty->setCacheDir(__DIR__.'/frontend/cache/');
			$this->_smarty->setTemplateDir(__DIR__.'/frontend/templates/');
			$this->_smarty->setCompileDir(__DIR__.'/frontend/templates_c/');
			$this->_smarty->setPluginsDir(array($this->config->smartyBasePath.'libs/plugins/', __DIR__.'/smartyPlugins/'));
		}
		return $this->_smarty;
	}
}
