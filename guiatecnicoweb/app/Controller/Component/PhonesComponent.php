<?php
App::uses('Component', 'Controller');

class PhonesComponent extends Component {
	
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

	public function getAllPhones() {

		$Phones = ClassRegistry::init('Phones');

		$phones = $Phones->find('all',
								array(
									'fields' => array('id', 'phone','info'),
									'recursive' => 1
								));

		$return = array();
		$i = 0;
		foreach ($phones as $key => $phone) {
			$return[$i] = $phone['Phones'];
			$i++;
		}

		return $return;
	}

}