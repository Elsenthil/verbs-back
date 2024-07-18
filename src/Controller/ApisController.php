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
        $message = 'Impossible d\'ajouter le verbe irrégulier';

        $data = $this->request->getData();
        $verb = $this->fetchTable('Verbs')->newEmptyEntity();
        // if(!empty($data)):
            
        //     $verb->infinitive = $data['infinitive'];
        //     $verb->preterit = $data['preterit'];
        //     $verb->past_participle = $data['past_participle'];
        //     $verb->translation = $data['translation'];

        //     if($this->fetchTable('Verbs')->save($verb)):
        //         $code = 200;
        //         $message = 'Verbe ajouté avec succès';
        //     else:
        //         $message = 'Impossible d\'enregistrer le verbe';
        //     endif;
        // endif;

        $response = ['code' => $code, 'message' => $message, 'data' => $data, 'verb' => $verb];

        $this->response = $this->response->withStringBody(json_encode($response));
        return $this->response;
    }
}
