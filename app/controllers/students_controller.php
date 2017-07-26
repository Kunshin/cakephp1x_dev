<?php
class StudentsController extends AppController {

 	public $name = "Students";

  	public $helpers = array('Html','Form');
  	
  	public $components = array('Auth');

  	public function beforeFilter() {

        parent::beforeFilter();
        
        $this->Auth->deny();

        $dataUser = $this->Auth->User();

		$this->loadModel('UsersGroup');

		$data = $this->UsersGroup->find("all", array(

          	'conditions' => array('user_id' => $dataUser['User']['id'] )

     	));

     	if (!isset($data[0]['UsersGroup']['group_id']) || $data[0]['UsersGroup']['group_id'] == 3) {

            return $this->redirect('/users/login');

        }
    
    }


  	public function index() {

      	$data = $this->Student->find("all", array(

          	'conditions' => array('is_deleted' => 0 )

     	));

      	$this->set("data",$data);

	}

    public function load_add() {

    	$dataUser = $this->Auth->User();

    	$this->loadModel('UsersGroup');

		$data = $this->UsersGroup->find("all", array(

          	'conditions' => array('user_id' => $dataUser['User']['id'] )

     	));

     	if (!isset($data[0]['UsersGroup']['group_id']) || $data[0]['UsersGroup']['group_id'] == 2) {

            return $this->redirect('/Students');

        }

		$this->Student->set($this->data);

	    if ($this->data) {

	      	if ($this->Student->validates()) {

	      		if ($this->Student->save($this->data)) {

				   $this->Session->setFlash('Recipe Saved!');

	            	return $this->redirect('/Students');

				} else {

		        	$this->Session->setFlash('Error');

				}

		    } else {

		    	$errors = $this->Student->invalidFields();

		        $this->Session->setFlash('Error');

				$this->set("errors", $errors);

		    }

	    }

	}

	public function edit($id) {

		$dataUser = $this->Auth->User();

    	$this->loadModel('UsersGroup');

		$data = $this->UsersGroup->find("all", array(

          	'conditions' => array('user_id' => $dataUser['User']['id'] )

     	));

     	if (!isset($data[0]['UsersGroup']['group_id']) || $data[0]['UsersGroup']['group_id'] == 2) {

            return $this->redirect('/Students');

        }
		
		$data = $this->Student->find("all", array(

          	'conditions' => array('id' => $id )

     	));

     	$this->set("data", $data);

     	$this->Student->set($this->data);

     	if ($this->data) {

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

	}

	public function delete($id) {

		$dataUser = $this->Auth->User();

    	$this->loadModel('UsersGroup');

		$data = $this->UsersGroup->find("all", array(

          	'conditions' => array('user_id' => $dataUser['User']['id'] )

     	));

     	if (!isset($data[0]['UsersGroup']['group_id']) || $data[0]['UsersGroup']['group_id'] == 2) {

            return $this->redirect('/Students');

        }

		$this->Student->id = $id;
		
		$this->Student->saveField('is_deleted', 1);

		$this->Session->setFlash("Delete Completed !!!");

		return $this->redirect('/Students');

	}

	public function changePassword($id='') {

		$data = $this->Student->find("all", array(

          	'conditions' => array('id' => $id )

        ));

        $this->set("data", $data);

        if ($this->data) {

            $this->Student->set($this->data);
            
            if ($this->Student->validates(array('fieldList' => array('password_old', 'password', 'password_confirm')))) {

                $this->Student->id = $id;

                if ($this->Student->save($this->data)) {

                    $this->Session->setFlash("Change Password Success !");
                
                    return $this->redirect('/Students/edit/'.$id);

                } else {

                    $this->Session->setFlash("Change Password Fail !");
                
                    return $this->redirect('/Students/edit/'.$id);
                }

            } else {

                $this->Session->setFlash("Data Not True !");

                $errors = $this->Student->invalidFields();

                $this->set("errors", $errors);

            }

        }

	}


}
