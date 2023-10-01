<?php
App::uses('Component', 'Controller');

class EventsComponent extends Component {
	
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

	public function getAllEvents() {
		
		$Event = ClassRegistry::init('Events');

		$events = $Event->find('all', array(
											'fields' => array('id', 'name','data','hora','text','photo', 'photo_dir'),
											'recursive' => 1,
											'order' => array('Events.data DESC'),
								));


		$return = array();
		$i = 0;
		foreach ($events as $key => $event) {
			$d1 = strtotime(str_replace('/', '-', $event['Events']['data']));
			$d2 = strtotime('today');
			if( $d1 >=  $d2){
				$return[$i] = $event['Events'];
				$i++;
			}
		}

		return $return;
	}

}