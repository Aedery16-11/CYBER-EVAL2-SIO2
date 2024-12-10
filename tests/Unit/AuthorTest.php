<?php

namespace App\Tests\Unit;

use App\Entity\Author;
use App\Entity\Book;
use PHPUnit\Framework\TestCase;

class AuthorTest extends TestCase
{
    public function testAuthor(): void
    {
        $author = new Author();
        $author->setName("Michel");

        $book = new Book();
        $book->setAuthor($author);
        $book->setIsbn("123456789012234");
        $book->setTitle("Book 1");
        $book->setId(1);
        $book->setPublishedAt(new \DateTime("2024-12-10"));

        $author->addBook($book);

        $this->assertCount(1, $author->getBooks()); //il n'y a qu'un seul livre
        $this->assertEquals($book, $author->getBooks()[0]); //le premier livre retourné par getBook est bien $book
    }

    public function testRemoveBook()
    {
        $author = new Author();
        $author->setName("Michel");

        $book = new Book();
        $book->setAuthor($author);
        $book->setIsbn("123456789012234");
        $book->setTitle("Book 1");
        $book->setId(1);
        $book->setPublishedAt(new \DateTime("2024-12-10"));

        $author->addBook($book);

        $author->removeBook($book);
        $this->assertCount(0, $author->getBooks()); //on attend 0 livre puisqu'on a retiré le seul existant
        $this->assertEquals(null, $author->getBooks()[0]); //getBooks ne peut que retourner null
    }
}
