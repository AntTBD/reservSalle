<?php

namespace App\Model;

class Creneau
{

    private $id;

    private $heureDebut;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;
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
