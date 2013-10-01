<?php
/**
 * Created by Trio Design (trio@tgitriodesign.com).
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
		if( !$this->smarty()->templateExists($page) ){
			$page = 'notFound';
		}
		$this->render($page);
	}
}