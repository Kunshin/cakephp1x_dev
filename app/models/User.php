<?php
class User extends AppModel {

    var $name = "User";

    var $validate = array(

        'email' => array(
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

    );

}