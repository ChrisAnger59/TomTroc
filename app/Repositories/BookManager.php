<?php 

declare(strict_types=1);

namespace App\Repositories;

//use App\Mock\Books;
//use App\Mock\Users;
use App\Models\Book;
use App\Models\User;
use PDOStatement;

class BookManager extends AbstractRepository
{
    public function findAllBooks(): array
    {
        try {
            $sql = "SELECT `books`.*, `users`.`nickname`
                    FROM `books`
                    INNER JOIN `users` ON `books`.`user_id` = `users`.`id`
                    WHERE `availability` = 1
                    ORDER BY `books`.`created_at` DESC";

            $result = $this->db->query($sql);

            return $this->hydrateBooksFromResult($result);

        } catch (\PDOException $e) {
            throw new \Exception("Impossible de récupérer les livres");
        }
    }

    public function findById(int $id): ?Book
    {
        try {
            $sql = "SELECT `books`.*, `users`.`nickname`, `users`.`profile_picture_path`
                    FROM `books`
                    INNER JOIN `users` ON `books`.`user_id` = `users`.`id`
                    WHERE `books`.`id` = :id";

            $result = $this->db->query($sql, ['id' => $id]);

            $books = $this->hydrateBooksFromResult($result);

            return $books[0] ?? null;

        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération du livre");
        }
    }

    public function findLastBooks(): array
    {
        try {
            $sql = "SELECT `books`.*, `users`.`nickname`
                    FROM `books`
                    INNER JOIN `users` ON `books`.`user_id` = `users`.`id`
                    ORDER BY `books`.`created_at` DESC
                    LIMIT 4";

            $result = $this->db->query($sql);

            return $this->hydrateBooksFromResult($result);

        } catch (\PDOException $e) {
            throw new \Exception("Impossible de récupérer les derniers livres");
        }
    }

    public function getSearchedBooks(string $search): array
    {
        try {
            $sql = "SELECT *
                    FROM `books`
                    WHERE `title` LIKE :search";

            $result = $this->db->query($sql, [
                "search" => '%' . $search . '%'
            ]);

            return $this->hydrateBooksFromResult($result);

        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la recherche");
        }
    }

    public function getBooksOfUser(User $user): array
    {
        try {
            $sql = "SELECT *
                    FROM `books`
                    WHERE `user_id` = :idUser";

            $result = $this->db->query($sql, [
                'idUser' => $user->getId()
            ]);

            return $this->hydrateBooksFromResult($result);

        } catch (\PDOException $e) {
            throw new \Exception("Impossible de récupérer les livres de l'utilisateur");
        }
    }

    public function updateBookInfo(Book $book): void
    {
        try {
            $sql = "UPDATE `books`
                    SET `title` = :title, `author` = :author, `description` = :description, `availability` = :availability
                    WHERE `id` = :id";

            $this->db->query($sql, [
                'id' => $book->getId(),
                'title' => $book->getTitle(),
                'author' => $book->getAuthor(),
                'description' => $book->getDescription(),
                'availability' => (int) $book->getAvailability()
            ]);

        } catch (\PDOException $e) {
            throw new \Exception("Impossible de modifier le livre");
        }
    }

    public function addBook(int $idUser, string $title, string $author, string $description, int $availability, string $imagePath)
    {
        try {
            $sql = "INSERT INTO `books` (`user_id`, `title`, `author`, `description`, `availability`, `cover_picture_path`)
                VALUES (:idUser, :title, :author, :description, :availability, :imagePath);";
            
            $this->db->query($sql, [
                'idUser' => $idUser,
                'title' => $title,
                'author' => $author,
                'description' => $description,
                'availability' => $availability,
                'imagePath' => $imagePath
            ]);
        } catch (\PDOException $e) {
            throw new \Exception("Impossible de créer le livre");
        }
    }

    public function deleteBook(Book $book): void
    {
        try {
            $sql = "DELETE FROM `books`
                    WHERE `id` = :id";

            $this->db->query($sql, [
                'id' => $book->getId()
            ]);

        } catch (\PDOException $e) {
            throw new \Exception("Impossible de supprimer le livre");
        }
    }

    public function updateCoverPicturePath(Book $book, string $newPath): void
    {
        try {
            $sql = "UPDATE `books`
                    SET `cover_picture_path` = :newPath
                    WHERE `id` = :id";

            $this->db->query($sql, [
                'id' => $book->getId(),
                'newPath' => $newPath
            ]);

        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la mise à jour de l'image");
        }
    }

    private function hydrateBooksFromResult(PDOStatement $result): array
    {
        $books = [];

        while ($row = $result->fetch()) {
            $bookData = $userData = [];

            foreach ($row as $key => $value) {
                
                if (in_array($key, ['nickname', 'profile_picture_path'])) {
                    $userData[$key] = $value;
                    continue;
                }
                
                $bookData[$key] = $value;
                
            }

            $book = new Book($bookData);
            $user = new User($userData);
            $book->setUser($user);

            $books[] = $book;
        }

        return $books;
    }
}