<?php

declare(strict_types=1);

namespace App\Models;

class Book extends AbstractModel
{
    private string $title = "";
    private string $author = "";
    private int $userId;
    private int $availability;
    private string $coverPicturePath = "";
    private string $createdAt = ""; 
    private ?string $updatedAt = "";
    private string $description = "";
    private string $owner = "";
    private string $profilePicturePath= "";


    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }


    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }


    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }


    public function setAvailability(int $availability): void
    {
        $this->availability = $availability;
    }

    public function getAvailability(): int
    {
        return $this->availability;
    }


    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }


    public function setCoverPicturePath(string $coverPicturePath): void
    {
        $this->coverPicturePath = $coverPicturePath;
    }

    public function getCoverPicturePath(): string
    {
        return $this->coverPicturePath;
    }


    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt(): string
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

    public function setOwner(string $owner): void
    {
        $this->owner = $owner;
    }

    public function getOwner(): string
    {
        return $this->owner;
    }

    public function setProfilePicturePath(string $profilePicturePath): void
    {
        $this->profilePicturePath = $profilePicturePath;
    }

    public function getProfilePicturePath(): string
    {
        return $this->profilePicturePath;
    }

}