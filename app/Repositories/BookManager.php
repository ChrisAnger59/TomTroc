<?php 

declare(strict_types=1);

namespace App\Repositories;

//use App\Mock\Books;
//use App\Mock\Users;
use App\Models\Book;
use App\Models\User;

class BookManager extends AbstractRepository
{
    public function findAllBooks(): array
    {
        $sql = "SELECT `books`.*, `users`.`nickname`
                FROM `books`
                INNER JOIN `users` ON `books`.`user_id` = `users`.`id`
                ORDER BY `books`.`created_at` DESC";

        $result = $this->db->query($sql);

        $allBooks = [];

        while ($row = $result->fetch()) {
            $bookData = [];
            $userData = [];

            foreach ($row as $key => $value) {
                if ($key === 'nickname') {
                    $userData[$key] = $value;
                } else {
                    $bookData[$key] = $value;
                }
            }

            $book = new Book($bookData);
            $user = new User($userData);

            $book->setUser($user);

            $allBooks[] = $book; 

            }
        
        return $allBooks;
    }

    public function findById(int $id): ?Book
    {

        $sql = "SELECT `books`.*, `users`.`nickname`, `users`.`profile_picture_path`
                FROM `books`
                INNER JOIN `users` ON `books`.`user_id` = `users`.`id`
                WHERE `books`.`id` = :id
                ORDER BY `books`.`created_at` DESC;";
            
        $result = $this->db->query($sql, ['id' => $id]);
        $row = $result->fetch();
        
        if ($row) {
            $bookData = [];
            $userData = [];

            foreach ($row as $key => $value) {
                if ($key === 'nickname' || $key === 'profile_picture_path') {
                    $userData[$key] = $value;
                } else {
                    $bookData[$key] = $value;
                }
            }

            $book = new Book($bookData);
            $user = new User($userData);

            $book->setUser($user);

            return $book;
        }

        return null;

    }


    public function findLastBooks(): array
    {
        $sql = "SELECT `books`.*, `users`.`nickname`
                FROM `books`
                INNER JOIN `users` ON `books`.`user_id` = `users`.`id`
                ORDER BY `books`.`created_at` DESC
                LIMIT 4;";

        $result = $this->db->query($sql);

        $lastBooks = [];

        while ($row = $result->fetch()) {
            $bookData = [];
            $userData = [];

            foreach ($row as $key => $value) {
                if ($key === 'nickname') {
                    $userData[$key] = $value;
                } else {
                    $bookData[$key] = $value;
                }
            }

            $book = new Book($bookData);
            $user = new User($userData);

            $book->setUser($user);

            $lastBooks[] = $book; 

            }
        
        return $lastBooks;
    }


}