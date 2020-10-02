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



    /*public function findAllForMe(int $id)
    {
        $response = $this->base->prepare('SELECT * FROM characters_log WHERE character_id = :id');
        $response->bindValue(':id', $id);
        $result = $response->execute();
        if ($result === true) {
            $records = $response->fetchAll(PDO::FETCH_CLASS, 'CharacterLog');
            return $records;
        }

        return false;
    }*/

}