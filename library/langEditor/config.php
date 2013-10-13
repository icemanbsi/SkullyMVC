<?php
/**
 * Created by Jay from Trio Design (jay@tgitriodesign.com).
 * Date: 10/12/13
 * Time: 10:16 AM
 * Description: Config file for langEditor
 */
namespace Library\LangEditor;
class LangEditorConfig {
	// Filesystem path to this library
	public $libBasePath = '';
	// Set this to false when your site's online so nobody can access it.
	public $active = true;
	public $smartyBasePath = '../library/smarty-3.1.13/';
	// Filesystem path to language files root directory
	public $langBasePath = '';
	// Directory name of default language. All language files must exist within this directory.
	public $mainLanguage = 'english';
	// Url path to CKEditor
	public $ckEditorUrl = '';
	// Url path to jquery
	public $jqueryUrl = '';
	// Url path to bootstrap. Include glyphicons in bootstrap. See example in /frontend dir
	public $bootstrapBaseUrl = '';
	// Bootstrap theme url I.e. bootswatch css from http://bootswatch.com/
	public $bootstrapThemeUrl = '';
	// Url to index page
	public $indexUrl = '';
	// Url to edit script
	public $editUrl = '';
	// Url to update script
	public $updateUrl = '';

	// todo: create and destroy feature
	public $addUrl = '';
	public $createUrl = '';
	// Url to destroy script
	public $destroyUrl = '';

	public function __construct($setup = array()) {
		$this->active = isset($setup['active']) ? $setup['active'] : $this->active;
		$this->libBasePath = isset($setup['libBasePath']) ? $setup['libBasePath'] : $this->libBasePath;
		$this->smartyBasePath = isset($setup['smartyBasePath']) ? $setup['smartyBasePath'] : $this->smartyBasePath;
		$this->langBasePath = isset($setup['langBasePath']) ? $setup['langBasePath'] : $this->langBasePath;
		$this->mainLanguage = isset($setup['mainLanguage']) ? $setup['mainLanguage'] : $this->mainLanguage;
		$this->bootstrapBaseUrl = isset($setup['bootstrapBaseUrl']) ? $setup['bootstrapBaseUrl'] : $this->bootstrapBaseUrl;
		$this->bootstrapThemeUrl = isset($setup['bootstrapThemeUrl']) ? $setup['bootstrapThemeUrl'] : $this->bootstrapThemeUrl;
		$this->ckEditorUrl = isset($setup['ckEditorUrl']) ? $setup['ckEditorUrl'] : $this->ckEditorUrl;
		$this->jqueryUrl = isset($setup['jqueryUrl']) ? $setup['jqueryUrl'] : $this->jqueryUrl;
		$this->indexUrl = isset($setup['indexUrl']) ? $setup['indexUrl'] : $this->indexUrl;
		$this->editUrl = isset($setup['editUrl']) ? $setup['editUrl'] : $this->editUrl;
		$this->updateUrl = isset($setup['updateUrl']) ? $setup['updateUrl'] : $this->updateUrl;
		$this->addUrl = isset($setup['addUrl']) ? $setup['addUrl'] : $this->addUrl;
		$this->createUrl = isset($setup['createUrl']) ? $setup['createUrl'] : $this->createUrl;
		$this->destroyUrl = isset($setup['destroyUrl']) ? $setup['destroyUrl'] : $this->destroyUrl;
	}
}