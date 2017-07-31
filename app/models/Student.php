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
            'empty' => array(
                'rule'      => 'notEmpty',
                'message'   => 'Must not be blank',
                'required' => true
            ),
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
                'required' => true
            ),
        ),
        'role' => array(
            'rule'      => 'notEmpty',
            'message'   => 'Must not be blank',
            'required' => true
        ),
        'password_old' => array(
            'rule'      => 'notEmpty',
            'message'   => 'Must not be blank',
            'required' => true
        ),
        'password' => array(
            'empty' => array(
                'rule'      => 'notEmpty',
                'message'   => 'Must not be blank',
                'required' => true
            ),
            'minLength' => array(
                'rule' => array('minLength', '8'),
                'message' => 'Mimimum 8 characters long'
            ),
        ),
        'password_confirm' => array(
            'empty' => array(
                'rule'      => 'notEmpty',
                'message'   => 'Must not be blank',
                'required' => true
            ),
            'checkPasswords' => array(
                'rule' => 'checkPasswords' , 
                'message' => 'Passwords Do Not Match'
            ),
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

        $check = $this->find("count", array(

            'conditions' => array(
                'Student.username' => $this->data['Student']['username'],
                'Student.is_deleted' => 0,

            ),

        ));

        if ($check > 0) {

            return false;

        } else {

            return true;

        }
        
    }

    public function checkEmail() {

        $check = $this->find("count", array(

            'conditions' => array(
                'Student.email' => $this->data['Student']['email'],
                'Student.is_deleted' => 0,

            ),

        ));

        if ($check > 0) {

            return false;

        } else {

            return true;

        }
        
    }

    public function beforeSave($options = array()) {

        if (isset($this->data['Student']['password'])) {

            App::import( 'Component', 'Auth' );
            
            $this->Auth = new AuthComponent();

            $hash = $this->Auth->password($this->data['Student']['password']);

            $this->data['Student']['password'] = $hash;

            return $hash;

        }

        return true;

    }

}
