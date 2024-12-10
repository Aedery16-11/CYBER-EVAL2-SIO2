<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    /**
     * @var Collection<int, Book>
     */
    #[ORM\OneToMany(targetEntity: Book::class, mappedBy: 'client')]
    private Collection $borrowedBooks;

    public function __construct()
    {
        $this->borrowedBooks = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Book>
     */
    public function getBorrowedBooks(): Collection
    {
        return $this->borrowedBooks;
    }

    public function addBorrowedBook(Book $borrowedBook): static
    {
        if (!$this->borrowedBooks->contains($borrowedBook)) {
            $this->borrowedBooks->add($borrowedBook);
            $borrowedBook->setClient($this);
        }

        return $this;
    }

    public function removeBorrowedBook(Book $borrowedBook): static
    {
        if ($this->borrowedBooks->removeElement($borrowedBook)) {
            // set the owning side to null (unless already changed)
            if ($borrowedBook->getClient() === $this) {
                $borrowedBook->setClient(null);
            }
        }

        return $this;
    }

    public function getBorrowedBooksCount(): int
    {
        return count($this->getBorrowedBooks());
    }

}
