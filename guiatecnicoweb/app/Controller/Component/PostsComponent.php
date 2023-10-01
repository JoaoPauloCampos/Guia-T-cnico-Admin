<?php
App::uses('Component', 'Controller');

class PostsComponent extends Component {
	
	public $status = 'success';

	public function hello($args) {
		return 'Hello World';
	}

	public function say($args) {

		if (empty($args['text'])) {
			throw new Exception('Missing argument: text');
		}
		return 'You said: ' . $args['text'];
	}

	public function getAllPosts($args) {

		$Post = ClassRegistry::init('Posts');

		$posts = $Post->find('all', array(
										'fields' => array('id', 'text','user_id','created'),
										'order' => array('Posts.created' => 'desc'),
										'conditions' => array( 'Posts.active' => 1 ),	
										'recursive' => 1
								));
		


		$return = array();
		$i = 0;

		foreach ($posts as $key => $post) {
			$return[$i] = $post['Posts'];

			$userId = $post['Posts']['user_id'];

			$User = ClassRegistry::init('Users');

			$data = $User->find('first', array(
												'fields' => array('id', 'name','photo', 'avatar'),
												'conditions' => array( 'Users.id' => $userId ),
												'recursive' => 0
							));

			unset($return[$i]['user_id']);

			if(isset($data['Users'])){
				$user =$data['Users'];
				$return[$i]['user'] = $user;
			}
			$i++;
		}

		return $return;
	}


	public function addPost() {
		$dados = $this->_Collection->getController()->request->data;

		$Post = ClassRegistry::init('Posts');

		$Post->create();
		$retorno = $Post->save($dados);
		
		if(isset($retorno['Posts'])){
			$retorno['id'] = $retorno['Posts']['id'];
			unset($retorno['Posts']);
		return $retorno;
		}else{
			throw new Exception("Erro ao criar o post", 1);
			
		}
	}


}