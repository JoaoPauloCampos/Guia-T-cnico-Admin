<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {
    
    public $helpers = array('Html', 'Form', 'Session', 'Time', 'Text', 'Number','Cache');

	public $components = array(
        'RequestHandler',
        'Session',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'posts',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'pages',
                'action' => 'display',
                'home'
            ),
            'authenticate' => array(
                'Form' => array('userModel' => 'User')
            )
        )
    );

    public function beforeFilter() {

        if ($this->params['controller'] == 'api') {
            $this->Auth->allow('delegate', 'auth_api');
        }
    }

    public function isAuthorized($user) {
	    if (isset($user['role']) && $user['role'] === 'admin') {
	        return true;
	    }

	    return false;
	}

}
