<?php
/**
 * Created by Jay from Trio Design (jay@tgitriodesign.com).
 * Date: 10/12/13
 * Time: 10:55 AM
 * Description: Tests for Lang Editor. To run within SkullyMVC,
 * browse to tests/ directory, then run: ./phpunit.phar /pathToLibrary/langEditor/tests/unit/TestName.php
 */

class EditorTest extends PHPUnit_Framework_TestCase
{
	protected $langEditor;

	public function setUp() {
		include_once(__DIR__."/../../LangEditor.php");
		$this->langEditor = new \Library\LangEditor\LangEditor(array(
			'libBasePath' => realpath(__DIR__.'/../..').'/',
			'mainLanguage' => 'english',
			'langBasePath' => realpath(__DIR__.'/../fixtures/langDir').'/',
			'smartyPluginsBasePath' => realpath(__DIR__.'/../fixtures/smarty-3.1.13/libs/plugins').'/',
			'indexUrl' => 'index',
			'editUrl' => 'edit'
		));
	}

	public function tearDown() {
		$this->langEditor = null;
	}

	public function testGetDirItems() {
		$this->assertEquals(realpath(__DIR__.'/../fixtures/langDir').'/', $this->langEditor->config->langBasePath);
		$this->assertEquals(realpath(__DIR__.'/../..').'/', $this->langEditor->config->libBasePath);

		// get first level items
		$items = $this->langEditor->getItems('');
		$this->assertCount(2, $items);
		$this->assertEquals('admin', $items[0]['name']);
		$this->assertEquals('admin', $items[0]['path']);

		// get second level items
		$items = $this->langEditor->getItems('admin');
		$this->assertCount(2, $items);

		// alternate way to get items
		$items = $this->langEditor->getItems('admin/');
		$this->assertCount(2, $items);
		$ok = false;
		foreach($items as $item) {
			if ($item['type'] == 'file') {
				$this->assertCount(2,$item['languages']);
				$this->assertTrue(is_array($item['languages'][0]), "Language must be array.");
				$this->assertEquals('english', $item['languages'][0]['name']);
				$this->assertEquals('english/admin/_adminLang.json', $item['languages'][0]['path']);
				$ok = true;
			}
		}
		$this->assertTrue($ok, "Must have a file item.");
	}

	public function testGetFileItems() {
		$items = $this->langEditor->getItems('english/admin/users/indexLang.json');
		$this->assertCount(1, $items);
		$this->assertEquals('test', $items[0]['name']);
		$this->assertEquals('test', $items[0]['value']);
	}

	public function testGetItem() {
		$item = $this->langEditor->getItem('english/admin/users/indexLang.json', 'test');
		$this->assertEquals('test', $item['key']);
		$this->assertEquals('test', $item['value']);
	}

	public function testGetBreadcrumbs() {
		$breadcrumbs = $this->langEditor->getBreadcrumbs('admin');
		$this->assertCount(2, $breadcrumbs);
		$this->assertEquals($this->langEditor->config->indexUrl, $breadcrumbs[0]['url']);
		$this->assertEquals('admin', $breadcrumbs[1]['label']);
		$this->assertTrue($breadcrumbs[1]['active'], 'should be active');

		$breadcrumbs = $this->langEditor->getBreadCrumbs('english/admin/_adminLang.json');
		$this->assertCount(3, $breadcrumbs);
		$this->assertContains('admin', $breadcrumbs[1]['url']);
		$this->assertTrue($breadcrumbs[2]['active'], 'should be active');

		// Breadcrumbs with key
		$breadcrumbs = $this->langEditor->getBreadCrumbs('english/admin/_adminLang.json', 'test');
		$this->assertCount(4, $breadcrumbs);
		$this->assertContains('english', $breadcrumbs[2]['url']);
		$this->assertContains('_adminLang.json', $breadcrumbs[2]['url']);
		$this->assertTrue($breadcrumbs[3]['active'], 'should be active');

		// alternative flavour
		$breadcrumbs = $this->langEditor->getBreadCrumbs('/english/admin/_adminLang.json', 'test');
		$this->assertCount(4, $breadcrumbs);
		$this->assertContains('english', $breadcrumbs[2]['url']);
		$this->assertContains('_adminLang.json', $breadcrumbs[2]['url']);
		$this->assertTrue($breadcrumbs[3]['active'], 'should be active');

	}

	public function testSmartyUrlAddParams() {
		$this->langEditor->smarty()->loadPlugin('smarty_function_addUrlParams');
		$url = smarty_function_addUrlParams(array(
			'url' => 'http://test.com/stuff?wow=1',
			'wow' => 2,
			'another' => 3
		), $this->langEditor->smarty());
		$this->assertEquals('http://test.com/stuff?wow=2&another=3', $url);
	}

	public function testGetOtherLanguages() {
		// When dir path is passed - should return empty array
		$otherBreadcrumbs = $this->langEditor->getOtherLanguages('admin/');
		$this->assertCount(0, $otherBreadcrumbs);

		// When file path is passed
		$otherBreadcrumbs = $this->langEditor->getOtherLanguages('/english/admin/_adminLang.json');
		$this->assertCount(1, $otherBreadcrumbs);
		$this->assertEquals('indonesian', $otherBreadcrumbs[0]['name']);
		$this->assertContains($this->langEditor->config->indexUrl, $otherBreadcrumbs[0]['url']);
		$this->assertContains('indonesian', $otherBreadcrumbs[0]['url']);

		// When file path + entry is passed
		$otherBreadcrumbs = $this->langEditor->getOtherLanguages('/english/admin/_adminLang.json', 'test');
		$this->assertCount(1, $otherBreadcrumbs);
		$this->assertEquals('indonesian', $otherBreadcrumbs[0]['name']);
		$this->assertContains($this->langEditor->config->editUrl, $otherBreadcrumbs[0]['url']);
		$this->assertContains('indonesian', $otherBreadcrumbs[0]['url']);

	}
}
