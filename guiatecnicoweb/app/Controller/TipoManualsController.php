<?php
App::uses('AppController', 'Controller');
/**
 * Galleries Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 */

class TipoManualsController extends AppController {

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
		
			$this->TipoManual->recursive = 0;
			$this->set('tipomanuals', $this->Paginator->paginate());
		

		$this->set('title_for_layout', 'Tipo Manuais');
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Álbum inválido'));
		}
		$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
		$this->set('category', $this->Category->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TipoManual->create();
			
			if ($this->TipoManual->save($this->request->data)) {
				$this->Session->setFlash(__('Tipo de manual salvo.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O tipo de manual não pode ser salvo. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
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
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Álbum inválido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('Categoria salvo.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('A categoria não pode ser salva. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find('first', $options);
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
		$this->TipoManual->id = $id;
		if (!$this->TipoManual->exists()) {
			throw new NotFoundException(__('Tipo de Manual inválido'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->TipoManual->delete()) {
			$this->Session->setFlash(__('Tipo deletado.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('Este Tipo não pode ser deletado. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
