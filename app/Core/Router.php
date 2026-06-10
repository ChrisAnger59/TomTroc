<?php 

declare(strict_types=1);

namespace App\Core;

use App\Services\Utils;
use App\Controllers\HomeController;

class Router
{

    public function handleRequest(): void
    {

        $action = Utils::request('action', 'home');

        switch ($action) {

            case 'home':
                $homeController = new HomeController();
                $homeController->showHome();
                break;

            default:
                throw new \Exception("La page demandée n'existe pas.");

        }

    }

}