<?php

namespace app\Controllers;

use app\Model\User;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AuthorisationController
{
    public function authorisation(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $data = $request->getParsedBody();
        $username = $data['user_name'];
        $password = $data['password'];

        $user = new User;

        if($user->checkAuthorize($username, $password) === false){
            $response->getBody()
                ->write(json_encode([
                    'error' => true,
                    'message' => 'Не верный логин или пароль.'
                ]));

            return $response->withHeader('Content-Type', 'application/json');
        }

        setcookie('username',$username, time() + 60 * 60 * 24 * 365, '/');

        $response->getBody()
            ->write(json_encode(['error' => false]));

        return $response->withHeader('Content-Type', 'application/json');
    }

    public function profile(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if(!isset($_COOKIE['username'])){
            return $response->withHeader('Location', '/login')
                ->withStatus(302);
        }
        $username = $_COOKIE['username'];

        ob_start();
        require PATH . 'src/profile.php';
        $content = ob_get_clean();

        $response->getBody()->write($content);

        return $response;
    }

    public function logout(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        setcookie('username',$_COOKIE['username'], time() - 60 * 60 * 24 * 365, '/');

        return $response->withHeader('Location', '/login')
            ->withStatus(302);
    }

    public function login(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if(isset($_COOKIE['username'])){
            return $response->withHeader('Location', '/profile')
                ->withStatus(302);
        }

        ob_start();
        require PATH . 'src/authorisation.php';
        $content = ob_get_clean();

        $response->getBody()->write($content);

        return $response;
    }
}