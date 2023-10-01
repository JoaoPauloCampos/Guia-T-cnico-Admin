    <?php

App::uses('AppController', 'Controller');

class UploadsController extends AppController
{

    public $name = 'Uploads';

    public $uses = array('Upload');
    

    public function browse() {

    }

    public function saveAvatar () {
        $this->Upload->uploadAvatar();
    }

    public function upload() {
        
        if ($this->request->is('post')) {

            if ($this->Upload->upload($this->data) === true) {
                $this->Session->setFlash(__('Arquivo enviado com sucesso.'), Flash::Success);
            }
            else {
                    if (isset($this->Upload->validationErrors['upload'][0])) {
                        $this->Session->setFlash($this->Upload->validationErrors['upload'][0]);
                    } else {
                        $this->Session->setFlash(__('Ocorreu um erro ao enviar o arquivo.'));
                    }
            }

            $this->redirect(array('action' => 'browse'));
        } else {
            $this->redirect(array('action' => 'browse'));
        }
    }

}