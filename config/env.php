<?php

declare(strict_types=1);

// Charge le fichier .env et retourne les config en tableau associatif
$env = parse_ini_file(__DIR__ . '/../.env');

// Si le fichier .env n'est pas trouvé
if ($env === false) {
    throw new Exception("Impossible de charger le fichier .env");
}

// On injecte les variables dans l'environnement PHP ($_ENV)
// Et dans l'environnement serveur (puenv()) accessible via getenv()
foreach ($env as $key => $value) {
    $_ENV[$key] = $value;

    putenv("$key=$value");
}