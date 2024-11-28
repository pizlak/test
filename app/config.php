<?php

define('PATH', dirname(__DIR__) . '/');

require_once PATH . 'vendor/autoload.php';

$host = 'localhost';
$dbname = 'test';
$user = 'root';
$pass = 'mysql';
$conn = new mysqli($host, $user, $pass, $dbname);