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

	var $components = array('Auth', 'Session');

	public function getDataUser() {

		$dataUser = $this->Auth->User();

		$this->loadModel('UsersGroup');

		$data = $this->UsersGroup->find("first", array(

          	'conditions' => array('user_id' => $dataUser['User']['id'])

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

        if (!isset($data['UsersGroup']['group_id']) || $data['UsersGroup']['group_id'] == 2) {

            return 2;

        } else if (!isset($data['UsersGroup']['group_id']) || $data['UsersGroup']['group_id'] == 3) {

        	return 3;

        } else {

        	return 1;

        }

    }

}
