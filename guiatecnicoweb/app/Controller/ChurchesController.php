<?php
App::uses('AppController', 'Controller');
/**
 * Churches Controller
 *
 * @property Church $Church
 * @property PaginatorComponent $Paginator
 */


define('UPLOADS_FOTOS', APP . WEBROOT_DIR . DS . 'uploads' . DS . 'local' . DS);
define('LINK',  BASE_LINK . DS . 'local' . DS);


class ChurchesController extends AppController {

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
		$this->Church->recursive = 0;
		$this->set('churches', $this->Paginator->paginate());

		$this->set('title_for_layout', 'Localização');
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Church->exists($id)) {
			throw new NotFoundException(__('Invalid church'));
		}
		$options = array('conditions' => array('Church.' . $this->Church->primaryKey => $id));
		$this->set('church', $this->Church->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$categorias = $this->Church->Category->find('list', array('conditions' => array('tipo' => 1)));
		$subcategorias = $this->Church->Category->find('list', array('conditions' => array('tipo' => 2)));
		$this->set(compact('categorias', 'subcategorias'));

		$this->set('title_for_layout', 'Localização');
		if ($this->request->is('post')) {
			$this->Church->create();

			$disk_used = foldersize("../../");
			$disk_remaining = CONSUMO_MAXIMO - $disk_used;
			if ($disk_remaining < 0) {
				$this->Session->setFlash(__('Você não possui mais espaço em disco.'), 'default', array('class' => 'alert alert-danger'));
				return;
			}

			/*$info = pathinfo($this->request->data['Church']['foto']['name']);
			$ext = $info['extension']; // get the extension of the file
			$newname = uniqid().'.'.$ext; 

			$target = UPLOADS_FOTOS.$newname;
			//var_dump($this->request->data['Church']);
			if (move_uploaded_file( $this->request->data['Church']['foto']['tmp_name'], $target)){
				unset($this->request->data['Church']['foto']);
				$this->request->data['Church']['photo'] =  LINK.$newname;
				*/
				if ($this->Church->save($this->request->data)) {
					$this->Session->setFlash(__('Localização salva.'), 'default', array('class' => 'alert alert-success'));
					return $this->redirect(array('action' => 'index'));
				}else {
					$this->Session->setFlash(__('O álbum não pode ser salvo. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
				}
			/*
			} else {
				$this->Session->setFlash(__('A localização não pode ser salva. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
			}*/

			
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

		$categorias = $this->Church->Category->find('list');
		$subcategorias = $this->Church->Category->find('list');
		$this->set(compact('categorias', 'subcategorias'));
		
		$this->set('title_for_layout', 'Localização');

		if (!$this->Church->exists($id)) {
			throw new NotFoundException(__('Localização Inválida'));
		}

		if ($this->request->is(array('post', 'put'))) {
			/*if ($this->request->data['Church']['foto']['name'] != "") {
				$info = pathinfo($this->request->data['Church']['foto']['name']);
				$ext = $info['extension']; 
				$newname = uniqid().'.'.$ext; 

				$target = UPLOADS_FOTOS.$newname;
				if (move_uploaded_file( $this->request->data['Church']['foto']['tmp_name'], $target)){
					unset($this->request->data['Church']['foto']);
					$this->request->data['Church']['photo'] =  LINK.$newname;
					if ($this->Church->save($this->request->data)) {
						$this->Session->setFlash(__('Localização salva.'), 'default', array('class' => 'alert alert-success'));
						return $this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('A localização não pode ser salvo. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
					}
				}else {
					$this->Session->setFlash(__('A localização não pode ser salvo. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
				}
			}else{
				unset($this->request->data['Church']['foto']);*/
				if ($this->Church->save($this->request->data)) {
					$this->Session->setFlash(__('Localização salva.'), 'default', array('class' => 'alert alert-success'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('A localização não pode ser salvo. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
				}
			//}

		} else {
			$options = array('conditions' => array('Church.' . $this->Church->primaryKey => $id));
			$this->request->data = $this->Church->find('first', $options);
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
		$this->Church->id = $id;
		if (!$this->Church->exists()) {
			throw new NotFoundException(__('Invalid church'));
		}
		$this->request->onlyAllow('post', 'delete');

		$options = array('conditions' => array('Church.' . $this->Church->primaryKey => $id));
		$delObj = $this->Church->find('first', $options);

		$this->request->onlyAllow('post', 'delete');
		$nomeArr = explode("/", $delObj["Church"]["photo"]);
		$nome = $nomeArr[count($nomeArr)-1];

		//if (unlink(UPLOADS_FOTOS.$nome)) {
			if ($this->Church->delete()) {
				$this->Session->setFlash(__('A localização foi deletada.'), 'default', array('class' => 'alert alert-success'));
			} else {
				$this->Session->setFlash(__('A localização não pode ser deletada. Por favor, tente novamente.'), 'default', array('class' => 'alert alert-danger'));
			}
		/*}else {
			$this->Session->setFlash(__('A localização não pode ser deletada. Por favor, tente novamente.'), 'default', array('class' => 'alert alert-danger'));
		}*/
		return $this->redirect(array('action' => 'index'));
	}
}
