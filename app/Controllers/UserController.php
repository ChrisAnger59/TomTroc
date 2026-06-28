<?php 

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Services\Utils;
use App\Repositories\UserManager;

class UserController
{

    public function showUser()
    {
        if (isset($_SESSION['id'])) {
            $idSession = $_SESSION['id'];
            $userManager = new UserManager();
            $user = $userManager->getUserById($idSession);

            $view = new View();
            $view->render('profil', ['user' => $user]); 
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

}