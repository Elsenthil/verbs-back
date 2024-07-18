<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

class TokensController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
    }

    public function getToken()
    {
        $token = $this->request->getAttribute('csrfToken');
        $this->set([
            'csrfToken' => $token,
            '_serialize' => ['csrfToken']
        ]);
        echo $token;
        exit();
    }
}
