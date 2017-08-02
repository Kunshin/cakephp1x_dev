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

    public function _sendNewUserMail($id = null, $data = null, $template = null) {

        if (is_null($id) || is_null($data) || is_null($template)) {

            return false;

        } else {

            $User = $this->Student->read(null,$id);

            $UserInput = $data;

            $this->Email->to = $User['Student']['email'];

            $this->Email->bcc = array('secret@example.com');

            $this->Email->subject = 'Information for New User !';

            $this->Email->replyTo = 'minhhoang.1907994@gmail.com';

            $this->Email->from = 'Test CakePHP 1.3';

            $this->Email->template = $template;

            $this->Email->sendAs = 'both';

            $this->set('User', $User);

            $this->set('UserInput', $UserInput);

            $this->Email->delivery = 'smtp';

            $this->Email->smtpOptions = array(
                'port'=>'465',
                'host' => 'ssl://smtp.gmail.com',
                'username'=>'minhhoang.1907994@gmail.com',
                'password'=>'aA121212',
                'client' => null
            );

            $check = $this->Email->send();

            return $check;

        }

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

	            if ($dataStudent) {

	            	$send = $this->_sendNewUserMail($dataStudent['Student']['id'], $this->data, 'forgot_password_mail');

	            	if ($send) {

	            		$this->Session->setFlash('Mail Has Send !');

	            	} else {

	            		$this->Session->setFlash('Send Mail Faild !');

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