<?php
class UsersController extends AppController {

	var $name = "Users";

	public function beforeFilter() {

		parent::beforeFilter();

		$this->Auth->autoRedirect = false;

	}

	public function login() {
		
		$dataUser = $this->Auth->user();

		if ($dataUser) {

			$this->redirect('/Home');

		} else {

			if ($this->data) {

				$this->Session->setFlash($this->Auth->loginError);
				
			}

			$this->loadModel('Student');

			$dataDelete = $this->Student->find("first", array(

	          	'conditions' => array('Student.id' => $dataUser['User']['id']),

	     	));

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

			}

		}

	}

	public function logout() {

		$this->redirect($this->Auth->logout());

	}

}