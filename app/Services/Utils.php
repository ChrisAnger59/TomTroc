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
            $url .= "&$paramName=" . urlencode($paramValue);
        }
        header("Location: $url");
        exit();
    }

    public static function redirectToLogin(string $errorMessage): void
    {
        $_SESSION['errorMessage'] = $errorMessage;
        self::redirect('loginForm');
    }

    public static function redirectToSignin(string $errorMessage): void
    {
        $_SESSION['errorMessage'] = $errorMessage;
        self::redirect('signinForm');
    }

    public static function redirectWithMessage(string $action, string $message): void
    {
        $_SESSION['errorMessage'] = $message;
        self::redirect($action);
    }

    public static function getErrorMessage(): ?string
    {
        $error = $_SESSION['errorMessage'] ?? null;
        unset($_SESSION['errorMessage']);
        return $error;
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