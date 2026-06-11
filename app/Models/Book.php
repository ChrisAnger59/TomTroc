<?php

declare(strict_types=1);

namespace App\Models;

class Book extends AbstractModel
{
    private string $title = "";
    private string $author = "";
    private string $owner = "";
    private string $dispo = "";
    private string $image = "";
    private string $dateCreation = ""; 
    private string $description = "";


    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }


    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }


    public function setOwner(string $owner): void
    {
        $this->owner = $owner;
    }

    public function getOwner(): string
    {
        return $this->owner;
    }


    public function setDispo(string $dispo): void
    {
        $this->dispo = $dispo;
    }

    public function getDispo(): string
    {
        return $this->dispo;
    }


    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }


    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getImage(): string
    {
        return $this->image;
    }


    public function setDateCreation(string $dateCreation): void
    {
        $this->dateCreation = $dateCreation;
    }

    public function getDateCreation(): string
    {
        return $this->dateCreation;
    }

}