<?php
class User extends AppModel {

    var $name = "User";

    function validateUser() {

       	$this->validate = array(
         	"username"=>array(
           		"rule1" =>array(
              	"rule" => "notBlank",
              	"message" => "Username không được rỗng",
           		),
           	"rule2" => array(
              	"rule" => "/^[a-z0-9_.]{4,}$/i",
              	"message" => "Username là kí tự hoặc số",
           		),
           	"rule3" =>array(
              	"rule" => "checkUsername", // call function check Username
              	"message" => "Username đã có người đăng ký",
           		),
         	),
         	"pass"=>array(
           		"rule" => "notBlank",
           		"message" => "Password không được rỗng",
           		"on" => "create"
         	),
         	"re_pass"=>array(
           		"rule1"=>array(
              		"rule" => "notBlank",
              		"message" => "Password comfirm không được rỗng",
              		"on" => "create"
           	),
           	"match" => array(
              	"rule" => "ComparePass", // call function compare password
              	"message" => "Password comfirm không trùng khớp",
           		),
        	),
        	"level"=>array(
           		"rule" => "notBlank",
           		"message" => "Please select level",
        	),
        	"email"=>array(
           		"rule" => "email",
           		"message" => "Email is not avalible",
        	),
        	'name' => array(
           		'not empty' => array(
              	'rule' => 'notBlank',
              	'message' => 'Name không được rỗng'
           	)
        )
    );

 	if ($this->validates($this->validate))

    	return TRUE;

 	else 

    	return FALSE;

 	}

 	function ComparePass() {

	    if ($this->data['User']['pass'] != $this->data['User']['re_pass']) {

	       return FALSE;

	    } else {

	       return TRUE;

	    }

 	}

	function checkUsername() {

	    if (isset($this->data['User']['id'])) {

	      	$where = array(
               	"id !=" => $this->data['User']['id'],
               	"username" => $this->data['User']['username'],
	      	);

	    } else {

	      	$where = array(
	            "username" => $this->data['User']['username'],
	     	);

		}

	  	$this->find("first", array(
	    	'conditions' => $where
	  	));

	  	$count = $this->getNumRows();

	  	if ($count!=0) {

	     	return false;

	  	} else {

	     	return true;

	  	}

 	}

	function beforeSave($options = array()) {

	    if (!empty($this->data['User']['pass'])) {

	      	$hash = Security::hash($this->data['User']['pass'], 'md5');

	      	$this->data['User']['password'] = $hash;

	    }

	    return true;

	}
}