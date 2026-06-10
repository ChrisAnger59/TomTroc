<?php 

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;

class MailController
{

    public function showMessages()
    {
        $view = new View("Vos Messages");
        $view->render("mailBox");
    }

}