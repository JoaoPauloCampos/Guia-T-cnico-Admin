<?php
App::uses('Component', 'Controller');

class GalleriesComponent extends Component {
	
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

	public function getAllGalleries() {
		
		$Gallery = ClassRegistry::init('Galleries');

		$galleries = $Gallery->find('all', array(
											'fields' => array('id', 'name','text','photo'),
											'recursive' => 1
								));


		$return = array();
		$i = 0;
		foreach ($galleries as $key => $gallery) {
			$return[$i] = $gallery['Galleries'];
			$i++;
		}

		return $return;
	}

}