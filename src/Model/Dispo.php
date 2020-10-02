<?php

namespace App\Model;
use App\Creneau;
use App\Salle;

class Dispo
{

    private $Date;

    private $idCreneau;

    private $salle;

    // date
    public function getDate()
    {
        return $this->date;
    }

    public function setId($date)
    {
        $this->date = $date;
    }

    // creneau
    public function getIdCreneau()
    {
        return $this->idCreneau;
    }

    public function setIdCreneau($idCreneau)
    {
        $this->idCreneau = $idCreneau;
    }

    // salle
    public function getIdSalle()
    {
        return $this->idSalle;
    }

    public function setIdSalle($idSalle)
    {
        $this->idSalle = $idSalle;
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
