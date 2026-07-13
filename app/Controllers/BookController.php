<?php 

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Services\Utils;
use App\Repositories\BookManager;
use App\Services\Auth;
use App\Services\BookValidator;
use App\Services\ImageUploader;

class BookController
{
    public function showAllBooks()
    {
        $search = Utils::request('search');
        $bookManager = new BookManager();

        $books = !empty($search)
            ? $bookManager->getSearchedBooks($search)
            : $bookManager->findAllBooks();

        (new View())->render("allBooks", [
            'books' => $books,
            'search' => $search
        ]);
    }

    public function showBookDetails()
    {
        $id = filter_var(Utils::request("id"), FILTER_VALIDATE_INT);

        $book = (new BookManager())->findById($id);

        (new View())->render("detailsBook", ['book' => $book]);
    }

    public function editBookDetails()
    {
        Auth::requireLogin();

        $idBook = filter_var(Utils::request('id'), FILTER_VALIDATE_INT);

        $bookManager = new BookManager();
        $book = $bookManager->findById($idBook);


        if (!Auth::isOwner($book->getUserId())) {
            Utils::redirect('home');
            return;
        }

        (new View())->render('editBookForm', ['book' => $book]);
    }

    public function updateBookInfo(): void
    {
        Auth::requireLogin();

        $idBook = filter_var(Utils::request('id'), FILTER_VALIDATE_INT);

        $bookManager = new BookManager();
        $book = $bookManager->findById($idBook);


        if (!Auth::isOwner($book->getUserId())) {
            Utils::redirect('home');
            return;
        }

        $title = Utils::request('title');
        $author = Utils::request('author');
        $description = Utils::request('description');
        $availability = filter_var(Utils::request('availability'), FILTER_VALIDATE_INT);

        $validator = new BookValidator();

        if (!$validator->validateUpdate($title, $author, $description, $availability)) {
            $_SESSION['errorMessage'] = implode(', ', $validator->getErrors());
            Utils::redirect('profil');
            return;
        }

        $book->updateBookInfo($title, $author, $description, $availability);
        $bookManager->updateBookInfo($book);

        Utils::redirect('profil');
    }

    public function deleteBook()
    {
        Auth::requireLogin();

        $idBook = filter_var(Utils::request('id'), FILTER_VALIDATE_INT);

        $bookManager = new BookManager();
        $book = $bookManager->findById($idBook);

        
        if (!Auth::isOwner($book->getUserId())) {
            Utils::redirect('home');
            return;
        }

        $bookManager->deleteBook($book);

        Utils::redirect('profil');
    }

    public function uploadBookPicture()
    {
        Auth::requireLogin();

        if (!isset($_FILES['bookPicture'])) {
            return;
        }

        $idBook = filter_var(Utils::request('id'), FILTER_VALIDATE_INT);
        $bookManager = new BookManager();
        $book = $bookManager->findById($idBook);
        
        if (!Auth::isOwner($book->getUserId())) {
            Utils::redirect('home');
            return;
        }

        $uploader = new ImageUploader();

        try {
            $imagePath = $uploader->upload($_FILES['bookPicture'], 'books');

            if ($book->getCoverPicturePath() && file_exists($book->getCoverPicturePath())) {
                unlink($book->getCoverPicturePath());
            }

            $bookManager->updateCoverPicturePath($book, $imagePath);
            Utils::redirect('updateBook', ['id' => $idBook]);
            
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}