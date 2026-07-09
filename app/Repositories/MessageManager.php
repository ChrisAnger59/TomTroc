<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Message;
use App\Models\User;

class MessageManager extends AbstractRepository
{
    public function getUserConversations(int $userId): array
    {
        $sql = "SELECT `messages`.*, `users`.`id`, `users`.`nickname`
                FROM `messages`
                INNER JOIN `users`
                    ON `users`.`id` = IF(`messages`.`sender_id` = :userId, `messages`.`receiver_id`, `messages`.`sender_id`)
                WHERE `messages`.`sender_id` = :userId OR `messages`.`receiver_id` = :userId
                ORDER BY `messages`.`created_at` DESC;";

        $result = $this->db->query($sql, ['userId' => $userId]);

        return $this->hydrateConversationsFromResult($result);
    }

    public function getConversation(int $user1, int $user2): array
    {
        $sql = "SELECT *
                FROM `messages`
                WHERE (`sender_id` = :user1 AND `receiver_id` = :user2)
                OR (`sender_id` = :user2 AND `receiver_id` = :user1)
                ORDER BY `created_at` ASC;";

        $result = $this->db->query($sql, [
            'user1' => $user1,
            'user2' => $user2
        ]);

        return $this->hydrateMessagesFromResult($result);
    }


    private function hydrateMessagesFromResult(\PDOStatement $result): array
    {
        $messages = [];

        while ($row = $result->fetch()) {

            $messages[] = new Message($row);

        }

        return $messages;
    }

    private function hydrateConversationsFromResult(\PDOStatement $result): array
    {
        $conversations = [];
        $seenUsers = [];

        while ($row = $result->fetch()) {

            $messageData = [];
            $userData = [];

            foreach ($row as $key => $value) {

                if (in_array($key, ['id', 'nickname'])) {
                    $userData[$key] = $value;
                    continue;
                }

                $messageData[$key] = $value;
            }

            $otherUserId = $userData['id'];

            if (isset($seenUsers[$otherUserId])) {
                continue;
            }

            $seenUsers[$otherUserId] = true;
            $message = new Message($messageData);
            $otherUser = new User($userData);
            $message->setOtherUser($otherUser);
            $conversations[] = $message;
        }

        return $conversations;
    }


    public function sendMessage(int $senderId, int $receiverId, string $content): bool
    {
        $content = trim($content);

        // Sécurité basique
        if ($senderId <= 0 || $receiverId <= 0) {
            return false;
        }

        if ($senderId === $receiverId) {
            return false;
        }

        if ($content === '') {
            return false;
        }

        $sql = "INSERT INTO messages (sender_id, receiver_id, content, created_at)
                VALUES (:sender, :receiver, :content, NOW())";

        $this->db->query($sql, [
            'sender' => $senderId,
            'receiver' => $receiverId,
            'content' => $content
        ]);

        return true;
    }
}