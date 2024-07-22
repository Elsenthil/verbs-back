<?php
namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

// src/Middleware/CorsMiddleware.php
class CorsMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        file_put_contents(WWW_ROOT.DS.'log.txt', 'Processing CORS Middleware' . PHP_EOL, FILE_APPEND);

        $origin = $request->getHeaderLine('Origin');
        $allowedOrigins = ['http://localhost:3000'];

        if ($request->getMethod() === 'OPTIONS') {
            file_put_contents(WWW_ROOT.DS.'log.txt', 'Handling OPTIONS request' . PHP_EOL, FILE_APPEND);

            $response = new \Laminas\Diactoros\Response();
            if (in_array($origin, $allowedOrigins)) {
                $response = $response->withHeader('Access-Control-Allow-Origin', $origin)
                                     ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                                     ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-CSRF-Token')
                                     ->withHeader('Access-Control-Allow-Credentials', 'true');
            }

            return $response->withStatus(204);
        }

        $response = $handler->handle($request);

        if (in_array($origin, $allowedOrigins)) {
            $response = $response->withHeader('Access-Control-Allow-Origin', $origin)
                                 ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                                 ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-CSRF-Token')
                                 ->withHeader('Access-Control-Allow-Credentials', 'true');
        }

        file_put_contents(WWW_ROOT.DS.'log.txt', 'CORS Middleware processed' . PHP_EOL, FILE_APPEND);
        return $response;
    }
}
