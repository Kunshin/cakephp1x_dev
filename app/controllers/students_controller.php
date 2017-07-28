<?php
class StudentsController extends AppController {

 	var $name = "Students";

  	public function beforeFilter() {

        parent::beforeFilter();

        $this->layout = 'students';
        
        $this->Auth->deny();

        $data = $this->getDataUser();

        $dataRole = $this->checkRoleUser();

        if ($dataRole == '3') {

            $this->redirect('/Users/login');

        }
    
    }

  	public function index() {

      	$data = $this->Student->find("all", array(

          	'conditions' => array('is_deleted' => 0),

     	));

      	$this->set("data",$data);

	}

    public function loadAdd() {

        $dataRole = $this->checkRoleUser();

        if ($dataRole == '2') {

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

                    return $this->redirect('/Students');

                } else {

                    $this->Session->setFlash('<h3>Save Error !</h3>');

                }

		    } else {

		    	$errors = $this->Student->invalidFields();

		        $this->Session->setFlash('<h3> Error !</h3>');

				$this->set("errors", $errors);

		    }

	    }

	}

	public function edit($id = null) {

        if (is_null($id)) {

            $this->Session->setFlash('User Not Exist !');

        } else {

            $dataRole = $this->checkRoleUser();

            if ($dataRole == '2') {

                $this->redirect('/Students');

            }
            
            $data = $this->Student->find("first", array(

                'conditions' => array('Student.id' => $id)

            ));

            if (count($data) > 0) {

                $this->set("data", $data['Student']);

                if ($this->data) {

                    $this->Student->set($this->data);

                    if ($this->Student->validates()) {

                        if ($this->Student->save($this->data)) {

                            return $this->redirect('/Students');

                        } else {

                            $this->Session->setFlash('Error Saved !');

                        }

                    } else {

                        $errors = $this->Student->invalidFields();

                        $this->Session->setFlash('Error');

                        $this->set("errors", $errors);

                    }

                }

            } else {

                $this->Session->setFlash('Data Not Exist !');

            }

        }

	}

	public function delete($id = null) {

        if (is_null($id)) {

            $this->Session->setFlash('User Not Exist !');

        } else {

            $dataRole = $this->checkRoleUser();

            if ($dataRole == '2') {

                $this->redirect('/Students');

            }

            $data = $this->Student->find("first", array(

                'conditions' => array('Student.id' => $id)

            ));

            if (count($data) > 0) {

                $this->Student->id = $data['Student']['id'];

                if ($this->Student->saveField('is_deleted', 1)) {

                    return $this->redirect('/Students');

                } else {

                    $this->Session->setFlash('Error Deleted !');

                }

            } else {

                $this->Session->setFlash('Data Not Exist !');

            }

        }

	}

}
