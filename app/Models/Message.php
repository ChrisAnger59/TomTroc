<?php

declare(strict_types=1);

namespace App\Models;

use DateTime;

class Message extends AbstractModel
{
    private int $senderId;
    private int $receiverId;
    private string $content = "";
    private ?DateTime $createdAt = null;
    private int $isRead;
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


    public function setCreatedAt(string|DateTime $createdAt, string $format = 'Y-m-d H:i:s'): void
    {
        if (is_string($createdAt)) {
            $createdAt = DateTime::createFromFormat($format, $createdAt);
        }
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt(): DateTime
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
    

    public function setIsRead(int $isRead): void
    {
        $this->isRead = $isRead;
    }

    public function getIsRead(): int
    {
        return $this->isRead;
    }
}