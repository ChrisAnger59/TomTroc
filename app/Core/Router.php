<?php 

declare(strict_types=1);

namespace App\Core;

use App\Services\Utils;
use App\Controllers\HomeController;
use App\Controllers\BookController;
use App\Controllers\MailController;
use App\Controllers\UserController;

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

            case 'profil':
                $userController = new UserController();
                $userController->showUser();
                break;
            
            case 'login':
                $userController = new UserController();
                $userController->showLogin();
                break;

            case 'signin':
                $userController = new UserController();
                $userController->showSignIn();
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