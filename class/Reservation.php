<?php

namespace App;


class Reservation
{

    private $id;

    private $salle;

    private $user;

    private $creneau;

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
    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
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

    // creneau
    public function getCreneau()
    {
        return $this->creneau;
    }

    public function setCreneau($creneau)
    {
        $this->creneau = $creneau;
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
