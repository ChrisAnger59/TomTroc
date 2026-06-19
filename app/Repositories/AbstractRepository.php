<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Core\DBManager;

abstract class AbstractRepository
{
    protected DBManager $db;

    public function __construct()
    {
        $this->db = DBManager::getInstance();
    }
}