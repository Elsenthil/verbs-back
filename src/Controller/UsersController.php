<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Utility\Security;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Cake\Log\Log;

class UsersController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configurez l'action de connexion pour ne pas exiger d'authentification,
        // évitant ainsi le problème de la boucle de redirection infinie
        $this->Authentication->addUnauthenticatedActions(['login', 'add']);
    }

    public function login()
    {
        $this->request->allowMethod(['post']);
        $result = $this->Authentication->getResult();

        if ($result->isValid()) {
            $user = $result->getData();

            if ($this->request->getHeader('Origin')[0] === 'http://localhost:3000') {
                $key = 'your-secret-key'; // Utilisez une clé sécurisée
                $payload = [
                    'sub' => $user->id,
                    'exp' => time() + 3600, // 1 heure d'expiration
                ];
                $token = JWT::encode($payload, $key, 'HS256');
                $user->token = $token;
                $this->Users->save($user);

                $response = [
                    'success' => true,
                    'user' => $user
                ];

                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode($response));
            } else {
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'Verbs',
                    'action' => 'index',
                ]);
                return $this->redirect($redirect);
            }
        } else {
            if($this->request->getHeader('Content-Type')[0] === 'application/json'){
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode(['success' => false]));
            } else {
                throw new UnauthorizedException('Invalid username or password');
            }
        }
    }

    public function logout()
    {
        $result = $this->Authentication->getResult();
        // indépendamment de POST ou GET, rediriger si l'utilisateur est connecté
        if ($result && $result->isValid()) {
            $this->Authentication->logout();

            if($this->request->getHeader('Content-Type')[0] === 'application/json'){
                return $this->response
                    ->withType('application/json')
                    ->withStringBody(json_encode(['success' => true]));
            } else {
                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            }
            
        }
    }

    public function index()
    {
        $query = $this->Users->find();
        $users = $this->paginate($query);

        $this->set(compact('users'));
    }

    public function view($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        $this->set(compact('user'));
    }

    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function edit($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
