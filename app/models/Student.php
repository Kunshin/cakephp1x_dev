<?php
class Student extends AppModel {
    
    var $name = "Student";

    public $useTable = 'users';

    var $validate = array(
        'Studentname' => array(
            'between' => array(
                'rule' => array('between', 5, 15),
                'message' => 'Between 5 to 15 characters'
            )
        ),
        'email' => array(
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'This Studentname has already been taken.'
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
        'password_old' => array(
            'rule'      => 'notEmpty',
            'message'   => 'Must not be blank',
        ),
        'password' => array(
            'rule' => array('minLength', '8'),
            'message' => 'Mimimum 8 characters long'
        ),
        'password_confirm' => array(
            'rule' => 'checkpasswords' , 
            'message' => 'Passwords Do Not Match'
        ),
        
    );

    public function checkpasswords() {

        if(strcmp($this->data['Student']['password'],$this->data['Student']['password_confirm']) == 0 ) {

            return true;

        } else {

            return false;

        }
        
    }

}
