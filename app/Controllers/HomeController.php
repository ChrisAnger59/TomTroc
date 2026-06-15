<?php 

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Repositories\BookManager;

class HomeController
{

    public function showHome()
    {

        $bookManager = new BookManager();
        $books = $bookManager->findLastBooks();

        $view = new View();
        $view->render("home", ['books' => $books]);
    }

    public function showPrivacyPolicy()
    {
        $view = new View();
        $view->render("privacyPolicy");
    }

    public function showLegalMentions()
    {
        $view = new View();
        $view->render("legalMentions");
    }

}