<?php 

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Services\Utils;
use App\Repositories\UserManager;
use PDOException;

class UserController
{

    public function showUser()
    {
        $view = new View();
        $view->render("profil");
    }

    public function showLogin()
    {
        $view = new View();
        $view->render("loginForm", [
            "titre" => "Se Connecter",
            "action" => "connectUser",
            "signin" => false,
            "buttonText" => "Se Connecter",
            "mentionLink" => "Pas de compte ?",
            "link" => "index.php?action=signinForm",
            "textLink" => "Inscrivez-vous"

        ]);
    }

    public function showSignIn()
    {
        $view = new View();
        $view->render("loginForm", [
            "titre" => "Inscription",
            "action" => "register",
            "signin" => "true",
            "buttonText" => "S'inscrire",
            "mentionLink" => "Déjà inscrit ?",
            "link" => "index.php?action=loginForm",
            "textLink" => "Connectez-vous"
        ]);
    }


    public function catchNewUser()
    {
        $email = Utils::request('email');
        $nickname = Utils::request('nickname');
        $password = Utils::request('password');

        if (empty($email) || empty($nickname) || empty($password)) {
            throw new \Exception("Tous les champs sont obligatoires");
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $userManager = new UserManager();

        try {
            $userManager->addUser($nickname, $email, $hashedPassword);
        } catch (\Exception $e) {
            echo "Exception reçue: ", $e->getMessage();
        }

        header("Location: index.php?action=loginForm");
        exit();
    }


    public function connectUser()
    {
        $email = Utils::request('email');
        $password = Utils::request('password');

        if (empty($email) || empty($password)) {
            throw new \Exception("Un ou plusieurs champs ne sont pas remplis");
        }

        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($email);

        if ($user && $user->verifyPassword($password)) {
            $view = new View();
            $view->render("profil", ['user' => $user]);

        } else {
            throw new \Exception("L'email ou le mot de passe est incorrect");
        }


    }

}