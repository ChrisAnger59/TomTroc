<?php 

declare(strict_types=1);

namespace App\Repositories;

use App\Core\FakeData;
use App\Models\Book;

class BookManager
{
    public function findAllBooks(): array
    {
        $books = [];

        foreach (FakeData::$books as $book) {
            $books[] = new Book($book);
        }
        return $books;
    }

    public function findById(int $id): ?Book
    {
        $bookDetails = [];

        foreach (FakeData::$books as $book) {
            if ($book['id'] === $id) {
                return new Book($book);
            }
        }

        return null;

    }


    public function findLastBooks(): array
    {
        $books = FakeData::$books;

        usort($books, function($a, $b) {
            return $b['date_creation'] <=> $a['date_creation'];
        });

        $books = array_slice($books, 0, 4);

        $lastBooks = [];

        foreach ($books as $book) {
            $lastBooks[] = new Book($book); 
        }

        return $lastBooks;
    }


}