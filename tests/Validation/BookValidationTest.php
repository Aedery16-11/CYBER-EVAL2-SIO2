<?php

namespace App\Tests\Validation;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BookValidationTest extends KernelTestCase
{
    public function makeBook()
    {

        $book = new Book();
        $book->setTitle("Book 1");
        $book->setId(1);
        $book->setIsbn("12345678901223");
        $book->setPublishedAt(new \DateTime("2024-12-10"));
        $author = new Author();
        $book->setAuthor($author);
        $book->setBorrowed(true);
        $client = new Client();
        $book->setClient($client);
        return $book; //on définit le livre
    }

    public function testBookWithBlankName()
    {
        self::bootKernel();
        $validator = static::getContainer()->get('validator');
        $book = $this->makeBook();

        $book->setTitle("");
        $errors = $validator->validate($book);
//        dump($errors);
        $this->assertCount(1, $errors); //la seule règle non respectée est que le titre ne doit pas être vide
    }

    public function testBookWithBlankIsbn()
    {
        self::bootKernel();
        $validator = static::getContainer()->get('validator');
        $book = $this->makeBook();

        $book->setIsbn("");
        $errors = $validator->validate($book);

//        dump($errors);
//        dump($book);
        $this->assertCount(2, $errors);
        //ici, l'isbn viole 2 règles, celle d'être vide et de ne pas être assez longue, donc on attend 2 erreurs contrairement à la fonction juste en dessous
    }

    public function testBookWithSmallIsbn()
    {
        self::bootKernel();
        $validator = static::getContainer()->get('validator');
        $book = $this->makeBook();

        $book->setIsbn("1234567890123");
        $errors = $validator->validate($book);

        $this->assertCount(1, $errors); //la seule règle non respectée est que l'isbn ne doit pas être vide
    }

    public function testBookWithBlankPublishedAt()
    {
        self::bootKernel();
        $validator = static::getContainer()->get('validator');
        $book = $this->makeBook();

        $book->setPublishedAt(null);
        $errors = $validator->validate($book);

//        dump($book);

        $this->assertCount(1, $errors); //la seule règle non respectée est que la date ne doit pas être vide
    }

    public function testBookWithCompleteInformation()
    {
        self::bootKernel();
        $validator = static::getContainer()->get('validator');
        $book = $this->makeBook();

        $errors = $validator->validate($book);

        $this->assertCount(0, $errors); //aucune erreur puisque le livre est complet
    }


}
