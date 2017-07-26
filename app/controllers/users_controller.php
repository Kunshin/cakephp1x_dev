<?php
class UsersController extends AppController {

	var $name = "Users";

	var $helpers = array("Html","Session");

	var $components = array("Auth");

	public function beforeFilter() {

		parent::beforeFilter();

	}


	public function login() {

		if ($this->Auth->login()) {

			$this->redirect("/students/");

		} else {

			$this->Session->setFlash('Username hoặc password sai','default',array('class'=>"alert alert-success"));

		}

	}

	public function logout() {

		$this->redirect($this->Auth->logout());

	}

}