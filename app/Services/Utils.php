<?php 

declare(strict_types=1);

namespace App\Services;

use App\Core\View;
use DateTime;
use IntlDateFormatter;

class Utils
{

    public static function request(string $variableName, mixed $defaultValue = null): mixed
    {
        return $_REQUEST[$variableName] ?? $defaultValue;
    }

    public static function redirect(string $action, array $params = []) : void
    {
        $url = "index.php?action=$action";
        foreach ($params as $paramName => $paramValue) {
            $url .= "&$paramName=$paramValue";
        }
        header("Location: $url");
        exit();
    }

    public static function redirectToLogin(string $errorMessage): void
    {
        $view = new View();
        $view->render('loginForm', [
            "titre" => "Se Connecter",
            "action" => "connectUser",
            "signin" => false,
            "buttonText" => "Se Connecter",
            "mentionLink" => "Pas de compte ?",
            "link" => "index.php?action=signinForm",
            "textLink" => "Inscrivez-vous",
            "redirectFromProfil" => true,
            "errorMessage" => $errorMessage
            ]);
    }


    public static function convertDateFormat(DateTime $date) : string
    {
  
        $dateFormatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $dateFormatter->setPattern('dd.MM HH:mm');
        return $dateFormatter->format($date);
    }

    public static function convertDateFormatHour(DateTime $date) : string
    {
  
        $dateFormatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $dateFormatter->setPattern('HH:mm');
        return $dateFormatter->format($date);
    }

}