<?php

namespace App\Tests\Service;

use App\Entity\Book;
use App\Entity\Client;
use App\Service\BorrowingManager;
use PHPUnit\Framework\TestCase;

class BorrowingManagerTest extends TestCase
{
    public function testGetBorrowedBooksCount(): void
    {
        $client = new Client();
        $book = new Book();
        $book1 = new Book();
        $client->addBorrowedBook($book)->addBorrowedBook($book1);

//        var_dump($client->getBorrowedBooksCount());
        $this->assertEquals(2, $client->getBorrowedBooksCount()); //le client a emprunté 2 livres, on attend 2 en retour de getBorrowedBooksCount
    }

    public function testBorrowMoreThanFiveBooks()
    { //Un client qui a déjà emprunté 5 livres ne peut pas emprunter d'autres.
        $client = new Client();
        $book1 = new Book();
        $book2 = new Book();
        $book3 = new Book();
        $book4 = new Book();
        $book5 = new Book();
        $borrowingManager = new BorrowingManager();
        $client->addBorrowedBook($book1)->addBorrowedBook($book2)->addBorrowedBook($book3)->addBorrowedBook($book4);
        $this->assertEquals(true, $borrowingManager->canBorrowBook($client, $book5)); //le client n'a que 4 livres donc il peut prendre un cinquième
        $book6 = new Book();
        $client->addBorrowedBook($book6);
        $this->assertEquals(false, $borrowingManager->canBorrowBook($client, $book6)); //il en a 5, impossible d'en prendre plus
    }

    public function testBorrowAnAvailableBook()
    { //Un client peut emprunter un livre disponible.
        $client = new Client();
        $book = new Book();
        $book->setBorrowed(false);

        $borrowingManager = new BorrowingManager();
        $this->assertEquals(true, $borrowingManager->canBorrowBook($client, $book)); //le livre est disponible, donc le client peut le prendre
    }

    public function testBorrowAnAlreadyBorrowedBook()
    {//Un client ne peut pas emprunter un livre déjà emprunté par un autre client.
        $client = new Client();
        $book = new Book();
        $book->setBorrowed(true);

        $borrowingManager = new BorrowingManager();
        $this->assertEquals(false, $borrowingManager->canBorrowBook($client, $book)); //le livre est indisponible, donc le client ne peut PAS le prendre

    }

}
