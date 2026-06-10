<?php 

declare(strict_types=1);

namespace App\Services;

class Utils
{

    public static function request(string $variableName, mixed $defaultValue = null): mixed
    {
        return $_REQUEST[$variableName] ?? $defaultValue;
    }

}