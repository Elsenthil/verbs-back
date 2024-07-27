<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;
use Cake\Http\Cookie\Cookie;
use Cake\Http\Response;
use Cake\I18n\FrozenTime;
use Firebase\JWT\JWT;
use Cake\Utility\Security;

class AppController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');
        $this->loadComponent('Authentication.Authentication');
        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $user = $this->request->getAttribute('user');
        if ($user) {
            $this->set('authUser', $user);
        }
    }

    private $expiration = 3600;
    protected function createCookie($user){
        $token = JWT::encode([
            'sub' => $user->id,
            'exp' => time() + $this->expiration // 1 heure
        ], Security::getSalt(), 'HS256');
        $user->token = $token;
        $this->fetchTable('Users')->save($user);

        $expiry = new FrozenTime('+1 hour');
        $cookie = new Cookie(
            'token',
            $token,
            $expiry,
            '/',
            '', // Change to your domain if needed
            true, // Secure (only sent over HTTPS)
            true, // HttpOnly (not accessible via JavaScript)
            'None', // SameSite (can be 'Strict', 'Lax', or 'None')
            'Strict'
        );
        return $cookie;
    }
}
