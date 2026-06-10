<?php 

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;

class BookController
{

    public function showAllBooks()
    {
        $view = new View("Nos Livres à l'échange");
        $view->render("allBooks");
    }


    public function showBookDetails()
    {
        $view = new View("Détails du livre");
        $view->render("detailsBook");
    }

}