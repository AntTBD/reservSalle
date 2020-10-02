<?php

namespace App\Model;

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

    public function __toString()
    {
        $toString = $this->getClassName().' [ ';
        foreach($this as $key => $value){
            $method = 'get'.ucfirst($key);
            if(method_exists($this,$method)){
                $toString .= $key.' => "'.$this->$method($value).'", ';
            }
        }
        return $toString.']';
    }

    public function getClassName()
    {
        return substr(strrchr(__CLASS__, "\\"), 1);
    }
}
