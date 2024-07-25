<?php
namespace App\Middleware;

use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TokenMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $authHeader = $request->getHeaderLine('Authorization');
        if ($authHeader) {
            list($token) = sscanf($authHeader, 'Bearer %s');
            if ($token) {
                try {
                    $key = 'your-secret-key';
                    $decoded = JWT::decode($token, new Key($key, 'HS256'));
                    // Ajouter les informations de l'utilisateur au request
                    $request = $request->withAttribute('user', $decoded);
                } catch (\Exception $e) {
                    return new Response(['body' => 'Unauthorized', 'status' => 401]);
                }
            }
        }

        return $handler->handle($request);
    }
}
