<?php 

declare(strict_types=1);

session_start();

use App\Core\Router;
use App\Core\View;

// Charge les variables d'environnement
require_once __DIR__ . '/../config/env.php';

// Active l'autoload de Composer
// Charge automatiquement les classes PHP (sans faire require)
require_once __DIR__ . '/../vendor/autoload.php';

try {
    
    $router = new Router();
    $router->handleRequest();

} catch (Exception $error) {

    $errorView = new View();
    $errorView->render('errorPage', ['errorMessage' => $error->getMessage() ]);

}