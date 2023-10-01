<?php
App::uses('Component', 'Controller');

class CategoriesComponent extends Component {
	
	public $status = 'success';

	public function say($args) {

		if (empty($args['text'])) {
			throw new Exception('Missing argument: text');
		}
		return 'You said: ' . $args['text'];
	}

	public function getallcategories() {
		
		$Category = ClassRegistry::init('Category');
		$categories = $Category->find('all', array(
											'fields' => array('id', 'name', 'tipo'),
											'recursive' => 0
							));

		$return = array();
		$i = 0;
		foreach ($categories as $key => $category) {
			$return[$i] = $category['Category'];
			$i++;
		}

		return $return;
	}

}