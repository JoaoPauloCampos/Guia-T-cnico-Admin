<?php
App::uses('AppModel', 'Model');

class User extends AppModel {

	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
			),
		),
		'username' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
			),
		),
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
			),
		),
		'role' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
			),
		),
	);


	public function getUser ($id) {
		
		if ($this->exists($id)) {
			$configs = array(
	            'conditions'=>array(
	                'User.id' => $id,
	            )
	        );
			return $this->find('first',$configs);
		} else {
			return false;
		}
	}


	public function getUserByMail ($mail) {
		
		$configs = array(
            'conditions'=>array(
                'User.email' => $mail,
            )
        );
		return $this->find('first',$configs);
		
	}


	public function getUserByRecoveryToken ($recovery_token) {
		
		$configs = array(
            'conditions'=>array(
                'User.password_recovery' => $recovery_token,
            )
        );
		return $this->find('first',$configs);
		
	}

	public function atualizaCampo($campo, $valor, $id) {
	
		if ($this->exists($id)) {
			$this->read(null, $id);
				
			$this->set(array(
			    $campo => $valor
			));
			if ($this->save()) {
				return true;
			} 
		}	
		return false;
	}


	public function atualizarAvatar ($avatar, $id) {

	}

	public $hasMany = array(
		'Phone' => array(
			'className' => 'Phone',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

/*
	public function beforeSave($options = array()) {
	    if (isset($this->data['User']['password'])) {
	        $password = AuthComponent::password($this->data['User']['password']);
	        $this->data['User']['password'] = $password;
	    }
	    return parent::beforeSave();
	}*/

}
