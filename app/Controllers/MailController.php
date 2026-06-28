<?php 

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;

class MailController
{

    public function showMessages()
    {
        if (isset($_SESSION['id'])) {
            $view = new View();
            $view->render('mailBox');
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
                "errorMessage" => "Veuillez Vous connecter pour acceder à la page 'Messagerie' :"
                ]);
        }
    }

}