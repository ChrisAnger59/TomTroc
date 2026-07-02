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
        $sql = "SELECT `books`.*, `users`.`nickname`
                FROM `books`
                INNER JOIN `users` ON `books`.`user_id` = `users`.`id`
                ORDER BY `books`.`created_at` DESC";

        $result = $this->db->query($sql);

        return $this->hydrateBooksFromResult($result);
    }

    public function findById(int $id): ?Book
    {

        $sql = "SELECT `books`.*, `users`.`nickname`, `users`.`profile_picture_path`
                FROM `books`
                INNER JOIN `users` ON `books`.`user_id` = `users`.`id`
                WHERE `books`.`id` = :id
                ORDER BY `books`.`created_at` DESC;";
            
        $result = $this->db->query($sql, ['id' => $id]);
         
        $books = $this->hydrateBooksFromResult($result);

        return $books[0] ?? null;

    }


    public function findLastBooks(): array
    {
        $sql = "SELECT `books`.*, `users`.`nickname`
                FROM `books`
                INNER JOIN `users` ON `books`.`user_id` = `users`.`id`
                ORDER BY `books`.`created_at` DESC
                LIMIT 4;";

        $result = $this->db->query($sql);

        return $this->hydrateBooksFromResult($result);
    }


    public function getSearchedBooks(string $search): array
    {
        $sql = "SELECT *
                FROM `books`
                WHERE `title` LIKE :search";
        
        $result = $this->db->query($sql, [
            "search" => '%' . $search . '%'
        ]);

        return $this->hydrateBooksFromResult($result);
    }


    public function getBooksOfUser(User $user): array
    {
        $sql = "SELECT *
                FROM `books`
                WHERE `user_id` = :idUser";

        $idUser = $user->getId();

        $result = $this->db->query($sql, ['idUser' => $idUser]);

        $books = $this->hydrateBooksFromResult($result);
        return $books;

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


    public function updateBookInfo(Book $book): void
    {
        $sql = "UPDATE `books`
                SET `title` = :title, `author` = :author, `description` = :description, `availability` = :availability
                WHERE `id` = :id";
        
        $this->db->query($sql, [
            'id' => $book->getId(),
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'description' => $book->getDescription(),
            'availability' => $book->getAvailability()
        ]);
    }


    public function deleteBook(Book $book): void
    {
        $sql = "DELETE FROM `books`
                WHERE `id` = :id";

        $this->db->query($sql, [
            'id' => $book->getId()
        ]);
    }


}