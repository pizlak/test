<?php

use app\Controllers\AuthorisationController;
use app\Controllers\RegistrationController;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->get('/', [RegistrationController::class, 'register'])->setName('home');
$app->get('/login', [AuthorisationController::class, 'login'])->setName('login');
$app->get('/profile', [AuthorisationController::class, 'profile'])->setName('profile');
$app->get('/logout', [AuthorisationController::class, 'logout'])->setName('logout');
$app->post('/registration', [RegistrationController::class, 'registration'])->setName('registration');
$app->post('/authorisation', [AuthorisationController::class, 'authorisation'])->setName('authorisation');

$app->run();