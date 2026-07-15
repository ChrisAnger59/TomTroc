<?php

declare(strict_types=1);

namespace App\Services;

class UserValidator
{
    private array $errors = [];

    public function validateUpdate(?string $email, ?string $nickname, ?string $password): bool
    {
        $this->errors = [];

        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Email invalide";
        }

        if (!empty($nickname) && strlen($nickname) < 3) {
            $this->errors[] = "Pseudo trop court";
        }

        if (!empty($password) && strlen($password) < 4) {
            $this->errors[] = "Mot de passe trop court";
        }

        return empty($this->errors);
    }

    public function validateLogin(?string $email, ?string $password): bool
    {
        $this->errors = [];

        if (empty($email)) {
            $this->errors[] = "Email requis";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Email invalide";
        }

        if (empty($password)) {
            $this->errors[] = "Mot de passe requis";
        }

        return empty($this->errors);
    }

    public function validateRegister(?string $email, ?string $nickname, ?string $password): bool
    {
        $this->errors = [];

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Email invalide";
        }

        if (empty($nickname) || strlen($nickname) < 3) {
            $this->errors[] = "Pseudo invalide";
        }

        if (empty($password) || strlen($password) < 4 ) {
            $this->errors[] = "Mot de passe invalide";
        }

        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}