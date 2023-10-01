<?php
App::uses('Component', 'Controller');

class PatrocinatorsComponent extends Component {
	
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

	public function getAllPatrocinators() {
		
		$Patrocinator = ClassRegistry::init('Patrocinators');

		$patrocinators = $Patrocinator->find('all', array(
											'fields' => array('id', 'name','text','photo'),
											'recursive' => 1
								));


		$return = array();
		$i = 0;
		foreach ($patrocinators as $key => $patrocinator) {
			$return[$i] = $patrocinator['Patrocinators'];
			$i++;
		}

		return $return;
	}

}