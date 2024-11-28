<?php

namespace app\Model;
class User
{
    public function save(string $username, string $password): void
    {
        global $conn;
        $result = $conn->prepare("INSERT INTO `users` (`user_name`, `password`) VALUES (?, ?)");
        $result->bind_param("ss", $username, $password);
        $result->execute();
    }

    public function checkAuthorize(string $username, string $password): bool
    {
        global $conn;
        $result = $conn->prepare("SELECT `password` FROM `users` WHERE `user_name` = ?");
        $result->bind_param("s", $username);
        $result->execute();
        $result->bind_result($hashPassword);
        $result->fetch();

        return password_verify($password, $hashPassword);
    }

}