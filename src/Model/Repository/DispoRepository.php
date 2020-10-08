<?php


namespace App\Model\Repository;
use App\Model\Dispo;
use App\Model\Salle;


class DispoRepository
{
    private $base;

    public function __construct(Repository $base)
    {
        $this->base = $base;
    }

    public function add(Dispo $dispo)
    {
        $response = $this->base->prepare('INSERT INTO dispo (jour, idSalle, idCreneau) VALUES(:jour, :idSalle, :idCreneau)');
        $response->bindValue(':jour', $dispo->getDate());
        $response->bindValue(':idSalle', $dispo->getIdSalle());
        $response->bindValue(':idCreneau', $dispo->getIdCreneau());

        $response->execute();

    }

    public function findAll()
    {
        $reponse = $this->base->prepare('SELECT * FROM creneau;');
        $resultats = $reponse->execute();
        if($resultats==true){
            $listSalle=$reponse->fetchAll(\PDO::FETCH_CLASS, 'App\Model\Dispo');
            return $listSalle;
        }
        return false;
    }

}