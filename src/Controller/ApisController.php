<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

class ApisController extends AppController
{
    public function beforeFilter(EventInterface $event) {
        parent::beforeFilter($event);
        $this->response = $this->response->withType('application/json');
    }

    public function getVerbs(){
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
}
