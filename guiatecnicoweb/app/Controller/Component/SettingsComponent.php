<?php
App::uses('Component', 'Controller');

class SettingsComponent extends Component {
	
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

	public function getAllSettings() {
		
		
		$Settings = ClassRegistry::init('Settings');

		$settings = $Settings->find('all', array(
											'fields' => array('id', 'name', 'tipo_patrocinador','geral_color','photo','email_contato','facebook_url','twitter_url','googleplus_url','instagram_url','youtube_url'),
											'recursive' => 1
							));

		$return = array();
		$i = 0;
		foreach ($settings as $key => $setting) {
			$return[$i] = $setting['Settings'];
			$i++;
		}

		return $return;
	}

}