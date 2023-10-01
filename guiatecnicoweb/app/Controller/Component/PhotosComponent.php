<?php
App::uses('Component', 'Controller');

class PhotosComponent extends Component {
	
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

	public function getAllPhotos($args) {
		
		$gallery_id = $args["galleryId"];

		$Photo = ClassRegistry::init('Photos');
		$photos = $Photo->find('all', array(
											'fields' => array('id', 'photo', 'photo_dir','photo_type','photo_size','dir'),
											'order' => array('Photos.modified' => 'desc'),
											'conditions' => array( 'Photos.gallery_id' => $gallery_id),
											'recursive' => 0
							));

		$return = array();
		$i = 0;
		foreach ($photos as $key => $photo) {
			$return[$i] = $photo['Photos'];
			$i++;
		}

		return $return;
	}

}