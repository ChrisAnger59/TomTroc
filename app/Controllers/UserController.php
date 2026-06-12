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
        $view->render("login");
    }

    public function showSignIn()
    {
        $view = new View();
        $view->render("signIn");
    }

}