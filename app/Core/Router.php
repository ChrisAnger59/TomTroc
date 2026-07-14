<?php 

declare(strict_types=1);

namespace App\Core;

use App\Services\Utils;
use App\Controllers\HomeController;
use App\Controllers\BookController;
use App\Controllers\MailController;
use App\Controllers\UserController;
use App\Models\User;

class Router
{

    public function handleRequest(): void
    {

        $action = Utils::request('action', 'home');

        switch ($action) {

            case 'home':
                $homeController = new HomeController();
                $homeController->showHome();
                break;
            
            case 'allBooks':
                $bookController = new BookController();
                $bookController->showAllBooks();
                break;
            
            case 'detailsBook':
                $bookController = new BookController();
                $bookController->showBookDetails();
                break;

            case 'mailBox':
                $mailController = new MailController();
                $mailController->showMessages();
                break;

            case 'messages':
                $mailController = new MailController();
                $mailController->showMessages();
                break;

            case 'sendMessage': 
                $mailController = new MailController();
                $mailController->sendMessage();
                break;

            case 'profil':
                $userController = new UserController();
                $userController->showUser();
                break;

            case 'uploadProfilePicture':
                $userController = new UserController();
                $userController->uploadProfilePicture();
                break;

            case 'uploadBookPicture':
                $bookController = new BookController();
                $bookController->uploadBookPicture();
                break;
            
            case 'loginForm':
                $userController = new UserController();
                $userController->showLogin();
                break;

            case 'connectUser':
                $userController = new UserController();
                $userController->connectUser();
                break;

            case 'detailsUser':
                $userController = new UserController();
                $userController->showPublicUser();
                break;

            case 'signinForm':
                $userController = new UserController();
                $userController->showSignIn();
                break;

            case 'register':
                $userController = new UserController();
                $userController->addUser();
                break;

            case 'disconnect':
                $userController = new UserController();
                $userController->disconnectUser();
                break;
            
            case 'updatePersonalInfo':
                $userController = new UserController();
                $userController->updatePersonalInfo();
                break;

            case'updateBook':
                $bookController = new BookController();
                $bookController->editBookDetails();
                break;

            case 'updateBookInfo':
                $bookController = new BookController();
                $bookController->updateBookInfo();
                break;

            case 'deleteBook':
                $bookController = new BookController();
                $bookController->deleteBook();
                break;

            case 'privacyPolicy':
                $homeController = new HomeController;
                $homeController->showPrivacyPolicy();
                break;

            case 'legalMentions':
                $homeController = new HomeController;
                $homeController->showLegalMentions();
                break;
               
            default:
                throw new \Exception("La page demandée n'existe pas.");

        }

    }

}