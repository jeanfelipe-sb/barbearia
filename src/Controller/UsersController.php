<?php

namespace App\Controller;

use Cake\Event\Event;
use App\Controller\AppController;
use Cake\Mailer\MailerAwareTrait;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController {

    use MailerAwareTrait;

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    //operação registra sem precisar estar atenticado
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['rememberPassword', 'changePassword','forgetpw']);
        $this->viewBuilder()->layout('admin');
    }

    public function index() {
        $this->paginate = [
            'contain' => ['Roles']
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $user = $this->Users->get($id, [
            'contain' => ['Roles']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                //enviar email de bem vindo
                $this->getMailer('User')->send('welcome', [$user]);

                $this->Flash->success(__('Usuário Cadastrado com sucesso!'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }

    public function login() {
           $this->viewBuilder()->layout('login');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Usuário ou senha inválidos!'));
        }
    }

    public function logout() {
        $this->Flash->success('Você foi desconectado');
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function rememberPassword() {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntities($user, $this->request->data);
            if ($user = $this->Users->findByEmail($this->request->data['email'])->toArray()) {
                $this->getMailer('User')->send('recovery', [$user]);
                $msg = 'Email enviado para sua caixa de email';
                $this->Flash->success($msg);
                return $this->redirect(['action' => 'rememberPassword']);
            } else {
                $msg = 'email não encontrado';
                $this->Flash->error($msg);
                return $this->redirect(['action' => 'rememberPassword']);
            }
        }
        $this->set(compact('user'));
    }

    public function changePassword() {
        $q_hash = $this->request->query('h');
        $q_email = $this->request->query('email');
        
        $user = $this->Users->newEntity();
        if ($this->request->is(['post', 'put'])) {
            $user = $this->Users->get($this->request->data['id']);
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Senha salva com sucesso'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('A senha não foi salva. Tente novamente mais tarde!'));
        } else {
            if ($user = $this->Users->findByEmail($q_email)->toArray()) {
                $hash = substr($user[0]['password'], 0, 25);
                if ($hash == $q_hash) {
                    $msg = 'Alterar senha do email: '.$q_email;
                    $this->Flash->set($msg);
                } else {
                    $msg = 'Você não tem permissão para essa senha!';
                    $this->Flash->set($msg);
                    $this->redirect(array('action' => 'rememberPassword'));
                }
            } else {

                $msg = 'Email não encontrado!';
                $this->Flash->set($msg);
                $this->redirect(array('action' => 'rememberPassword'));
            }
        }
        $this->set('id', $user[0]['id']);
        $this->set(compact('user'));
    }

    
}
