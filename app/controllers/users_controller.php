<?php
class UsersController extends AppController {

	var $name = "Users";

	var $helpers = array("Html","Session");

	var $components = array("Auth", "Session");

	public function beforeFilter() {

		parent::beforeFilter();

		$dataUser = $this->Auth->User();

		$this->set('dataUser', $dataUser);

		$this->Auth->autoRedirect = false;

	}


	public function login() {

		$dataUser = $this->Auth->User();

		if ($dataUser) {

			$this->redirect('/Students');

		}

		if ($this->data) {

			if ($this->Auth->login()) {

				

				$this->loadModel('UsersGroup');

				$data = $this->UsersGroup->find("all", array(

		          	'conditions' => array('user_id' => $dataUser['User']['id'] )

		     	));

		     	if (!isset($data[0]['UsersGroup']['group_id']) || $data[0]['UsersGroup']['group_id'] == 3) {

		            $this->Session->setFlash('Login Success - You are General User !');

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