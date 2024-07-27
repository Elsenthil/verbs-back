<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Cookie\Cookie;
use Cake\Http\Response;
use Cake\I18n\FrozenTime;
use Firebase\JWT\JWT;
use Cake\Utility\Security;
use Cake\Log\Log;


class UsersController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configurez l'action de connexion pour ne pas exiger d'authentification,
        // évitant ainsi le problème de la boucle de redirection infinie
        $this->Authentication->addUnauthenticatedActions(['login', 'logout']);
    }

    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        if ($this->request->is('post')) {
            $result = $this->Authentication->getResult();
            if ($result->isValid()) {
                if($this->request->getHeader('Content-Type')[0] === 'application/json'){
                    $user = $result->getData();
                    
                    $cookie = $this->createCookie($user);

                    return $this->response
                        ->withCookie($cookie)
                        ->withType('application/json')
                        ->withStringBody(json_encode(['success' => true, 'user' => $user]));
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
                    return $this->redirect($this->referer());
                }
            }
        }
    }

    public function logout()
    {
        $cookie = (new Cookie('token'))
        ->withValue('')
        ->withExpiry(new \DateTime('-1 year'))
        ->withPath('/')
        ->withDomain('')
        ->withSecure(true)
        ->withHttpOnly(true)
        ->withSameSite(Cookie::SAMESITE_LAX);
        $result = $this->Authentication->getResult();
        // indépendamment de POST ou GET, rediriger si l'utilisateur est connecté
        $response = false;
        if ($result && $result->isValid()) {
            $this->Authentication->logout();
            $response = true;
        }
        if(isset($this->request->getHeader('Content-Type')[0]) && $this->request->getHeader('Content-Type')[0] === 'application/json'){
            return $this->response
            ->withType('application/json')
            ->withExpiredCookie($cookie)
            ->withStringBody(json_encode(['success' => $response]));
        }
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
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
