<?php

namespace App\Controller;

use Cake\Event\Event;
use Cake\Filesystem\File;
use App\Controller\AppController;

/**
 * Imgloja Controller
 *
 * @property \App\Model\Table\ImglojaTable $Imgloja
 *
 * @method \App\Model\Entity\Imgloja[] paginate($object = null, array $settings = [])
 */
class ImglojaController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function initialize() {
        parent::initialize();

        $this->loadComponent('Upload');
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->viewBuilder()->layout('admin');
    }

    public function index() {
        $imgloja = $this->paginate($this->Imgloja);

        $this->set(compact('imgloja'));
        $this->set('_serialize', ['imgloja']);
    }

    /**
     * View method
     *
     * @param string|null $id Imgloja id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $imgloja = $this->Imgloja->get($id, [
            'contain' => []
        ]);

        $this->set('imgloja', $imgloja);
        $this->set('_serialize', ['imgloja']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $imgloja = $this->Imgloja->newEntity();
        if ($this->request->is('post')) {
            $imgloja = $this->Imgloja->patchEntity($imgloja, $this->request->getData());
            $this->Upload->uploadImg($this->request->data['img'], $imgloja,'Imgloja');
        }
        $this->set(compact('imgloja'));
        $this->set('_serialize', ['imgloja']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Imgloja id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $imgloja = $this->Imgloja->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $imgloja = $this->Imgloja->patchEntity($imgloja, $this->request->getData());
            if ($this->Imgloja->save($imgloja)) {
                $this->Flash->success(__('The imgloja has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The imgloja could not be saved. Please, try again.'));
        }
        $this->set(compact('imgloja'));
        $this->set('_serialize', ['imgloja']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Imgloja id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $imgloja = $this->Imgloja->get($id);

        //nome da imagem
        $filename = $imgloja->img;
        $dir = WWW_ROOT . 'img' . DS . $filename;
        $dirThumb = WWW_ROOT . 'img' . DS . 'thumb' . DS . $filename;
        if ($this->Imgloja->delete($imgloja)) {
            //deletando o arquivo da pasta
            $file = new File($dir);
            $file->delete();
            $file->close();
            //deletando thumb
            $file1 = new File($dirThumb);
            $file1->delete();
            $file1->close();
            $this->Flash->success(__('The imgloja has been deleted.'));
        } else {
            $this->Flash->error(__('The imgloja could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
