<?php 

declare(strict_types=1);

namespace App\Services;

class BookValidator
{
    private array $errors = [];

    public function validateUpdate(?string $title, ?string $author, ?string $description, ?int $availability): bool
    {
        $this->errors = [];

        if (!empty($title) && strlen($title) < 3) {
            $this->errors[] = "Le titre n'est pas valide"; 
        }

        if (!empty($author) && strlen($author) < 3) {
            $this->errors[] = "L'auteur n'est pas valide";
        }

        if (!empty($description) && strlen($description) < 10) {
            $this->errors[] = "La description n'est pas valide";
        }

        if ($availability !== 1 && $availability !== 0) {
            $this->errors[] = "La disponnibilité n'est pas valide";
        }

        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}