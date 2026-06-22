<?php

declare(strict_types=1);

namespace App\Models;

class User extends AbstractModel
{
    private string $nickname = "";
    private string $email = "";
    private string $password = "";
    private string $profilePicturePath = "";
    private string $createdAt = "";
    private ?string $updatedAt = "";
    private string $status = "";

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


    public function setProfilePicturePath(string $profilPicturePath): void
    {
        $this->profilPicturePath = $profilPicturePath;
    }

    public function getProfilePicturePath(): string
    {
        return $this->profilPicturePath;
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
}