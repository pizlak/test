<?php
require_once __DIR__ . "/../app/config.php";

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);
$conn->query("CREATE DATABASE IF NOT EXISTS " . DB_NAME);
$conn->close();

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$conn->query("CREATE TABLE IF NOT EXISTS users (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_name` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL
)");
$conn->close();