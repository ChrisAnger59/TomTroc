<?php

declare(strict_types=1);

namespace App\Models;

abstract class AbstractModel
{
    // Permet de vérifier si l'entité est nouvelle. 
    protected int $id = -1;

    /**
     * Constructeur de la classe.
     * Si un tableau associatif est passé en paramètre, on hydrate l'entité.
     */
    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * Système d'hydratation de l'entité.
     * Permet de transformer les données d'un tableau associatif.
     * Les noms de champs de la table doivent correspondre aux noms des attributs de l'entité.
     * Les underscore sont transformés en camelCase (ex: date_creation devient setDateCreation).
     * 
     * Si la methode n'exsite pas, lance une Exception.
     */
    protected function hydrate(array $data) : void 
    {
        foreach ($data as $key => $value) {
            $method = 'set' . str_replace('_', '', ucwords($key, '_'));
            if (method_exists($this, $method)) {
                $this->$method($value);
            } else {
                throw new \Exception("Méthode $method inexistante / impossible d'hydrater l'entité");
            }
        }
    }

    public function setId(int $id) : void 
    {
        $this->id = $id;
    }

    public function getId() : int 
    {
        return $this->id;
    }

}