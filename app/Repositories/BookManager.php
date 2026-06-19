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
        $books = [];

        //index des users
        $usersById = [];
        foreach (Users::$users as $user) {
            $usersById[$user['id']] = $user;
        }

        foreach (Books::$books as $bookData) {
            $book = new Book($bookData);

            //Enrichissement
            $userId = $book->getUserId();

            if (isset($usersById[$userId])) {
                $book->setOwner($usersById[$userId]['nickname']);
                $book->setOwnerPicture($usersById[$userId]['profil_picture_path']);
            }

            $books[] = $book;
        }

        return $books;
    }

    public function findById(int $id): ?Book
    {

        //index des users
        $usersById = [];
        foreach (Users::$users as $user) {
            $usersById[$user['id']] = $user;
        }

        foreach (Books::$books as $bookData) {
            if ($bookData['id'] === $id) {
                $book = new Book($bookData);
                
                //Enrichissement
                $userId = $book->getUserId();

                if (isset($usersById[$userId])) {
                    $book->setOwner($usersById[$userId]['nickname']);
                    $book->setOwnerPicture($usersById[$userId]['profil_picture_path']);
                }

                return $book;
            }
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