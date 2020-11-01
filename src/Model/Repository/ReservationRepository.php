<?php


namespace App\Model\Repository;


use App\Model\Reservation;

class ReservationRepository
{
    private $base;

    public function __construct(Repository $base)
    {
        $this->base = $base;
    }

    public function add($idSalle, $idUser, $idCreneau, $jour) //Ajoute une reservation
    {
        $response = $this->base->prepare('INSERT INTO reservation (idSalle, idUser, idCreneau,jour) VALUES(:idSalle, :idUser, :idCreneau,:jour)');
        $response->bindValue(':idSalle', $idSalle);
        $response->bindValue(':idUser', $idUser);
        $response->bindValue(':idCreneau', $idCreneau);
        $resaDate = explode('/', $jour);
        $resaDateString = $resaDate[0]."-".$resaDate[1]."-".$resaDate[2];
        $response->bindValue(':jour', $resaDateString);

        return $response->execute();

    }

    public function countsalle()
    {
        $reponse = $this->base->prepare('SELECT  COUNT(id)  FROM salle;  ');
        $resultats = $reponse->execute();
        return $resultats[0];
    }

    /*public function countResaBySalle($idSalle, $idCreneau){
        //$reponse = $this->base->prepare('SELECT COUNT(id)  FROM reservation WHERE idSalle = :idSalle;  ');
        $reponse = $this->base->prepare('SELECT * FROM reservation;');
        $resultats = $reponse->execute();
        $reponse->bindValue(':idSalle',$idSalle);
        $listResa =$reponse->fetchAll(\PDO::FETCH_CLASS, 'App\Model\Reservation');
        $i =0;
        foreach ($listResa as $resa){
            if($resa->getIdSalle() == $idSalle && $resa->getIdCreneau() == $idCreneau){
                $i++;
            }
        }

        return $i;
    }

    public function countResaBySalleCreneauJour($idSalle, $idCreneau, $jour){
        //$reponse = $this->base->prepare('SELECT COUNT(id)  FROM reservation WHERE idSalle = :idSalle;  ');
        $reponse = $this->base->prepare('SELECT COUNT(*)  FROM reservation WHERE idSalle = :idSalle && idCreneau = :idCreneau && jour = :jour;');
        $reponse->bindValue(':idSalle',$idSalle);
        $reponse->bindValue(':idCreneau',$idCreneau);
        $resaDate = explode('/', $jour);
        $resaDateString = $resaDate[0]."-".$resaDate[1]."-".$resaDate[2];
        $reponse->bindValue(':jour',$resaDateString);
        $resultats = $reponse->execute();
        return $resultats;
    }*/

    public function findAll()
    {
        $reponse = $this->base->prepare('SELECT * FROM reservation;');
        $resultats = $reponse->execute();
        if($resultats==true){
            $listSalle=$reponse->fetchAll(\PDO::FETCH_CLASS, 'App\Model\Reservation');
            return $listSalle;
        }
        return false;
    }

    public function verifDispoSalle($nbPlaces,$idSalle,$idCreneau,$date,$idUser){
        $resas = self::findAll();
        $dejaReserv = false;
        $compteur = 0;

        //Module de lecture de Dates
        $resaDate = explode('/', $date);
        $resaDateString = $resaDate[0]."-".$resaDate[1]."-".$resaDate[2];

        foreach ($resas as $resa){

            if($resa->getJour() == $resaDateString && $resa->getIdCreneau() == $idCreneau && $resa->getIdSalle() == $idSalle ){
                if($resa->getIdUser() == $idUser){
                    $dejaReserv = true;
                }
                $compteur++;
            }


        }

        if( $dejaReserv == true && $compteur >= $nbPlaces){
            return 3;
        }elseif( $dejaReserv == true){
            return 2;
        }elseif ($compteur < $nbPlaces) {
            return 1;
        }else{
            return 0;
        }

    }

    public function findAllByIdUser($idUser)
    {
        $response = $this->base->prepare('SELECT * FROM reservation WHERE idUser=:idUser;');
        $response->bindValue(':idUser', $idUser);
        $resultats = $response->execute();
        if($resultats==true){
            $listResa=$response->fetchAll(\PDO::FETCH_CLASS, 'App\Model\Reservation');
            return $listResa;
        }
        return false;
    }

    public function find($id)
    {
        $response = $this->base->prepare('SELECT * FROM reservation WHERE id = :id');
        $response->bindValue(':id', $id);
        $result = $response->execute();
        if ($result === true) {
            if ($resa_temp = $response->fetch()) {
                return new Reservation($resa_temp);
            }
        }
        return false;
    }

    public function delete($idReservation)
    {
        $response = $this->base->prepare('DELETE FROM reservation  WHERE id = :id;');
        $response->bindValue(':id', $idReservation);

        $response->execute();
        if($response->rowcount()==null) {
            return false;
        }else{
            return true;
        }
    }
}
