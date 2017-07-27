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
         	"password"=>array(
           		"rule" => "notBlank",
           		"message" => "Password không được rỗng",
           		"on" => "create"
         	),
         	"password_confirm"=>array(
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
}