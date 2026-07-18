<?php

declare(strict_types=1);

namespace App\Services;

use Exception;

class ImageUploader
{
    private array $allowed = ['image/jpeg', 'image/png'];
    private array $allowedFolders = ['users', 'books'];
    private int $maxSize = 5000000;

    public function upload(array $file, string $folder): string
    {
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Erreur d'upload");
        }

        if (!in_array($folder, $this->allowedFolders)) {
            throw new Exception("Dossier invalide");
        }

        $tmp_name = $file['tmp_name'];
        $file_size = $file['size'];

        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($tmp_name);

        if (!in_array($mime, $this->allowed)) {
            throw new Exception("Type de fichier invalide");
        }

        if ($file_size > $this->maxSize) {
            throw new Exception("Fichier trop volumineux");
        }

        $extension = $mime === 'image/png' ? '.png' : '.jpg';

        $file_name = uniqid('', true) . $extension;

        $directory = __DIR__ . "/../../public/uploads/$folder/";

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        $fullPath = $directory . $file_name;

        if (!move_uploaded_file($tmp_name, $fullPath)) {
            throw new Exception("Erreur lors du déplacement du fichier");
        }

        return "uploads/$folder/" . $file_name;
    }
}