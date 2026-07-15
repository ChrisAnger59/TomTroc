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
    private BookManager $bookManager;

    public function __construct()
    {
        $this->bookManager = new BookManager();
    }

    public function showAllBooks(): void
    {
        $search = Utils::request('search');

        try {
            $books = !empty($search)
                ? $this->bookManager->getSearchedBooks($search)
                : $this->bookManager->findAllBooks();

            (new View())->render("allBooks", [
                'books' => $books,
                'search' => $search
            ]);

        } catch (\Exception $e) {
            Utils::redirectWithMessage("home", $e->getMessage());
        }
    }

    public function showBookDetails(): void
    {
        $id = filter_var(Utils::request("id"), FILTER_VALIDATE_INT);

        if (!$id) {
            Utils::redirectWithMessage("home", "Livre invalide");
            return;
        }

        try {
            $book = $this->bookManager->findById($id);

            if (!$book) {
                Utils::redirectWithMessage("home", "Livre introuvable");
                return;
            }

            (new View())->render("detailsBook", ['book' => $book]);

        } catch (\Exception $e) {
            Utils::redirectWithMessage("home", $e->getMessage());
        }
    }

    public function editBookDetails(): void
    {
        Auth::requireLogin();

        $book = $this->getOwnedBookFromRequest("home");
        if (!$book) return;

        (new View())->render('editBookForm', ['book' => $book]);
    }

    public function updateBookInfo(): void
    {
        Auth::requireLogin();

        $book = $this->getOwnedBookFromRequest("profil");
        if (!$book) return;

        $title = Utils::request('title');
        $author = Utils::request('author');
        $description = Utils::request('description');
        $availability = filter_var(Utils::request('availability'), FILTER_VALIDATE_INT);

        $validator = new BookValidator();

        if (!$validator->validateUpdate($title, $author, $description, $availability)) {
            Utils::redirectWithMessage("profil", implode(', ', $validator->getErrors()));
            return;
        }

        try {
            $book->updateBookInfo($title, $author, $description, $availability);
            $this->bookManager->updateBookInfo($book);
            Utils::redirect("profil");

        } catch (\Exception $e) {
            Utils::redirectWithMessage("profil", $e->getMessage());
        }
    }

    public function deleteBook(): void
    {
        Auth::requireLogin();

        $book = $this->getOwnedBookFromRequest("profil");
        if (!$book) return;

        try {
            $this->bookManager->deleteBook($book);
            Utils::redirect("profil");

        } catch (\Exception $e) {
            Utils::redirectWithMessage("profil", $e->getMessage());
        }
    }

    public function uploadBookPicture(): void
    {
        Auth::requireLogin();

        if (!isset($_FILES['bookPicture'])) {
            Utils::redirectWithMessage("profil", "Aucune image envoyée");
            return;
        }

        $book = $this->getOwnedBookFromRequest("profil");
        if (!$book) return;

        try {
            $uploader = new ImageUploader();
            $imagePath = $uploader->upload($_FILES['bookPicture'], 'books');

            $oldPath = $book->getCoverPicturePath();

            if ($oldPath && file_exists($oldPath) && str_contains($oldPath, 'books')) {
                unlink($oldPath);
            }

            $this->bookManager->updateCoverPicturePath($book, $imagePath);

            Utils::redirect('updateBook', ['id' => $book->getId()]);

        } catch (\Exception $e) {
            Utils::redirectWithMessage("profil", $e->getMessage());
        }
    }


    private function getOwnedBookFromRequest(string $redirectRoute)
    {
        $idBook = filter_var(Utils::request('id'), FILTER_VALIDATE_INT);

        if (!$idBook) {
            Utils::redirectWithMessage($redirectRoute, "Livre invalide");
            return null;
        }

        try {
            $book = $this->bookManager->findById($idBook);

            if (!$book) {
                Utils::redirectWithMessage($redirectRoute, "Livre introuvable");
                return null;
            }

            if (!Auth::isOwner($book->getUserId())) {
                Utils::redirectWithMessage("home", "Accès refusé");
                return null;
            }

            return $book;

        } catch (\Exception $e) {
            Utils::redirectWithMessage($redirectRoute, $e->getMessage());
            return null;
        }
    }
}