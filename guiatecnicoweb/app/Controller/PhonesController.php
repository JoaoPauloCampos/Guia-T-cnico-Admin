<?php
App::uses('AppController', 'Controller');
/**
 * Phones Controller
 *
 * @property Phone $Phone
 * @property PaginatorComponent $Paginator
 */
class PhonesController extends AppController {

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
			$this->Phone->recursive = 0;
			$this->set('phones', $this->Paginator->paginate());
		}else{
			$this->Phone->recursive = 0;
			$this->set('phones', $this->Paginator->paginate(array('Phone.church_id' => $authUser['church_id'])));
		}

		$this->set('title_for_layout', 'Telefones');
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Phone->exists($id)) {
			throw new NotFoundException(__('Telefone inválido'));
		}
		$options = array('conditions' => array('Phone.' . $this->Phone->primaryKey => $id));
		$this->set('phone', $this->Phone->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Phone->create();
			if ($this->Phone->save($this->request->data)) {
				$this->Session->setFlash(__('Telefone salvo.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O telefone não pode ser salvo. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$churches = $this->Phone->Church->find('list');
		$users = $this->Phone->User->find('list');
		$this->set(compact('churches', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Phone->exists($id)) {
			throw new NotFoundException(__('Telefone inválido'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Phone->save($this->request->data)) {
				$this->Session->setFlash(__('Telefone salvo.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O telefone não pode ser salvo. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Phone.' . $this->Phone->primaryKey => $id));
			$this->request->data = $this->Phone->find('first', $options);
		}
		$churches = $this->Phone->Church->find('list');
		$users = $this->Phone->User->find('list');
		$this->set(compact('churches', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Phone->id = $id;
		if (!$this->Phone->exists()) {
			throw new NotFoundException(__('Telefone inválido'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Phone->delete()) {
			$this->Session->setFlash(__('O telefone foi deletado.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('O telefone não pode ser deletado. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
