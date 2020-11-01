<?php


namespace App\Model\Repository;
use App\Model\Creneau;


class CreneauRepository
{
    private $base;

    public function __construct(Repository $base)
    {
        $this->base = $base;
    }

    public function exists(Creneau $creneau)
    {
        $response = $this->base->prepare('SELECT COUNT(*) FROM creneau WHERE heureDebut = :heureDebut');
        $response->bindValue(':heureDebut', $creneau->getHeureDebut());
        $response->execute();

        return (bool) $response->fetchColumn();
    }

    public function findAll()
    {
        $reponse = $this->base->prepare('SELECT * FROM creneau;');
        $resultats = $reponse->execute();
        if($resultats==true){
            $listSalle=$reponse->fetchAll(\PDO::FETCH_CLASS, 'App\Model\Creneau');
            return $listSalle;
        }
        return false;
    }

    public function find($id)
    {
        $response = $this->base->prepare('SELECT * FROM creneau WHERE id = :id');
        $response->bindValue(':id', $id);
        $result = $response->execute();
        if ($result === true) {
            if ($creneau_temp = $response->fetch()) {
                return new Creneau($creneau_temp);
            }
        }
        return false;

    }

    public function modifyById($id,$heureDebut){
        $response = $this->base->prepare('UPDATE Creneau SET heureDebut = :heureDebut WHERE id = :id');
        $response->bindValue(':id', $id);
        $response->bindValue(':heureDebut', $heureDebut);
        return $response->execute();
    }

}