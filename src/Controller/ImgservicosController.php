<?php

namespace App\Controller;

use Cake\Event\Event;
use Cake\Filesystem\File;
use App\Controller\AppController;

/**
 * Imgservicos Controller
 *
 * @property \App\Model\Table\ImgservicosTable $Imgservicos
 *
 * @method \App\Model\Entity\Imgservico[] paginate($object = null, array $settings = [])
 */
class ImgservicosController extends AppController {

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
        $imgservicos = $this->paginate($this->Imgservicos);

        $this->set(compact('imgservicos'));
        $this->set('_serialize', ['imgservicos']);
    }

    /**
     * View method
     *
     * @param string|null $id Imgservico id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $imgservico = $this->Imgservicos->get($id, [
            'contain' => []
        ]);

        $this->set('imgservico', $imgservico);
        $this->set('_serialize', ['imgservico']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $imgservico = $this->Imgservicos->newEntity();
        if ($this->request->is('post')) {
            $imgservico = $this->Imgservicos->patchEntity($imgservico, $this->request->getData());
            $this->Upload->uploadImg($this->request->data['img'], $imgservico,'Imgservicos');
        }
        $this->set(compact('imgservico'));
        $this->set('_serialize', ['imgservico']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Imgservico id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $imgservico = $this->Imgservicos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $imgservico = $this->Imgservicos->patchEntity($imgservico, $this->request->getData());
            if ($this->Imgservicos->save($imgservico)) {
                $this->Flash->success(__('The imgservico has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The imgservico could not be saved. Please, try again.'));
        }
        $this->set(compact('imgservico'));
        $this->set('_serialize', ['imgservico']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Imgservico id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $imgservico = $this->Imgservicos->get($id);
        $dirThumb = WWW_ROOT . 'img' . DS . 'thumb' . DS . $filename;
         //nome da imagem
        $filename = $imgservico->img;
        $dir = WWW_ROOT . 'img' . DS . $filename;
                
        if ($this->Imgservicos->delete($imgservico)) {
             //deletando o arquivo da pasta
            $file = new File($dir);
            $file->delete();
            $file->close();
            //deletando thumb
            $file1 = new File($dirThumb);
            $file1->delete();
            $file1->close();
            $this->Flash->success(__('The imgservico has been deleted.'));
        } else {
            $this->Flash->error(__('The imgservico could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
