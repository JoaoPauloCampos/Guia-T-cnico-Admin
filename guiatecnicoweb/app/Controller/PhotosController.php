<?php
App::uses('AppController', 'Controller');
/**
 * Photos Controller
 *
 * @property Photo $Photo
 * @property PaginatorComponent $Paginator
 */

define('UPLOADS_FOTOS', APP . WEBROOT_DIR . DS . 'uploads' . DS . 'userfiles' . DS);
define('LINK',  BASE_LINK . DS . 'userfiles' . DS);

class PhotosController extends AppController {

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
			$this->Photo->recursive = 0;
			$this->Photo->order = array('Photo.modified' => 'desc');
			$this->set('photos', $this->Paginator->paginate());
		}else{
			$this->Photo->recursive = 0;
			$this->Photo->order = array('Photo.modified' => 'desc');
			$this->set('photos', $this->Paginator->paginate(array('Photo.church_id' => $authUser['church_id'])));
		}

		$this->set('title_for_layout', 'Fotos');
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Photo->exists($id)) {
			throw new NotFoundException(__('Foto inválida'));
		}
		$options = array('conditions' => array('Photo.' . $this->Photo->primaryKey => $id));
		$this->set('photo', $this->Photo->find('first', $options));
	}

	public function beforeSave($options = array()) {
    	

    	//if (!empty($this->data['Event']['begindate'])
       
       var_dump($this->data);
    exit();
    	return true;
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {


			$this->Photo->create();

			$disk_used = foldersize("../../");
			$disk_remaining = CONSUMO_MAXIMO - $disk_used;
			if ($disk_remaining < 0) {
				$this->Session->setFlash(__('Você não possui mais espaço em disco.'), 'default', array('class' => 'alert alert-danger'));
				return;
			}

			 $info = pathinfo($this->request->data['Photo']['foto']['name']);
			 $ext = $info['extension']; // get the extension of the file
			 $newname = uniqid().'.'.$ext; 

			 $target = UPLOADS_FOTOS.$newname;
			 if (move_uploaded_file( $this->request->data['Photo']['foto']['tmp_name'], $target)){
				unset($this->request->data['Photo']['foto']);
				$this->request->data['Photo']['photo'] =  LINK.$newname;

				if ($this->Photo->save($this->request->data)) {
					$this->Session->setFlash(__('Foto salva.'), 'default', array('class' => 'alert alert-success'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('A foto não pode ser salvo. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
				}

			 }else{
				$this->Session->setFlash(__('A foto não pode ser salvo. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
			
			 }
			
		}
		$galleries = $this->Photo->Gallery->find('list');
		$this->set(compact('galleries'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Photo->exists($id)) {
			throw new NotFoundException(__('Foto inválida'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Photo->save($this->request->data)) {
				$this->Session->setFlash(__('Foto salva.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('A foto não pode ser salvo. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Photo.' . $this->Photo->primaryKey => $id));
			$this->request->data = $this->Photo->find('first', $options);
		}
		$galleries = $this->Photo->Gallery->find('list');
		$this->set(compact('galleries'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Photo->id = $id;
		if (!$this->Photo->exists()) {
			throw new NotFoundException(__('Foto inválida'));
		}

		$options = array('conditions' => array('Photo.' . $this->Photo->primaryKey => $id));
		$delObj = $this->Photo->find('first', $options);

		$this->request->onlyAllow('post', 'delete');
		$nomeArr = explode("/", $delObj["Photo"]["photo"]);
		$nome = $nomeArr[count($nomeArr)-1];

		if (unlink(UPLOADS_FOTOS.$nome)) {
			if ($this->Photo->delete()) {
				$this->Session->setFlash(__('A foto foi deletada.'), 'default', array('class' => 'alert alert-success'));
			} else {
				$this->Session->setFlash(__('A foto não pode ser deletada. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
			}

		}else{
			$this->Session->setFlash(__('A foto não pode ser deletada. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
