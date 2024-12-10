<?php

namespace App\Service;

use App\Entity\Book;
use App\Entity\Client;

class BorrowingManager
{
    public function canBorrowBook(Client $client, Book $book): bool
    {
        if ($client->getBorrowedBooksCount() >= 5) {
            return false;
        }

        if ($book->isBorrowed()) {
            return false;
        }

        return true;
    }
}