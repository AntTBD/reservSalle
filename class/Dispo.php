<?php

namespace App;
use App\Creneau;
use App\Salle;

class Dispo
{

    private $Date;

    private $creneau;

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
    public function getCreneau()
    {
        return $this->creneau;
    }

    public function setCreneau($creneau)
    {
        $this->creneau = $creneau;
    }

    // salle
    public function getSalle()
    {
        return $this->salle;
    }

    public function setSalle($salle)
    {
        $this->salle = $salle;
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
