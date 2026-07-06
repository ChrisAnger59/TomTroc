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
        $search = Utils::request('search');
        $bookManager = new BookManager();
        
        
        if (!empty($search)) {
            $books = $bookManager->getSearchedBooks($search);
        } else {
            $books = $bookManager->findAllBooks();
        }

        $view = new View();
        $view->render("allBooks", ['books' => $books, 'search' => $search]);
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


    public function editBookDetails()
    {
        $idBook = Utils::request('id');
        $idBook = filter_var($idBook, FILTER_VALIDATE_INT);

        $bookManager = new BookManager();
        $book = $bookManager->findById($idBook);

        $view = new View();
        $view->render('editBookForm', ['book' => $book]);
    }

    public function updateBookInfo(): void
    {
        if (!isset($_GET['id'])) {
                $_SESSION['errorMessage'] = "Veuillez vous connecter pour modifier vos livres";
                Utils::redirect('loginForm');
                exit();
        }


        $idBook = Utils::request('id');
        $idBook = filter_var($idBook, FILTER_VALIDATE_INT);

        $title = Utils::request('title');
        $author = Utils::request('author');
        $description = Utils::request('description');
        $availability = Utils::request('availability');
        $availability = filter_var($availability, FILTER_VALIDATE_INT);

        $bookManager = new BookManager();
        $book = $bookManager->findById($idBook);

        if (!empty($title) && $title !== $book->getTitle()) {
            $book->setTitle($title);
        }

        if (!empty($author) && $author !== $book->getAuthor()) {
            $book->setAuthor($author);
        }

        if (!empty($description) && $description !== $book->getDescription()) {
            $book->setDescription($description);
        }

        if ($availability !== $book->getAvailability()) {
            $book->setAvailability($availability);
        }

        $bookManager->updateBookInfo($book);

        Utils::redirect('profil');
        exit();
        
    }

    public function deleteBook()
    {
        if (!isset($_GET['id'])) {
                $_SESSION['errorMessage'] = "Veuillez vous connecter pour supprimer vos livres";
                Utils::redirect('loginForm');
                exit();
        }

        $idBook = Utils::request('id');
        $idBook = filter_var($idBook, FILTER_VALIDATE_INT);

        $bookManager = new BookManager();
        $book = $bookManager->findById($idBook);
        $bookManager->deleteBook($book);

        Utils::redirect('profil');
        exit();

    }

    public function uploadBookPicture()
    {
        if (isset($_FILES['bookPicture'])) {

            $tmp_name = $_FILES['bookPicture']['tmp_name'];
            $file_size = $_FILES['bookPicture']['size'];
            $max_size = 5000000;

            $mime = mime_content_type($tmp_name);
            $allowed = ['image/jpg', 'image/jpeg', 'image/png'];

            if (!in_array($mime, $allowed)) {
                $error = "Type de fichier invalide";
            }

            if ($file_size > $max_size) {
                $error = "Fichier trop volumineux";
            }

            $file_extension = strrchr($_FILES['bookPicture']['type'], "/");
            $file_extension = str_replace("/", ".", $file_extension);

            $file_name = uniqid() . $file_extension;
            $folder = './../public/uploads/books/';
            $imagePath = './../public/uploads/books/'. $file_name;



            if (!isset($error)) {

                $idBook = Utils::request('id');
                $idBook = filter_var($idBook, FILTER_VALIDATE_INT);
                $bookManager = new BookManager();
                $book = $bookManager->findById($idBook);
                $oldImg = $book->getCoverPicturePath();

                if ($oldImg && file_exists($oldImg)) {
                    unlink($oldImg);
                }

                if (move_uploaded_file($tmp_name, $folder . $file_name)) {
                    $bookManager->updateCoverPicturePath($book, $imagePath);

                    Utils::redirect('updateBook', ['id' => $idBook]);
                    exit();

                } else {
                    echo "L'upload n'a pas fonctionné !";
                }
            } else {
                echo $error;
            }
            
        
        }
    }


}