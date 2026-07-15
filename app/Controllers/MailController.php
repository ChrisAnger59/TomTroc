<?php 

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Services\Utils;
use App\Services\Auth;
use App\Repositories\MessageManager;
use App\Repositories\Usermanager;

class MailController
{
    private MessageManager $messageManager;
    private UserManager $userManager;

    public function __construct()
    {
        $this->messageManager = new MessageManager();
        $this->userManager = new UserManager();
    }

    public function showMessages(): void
    {
        Auth::requireLogin();

        $userId = Auth::getLoggedUserId();
        $otherUserId = filter_var(Utils::request('user'), FILTER_VALIDATE_INT);

        try {
            $otherUser = null;

            if ($otherUserId) {
                $otherUser = $this->userManager->getUserById($otherUserId);

                if (!$otherUser) {
                    Utils::redirectWithMessage("messages", "Utilisateur introuvable");
                    return;
                }
            }

            $conversations = $this->messageManager->getUserConversations($userId);

            $messages = [];

            if ($otherUserId) {
                $messages = $this->messageManager->getConversation($userId, $otherUserId);
                $this->messageManager->markAsRead($userId, $otherUserId);
            }

            (new View())->render('mailBox', [
                'conversations' => $conversations,
                'messages' => $messages,
                'userId' => $userId,
                'otherUserId' => $otherUserId,
                'otherUser' => $otherUser
            ]);

        } catch (\Exception $e) {
            Utils::redirectWithMessage("home", $e->getMessage());
        }
    }

    public function sendMessage(): void
    {
        Auth::requireLogin();

        if (!$this->isValidMessageRequest()) {
            Utils::redirectWithMessage("messages", "Requête invalide");
            return;
        }

        $senderId = Auth::getLoggedUserId();
        $receiverId = filter_var(Utils::request('receiver_id'), FILTER_VALIDATE_INT);
        $content = Utils::request('content');

        try {
            $success = $this->messageManager->sendMessage($senderId, $receiverId, $content);

            if (!$success) {
                Utils::redirectWithMessage("messages&user=" . $receiverId, "Impossible d'envoyer le message");
                return;
            }

            Utils::redirect('messages&user=' . $receiverId);

        } catch (\Exception $e) {
            Utils::redirectWithMessage("messages", $e->getMessage());
        }
    }

    private function isValidMessageRequest(): bool
    {
        return !empty($_POST['receiver_id']) && !empty($_POST['content']);
    }
}