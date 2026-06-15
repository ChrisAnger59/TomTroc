<?php 

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;

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
        $view->render("login", [
            "titre" => "Se Connecter",
            "action" => "",
            "signin" => false,
            "buttonText" => "Se Connecter",
            "mentionLink" => "Pas de compte ?",
            "link" => "index.php?action=signin",
            "textLink" => "Inscrivez-vous"

        ]);
    }

    public function showSignIn()
    {
        $view = new View();
        $view->render("login", [
            "titre" => "Inscription",
            "action" => "",
            "signin" => "true",
            "buttonText" => "S'inscrire",
            "mentionLink" => "Déjà inscrit ?",
            "link" => "index.php?action=login",
            "textLink" => "Connectez-vous"
        ]);
    }

}