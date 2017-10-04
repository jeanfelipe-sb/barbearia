<?php
namespace App\Controller;

use Cake\Event\Event;
use App\Controller\AppController;

/**
 * HomeAdmin Controller
 *
 * @property \App\Model\Table\HomeAdminTable $HomeAdmin
 *
 * @method \App\Model\Entity\HomeAdmin[] paginate($object = null, array $settings = [])
 */
class HomeAdminController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->viewBuilder()->layout('admin');
    }
    public function index()
    {        
        $this->loadModel('Banner');
        
        $banner = $this->Banner->find('all');

        $this->set(compact('banner'));
        $this->set('_serialize', ['banner']);
    }

    /**
     * View method
     *
     * @param string|null $id Home Admin id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $homeAdmin = $this->HomeAdmin->get($id, [
            'contain' => []
        ]);

        $this->set('homeAdmin', $homeAdmin);
        $this->set('_serialize', ['homeAdmin']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $homeAdmin = $this->HomeAdmin->newEntity();
        if ($this->request->is('post')) {
            $homeAdmin = $this->HomeAdmin->patchEntity($homeAdmin, $this->request->getData());
            if ($this->HomeAdmin->save($homeAdmin)) {
                $this->Flash->success(__('The home admin has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The home admin could not be saved. Please, try again.'));
        }
        $this->set(compact('homeAdmin'));
        $this->set('_serialize', ['homeAdmin']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Home Admin id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $homeAdmin = $this->HomeAdmin->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $homeAdmin = $this->HomeAdmin->patchEntity($homeAdmin, $this->request->getData());
            if ($this->HomeAdmin->save($homeAdmin)) {
                $this->Flash->success(__('The home admin has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The home admin could not be saved. Please, try again.'));
        }
        $this->set(compact('homeAdmin'));
        $this->set('_serialize', ['homeAdmin']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Home Admin id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $homeAdmin = $this->HomeAdmin->get($id);
        if ($this->HomeAdmin->delete($homeAdmin)) {
            $this->Flash->success(__('The home admin has been deleted.'));
        } else {
            $this->Flash->error(__('The home admin could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
