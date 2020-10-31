<?php


namespace App\Model\Repository;
use App\Model\Dispo;


class DispoRepository
{
    private $base;

    public function __construct(Repository $base)
    {
        $this->base = $base;
    }

    public function add($jour,$idSalle,$idCreneau)
    {
        $response = $this->base->prepare('INSERT INTO dispo (jour, idSalle, idCreneau) VALUES(:jour, :idSalle, :idCreneau)');
        $response->bindValue(':jour', $jour);
        $response->bindValue(':idSalle', $idSalle);
        $response->bindValue(':idCreneau', $idCreneau);

        $response->execute();
        if($response == true){
            return true;
        }else{
            return false;
        }
    }

    public function findAll()
    {
        $reponse = $this->base->prepare('SELECT * FROM dispo;');
        $resultats = $reponse->execute();
        if($resultats==true){
            $listDispo=$reponse->fetchAll(\PDO::FETCH_CLASS, 'App\Model\Dispo');
            return $listDispo;
        }
        return false;
    }

    public function findBySalle($idSalle, $jour){
        $reponse = $this->base->prepare('SELECT * FROM dispo WHERE idSalle = :salle && jour = :jour;');
        $reponse->bindValue(':salle',$idSalle);
        $date = explode('/', $jour);
        $dateString = $date[0]."-".$date[1]."-".$date[2];
        $reponse->bindValue(':jour',$dateString);
        $resultats = $reponse->execute();

        if($resultats==true){
            $listDispo=$reponse->fetchAll(\PDO::FETCH_CLASS, 'App\Model\Dispo');
            return $listDispo;
        }

        return false;
    }

    public function findByAll($jour, $idSalle, $idCreneau){
        $reponse = $this->base->prepare('SELECT * FROM dispo WHERE  jour = :jour && idSalle = :idSalle && idCreneau = :idCreneau;');
        $reponse->bindValue(':jour', $jour);
        $reponse->bindValue(':idSalle', $idSalle);
        $reponse->bindValue(':idCreneau', $idCreneau);
        $resultats = $reponse->execute();

        if($resultats==true){
            $listDispo=$reponse->fetchAll(\PDO::FETCH_CLASS, 'App\Model\Dispo');
            return $listDispo;
        }

        return false;
    }

    public function deleteByArguments($idSalle, $idCreneau){
        $reponse = $this->base->prepare('DELETE FROM dispo WHERE idSalle = :idSalle && idCreneau = :idCreneau ');
        $reponse->bindValue(':idSalle',$idSalle);
        $reponse->bindValue(':idCreneau',$idCreneau);
        return $resultats = $reponse->execute();
    }

}