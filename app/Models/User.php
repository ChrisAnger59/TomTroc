<?php

declare(strict_types=1);

namespace App\Models;

use DateTime;

class User extends AbstractModel
{
    private string $nickname = "";
    private string $email = "";
    private string $password = "";
    private ?string $profilePicturePath = "";
    private string $createdAt = "";
    private ?string $updatedAt = "";
    private string $status = "";
    public const DEFAULT_PPP = './../public/uploads/users/defaultPicture.png'; 

    public function setNickname(string $nickname): void
    {
        $this->nickname = $nickname;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }


    public function setProfilePicturePath(?string $profilePicturePath): void
    {
        $this->profilePicturePath = $profilePicturePath;
    }

    public function getProfilePicturePath(): string
    {
        return $this->profilePicturePath;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getcreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setUpdatedAt(?string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getstatus(): string
    {
        return $this->status;
    }

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }

    public function getMembershipTime(): string
    {
        $createdAt = new DateTime($this->createdAt);
        $now = new DateTime();

        $duration = $createdAt->diff($now);

        if ($duration->y > 0) {
            return "Membre depuis " . $duration->y . " ans"; 
        } elseif ($duration->m > 0) {
            return "Membre depuis ". $duration->m . " mois";
        } else {
            return "Membre depuis ". $duration->d . " jours";
        }
    }

    public function updateUserInfo(?string $email, ?string $nickname, ?string $password): void
    {
        if (!empty($email) && $email !== $this->email) {
            $this->email = $email;
        }

        if (!empty($nickname) && $nickname !== $this->nickname) {
            $this->nickname = $nickname;
        }

        if (!empty($password)) {
            $this->password = password_hash($password, PASSWORD_DEFAULT);
        }
    }
}