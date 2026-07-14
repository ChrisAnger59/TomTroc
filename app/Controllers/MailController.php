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

    public function showMessages()
    {
        Auth::requireLogin();

        $userId = Auth::getLoggedUserId();
        $otherUserId = Utils::request('user');
        $otherUserId = filter_var($otherUserId, FILTER_VALIDATE_INT);
        $userManager = new UserManager();
        $otherUser = null;
        
        if ($otherUserId) {
            $otherUser = $userManager->getUserById($otherUserId);
        }

        $messageManager = new MessageManager();

        $conversations = $messageManager->getUserConversations($userId);

        $messages = [];

        if ($otherUserId) {
            $messages = $messageManager->getConversation($userId, $otherUserId);

            $messageManager->markAsRead($userId, $otherUserId);
        }

        $view = new View();
        $view->render('mailBox', [
            'conversations' => $conversations,
            'messages' => $messages,
            'userId' => $userId,
            'otherUserId' => $otherUserId,
            'otherUser' => $otherUser
        ]);

    }


    public function sendMessage()
    {
        Auth::requireLogin();

        if (!$this->isValidMessageRequest()) {
            Utils::redirect('messages');
            exit;
        }

        $senderId = Auth::getLoggedUserId();
        $receiverId = filter_var(Utils::request('receiver_id'), FILTER_VALIDATE_INT);
        $content = Utils::request('content');

        $messageManager = new MessageManager();

        $success = $messageManager->sendMessage($senderId, $receiverId, $content);

        if ($success) {
            Utils::redirect('messages&user=' . $receiverId);
        }

        Utils::redirect('messages');
    }

    private function isValidMessageRequest(): bool
    {
        return !empty($_POST['receiver_id']) && !empty($_POST['content']);
    }
}