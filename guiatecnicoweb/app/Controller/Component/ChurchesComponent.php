<?php
App::uses('Component', 'Controller');

class ChurchesComponent extends Component {
	
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

	public function getallchurches() {
		
		$Church = ClassRegistry::init('Church');
		$churches = $Church->find('all', array(
											'fields' => array('id', 'text', 'telefone','name','photo','categoria','subcategoria','address','lat','lng'),
											'recursive' => 0
							));

		$return = array();
		$i = 0;
		foreach ($churches as $key => $church) {
			$return[$i] = $church['Church'];
			$i++;
		}

		return $return;
	}

}