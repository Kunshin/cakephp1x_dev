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

            if (isset($this->data['password']) && isset($this->data['password_confirm'])) {

                $this->data['password'] = $this->Auth->password($this->data['password']);

                $this->data['password_confirm'] = $this->Auth->password($this->data['password_confirm']);

            }

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

	public function edit($id) {

        $dataRole = $this->checkRoleUser();

        if ($dataRole == '2') {

            $this->redirect('/Students');

        }
		
		$data = $this->Student->find("first", array(

          	'conditions' => array('Student.id' => $id)

     	));

     	$this->set("data", $data['Student']);

     	$this->Student->set($this->data);

      	if ($this->Student->validates()) {

            if ($this->Student->save($this->data)) {

                $this->Session->setFlash('Recipe Saved!');

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

	public function delete($id) {

        $dataRole = $this->checkRoleUser();

        if ($dataRole == '2') {

            $this->redirect('/Students');

        }

        $this->Student->saveField('is_deleted', 1);

        $this->Session->setFlash("Delete Completed !!!");

        return $this->redirect('/Students');

	}

}
