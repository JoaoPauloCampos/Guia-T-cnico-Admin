<?php
App::uses('AppController', 'Controller');
/**
 * Settings Controller
 *
 * @property Setting $Setting
 * @property PaginatorComponent $Paginator
 */

define('UPLOADS_FOTOS', APP . WEBROOT_DIR . DS . 'uploads/');
define('LINK',  'http://fastapps.com.br/admin/app/webroot/uploads/');

class SettingsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Setting->recursive = 0;
		$this->set('settings', $this->Paginator->paginate());

		$this->set('title_for_layout', 'Configurações');
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Setting->exists($id)) {
			throw new NotFoundException(__('Configurações inválidas'));
		}
		$options = array('conditions' => array('Setting.' . $this->Setting->primaryKey => $id));
		$this->set('setting', $this->Setting->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Setting->create();
			if ($this->Setting->save($this->request->data)) {
				$this->Session->setFlash(__('Configurações salvas.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('As Configurações não foram salvas. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Setting->exists($id)) {
			throw new NotFoundException(__('Configurações inválidas'));
		}
		if ($this->request->is(array('post', 'put'))) {

			if (isset($this->request->data['Setting']['foto'])) {
				//var_dump($this->request->data['Setting']);
				if(!empty($this->request->data['Setting']['foto']['name'])){
					$info = pathinfo($this->request->data['Setting']['foto']['name']);
				 	$ext = $info['extension']; // get the extension of the file
				 	$newname = 'logomarca.'.$ext; 

				 	$target = UPLOADS_FOTOS.$newname;
				 	if (move_uploaded_file( $this->request->data['Setting']['foto']['tmp_name'], $target)){
						unset($this->request->data['Setting']['foto']);
						$this->request->data['Setting']['photo'] =  LINK.$newname;
					}
				}
			}
			

			if ($this->Setting->save($this->request->data)) {
				$this->Session->setFlash(__('Configurações salvas.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'edit/1'));
			} else {
				$this->Session->setFlash(__('Configuração não pode ser salvo. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Setting.' . $this->Setting->primaryKey => $id));
			$this->request->data = $this->Setting->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Setting->id = $id;
		if (!$this->Setting->exists()) {
			throw new NotFoundException(__('Configurações inválidas'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Setting->delete()) {
			$this->Session->setFlash(__('As Configurações foram deletadas.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('As Configurações não foram deletadas. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
