<?php 

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Services\Utils;
use App\Repositories\UserManager;
use App\Repositories\BookManager;

class UserController
{

    public function showUser()
    {
        if (isset($_SESSION['id'])) {
            $idSession = $_SESSION['id'];

            $userManager = new UserManager();
            $user = $userManager->getUserById($idSession);

            $bookManager = new BookManager();
            $books = $bookManager->getBooksOfUser($user);

            $errorMessage = $_SESSION['errorMessage'] ?? null;
            unset($_SESSION['errorMessage']);

            $view = new View();
            $view->render('profil', ['user' => $user, 'books' => $books, 'errorMessage' => $errorMessage]); 
        }
        else {
            $view = new View();
            $view->render('loginForm', [
                "titre" => "Se Connecter",
                "action" => "connectUser",
                "signin" => false,
                "buttonText" => "Se Connecter",
                "mentionLink" => "Pas de compte ?",
                "link" => "index.php?action=signinForm",
                "textLink" => "Inscrivez-vous",
                "redirectFromProfil" => true,
                "errorMessage" => "Veuillez Vous connecter pour acceder à la page 'Mon compte' :"
                ]);
        }
    }

    public function showLogin()
    {
        $errorMessage = $_SESSION['errorMessage'] ?? null;

        unset($_SESSION['errorMessage']);

        $view = new View();
        $view->render("loginForm", [
            "titre" => "Se Connecter",
            "action" => "connectUser",
            "signin" => false,
            "buttonText" => "Se Connecter",
            "mentionLink" => "Pas de compte ?",
            "link" => "index.php?action=signinForm",
            "textLink" => "Inscrivez-vous",
            "redirectFromProfil" => false,
            "errorMessage" => $errorMessage

        ]);
    }

    public function showSignIn()
    {
        $errorMessage = $_SESSION['errorMessage'] ?? null;

        unset($_SESSION['errorMessage']);

        $view = new View();
        $view->render("loginForm", [
            "titre" => "Inscription",
            "action" => "register",
            "signin" => true,
            "buttonText" => "S'inscrire",
            "mentionLink" => "Déjà inscrit ?",
            "link" => "index.php?action=loginForm",
            "textLink" => "Connectez-vous",
            "redirectFromProfil" => false,
            "errorMessage" => $errorMessage
        ]);
    }


    public function addUser()
    {
        $email = Utils::request('email');
        $nickname = Utils::request('nickname');
        $password = Utils::request('password');

        if (empty($email) || empty($nickname) || empty($password)) {
            $_SESSION['errorMessage'] = "Merci de renseigner tous les champs";

            Utils::redirect('signinForm');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errorMessage'] = "L'email n'est pas valide";

            Utils::redirect('signinForm');
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $userManager = new UserManager();

        try {
            $userManager->addUser($nickname, $email, $hashedPassword);
        } catch (\Exception $e) {
            echo "Exception reçue: ", $e->getMessage();
        }

        Utils::redirect('loginForm');
        exit();
    }


    public function connectUser()
    {
        $email = Utils::request('email');
        $password = Utils::request('password');

        if (empty($email) || empty($password)) {
            $_SESSION['errorMessage'] = "Merci de renseigner tous les champs";

            Utils::redirect('loginForm');
            exit;
        }

        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($email);

        if ($user && $user->verifyPassword($password)) {
            $_SESSION['id'] = $user->getId();
            Utils::redirect('home');

        } else {
            $_SESSION['errorMessage'] = "Identifiant ou mot de passe incorrect";

            Utils::redirect('loginForm');
            exit;
        }
    }

    public function disconnectUser()
    {
        $_SESSION = [];

        session_destroy();

        Utils::redirect('loginForm');
        exit;
    }

    public function updatePersonalInfo(): void
    {
        if (!isset($_SESSION['id'])) {
            $_SESSION['errorMessage'] = "Veuillez vous connecter pour modifier vos infos";
            Utils::redirect('loginForm');
            exit();
        }

        $email = Utils::request('email');
        $password = Utils::request('password');
        $nickname = Utils::request('nickname');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errorMessage'] = "L'email n'est pas valide";

            Utils::redirect('profil');
            exit();
        }

        $idUser = $_SESSION['id'];
        $userManager = new UserManager();
        $user = $userManager->getUserById($idUser);

        if (!empty($email) && $email !== $user->getEmail()) {
            $user->setEmail($email);
        }

        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $user->setPassword($hashedPassword);
        }

        if (!empty($nickname) && $nickname !== $user->getNickname()) {
            $user->setNickname($nickname);
        }

        $userManager->updateUser($user);

        Utils::redirect('profil');
        exit();
    }

    public function showPublicUser()
    {
        $idUser = Utils::request("id", -1);
        $idUser = filter_var($idUser, FILTER_VALIDATE_INT);
        
        $userManager = new UserManager();
        $user = $userManager->getUserById($idUser);

        $bookManager = new BookManager();
        $books = $bookManager->getBooksOfUser($user);

        $view = new View();
        $view->render('detailUser', [
            'user' => $user,
            'books' => $books
        ]);
        
    }

}