<?php

namespace App\Model;


class Reservation
{

    private $id;

    private $idSalle;

    private $idUser;

    private $idCreneau;

    private $jour;

    // id
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    // user
    public function getIdUser()
    {
        return $this->idUser;
    }

    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
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

    // creneau
    public function getIdCreneau()
    {
        return $this->idCreneau;
    }

    public function setIdCreneau($idCreneau)
    {
        $this->idCreneau = $idCreneau;
    }

    // jour
    public function getJour()
    {
        return $this->jour;
    }

    public function setJour($jour)
    {
        $this->jour = $jour;
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
