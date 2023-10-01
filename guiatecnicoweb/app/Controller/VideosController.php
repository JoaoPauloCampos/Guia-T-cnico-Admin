<?php
App::uses('AppController', 'Controller');
/**
 * Videos Controller
 *
 * @property Video $Video
 * @property PaginatorComponent $Paginator
 */

define('UPLOADS_FOTOS', APP . WEBROOT_DIR . DS . 'uploads' . DS . 'videos' . DS);
define('LINK',  BASE_LINK . DS . 'videos' . DS);

class VideosController extends AppController {

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
			$this->Video->recursive = 0;
			$this->Video->order = array('Video.modified' => 'desc');
			$this->set('videos', $this->Paginator->paginate());
		}else{
			$this->Video->recursive = 0;
			$this->Video->order = array('Video.modified' => 'desc');
			$this->set('videos', $this->Paginator->paginate(array('Video.church_id' => $authUser['church_id'])));
		}
		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Video->exists($id)) {
			throw new NotFoundException(__('Vídeo inválido'));
		}
		$options = array('conditions' => array('Video.' . $this->Video->primaryKey => $id));
		$this->set('video', $this->Video->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Video->create();

			$disk_used = foldersize("../../");
			$disk_remaining = CONSUMO_MAXIMO - $disk_used;
			if ($disk_remaining < 0) {
				$this->Session->setFlash(__('Você não possui mais espaço em disco.'), 'default', array('class' => 'alert alert-danger'));
				return;
			}

			$info = pathinfo($this->request->data['Video']['foto']['name']);
			$ext = $info['extension']; // get the extension of the file
			$newname = uniqid().'.'.$ext; 

			$target = UPLOADS_FOTOS.$newname;
			if (move_uploaded_file( $this->request->data['Video']['foto']['tmp_name'], $target)){
				unset($this->request->data['Video']['foto']);
				$this->request->data['Video']['photo'] =  LINK.$newname;

				if ($this->Video->save($this->request->data)) {
					$this->Session->setFlash(__('Vídeo salvo.'), 'default', array('class' => 'alert alert-success'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Vídeo não pode ser salvo. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
				}
			} else {
				$this->Session->setFlash(__('Vídeo não pode ser salvo. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
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
		if (!$this->Video->exists($id)) {
			throw new NotFoundException(__('Vídeo inválido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$dados = $this->request->data;
			if (isset($dados['Video']['foto'])) {
				//var_dump($this->request->data['Setting']);
				if(!empty($dados['Video']['foto']['name'])){
					$info = pathinfo($dados['Video']['foto']['name']);
				 	if (isset($info['extension'])) {
				 		$ext = $info['extension']; // get the extension of the file
				 	}else{
				 		$ext = 'png';
				 	}

				 	$newname = uniqid().'.'.$ext; 
				 	$target = UPLOADS_FOTOS.$newname;
				 	
				 	if (move_uploaded_file( $dados['Video']['foto']['tmp_name'], $target)){
						unset($dados['Video']['foto']);
						$dados['Video']['photo'] =  LINK.$newname;
					}
				}
			}

			if ($this->Video->save($dados)) {
				$this->Session->setFlash(__('Vídeo salvo.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Vídeo não pode ser salvo. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Video.' . $this->Video->primaryKey => $id));
			$this->request->data = $this->Video->find('first', $options);
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
		$this->Video->id = $id;
		if (!$this->Video->exists()) {
			throw new NotFoundException(__('Vídeo inválido'));
		}
		$this->request->onlyAllow('post', 'delete');
		$options = array('conditions' => array('Video.' . $this->Video->primaryKey => $id));
		$delObj = $this->Video->find('first', $options);

		$this->request->onlyAllow('post', 'delete');
		$nomeArr = explode("/", $delObj["Video"]["photo"]);
		$nome = $nomeArr[count($nomeArr)-1];

		if (unlink(UPLOADS_FOTOS.$nome)) {

			if ($this->Video->delete()) {
				$this->Session->setFlash(__('Vídeo deletado.'), 'default', array('class' => 'alert alert-success'));
			} else {
				$this->Session->setFlash(__('O vídeo não pode ser deletado. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
			}
		}else {
			$this->Session->setFlash(__('O vídeo não pode ser deletado. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
		}

		return $this->redirect(array('action' => 'index'));
	}
}
