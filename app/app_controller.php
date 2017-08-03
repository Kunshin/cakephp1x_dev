<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @link http://book.cakephp.org/1.3/en/The-Manual/Developing-with-CakePHP/Controllers.html#the-app-controller
 */
class AppController extends Controller {

	var $helpers = array('Html','Session','Form');

	var $components = array(
		'Auth' => array(
            'userScope' => array(
                'is_deleted' => 0,
                'is_actived' => 1
                )
        ),
		'Session',
    'Email');

    public function beforeFilter() {

        parent::beforeFilter();

        $this->Auth->autoRedirect = false;

        $this->dataUser = $this->getDataUser();
    
    }

    public $dataUser = null;

	public function getDataUser() {

		$dataUser = $this->Auth->User();

		$this->loadModel('Student');

		$data = $this->Student->find("first", array(

          	'conditions' => array('Student.id' => $dataUser['User']['id']),

     	));

     	$this->set('dataUser', $data);

     	return $data;

    }

    public function checkRoleUser() {

    	$dataUser = $this->Auth->User();

		$this->loadModel('UsersGroup');

		$data = $this->UsersGroup->find("first", array(

          	'conditions' => array('user_id' => $dataUser['User']['id'])

     	));

        if (count($data) > 0) {

          	if (isset($data['UsersGroup']['group_id'])) {

          		return $data['UsersGroup']['group_id'];

          	}

        }

        return null;

    }

    public function _sendNewUserMail($id = null, $data = null, $template = null, $password = null, $key) {

        if (is_null($id) || is_null($data) || is_null($template)) {

            return false;

        } else {

            if (!is_null($password)) {

                $this->set('password', $password);

            }

            if (!is_null($key)) {

                $this->set('key', $key);

            }

            $User = $this->Student->read(null,$id);

            $UserInput = $data;

            $this->Email->to = $User['Student']['email'];

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

}
