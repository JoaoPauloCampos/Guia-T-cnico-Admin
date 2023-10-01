<?php
App::uses('AppController', 'Controller');
/**
 * Galleries Controller
 *
 * @property Gallery $Gallery
 * @property PaginatorComponent $Paginator
 */

define('UPLOADS_FOTOS', APP . WEBROOT_DIR . DS . 'uploads' . DS . 'album' . DS);
define('LINK',  BASE_LINK . DS . 'album' . DS);

class GalleriesController extends AppController {

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
			$this->Gallery->recursive = 0;
			$this->Gallery->order = array('Gallery.modified' => 'desc');
			$this->set('galleries', $this->Paginator->paginate());
		}else{
			$this->Gallery->recursive = 0;
			$this->Gallery->order = array('Gallery.modified' => 'desc');
			$this->set('galleries', $this->Paginator->paginate());
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
		if (!$this->Gallery->exists($id)) {
			throw new NotFoundException(__('Álbum inválido'));
		}
		$options = array('conditions' => array('Gallery.' . $this->Gallery->primaryKey => $id));
		$this->set('gallery', $this->Gallery->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {

			$disk_used = foldersize("../../");
			$disk_remaining = CONSUMO_MAXIMO - $disk_used;
			if ($disk_remaining < 0) {
				$this->Session->setFlash(__('Você não possui mais espaço em disco.'), 'default', array('class' => 'alert alert-danger'));
				return;
			}

			$this->Gallery->create();
			$info = pathinfo($this->request->data['Gallery']['foto']['name']);
			$ext = $info['extension']; // get the extension of the file
			$newname = uniqid().'.'.$ext; 

			$target = UPLOADS_FOTOS.$newname;
			if (move_uploaded_file( $this->request->data['Gallery']['foto']['tmp_name'], $target)){
				unset($this->request->data['Gallery']['foto']);
				$this->request->data['Gallery']['photo'] =  LINK.$newname;
				if ($this->Gallery->save($this->request->data)) {
					$this->Session->setFlash(__('Álbum salvo.'), 'default', array('class' => 'alert alert-success'));
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
		if (!$this->Gallery->exists($id)) {
			throw new NotFoundException(__('Álbum inválido'));
		}
		if ($this->request->is(array('post', 'put'))) {

			$info = pathinfo($this->request->data['Gallery']['foto']['name']);
			$ext = $info['extension']; // get the extension of the file
			$newname = uniqid().'.'.$ext; 

			$target = UPLOADS_FOTOS.$newname;
			if (move_uploaded_file( $this->request->data['Gallery']['foto']['tmp_name'], $target)){
				unset($this->request->data['Gallery']['foto']);
				$this->request->data['Gallery']['photo'] =  LINK.$newname;
				if ($this->Gallery->save($this->request->data)) {
					$this->Session->setFlash(__('Album salvo.'), 'default', array('class' => 'alert alert-success'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('O álbum não pode ser salvo. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
				}

			}else{
				$this->Session->setFlash(__('O Álbum não pode ser salvo. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
			}

		} else {
			$options = array('conditions' => array('Gallery.' . $this->Gallery->primaryKey => $id));
			$this->request->data = $this->Gallery->find('first', $options);
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
		$this->Gallery->id = $id;
		if (!$this->Gallery->exists()) {
			throw new NotFoundException(__('Álbum inválido'));
		}
		$this->request->onlyAllow('post', 'delete');

		$options = array('conditions' => array('Gallery.' . $this->Gallery->primaryKey => $id));
		$delObj = $this->Gallery->find('first', $options);

		$this->request->onlyAllow('post', 'delete');
		$nomeArr = explode("/", $delObj["Gallery"]["photo"]);
		$nome = $nomeArr[count($nomeArr)-1];

		if (unlink(UPLOADS_FOTOS.$nome)) {
			if ($this->Gallery->delete()) {
				$this->Session->setFlash(__('Álbum deletado.'), 'default', array('class' => 'alert alert-success'));
			} else {
				$this->Session->setFlash(__('Este Álbum não pode ser deletado. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
			}
		}else{
			$this->Session->setFlash(__('Este Álbum não pode ser deletado. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
