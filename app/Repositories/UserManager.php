<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;

class UserManager extends AbstractRepository
{
    public function addUser(string $nickname, string $email, string $password): void
    {
        try {
            $sql = "INSERT INTO `users` (`nickname`, `email`, `password`, `profile_picture_path`)
                    VALUES (:nickname, :email, :password, :profilePicture)";

            $this->db->query($sql, [
                'nickname' => $nickname,
                'email' => $email,
                'password' => $password,
                'profilePicture' => User::DEFAULT_PPP
            ]);

        } catch (\PDOException $e) {
            throw new \Exception("Impossible de créer le compte");
        }
    }

    public function getUserByEmail(string $email): ?User
    {
        try {
            $sql = "SELECT * FROM `users` 
                    WHERE `email` = :email";

            $result = $this->db->query($sql, [
                'email' => $email
            ]);

            $user = $result->fetch();

            return $user ? new User($user) : null;

        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération de l'utilisateur");
        }
    }

    public function getUserById(int $id): ?User
    {
        try {
            $sql = "SELECT * FROM `users` 
                    WHERE `id` = :id";

            $result = $this->db->query($sql, [
                'id' => $id
            ]);

            $user = $result->fetch();

            return $user ? new User($user) : null;

        } catch (\PDOException $e) {
            throw new \Exception("Impossible de récupérer l'utilisateur");
        }
    }

    public function updateUser(User $user): void
    {
        try {
            $sql = "UPDATE `users`
                    SET `email` = :email, `nickname` = :nickname, `password` = :password
                    WHERE `id` = :id";

            $this->db->query($sql, [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'nickname' => $user->getNickname(),
                'password' => $user->getPassword()
            ]);

        } catch (\PDOException $e) {
            throw new \Exception("Impossible de mettre à jour le profil");
        }
    }

    public function updateProfilePicturePath(User $user, string $newPath): void
    {
        try {
            $sql = "UPDATE `users`
                    SET `profile_picture_path` = :newPath
                    WHERE `id` = :id";

            $this->db->query($sql, [
                'id' => $user->getId(),
                'newPath' => $newPath
            ]);

        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la mise à jour de l'image");
        }
    }
}