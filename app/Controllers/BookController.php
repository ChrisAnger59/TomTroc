<?php 

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Services\Utils;
use App\Repositories\BookManager;
use App\Services\Auth;

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

        // ✅ sécurité ownership
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

        // ✅ sécurité ownership
        if (!Auth::isOwner($book->getUserId())) {
            Utils::redirect('home');
            return;
        }

        $title = Utils::request('title');
        $author = Utils::request('author');
        $description = Utils::request('description');
        $availability = filter_var(Utils::request('availability'), FILTER_VALIDATE_INT);

        if (!empty($title)) {
            $book->setTitle($title);
        }

        if (!empty($author)) {
            $book->setAuthor($author);
        }

        if (!empty($description)) {
            $book->setDescription($description);
        }

        if ($availability !== null) {
            $book->setAvailability($availability);
        }

        $bookManager->updateBookInfo($book);

        Utils::redirect('profil');
    }

    public function deleteBook()
    {
        Auth::requireLogin();

        $idBook = filter_var(Utils::request('id'), FILTER_VALIDATE_INT);

        $bookManager = new BookManager();
        $book = $bookManager->findById($idBook);

        // ✅ sécurité ownership
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

        $tmp_name = $_FILES['bookPicture']['tmp_name'];
        $file_size = $_FILES['bookPicture']['size'];

        $mime = mime_content_type($tmp_name);
        $allowed = ['image/jpg', 'image/jpeg', 'image/png'];

        if (!in_array($mime, $allowed)) {
            echo "Type de fichier invalide";
            return;
        }

        if ($file_size > 5000000) {
            echo "Fichier trop volumineux";
            return;
        }

        $idBook = filter_var(Utils::request('id'), FILTER_VALIDATE_INT);

        $bookManager = new BookManager();
        $book = $bookManager->findById($idBook);

        // ✅ sécurité ownership
        if (!Auth::isOwner($book->getUserId())) {
            Utils::redirect('home');
            return;
        }

        $file_extension = str_replace("/", ".", strrchr($_FILES['bookPicture']['type'], "/"));
        $file_name = uniqid() . $file_extension;

        $folder = './../public/uploads/books/';
        $imagePath = $folder . $file_name;

        if ($book->getCoverPicturePath() && file_exists($book->getCoverPicturePath())) {
            unlink($book->getCoverPicturePath());
        }

        if (move_uploaded_file($tmp_name, $imagePath)) {
            $bookManager->updateCoverPicturePath($book, $imagePath);
            Utils::redirect('updateBook', ['id' => $idBook]);
        }
    }
}