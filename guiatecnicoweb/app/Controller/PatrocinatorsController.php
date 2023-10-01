<?php
App::uses('AppController', 'Controller');
/**
 * Galleries Controller
 *
 * @property Gallery $Gallery
 * @property PaginatorComponent $Paginator
 */

define('UPLOADS_FOTOS', APP . WEBROOT_DIR . DS . 'uploads' . DS . 'patrocinio' . DS);
define('LINK',  BASE_LINK . DS . 'patrocinio' . DS);

class PatrocinatorsController extends AppController {

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
		$authUser = $this->Session->read('Auth.User');
		
		if($authUser['role'] == 'admin'){
			$this->Patrocinator->recursive = 0;
			$this->Patrocinator->order = array('Patrocinator.modified' => 'desc');
			$this->set('patrocinators', $this->Paginator->paginate());
		}else{
			$this->Patrocinator->recursive = 0;
			$this->Patrocinator->order = array('Patrocinator.modified' => 'desc');
			$this->set('patrocinators', $this->Paginator->paginate());
		}

		$this->set('title_for_layout', 'Albuns');
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Patrocinator->exists($id)) {
			throw new NotFoundException(__('Álbum inválido'));
		}
		$options = array('conditions' => array('Patrocinator.' . $this->Gallery->primaryKey => $id));
		$this->set('patrocinator', $this->Patrocinator->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Patrocinator->create();
			$info = pathinfo($this->request->data['Patrocinator']['foto']['name']);
			$ext = $info['extension']; // get the extension of the file
			$newname = uniqid().'.'.$ext; 

			$target = UPLOADS_FOTOS.$newname;
			if (move_uploaded_file( $this->request->data['Patrocinator']['foto']['tmp_name'], $target)){
				unset($this->request->data['Patrocinator']['foto']);
				$this->request->data['Patrocinator']['photo'] =  LINK.$newname;
				if ($this->Patrocinator->save($this->request->data)) {
					$this->Session->setFlash(__('Patrocinator salvo.'), 'default', array('class' => 'alert alert-success'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('O álbum não pode ser salvo. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
				}

			} else {
				$this->Session->setFlash(__('Álbum não pode ser salvo. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
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
		if (!$this->Patrocinator->exists($id)) {
			throw new NotFoundException(__('Patrocinador inválido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$salva = true;
			if ($this->request->data['Patrocinator']['foto']['name'] != '') {
				$info = pathinfo($this->request->data['Patrocinator']['foto']['name']);
				$ext = $info['extension']; // get the extension of the file
				$newname = uniqid().'.'.$ext; 

				$target = UPLOADS_FOTOS.$newname;
				if (move_uploaded_file( $this->request->data['Patrocinator']['foto']['tmp_name'], $target)){
					unset($this->request->data['Patrocinator']['foto']);
					$this->request->data['Patrocinator']['photo'] =  LINK.$newname;
					
				}else{
					$salva = false;
				}

			}

			if ($salva){
				if ($this->Patrocinator->save($this->request->data)) {
					$this->Session->setFlash(__('Album salvo.'), 'default', array('class' => 'alert alert-success'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('O patrocinador não pode ser salvo. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
				}
			}else{
				$this->Session->setFlash(__('O patrocinador não pode ser salvo. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
			}

		} else {
			$options = array('conditions' => array('Patrocinator.' . $this->Patrocinator->primaryKey => $id));
			$this->request->data = $this->Patrocinator->find('first', $options);
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
		$this->Patrocinator->id = $id;
		if (!$this->Patrocinator->exists()) {
			throw new NotFoundException(__('Patrocinator inválido'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Patrocinator->delete()) {
			$this->Session->setFlash(__('Patrocinator deletado.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('Este patrocinador não pode ser deletado. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
