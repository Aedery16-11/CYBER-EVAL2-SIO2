<?php

namespace App\Tests\Unit;

use App\Entity\Book;
use Doctrine\DBAL\Types\DateTimeTzImmutableType;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Constraints\Date;
use function PHPUnit\Framework\throwException;
use function Symfony\Component\Clock\now;

class BookTest extends TestCase
{
    public function makeBook(): Book
    {
        $book = new Book();
        $book->setTitle("Book 1");
        $book->setId(1);
        $book->setIsbn("12345678901223");
        $book->setPublishedAt(new \DateTime("2024-12-10"));
        return $book; //créer un livre
    }

    public function testGetId()
    {
        $book = $this->makeBook();
        $this->assertEquals(1, $book->getId()); //l'id défini est 1
    }

    public function testGetTitle()
    {
        $book = $this->makeBook();
        $this->assertEquals("Book 1", $book->getTitle()); //le nom défini est bien Book 1
    }

    public function testGetIsbn()
    {
        $book = $this->makeBook();
        $this->assertEquals("12345678901223", $book->getIsbn()); //l'isbn défini est bien 12345678901223
    }

    public function testGetPublisedAt()
    {
        $book = $this->makeBook();
        $this->assertEquals(new \DateTime("2024-12-10"), $book->getPublishedAt()); //la date définie est bien 2024-12-10
    }



}
