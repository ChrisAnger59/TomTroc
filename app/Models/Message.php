<?php

declare(strict_types=1);

namespace App\Models;

class Message extends AbstractModel
{
    private int $senderId;
    private int $receiverId;
    private string $content = "";
    private string $createdAt = "";
    private ?User $otherUser = null;

    
    public function setSenderId(int $senderId): void
    {
        $this->senderId = $senderId;
    }

    public function getSenderId(): int
    {
        return $this->senderId;
    }


    public function setReceiverId(int $receiverId): void
    {
        $this->receiverId = $receiverId;
    }

    public function getReceiverId(): int
    {
        return $this->receiverId;
    }


    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }


    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }


    public function setOtherUser(User $user): void
    {
        $this->otherUser = $user;
    } 

    public function getOtherUser(): ?User
    {
        return $this->otherUser;
    }
}