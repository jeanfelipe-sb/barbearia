<?php

namespace App\Controller;

use Cake\Event\Event;
use Cake\Filesystem\File;
use App\Controller\AppController;

/**
 * Banner Controller
 *
 * @property \App\Model\Table\BannerTable $Banner
 *
 * @method \App\Model\Entity\Banner[] paginate($object = null, array $settings = [])
 */
class BannerController extends AppController {

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

    public function test() {
        if ($this->request->is('post')) {
            $photo_src = $_FILES['photo']['tmp_name'];
            // test if the photo realy exists
            if (is_file($photo_src)) {
                // photo path in our example
                $photo_dest = 'images/photo_' . time() . '.jpg';
                // copy the photo from the tmp path to our path
                copy($photo_src, $photo_dest);
                // call the show_popup_crop function in JavaScript to display the crop popup
                echo '<script type="text/javascript">window.top.window.show_popup_crop("' . $photo_dest . '")</script>';
            }
        }
    }

    public function index() {
        $banner = $this->paginate($this->Banner);

        $this->set(compact('banner'));
        $this->set('_serialize', ['banner']);
    }

    /**
     * View method
     *
     * @param string|null $id Banner id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $banner = $this->Banner->get($id, [
            'contain' => []
        ]);

        $this->set('banner', $banner);
        $this->set('_serialize', ['banner']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $banner = $this->Banner->newEntity();
        if ($this->request->is('post')) {
            $banner = $this->Banner->patchEntity($banner, $this->request->getData());
            $this->Upload->uploadImg($this->request->data['img'], $banner,'Banner');
        }
        $this->set(compact('banner'));
        $this->set('_serialize', ['banner']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Banner id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $banner = $this->Banner->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $banner = $this->Banner->patchEntity($banner, $this->request->getData());
            if ($this->Banner->save($banner)) {
                $this->Flash->success(__('The banner has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The banner could not be saved. Please, try again.'));
        }
        $this->set(compact('banner'));
        $this->set('_serialize', ['banner']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Banner id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $banner = $this->Banner->get($id);

        //nome da imagem
        $filename = $banner->img;
        $dir = WWW_ROOT . 'img' . DS . $filename;
        $dirThumb = WWW_ROOT . 'img' . DS . 'thumb' . DS . $filename;

        if ($this->Banner->delete($banner)) {
            //deletando o arquivo da pasta
            $file = new File($dir);
            $file->delete();
            $file->close();
            //deletando thumb
            $file1 = new File($dirThumb);
            $file1->delete();
            $file1->close();
            $this->Flash->success(__('The banner has been deleted.'));
        } else {
            $this->Flash->error(__('The banner could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
