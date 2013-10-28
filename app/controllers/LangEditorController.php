<?php
/**
 * Created by Jay from Trio Design (jay@tgitriodesign.com).
 * Date: 10/12/13
 * Time: 9:35 AM
 * Description: This controller contains a set of pages used to edit Lang files.
 */
namespace App\Controllers;

class LangEditorController extends BaseController
{
	public $langEditor = null; // Lang editor library

	public function beforeAction($action = '') {
		$this->langEditor = new \Library\LangEditor\LangEditor(array(
			'active' => !app()->config('online'),
			'libBasePath' => app()->config('basePath').'library/langEditor/',
			'langBasePath' => app()->themePath().'languages/',
			'bootstrapBaseUrl' => app()->themeUrl().'resources/bootstrap-3.0.0/',
			'bootstrapThemeUrl' => app()->themeUrl().'resources/bootswatch/bootswatch.min.css',
			'jqueryUrl' => app()->themeUrl().'resources/js/jquery-2.0.3.min.js',
			'smartyBasePath' => app()->config('basePath').'library/smarty-3.1.13/',
			'ckEditorUrl' => app()->themeUrl().'resources/js/plugins/ckeditor/ckeditor.js',
			'indexUrl' => url('langEditor/index'),
			'editUrl' => url('langEditor/edit'),
			'updateUrl' => url('langEditor/update'),
			// todo: create and destroy feature
			'addUrl' => url('langEditor/add'),
			'createUrl' => url('langEditor/create'),
			'destroyUrl' => url('langEditor/destroy')
		));
	}

	public function index() {
		$this->langEditor->actionIndex();
	}
	public function edit() {
		$this->langEditor->actionEdit();
	}
	public function update() {
		$this->langEditor->actionUpdate();
	}
	public function add() {
		$this->langEditor->actionAdd();
	}
	public function create() {
		$this->langEditor->actionCreate();
	}
	public function destroy() {
		$this->langEditor->actiondestroy();
	}
}
