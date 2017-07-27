<?php
class UsersController extends AppController {

	var $name = "Users";

	// var $helpers = array("Html","Session");

	// var $components = array("Auth", "Session");

	public function beforeFilter() {

		parent::beforeFilter();

		$dataUser = $this->Auth->user();

		$this->set('dataUser', $dataUser);

		$this->Auth->autoRedirect = false;

	}

	public function login() {
		
		$dataUser = $this->Auth->user();

		if ($dataUser) {

			$this->redirect('/Home');

		}

		if ($this->data) {

			if ($this->Auth->login($this->data)) {

				$this->loadModel('UsersGroup');

				$data = $this->UsersGroup->find("first", array(

		          	'conditions' => array('user_id' => $dataUser['User']['id'] )

		     	));

		     	if (!isset($data['UsersGroup']['group_id']) || $data['UsersGroup']['group_id'] == 3) {

		            $this->redirect('/Home');

		        } else {

		        	$this->redirect('/Students');

		        }

			} else {

				$this->Session->setFlash($this->Auth->loginError);

			}

		}

	}

	public function logout() {

		$this->redirect($this->Auth->logout());

	}

}