<?php
App::uses('Component', 'Controller');

class UsersComponent extends Component {
	
	public $status = 'success';

	public function uploadAvatar($args) {

		if (is_array($args)){
			if (isset($args['user_id'])) {
				$base64img = $args['base64img'];
				$user_id = $args['user_id'];
			}
		}else {
			$base64img = $args->base64img;
			$user_id = $args->user_id;
		}

		$Upload = ClassRegistry::init('Upload');
		
		$status = $Upload->uploadAvatar($base64img);

		if ($status) {
			$User = ClassRegistry::init('User');
			$status = $User->atualizaCampo('avatar', $status, $user_id);
		}

		return $status;
	}

}