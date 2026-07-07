<?php

declare(strict_types=1);

namespace App\Services;

class Auth
{

    // Retourne l'id d'utilisateur de la session
    public static function getLoggedUserId(): ?int
    {
        // Si $_SESSION['id'] contient autre chose que des nombres
        // Sinon (int) "abc" retournera 0 et pas null
        if (!isset($_SESSION['id']) || !is_numeric($_SESSION['id'])) {
            return null;
        }

        return (int) $_SESSION['id'];
    }


    // Vérifie si une valeur 'id' à bien été attribué à la session
    public static function isLogged(): bool
    {
        // Si $_SESSION['id'] n'est pas attribué, retourne false
        return isset($_SESSION['id']);
    }


    // Vérifie que la session à l'id de l'utilisateur
    // Vérifie que l'id de l'utilisateur de la session est identique à celle en paramètre ($userId)
    public static function isOwner(int $userId): bool
    {
        return self::isLogged() && self::getLoggedUserId() === $userId;
    }

    public static function requireLogin(): void
    {
        if (!self::isLogged()) {
            Utils::redirect('loginForm');
            exit();
        }
    }
}