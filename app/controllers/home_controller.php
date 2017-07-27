<?php
class HomeController extends AppController {

	var $name = 'Home';

	var $helpers = array("Html","Session");

	var $components = array("Auth", "Session");

	public function beforeFilter() {

		parent::beforeFilter();

		$this->layout = 'students';

		$dataUser = $this->Auth->user();

		$this->loadModel('UsersGroup');

		$data = $this->UsersGroup->find("first", array(

          	'conditions' => array('user_id' => $dataUser['User']['id'])

     	));

        $this->set('dataUser', $data);

		$this->Auth->autoRedirect = false;

	}


	public function index() {

	}

}