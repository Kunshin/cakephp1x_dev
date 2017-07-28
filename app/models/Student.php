<?php
class Student extends AppModel {

    var $name = "Student";

    public $useTable = 'users';

    public $hasOne = array(
        'UsersGroup' => array(
            'className' => 'UsersGroup',
            'dependent' => true
        )
    );

    var $validate = array(
        'username' => array(
            'between' => array(
                'rule' => array('between', 5, 15),
                'message' => 'Between 5 to 15 characters'
            ),
            'isUnique' => array(
                'rule' => 'checkUsername',
                'message' => 'This Username has already been taken.'
            ),
        ),
        'email' => array(
            'isUnique' => array(
                'rule' => 'checkEmail',
                'message' => 'This email has already been taken.'
            ),
            'email' => array(
                'rule' => array('email', true),
                'message' => 'Please supply a valid email address.'
            ),
            'empty' => array(
                'rule'      => 'notEmpty',
                'message'   => 'Must not be blank',
            ),
        ),
        'role' => array(
            'rule'      => 'notEmpty',
            'message'   => 'Must not be blank',
        ),
        'password_old' => array(
            'rule'      => 'notEmpty',
            'message'   => 'Must not be blank',
        ),
        'password' => array(
            'rule' => array('minLength', '8'),
            'message' => 'Mimimum 8 characters long'
        ),
        'password_confirm' => array(
            'rule' => 'checkPasswords' , 
            'message' => 'Passwords Do Not Match'
        ),
        
    );

    public function checkPasswords() {

        if (strcmp($this->data['Student']['password'],$this->data['Student']['password_confirm']) == 0 ) {

            return true;

        } else {

            return false;

        }
        
    }

    public function checkUsername() {

        $data = $this->find("all", array(

            'conditions' => array('Student.is_deleted' => 0),

        ));

        $checkReplace = array();

        foreach ($data as $key => $value) {

            if (strcmp($this->data['Student']['username'],$value['Student']['username']) == 0) {

                array_push($checkReplace, $value['Student']['username']);

            }

        }

        if (count($checkReplace) == 0) {

            return true;

        } else {

            return false;

        }
        
    }

    public function checkEmail() {

        $data = $this->find("all", array(

            'conditions' => array('Student.is_deleted' => 0),

        ));

        $checkReplace = array();

        foreach ($data as $key => $value) {

            if (strcmp($this->data['Student']['email'],$value['Student']['email']) == 0) {

                array_push($checkReplace, $value['Student']['email']);

            }

        }

        if (count($checkReplace) == 0) {

            return true;

        } else {

            return false;

        }
        
    }

}
