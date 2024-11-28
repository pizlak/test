<?php
$hostName = "localhost";
$userName = "root";
$password = "mysql";
$database = "test";

$conn = new mysqli($hostName, $userName, $password);
$conn->query("CREATE DATABASE IF NOT EXISTS $database");
$conn->close();

$conn = new mysqli($hostName, $userName, $password, $database);
$conn->query("CREATE TABLE IF NOT EXISTS users (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_name` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL
)");
$conn->close();