<?php 

declare(strict_types=1);

namespace App\Repositories;

use App\Mock\Books;
use App\Mock\Users;
use App\Models\Book;

class BookManager extends AbstractRepository
{
    public function findAllBooks(): array
    {
        $sql = "SELECT `books`.*, `users`.`nickname` AS `owner`
                FROM `books`
                INNER JOIN `users` ON `books`.`user_id` = `users`.`id`
                ORDER BY `books`.`created_at` DESC";

        $result = $this->db->query($sql);

        $lastBooks = [];

        while ($book = $result->fetch()) {
            $lastBooks[] = new Book($book);
        }

        return $lastBooks;
    }

    public function findById(int $id): ?Book
    {

        $sql = "SELECT `books`.*, `users`.`nickname` AS `owner`, `users`.`profile_picture_path`
                FROM `books`
                INNER JOIN `users` ON `books`.`user_id` = `users`.`id`
                WHERE `books`.`id` = :id
                ORDER BY `books`.`created_at` DESC;";
            
        $result = $this->db->query($sql, ['id' => $id]);
        $book = $result->fetch();

        if ($book) {
            return new Book($book);
        }

        return null;

    }


    public function findLastBooks(): array
    {
        $sql = "SELECT `books`.*, `users`.`nickname` AS `owner`
                FROM `books`
                INNER JOIN `users` ON `books`.`user_id` = `users`.`id`
                ORDER BY `books`.`created_at` DESC
                LIMIT 4;";

        $result = $this->db->query($sql);

        $lastBooks = [];

        while ($book = $result->fetch()) {
            $lastBooks[] = new Book($book);
        }

        return $lastBooks;
    }


}