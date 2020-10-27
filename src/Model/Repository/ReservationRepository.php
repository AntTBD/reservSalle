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

    public function add(Reservation $reservation)
    {
        /*$response = $this->base->prepare('INSERT INTO user (email, mdp) VALUES(:email, :mdp)');
        $response->bindValue(':name', $user->getEmail());
        $response->bindValue(':mdp', $user->getMdp());

        $response->execute();

        $user->hydrate(['id' => $this->base->lastInsertId()]);*/
    }

    public function countsalle()
    {
        $reponse = $this->base->prepare('SELECT  COUNT(id)  FROM salle;  ');
        $resultats = $reponse->execute();
        return $resultats[0];
    }

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

    public function findOne()
    {
        $reponse = $this->base->prepare('SELECT * FROM reservation WHERE id =1;');
        $resultats = $reponse->execute();
        return $resultats;
    }

    public function verifDispoSalle($nbPlaces,$idSalle,$idCreneau){
        $reservationRepository = new ReservationRepository($this->base);
        $resas = $reservationRepository->findAll();

        $compteur = 0;

        foreach ($resas as $resa){
            if($resa->getIdSalle() == $idSalle && $resa->getIdCreneau() == $idCreneau){
                $compteur++;
            }
        }

        if($compteur < $nbPlaces){
            return 1;
        }else{
            return 0;
        }

    }

    public function findAllById($idUser)
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
}
