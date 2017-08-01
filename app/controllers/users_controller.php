<?php
class UsersController extends AppController {

	var $name = "Users";

	public function beforeFilter() {

		parent::beforeFilter();

	}

	public function login() {

		if ($this->Auth->user()) {

			$this->redirect('/Home');

		} else {

			if ($this->data) {

				$this->Session->setFlash($this->Auth->loginError);
				
			}

		}

	}

	public function logout() {

		$this->redirect($this->Auth->logout());

	}

}