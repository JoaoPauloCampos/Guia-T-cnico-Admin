<?php

App::uses('Component', 'Controller');
App::uses('Security', 'Utility');
App::uses('ClassRegistry', 'Utility');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('CakeEmail', 'Network/Email');

class AccessComponent extends Component {
	
	public $components = array('Session' ,'Auth');
	public $status = 'success';

	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow('login','recover');
	}


	public function register($args) {
		
		if (empty($args['username'])) {
			throw new Exception('Missing argument: username');
		}
		
		if (empty($args['password'])) {
			throw new Exception('Missing argument: password');
		}
		
		$User = ClassRegistry::init('User');

		$User->create();

		return $User->save(array(
							'username' => $args['username'],
							'password' => Security::hash($args['password'], null, true)
		)); 	
	}

	public function login () {
		$args = $this->_Collection->getController()->request->data;

		if (empty($args['username'])) {
			throw new Exception('Missing argument: username');
		}
		if (empty($args['password'])) {
			throw new Exception('Missing argument: password');
		}
		
		$User = ClassRegistry::init('User');

		$password = AuthComponent::password($args['password']);
		//echo $password;
		$data = $User->find('first', array(
			'conditions' => array(
			'User.username' => $args['username'],
			'User.password' => $password
		)));


		if (!empty($data)) {

			if (empty($data['User']['token'])) {

				$request = $this->_Collection->getController()->request;
				$data['User']['token'] = md5(uniqid());
				$data['User']['ip'] = $request->clientIp(false);

				unset($data['ParentUser']);

				unset($data['User']['password']);

				$User->save($data);

			}

			$this->Session->write('auth_token', $data['User']['token']);

			$return['id'] = $data['User']['id'];
			$return['name'] = $data['User']['name'];
			$return['email'] = $data['User']['email'];
			$return['phone'] = $data['User']['phone'];
			$return['photo'] = $data['User']['photo'];
			$return['photo_dir'] = $data['User']['photo_dir'];
			$return['token'] = $data['User']['token'];
			$return['avatar'] = $data['User']['avatar'];


			return $return;
		}else{
			throw new Exception("Dados Inválidos", 1);
		}
		return "Dados Inválidos";
	}

	public function logout() {
		$args = $this->_Collection->getController()->request->data;

		if (isset($args['id']) && isset($args['user_token'])) {
			$request = $this->_Collection->getController()->request;
			$User = ClassRegistry::init('User');
			$data = $User->find('first', array('conditions' => array(
																'User.id' => isset($args['id']))));

			unset($data['ParentUser']);
			unset($data['User']['password']);	

			if (!empty($data)) {
				$data['User']['token'] = null;
				$data['User']['ip'] = null;
				$User->save($data);
				$this->Session->delete('auth_token');
				return true;
			}
		}
		return false;
	}

	public function validate($args) {

		if ($this->Session->check('auth_token')) {

			$request = $this->_Collection->getController()->request;
			$User = ClassRegistry::init('User');
			$data = $User->find('first', array('conditions' => array(
																'User.token' => $this->Session->read('auth_token')),
																'recursive' => 0
																));
			
			if (!empty($data)) {		
				return true;
			}
		}
		return false;
	}

	public function addUser() {
			$dados = $this->_Collection->getController()->request->data;

			$passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha1'));
	        $dados['password'] = $passwordHasher->hash($dados['password']);

			$User = ClassRegistry::init('User');

			$User->create();
			$retorno = $User->save($dados);
			if(isset($retorno['User'])){
				$retorno['id'] = $retorno['User']['id'];
				unset($retorno['User']);
			return $retorno;
			}else{
				throw new Exception("Erro ao criar o usuário", 1);
				
			}
	}


	public function recoveryPassword(){
		$dados = $this->_Collection->getController()->request->data;
		$mail = $dados['mail'];

		$User = ClassRegistry::init('User');

		$user = $User->getUserByMail($mail);

		if (!empty($user)) {

			$recovery_token = $user['User']['id'].substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
			$User->atualizaCampo("password_recovery",$recovery_token,$user['User']['id']);

			$fullUrl = Router::url(array('controller' => "users", 'action' => "recover/".$recovery_token ), true);

			$message = "Olá, para recuperar sua senha clique no link abaixo:<br/>".$fullUrl;

			$Email = new CakeEmail();
			$Email->from(array('contato@fastapps.com.br' => 'Fastapps'));
			$Email->to($mail);
			$Email->subject('Esqueci minha senha');
			$Email->send($message);


			return $this->status;
		}else{
			throw new Exception("Usuário não encontrado", 1);
		}
	}


	public function recoveryUsername(){
		$dados = $this->_Collection->getController()->request->data;
		$mail = $dados['mail'];

		$User = ClassRegistry::init('User');

		$user = $User->getUserByMail($mail);

		if (!empty($user)) {

			$message = "Olá, seu nome de usuário é:<br/>".$user['User']['username'];

			$Email = new CakeEmail();
			$Email->from(array('contato@fastapps.com.br' => 'Fastapps'));
			$Email->to($mail);
			$Email->subject('Esqueci meu nome de usuário');
			$Email->send($message);


			return $this->status;
		}else{
			throw new Exception("Usuário não encontrado", 1);
		}
	}

	public function editUser($id = null) {
		$args = $this->_Collection->getController()->request->data;
		$id = $args['id'];
		$User = ClassRegistry::init('User');

		if (!$User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($User->save($this->_Collection->getController()->request->data)) {
			$options = array('conditions' => array('User.' . $User->primaryKey => $id));
			$retorno = $User->find('first', $options);
			return $retorno;
		} else {
			$this->Session->setFlash(__('Usuario não pode ser salvo. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
		}
	}

	
}