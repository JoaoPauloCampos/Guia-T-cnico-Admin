<?php
App::uses('Component', 'Controller');

class VideosComponent extends Component {
	
	public $status = 'success';

	public function getAllVideos() {
		
		$Videos = ClassRegistry::init('Videos');

		$videos = $Videos->find('all', array(
											'fields' => array('id', 'name','url','photo', 'photo_dir'),
											'recursive' => 1
							));

		$return = array();
		$i = 0;
		foreach ($videos as $key => $video) {
			$return[$i] = $video['Videos'];
			$i++;
		}

		return $return;
	}

}