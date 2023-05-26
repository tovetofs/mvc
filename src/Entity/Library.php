<?php

namespace App\Entity;

use App\Repository\LibraryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LibraryRepository::class)]
class Library
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $isbn = null;

    #[ORM\Column(length: 255)]
    private ?string $author = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    /**
     * Returns id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Returns title
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Sets title
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Returns isbn
     */
    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    /**
     * Sets isbn
     */
    public function setIsbn(?string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Returns author
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * Sets author
     */
    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Returns image-url
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * Sets image-url
     */
    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
