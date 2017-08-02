<?php
class StudentsController extends AppController {

 	var $name = "Students";

  	public function beforeFilter() {

        parent::beforeFilter();

        $this->layout = 'students';
        
        $this->Auth->deny();

        $dataRole = $this->checkRoleUser();

        if ($dataRole == '3') {

            $this->Session->setFlash('You are not authorized !');

            $this->redirect('/Users/login');

        }
    
    }

  	public function index() {

      	$data = $this->Student->find("all", array(

          	'conditions' => array('is_deleted' => 0),
            'order' => 'Student.id ASC',

     	));

      	$this->set("data",$data);

	}

    public function loadAdd() {

        $dataRole = $this->checkRoleUser();

        if ($dataRole == '2') {

            $this->Session->setFlash('You are not authorized !');

            $this->redirect('/Students');

        }

	    if ($this->data) {

            $this->Student->set($this->data);

	      	if ($this->Student->validates()) {

                if ($this->Student->save($this->data)) {

                    $student_id = $this->Student->getLastInsertId();

                    $this->data['UsersGroup']['user_id'] = $student_id;

                    $this->data['UsersGroup']['group_id'] = $this->data['role'];

                    $this->UsersGroup->save($this->data['UsersGroup']);

                    $send = $this->_sendNewUserMail($student_id, $this->data, 'simple_message');

                    if ($send) {

                        $this->Session->setFlash('Add User Success !');

                        $this->redirect('/Students');

                    } else {

                        $this->set('smtp_errors', $this->Email->smtpError);

                    }

                } else {

                    $this->Session->setFlash('Save Error !');

                }

		    } else {

		    	$errors = $this->Student->invalidFields();

		        $this->Session->setFlash('Error !');

				$this->set("errors", $errors);

		    }

	    }

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

	public function edit($id = null) {

        $dataRole = $this->checkRoleUser();

        if ($dataRole == '2') {

            $this->Session->setFlash('You are not authorized !');

            $this->redirect('/Students');

        }

        if (is_null($id)) {

            $this->Session->setFlash('User Not Exist !');

            $this->redirect('/Students');

        } else {
            
            $data = $this->Student->find("first", array(

                'conditions' => array(
                    'Student.id' => $id,
                    'Student.is_deleted' => 0,
                )

            ));

            if (count($data) > 0) {

                $this->set("data", $data['Student']);

                if ($this->data) {

                    $this->Student->id = $data['Student']['id'];

                    if ($this->Student->save($this->data, false, array('info'))) {

                        $this->Session->setFlash('Data Saved !');

                        $this->redirect('/Students');

                    } else {

                        $this->Session->setFlash('Error Saved !');

                        $this->redirect('/Students');

                    }

                }

            } else {

                $this->Session->setFlash('Data Not Exist !');

                $this->redirect('/Students');

            }

        }

	}

	public function delete($id = null) {

        $dataRole = $this->checkRoleUser();

        if ($dataRole == '2') {

            $this->Session->setFlash('You are not authorized !');

            $this->redirect('/Students');

        }

        if (is_null($id)) {

            $this->Session->setFlash('User Not Exist !');

            $this->redirect('/Students');

        } else {

            if ($this->dataUser['Student']['id'] == $id) {

                $this->Session->setFlash('Can not delete login account !');

                $this->redirect('/Students');

            } else {

                $data = $this->Student->find("first", array(

                    'conditions' => array(
                        'Student.id' => $id,
                        'Student.is_deleted' => 0,
                    )

                ));

                if (count($data) > 0) {

                    $this->Student->id = $data['Student']['id'];

                    if ($this->Student->saveField('is_deleted', 1)) {

                        $this->Session->setFlash('Deleted Success !');

                        $this->redirect('/Students');

                    } else {

                        $this->Session->setFlash('Error Deleted !');

                        $this->redirect('/Students');

                    }

                } else {

                    $this->Session->setFlash('Data Not Exist !');

                    $this->redirect('/Students');

                }

            }

        }

	}
    
}
