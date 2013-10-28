<?php
/**
 * Created by Jay from Trio Design (jay@tgitriodesign.com).
 * Date: 2/27/13
 * Time: 10:06 AM
 * Description: Anything related to site index and client app.
 */
namespace App\Controllers;
class PagesController extends BaseController {
	public function view() {
		$page = 'index';
		if (!empty($this->params['page'])) {
			$page = $this->params['page'];
		}

		$data = \App\Models\Page::model()->getPage($page, true);
		if(!$data)
			$page = "notFound";

		$this->render($page, array(
			"page" => $data
		));
	}
}