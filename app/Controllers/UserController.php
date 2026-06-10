<?php 

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;

class UserController
{

    public function showUser()
    {
        $view = new View("Mon Compte");
        $view->render("profil");
    }

    public function showLogin()
    {
        $view = new View("Connexion");
        $view->render("login");
    }

    public function showSignIn()
    {
        $view = new View("Inscription");
        $view->render("signIn");
    }

}