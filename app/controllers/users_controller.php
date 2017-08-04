<?php
class UsersController extends AppController {

	var $name = "Users";

	public function beforeFilter() {

		parent::beforeFilter();

		$this->Auth->allow('forgotPassword');

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

	public function forgotPassword() {

		if ($this->data) {

			$this->User->set($this->data);

	      	if ($this->User->validates()) {

	      		$this->loadModel('Student');

	      		$dataStudent = $this->Student->find("first", array(

	                'conditions' => array(
	                    'Student.email' => $this->data['User']['email'],
	                    'Student.is_deleted' => 0,
	                )

	            ));

	            if (is_array($dataStudent) && count($dataStudent) > 0) {

	            	$time = time();

	            	$this->Student->id = $dataStudent['Student']['id'];

	            	if ($this->Student->saveField('password', $time)) {

	            		$send = $this->_sendNewUserMail($dataStudent['Student']['id'], $this->data, 'forgot_password_mail', $time);

		            	if ($send) {

		            		$this->Session->setFlash('Mail Has Send !', 'flash_success');

		            	} else {

		            		$this->Session->setFlash('Send Mail Faild !');

		            	}

	            	} else {

	            		$this->Session->setFlash('Save Faild !');

	            	}

	            } else {

	            	$this->Session->setFlash('This Email Not Exist !');

	            }

	      	} else {

	      		$errors = $this->Student->invalidFields();

				$this->set("errors", $errors);

	      	}

		}

    }

}