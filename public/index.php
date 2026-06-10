<?php 

declare(strict_types=1);

use App\Core\Router;
use App\Core\View;

//require_once __DIR__ . '/../config/env.php';
require_once __DIR__ . '/../vendor/autoload.php';

try {
    
    $router = new Router();
    $router->handleRequest();

} catch (Exception $error) {

    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $error->getMessage() ]);

}