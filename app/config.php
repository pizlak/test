<?php

define('PATH', dirname(__DIR__) . '/');

require_once PATH . 'vendor/autoload.php';

define('DB_HOST', 'localhost');
define('DB_NAME', 'test');
define('DB_USER', 'root');
define('DB_PASSWORD', 'mysql');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);