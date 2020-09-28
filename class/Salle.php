<?php

namespace App;

class Salle
{

    private $id;

    private $dispo;

    private $numSalle;

    private $nbPlaces;

    // id
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    // dispo
    public function getDispo()
    {
        return $this->dispo;
    }

    public function setDispo($dispo)
    {
        $this->dispo = $dispo;
    }

    // numSalle
    public function getNumSalle()
    {
        return $this->numSalle;
    }

    public function setNumSalle($numSalle)
    {
        $this->numSalle = $numSalle;
    }

    // nbPlaces
    public function getNbPlaces()
    {
        return $this->nbPlaces;
    }

    public function setNbPlaces($nbPlaces)
    {
        $this->nbPlaces = $nbPlaces;
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    public function __construct(array $arrayOfValues = null)
    {
        if ($arrayOfValues !== null) {
            $this->hydrate($arrayOfValues);
        }
    }
}
