<?php
App::uses('AppController', 'Controller');
Configure::write('Config.language', 'pt_br');
/**
 * Events Controller
 *
 * @property Event $Event
 * @property PaginatorComponent $Paginator
 */

class ManualsController extends AppController {

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
		
		
			$this->Manual->recursive = 0;
			$this->set('manuais', $this->Paginator->paginate());
		

		$this->set('title_for_layout', 'Manuais');
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Event->exists($id)) {
			throw new NotFoundException(__('Invalid event'));
		}
		$options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
		$this->set('event', $this->Event->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */

//cod, codTipoManual, codCategoria, titulo, url, marca, modelo
	public function add() {
		$categorias = $this->Manual->Categoria->find('list');
		$tipoManuals = $this->Manual->TipoManual->find('list');
		$this->set(compact('categorias', 'tipoManuals'));
		//$categorias = $this->Manual->Categoria->find('list');
		//$tipoManuals = $this->Manual->TipoManual->find('list');
		//$this->set(compact('categorias'));
		//$this->set(compact('tipoManuals'));
		//var_dump($categorias);
		//('list', array('conditions' => array('tipo' => 1)));

		if ($this->request->is('post')) {		
			 
			 $this->request->data['Manual']['codtipomanual_id'] = intval($this->request->data['Manual']['tipoManual']);
			 $this->request->data['Manual']['codcategoria_id'] = intval($this->request->data['Manual']['categoria']);
			 unset($this->request->data['Manual']['tipoManual']);
			 unset($this->request->data['Manual']['categoria']);
			 //var_dump($this->data);
			 //die();

				$this->Manual->create();
				if ($this->Manual->save($this->request->data)) {
					$this->Session->setFlash(__('Manual salvo'), 'default', array('class' => 'alert alert-success'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('O Manual não pode ser salvo. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
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
		if (!$this->Event->exists($id)) {
			throw new NotFoundException(__('Invalid event'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$dados = $this->request->data;

			$dados['Event']['data'] = $dados['Event']['data']['day']."/".$dados['Event']['data']['month']."/".$dados['Event']['data']['year'];
			$dados['Event']['hora'] = $dados['Event']['hora']['hour'].":".$dados['Event']['hora']['min']." ".$dados['Event']['hora']['meridian'];

			if (isset($dados['Event']['foto'])) {
				//var_dump($this->request->data['Setting']);
				if(!empty($dados['Event']['foto']['name'])){
					$info = pathinfo($dados['Event']['foto']['name']);
					//var_dump($this->request->data['Event']['foto']);
				 	if (isset($info['extension'])) {
				 		$ext = $info['extension']; // get the extension of the file
				 	}else{
				 		$ext = 'png';
				 	}

				 	$newname = uniqid().'.'.$ext; 
				 	$target = UPLOADS_FOTOS.$newname;
				 	
				 	if (move_uploaded_file( $dados['Event']['foto']['tmp_name'], $target)){
						unset($dados['Event']['foto']);
						$dados['Event']['photo'] =  LINK.$newname;
					}
				}
			}


			if ($this->Event->save($dados)) {
				$this->Session->setFlash(__('Evento salvo.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O evento não pode ser salvo. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
			$this->request->data = $this->Event->find('first', $options);
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
		$this->Manual->id = $id;
		if (!$this->Manual->exists()) {
			throw new NotFoundException(__('Invalid event'));
		}
		$this->request->onlyAllow('post', 'delete');

		$options = array('conditions' => array('Manual.' . $this->Manual->primaryKey => $id));
		$delObj = $this->Manual->find('first', $options);

		$this->request->onlyAllow('post', 'delete');
		//$nomeArr = explode("/", $delObj["Manual"]["photo"]);
		//$nome = $nomeArr[count($nomeArr)-1];

			if ($this->Manual->delete()) {
				$this->Session->setFlash(__('O manual foi deletado.'), 'default', array('class' => 'alert alert-success'));
			} else {
				$this->Session->setFlash(__('O manual não pode ser deletado. Por favor, tente novamente.'), 'default', array('class' => 'alert alert-danger'));
			} 
		return $this->redirect(array('action' => 'index'));
	}
}
