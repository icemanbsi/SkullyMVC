<?php
/**
 * Created by Trio Design (trio@tgitriodesign.com).
 * Date: 8/26/13
 * Time: 4:42 PM
 * Description: Home Controller
 */
namespace App\Controllers;
class HomeController extends BaseController
{
	public function index() {
		$this->render('index');
	}
}
