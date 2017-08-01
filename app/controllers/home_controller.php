<?php
class HomeController extends AppController {

	var $name = 'Home';

	public function beforeFilter() {

		parent::beforeFilter();

		$this->layout = 'students';

		$this->Auth->allow('*');

	}


	public function index() {

	}

}