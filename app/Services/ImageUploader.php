<?php

declare(strict_types=1);

namespace App\Services;

use Exception;

class ImageUploader
{
    private array $allowed = ['image/jpeg', 'image/png'];
    private int $maxSize = 5000000;

    public function upload(array $file, string $folder): string
    {
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Erreur d'upload");
        }

        $tmp_name = $file['tmp_name'];
        $file_size = $file['size'];

        $mime = mime_content_type($tmp_name);

        if (!in_array($mime, $this->allowed)) {
            throw new Exception("Type de fichier invalide");
        }

        if ($file_size > $this->maxSize) {
            throw new Exception("Fichier trop volumineux");
        }

        switch ($mime) {
            case 'image/jpeg':
                $extension = '.jpg';
                break;
            case 'image/png':
                $extension = '.png';
                break;
            case 'image/jpg':
                $extension = '.jpg';
                break;
            default :
                throw new \Exception("Type non supporté");
        }

        $file_name = uniqid('', true) . $extension;

        $path = "./../public/uploads/$folder/" . $file_name;

        if (!move_uploaded_file($tmp_name, $path)) {
            throw new Exception("Erreur lors du déplacement du fichier");
        }

        return $path;
    }
}