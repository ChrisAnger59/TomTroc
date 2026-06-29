<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;

class Usermanager extends AbstractRepository
{
    public function addUser(string $nickname, string $email, string $password)
    {
        $sql = "INSERT INTO `users` (`nickname`, `email`, `password`)
                VALUES (:nickname, :email, :password);";

        $result = $this->db->query($sql, [
            'nickname' => $nickname,
            'email' => $email,
            'password' => $password
        ]);
    }


    public function getUserByEmail(string $email): ?User
    {
        $sql = "SELECT * FROM `users` 
                WHERE `email` = :email";
        
        $result = $this->db->query($sql, [
            'email' => $email
        ]);

        $user = $result->fetch();

        if ($user) {
            return new User($user);
        }

        return null;
    }

    public function getUserById(int $id): ?User
    {
        $sql = "SELECT * FROM `users` 
                WHERE `id` = :id";
        
        $result = $this->db->query($sql, [
            'id' => $id
        ]);

        $user = $result->fetch();

        if ($user) {
            return new User($user);
        }

        return null;
    }


    public function updateUser(User $user): void
    {
        $sql = "UPDATE `users`
                SET `email` = :email, `nickname` = :nickname, `password` = :password
                WHERE `id` = :id;";
                
        $result = $this->db->query($sql, [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'nickname' => $user->getNickname(),
            'password' => $user->getPassword()
        ]);
    }
}