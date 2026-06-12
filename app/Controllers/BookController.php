<?php 

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Services\Utils;
use App\Repositories\BookManager;

class BookController
{

    public function showAllBooks()
    {
        $bookManager = new BookManager();
        $books = $bookManager->findAllBooks();

        $view = new View();
        $view->render("allBooks", ['books' => $books]);
    }


    public function showBookDetails()
    {
        $id = Utils::request("id", -1);
        $id = filter_var($id, FILTER_VALIDATE_INT);

        $bookManager = new BookManager();
        $book = $bookManager->findById($id);

        $view = new View();
        $view->render("detailsBook", ['book' => $book]);
    }

}