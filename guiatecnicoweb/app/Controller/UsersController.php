<?php
App::uses('AppController', 'Controller');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class UsersController extends AppController {

	public $components = array('Paginator');

	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow('add','recover');
	}

	public function login() {

	  $this->layout = 'login';

	    if ($this->request->is('post')) {

	        if ($this->Auth->login()) {
	        	
	            return $this->redirect($this->Auth->redirectUrl());
	        }

	        $this->Session->setFlash(
	              __('Dados inválidos'), 'alerts/inline' );
	    }

	    $this->set(array(
			'title_for_layout' => 'Painel de Controle'
		));
	}

	public function logout() {
	    return $this->redirect($this->Auth->logout());
	}


	public function index() {
		$this->User->recursive = 0;
		// $this->paginate = array(
		// 	'conditions' => array('User.role !=' => 'admin')
		// );
		$this->set('users', $this->paginate());

		$this->set('title_for_layout', 'Usuários');

	}

	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Usuário inválido'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

	public function add() {

		if ($this->request->is('post')) {
		$data = $this->request->data;

		$passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha1'));
        $data['User']['password'] = $passwordHasher->hash($data['User']['password']);

			$this->User->create();
			if ($this->User->save($data)) {
				$this->Session->setFlash(__('Usuário salvo com sucesso.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O Usuário não pode ser salvo. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		// $churches = $this->User->Church->find('list');
		// $this->set(compact('churches'));
	}

	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Usuário inválido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$data = $this->request->data;
			$passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha1'));
	        $data['User']['password'] = $passwordHasher->hash($data['User']['password']);

			if ($this->User->save($data)) {
				$this->Session->setFlash(__('Usuário salvo.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O Usuário não pode ser salvo. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

	public function recover($token = null) {

		$this->layout = 'login';
	if ($this->request->is(array('post', 'put'))) {
		$data = $this->request->data;
		$this->User->id = $data['User']['id'];

		if (!$this->User->exists()) {
			throw new NotFoundException(__('Usuário inválido'));
		}
		$options = array('conditions' => array('User.id' => $data['User']['id']));
		$user = $this->request->data = $this->User->find('first', $options);

		if(!empty($data['User']['password']) && !empty($data['User']['confirm']) && $data['User']['password']==$data['User']['confirm']){
			$passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha1'));
			
	        $user['User']['password'] = $passwordHasher->hash($data['User']['password']);
	        $user['User']['password_recovery'] = "";

			if ($this->User->save($user)) {
				$this->Session->setFlash(__('Sucesso.'), 'default', array('class' => 'alert alert-success'));
				$this->set('message',"Usuário salvo");
			} else {
				$this->Session->setFlash(__('Usuário não pode ser salvo. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
			}

		}else{
			$this->set('user', $user);
		}
	}
	else{
		$user = $this->User->getUserByRecoveryToken($token);
		if(!empty($user)){
			$this->set('user', $user);

		}else {
			$this->Session->setFlash(__('Token inválida'), 'default', array('class' => 'alert alert-danger'));
			$this->set('message',"Token inválida");
		}
	}


	}

	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Usuário inválido'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('O Usuário foi deletado.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('O usuário não pode ser deletado. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
