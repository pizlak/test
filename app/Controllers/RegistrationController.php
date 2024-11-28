<?php

namespace app\Controllers;

use app\Model\User;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class RegistrationController
{
    public function register(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if(isset($_COOKIE['username'])){
            return $response->withHeader('Location', '/profile')
                ->withStatus(302);
        }

        ob_start();
        require PATH . 'src/registration.php';
        $content = ob_get_clean();

        $response->getBody()->write($content);

        return $response;
    }

    public function registration(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $data = $request->getParsedBody();
        $username = $data['user_name'];
        $password = $data['password'];

        if (!preg_match('/^[a-zA-Z0-9]{2,20}$/', $username)){
            $response->getBody()
                ->write(json_encode([
                    'error' => true,
                    'message' => 'Ошибка регистрации. Логин должен состоять из латинских символов и цифр, не должен быть длинее 20 и меньше 2 символов.'
                ]));

            return $response->withHeader('Content-Type', 'application/json');
        }
        if (strlen($password) < 5){
            $response->getBody()
                ->write(json_encode([
                    'error' => true,
                    'message' => 'Ошибка регистрации. Пароль должен содержать не менее 5 символов.'
                ]));

            return $response->withHeader('Content-Type', 'application/json');
        }
        if (ctype_digit($password)){
            $response->getBody()
                ->write(json_encode([
                    'error' => true,
                    'message' => 'Ошибка регистрации. В пароле должны быть символы, кроме цифр.'
                ]));

            return $response->withHeader('Content-Type', 'application/json');
        }

        (new User())->save($username, password_hash($password, PASSWORD_DEFAULT));

        $response->getBody()
            ->write(json_encode(['error' => false]));

        return $response->withHeader('Content-Type', 'application/json');
    }
}