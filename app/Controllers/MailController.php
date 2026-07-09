<?php 

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Services\Utils;
use App\Services\Auth;
use App\Repositories\MessageManager;

class MailController
{

    public function showMessages()
    {
        Auth::requireLogin();

        $userId = Auth::getLoggedUserId();
        $otherUser = Utils::request('user');
        $otherUser = filter_var($otherUser, FILTER_VALIDATE_INT);

        $messageManager = new MessageManager();

        $conversations = $messageManager->getUserConversations($userId);

        $messages = [];

        if ($otherUser) {
            $messages = $messageManager->getConversation($userId, $otherUser);
        }

        $view = new View();
        $view->render('mailBox', [
            'conversations' => $conversations,
            'messages' => $messages,
            'userId' => $userId,
            'otherUserId' => $otherUser
        ]);

    }


    public function sendMessage()
    {
        Auth::requireLogin();

        $senderId = Auth::getLoggedUserId();
        $receiverId = filter_var(Utils::request('receiver_id'), FILTER_VALIDATE_INT);
        $content = Utils::request('content');

        $messageManager = new MessageManager();

        $success = $messageManager->sendMessage($senderId, $receiverId, $content);

        // Redirection après envoi
        if ($success) {
            Utils::redirect('messages&user=' . $receiverId);
        }

        // fallback en cas d'erreur
        Utils::redirect('messages');
    }
}