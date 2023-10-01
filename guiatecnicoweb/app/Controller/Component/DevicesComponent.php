<?php
App::uses('Component', 'Controller');

class DevicesComponent extends Component {
	
	public $status = 'success';

	public function addDevice() {
		$dados = $this->_Collection->getController()->request->data;

		$Device = ClassRegistry::init('Devices');

		$Device->create();
		$retorno = $Device->save($dados);
		
		if(isset($retorno['Devices'])){
			$retorno['id'] = $retorno['Devices']['id'];
			unset($retorno['Devices']);
		return $retorno;
		}else{
			throw new Exception("Erro ao criar o device", 1);
		}
	}


}