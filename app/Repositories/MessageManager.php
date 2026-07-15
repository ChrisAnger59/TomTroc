<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Message;
use App\Models\User;

class MessageManager extends AbstractRepository
{

    public function getUserConversations(int $userId): array
    {
        try {
            $sql = "SELECT 
                    m.*,
                    u.id AS user_id,
                    u.nickname,
                    u.profile_picture_path
                    FROM messages m
                    JOIN users u 
                        ON u.id = IF(m.sender_id = :userId, m.receiver_id, m.sender_id)
                    JOIN (
                        SELECT 
                            IF(sender_id = :userId, receiver_id, sender_id) AS other_user_id,
                            MAX(created_at) as max_date
                        FROM messages
                        WHERE sender_id = :userId OR receiver_id = :userId
                        GROUP BY other_user_id
                    ) last_msg 
                        ON last_msg.other_user_id = u.id 
                        AND m.created_at = last_msg.max_date
                    ORDER BY m.created_at DESC";

            $result = $this->db->query($sql, ['userId' => $userId]);

            $conversations = [];

            while ($row = $result->fetch()) {

                $userData = [
                    'id' => $row['user_id'],
                    'nickname' => $row['nickname'],
                    'profile_picture_path' => $row['profile_picture_path']
                ];

                unset($row['user_id'], $row['nickname'], $row['profile_picture_path']);

                $message = new Message($row);
                $otherUser = new User($userData);
                
                $message->setOtherUser($otherUser);
                $conversations[] = $message;
            }

            return $conversations;

        } catch (\PDOException $e) {
            throw new \Exception("Impossible de récupérer les conversations");
        }
    }

    public function getConversation(int $user1, int $user2): array
    {
        try {
            $sql = "SELECT *
                    FROM `messages`
                    WHERE (`sender_id` = :user1 AND `receiver_id` = :user2)
                    OR (`sender_id` = :user2 AND `receiver_id` = :user1)
                    ORDER BY `created_at` ASC";

            $result = $this->db->query($sql, [
                'user1' => $user1,
                'user2' => $user2
            ]);

            return $this->hydrateMessagesFromResult($result);

        } catch (\PDOException $e) {
            throw new \Exception("Impossible de récupérer la conversation");
        }
    }

    public function sendMessage(int $senderId, int $receiverId, string $content): bool
    {
        try {
            $content = trim($content);

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

        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de l'envoi du message");
        }
    }

    public function markAsRead(int $userId, int $otherUserId): void
    {
        try {
            $sql = "UPDATE `messages` 
                    SET `is_read` = 1
                    WHERE `receiver_id` = :userId
                    AND `sender_id` = :otherUserId
                    AND `is_read` = 0";

            $this->db->query($sql, [
                'userId' => $userId,
                'otherUserId' => $otherUserId
            ]);

        } catch (\PDOException $e) {
            throw new \Exception("Impossible de marquer les messages comme lus");
        }
    }

    public function countUnreadMessages(int $userId): int
    {
        try {
            $sql = "SELECT COUNT(*)
                    FROM `messages`
                    WHERE `receiver_id` = :userId
                    AND `is_read` = 0";

            $result = $this->db->query($sql, [
                'userId' => $userId
            ]);

            return (int) $result->fetchColumn();

        } catch (\PDOException $e) {
            throw new \Exception("Impossible de compter les messages non lus");
        }
    }

    private function hydrateMessagesFromResult(\PDOStatement $result): array
    {
        $messages = [];

        while ($row = $result->fetch()) {

            $messages[] = new Message($row);

        }

        return $messages;
    }

}