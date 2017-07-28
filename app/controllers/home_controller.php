<?php
class HomeController extends AppController {

	var $name = 'Home';

	public function beforeFilter() {

		parent::beforeFilter();

		$this->layout = 'students';

		$data = $this->getDataUser();

		$this->Auth->autoRedirect = false;

	}


	public function index() {

	}

}