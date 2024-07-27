<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Cake\Utility\Security;
use Cake\Log\Log;
use Cake\Http\Cookie\Cookie;
use Cake\I18n\FrozenTime;

class ApisController extends AppController
{
    public function beforeFilter(EventInterface $event) {
        parent::beforeFilter($event);

        // Récupère l'action courante
        $currentAction = $this->request->getParam('action');
        // Ajoute dynamiquement l'action courante aux actions non authentifiées
        $this->Authentication->addUnauthenticatedActions([$currentAction]);
        $this->response = $this->response->withType('application/json');

        $isAuthorized = $this->isAuthorized();
        if ($isAuthorized === false) {
            return $this->response
                ->withStatus(401)
                ->withStringBody(json_encode(['success' => false, 'message' => 'Non autorisé']));
        }
    }

    private function isAuthorized() {
        $token = $this->request->getCookie('token');
        if (!$token) {
            return false;
        }

        try {
            $decoded = JWT::decode($token, new Key(Security::getSalt(), 'HS256'));
            $userId = $decoded->sub;
            $user = $this->fetchTable('Users')->findById($userId)->first();

            $unauthorized = [
                ($decoded->exp < time()),
                (empty($user))
                // Ajouter d'autres motifs de refus ici
            ];

            if (!in_array(true, $unauthorized)) {
                // Vérifie si le token est sur le point d'expirer (par exemple, dans les 5 minutes)
                $expiresSoon = ($decoded->exp - time()) < 300; // 300 secondes = 5 minutes
                if ($expiresSoon) {
                    
                    $cookie = $this->createCookie($user);

                    // Mets à jour la réponse pour inclure le nouveau cookie
                    $this->response = $this->response->withCookie($cookie);
                }

                return true;
            }
        } catch (\Exception $e) {
            Log::error('Erreur de décodage JWT : ' . $e->getMessage());
        }

        return false;
    }

    public function getVerbs(){
        $this->request->allowMethod(['get']);
        $data = $this->fetchTable('Verbs')
        ->find()
        ->order(['Verbs.infinitive' => 'ASC'])
        ->all();

        $this->response = $this->response->withStringBody(json_encode($data));
        return $this->response;
    }

    public function addVerb(){
        $this->request->allowMethod(['post']);

        $code = 500;
        $message = 'Erreur inconnue';
        $success = false;

        $data = $this->request->getData();
        $verb = $this->fetchTable('Verbs')->newEmptyEntity();
        if(!empty($data)):
            
            $verb->infinitive = $data['infinitive'];
            $verb->preterit = $data['preterit'];
            $verb->past_participle = $data['past_participle'];
            $verb->translation = $data['translation'];

            if($this->fetchTable('Verbs')->save($verb)):
                $success = true;
                $code = 200;
                $message = 'Verbe ajouté avec succès';
            else:
                $message = 'Impossible d\'ajouter le verbe';
            endif;
        endif;

        $response = ['success' => $success, 'code' => $code, 'message' => $message, 'data' => $data, 'verb' => $verb];

        $this->response = $this->response->withStringBody(json_encode($response));
        return $this->response;
    }

    public function editVerb(){
        $this->request->allowMethod(['put']);

        $code = 500;
        $message = 'Erreur inconnue';
        $success = false;

        $data = $this->request->getData();
        $verb = [];
        if(!empty($data)):
            $verb = $this->fetchTable('Verbs')->get($data['id']);
            $verb->infinitive = $data['infinitive'];
            $verb->preterit = $data['preterit'];
            $verb->past_participle = $data['past_participle'];
            $verb->translation = $data['translation'];

            if($this->fetchTable('Verbs')->save($verb)):
                $success = true;
                $code = 200;
                $message = 'Verbe modifié avec succès';
            else:
                $message = 'Impossible de modifier le verbe';
            endif;
        endif;

        $response = ['success' => $success, 'code' => $code, 'message' => $message, 'data' => $data, 'verb' => $verb];

        $this->response = $this->response->withStringBody(json_encode($response));
        return $this->response;
    }

    public function deleteVerb(){
        $this->request->allowMethod(['delete']);

        $code = 500;
        $message = 'Aucune données';
        $success = false;

        $data = $this->request->getData();
        $id = $data['id'];
        if(!empty($id)):
            $verb = $this->fetchTable('Verbs')->get($id);
            if ($this->fetchTable('Verbs')->delete($verb)):
                $success = true;
                $code = 200;
                $message = 'Verbe irrégulier supprimé';
            else:
                $message = 'Impossible de supprimer le verbe irrégulier';
            endif;
        endif;

        $response = ['success' => $success, 'code' => $code, 'message' => $message, 'data' => $data, 'verb' => $verb];

        $this->response = $this->response->withStringBody(json_encode($response));
        return $this->response;
    }

    public function deleteMultipleVerbs(){
        $this->request->allowMethod(['delete']);

        $code = 500;
        $message = 'Erreur';
        $success = false;
        $data = $this->request->getData();
        $errors = [];

        if(!empty($data)):
            foreach($data as $id):
                $entity = $this->fetchTable('Verbs')->findById($id)->first();
                if (!empty($entity)):
                    $result = $this->fetchTable('Verbs')->delete($entity);
                    if ($result):
                        $code = 200;
                        $success = true;
                        $message = 'Sélection de verbe supprimée';
                    else:
                        $errors[] = 'Le verbe '.$entity->infinitive.' n\'a pas été supprimé';
                    endif;
                else:
                    $errors[] = 'Le verbe avec l\'ID '.$id.' n\'a pas été trouvé';
                endif;
            endforeach;
        endif;

        if(count($errors) > 0 && $success):
            $code = 201;
            $message = 'Certains verbes n\'ont pas pu être supprimés';
        endif;

        $response = ['success' => $success, 'code' => $code, 'message' => $message, 'data' => $data, 'errors' => $errors];

        $this->response = $this->response->withStringBody(json_encode($response));
        return $this->response;
    }

    public function loadTest(){

        $this->request->allowMethod(['post']);
        $code = 500;
        $message = 'Erreur';
        $success = false;
        $data = $this->request->getData();
        $errors = [];

        $existingTest = $this->fetchTable('Tests')->find()->contain('Answers', function ($q) {
            return $q->where(['Answers.is_done' => false]);
        })->where(['Tests.is_finished' => false])->first();

        if(empty($existingTest)):
            $limit = (!empty($data['limit'])) ? intval($data['limit']) : 5 ;
            $given = (!empty($data['given'])) ? $data['given']: 'random' ; //valeurs possibles : infinitive, preterit, past_participle, translation, random

            $index = ['infinitive', 'preterit', 'past_participle', 'translation'];
            $key = array_search($given, $index);
            $test = $this->fetchTable('Tests')->newEmptyEntity();
            $verbs = $this->fetchTable('Verbs')->getRandomVerbs($limit);
            $answers = [];

            if($key !== false || $given === 'random'): 
                if(!empty($verbs)):
                    if($this->fetchTable('Tests')->save($test)):
                        foreach($verbs as $verb):
                            $answer = $this->fetchTable('Answers')->newEmptyEntity();
                            $answer->is_done = false;
                            $answer->is_correct = false;
                            $answer->verb_id = $verb->id;
                            $answer->test_id = $test->id;

                            $answer->infinitive = null;
                            $answer->infinitive_given = false;
                            $answer->preterit = null;
                            $answer->preterit_given = false;
                            $answer->past_participle = null;
                            $answer->past_participle_given = false;
                            $answer->translation = null;
                            $answer->translation_given = false;

                            if($given === 'random'):
                                $key = rand(0,count($index)-1);
                            endif;

                            $field = $index[$key];
                            $givenField = $index[$key].'_given';
                            $answer->$field = $verb->$field;
                            $answer->$givenField = true;
                            if($this->fetchTable('Answers')->save($answer)):
                                $answers[] = $answer;
                            else:
                                $errors[] = 'Le verbe '.$verb->infinitive.' n\'a pas pu être ajouté';
                            endif;
                            $data['response']['created'][] = $answer;
                        endforeach;

                        if(count($errors) == 0):
                            $code = 200;
                            $message = 'Test créé avec succès';
                            $success = true;
                        else:
                            if(count($errors) == count($verbs)):
                                $code = 400;
                                $message = 'Erreur : test non conforme, opération annulée';
                                $this->fetchTable('Tests')->delete($test);
                            else:
                                $code = 300;
                                $message = 'Attention : Test créé mais un ou plusieurs verbes n\'ont pas pu être ajouté correctement';
                                $success = true;
                            endif;
                        endif;
                    else:
                        $code = 400;
                        $message = 'Erreur : aucun verbe trouvé !';
                    endif;
                else:
                    $code = 400;
                    $message = 'Erreur : impossible de créer le test';
                endif;     
            else:
                $code = 400;
                $message = 'Erreur : instruction non valide';
            endif;
        else:
            $answers = $existingTest->answers;
            unset($existingTest->answers);
            $test = $existingTest;

            $code = 200;
            $message = 'Test chargé avec succès';
            $success = true;
        endif;

        $response = ['success' => $success, 'code' => $code, 'message' => $message, 'test' => $test, 'answers' => $answers, 'data' => $data, 'errors' => $errors];

        $this->response = $this->response->withStringBody(json_encode($response));
        return $this->response;
    }

    public function getCorrection(){

        $this->request->allowMethod(['post']);
        $code = 500;
        $message = 'Erreur';
        $success = false;
        $data = $this->request->getData();
        $errors = [];

        if(!empty($data['id'])):
            $test = $this->fetchTable('Tests')->find()->contain(['Answers.Verbs'])->all();
        endif;

        $test = [];

        $response = ['success' => $success, 'code' => $code, 'message' => $message, 'data' => $data, 'errors' => $errors];

        $this->response = $this->response->withStringBody(json_encode($response));
        return $this->response;
    }

    public function getAnswers($testId){
        $this->request->allowMethod(['get']);
        $answers = $this->fetchTable('Answers')->find()->where(['test_id' => $testId])->all();
        $response = [
            'id' => $testId,
            'answers' => $answers
        ];
        $this->response = $this->response->withStringBody(json_encode($response));
        return $this->response;
    }
}
