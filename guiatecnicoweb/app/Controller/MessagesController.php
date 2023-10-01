<?php
App::uses('AppController', 'Controller');
/**
 * Messages Controller
 *
 * @property Message $Message
 * @property PaginatorComponent $Paginator
 */
define( 'API_ACCESS_KEY', 'AIzaSyDHOM9AqYXOba7lmRp9WCVhq6MbNhPl6k0' );
class MessagesController extends AppController {

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
		
		
			$this->Message->recursive = 0;
			$this->set('messages', $this->Paginator->paginate());
		
		$this->set('title_for_layout', 'Mensagens');
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Mensagem inválida'));
		}
		$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
		$this->set('message', $this->Message->find('first', $options));

		$this->set('title_for_layout', 'Mensagens');
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Message->create();
			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash(__('A mensagem foi salva.'), 'default', array('class' => 'alert alert-success'));

				$Device = ClassRegistry::init('Devices');
				$devices = $Device->find('all', array(
											'fields' => array('id', 'type','token'),
											'recursive' => 1
								));


				$android = array();
				$ios = array();
				foreach ($devices as $key => $device) {
					
					if($device['Devices']['type']=='Android'){
						array_push($android, $device['Devices']['token']);
					}else{
						array_push($ios, $device['Devices']['token']);
					}
				}
				$message = $this->request->data;
				
				$this->sendNotification($android,$message['Message']['text']);
				$this->sendiOSNotification($ios,$message['Message']['text']);

				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('A mensagem não pode ser salva. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
	}


    public function sendiOSNotification($devices,$texto){
		$passphrase = 'fast2015';
		$message = $texto;

		$ctx = stream_context_create();
		stream_context_set_option($ctx, 'ssl', 'local_cert', 'prodck.pem');
		stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

		// Open a connection to the APNS server
		$fp = stream_socket_client(
			'ssl://gateway.push.apple.com:2195', $err,
			$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

		if (!$fp)
			exit( "Problema ao conectar ao servidor apple: $err $errstr" . PHP_EOL);
			
		//echo 'Connected to APNS' . PHP_EOL;


		$errors = 0;
		$sucess = 0;


		//print_r($devices);

		for ($i=0; $i < count($devices); $i++) { 
			$deviceToken = $devices[$i];
			//print_r($deviceToken);
			//print_r("<br>");
			$body['aps'] = array(
				'alert' => $message,
				'sound' => 'default'
				);

			// Encode the payload as JSON
			$payload = json_encode($body);

			// Build the binary notification
			$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

			// Send it to the server
			$result = fwrite($fp, $msg, strlen($msg));

			if (!$result)
				$errors++;
			else
				$sucess++;

		}

		fclose($fp);
    }


    public function sendNotification($registrationIds,$texto){

        $msg = array
        (
            'message'   => $texto
        );

        $fields = array
        (
            'registration_ids'  => $registrationIds,
            'data'          => $msg
        );
         
        $headers = array
        (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );
         
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );

        return $result;
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		
		$this->set('title_for_layout', 'Mensagens');
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Mensagem inválida'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash(__('Mensagem salva.'), 'default', array('class' => 'alert alert-success'));


				$Device = ClassRegistry::init('Devices');
				$devices = $Device->find('all', array(
											'fields' => array('id', 'type','token'),
											'recursive' => 1
								));


				$android = array();
				foreach ($devices as $key => $device) {
					
					if($device['Devices']['type']=='Android'){
						array_push($android, $device['Devices']['token']);
					}
				}
				$message = $this->request->data;
				
				$this->sendNotification($android,$message['Message']['text']);

				
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('A mensagem não pode ser salva. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
			$this->request->data = $this->Message->find('first', $options);
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
		$this->Message->id = $id;
		if (!$this->Message->exists()) {
			throw new NotFoundException(__('Mensagem inválida'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Message->delete()) {
			$this->Session->setFlash(__('A Mensagem foi deletada.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('A Mensagem não pode ser deletado. Tente novamente.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
