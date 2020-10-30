<?php


namespace App\Model\Repository;


use App\Model\Salle;

class SalleRepository
{
    private $base;

    public function __construct(Repository $base)
    {
        $this->base = $base;
    }

    public function find($id)
    {

        $response = $this->base->prepare('SELECT * FROM salle');
        $result = $response->execute();
        $listSalle = $response->fetchAll(\PDO::FETCH_CLASS, 'App\Model\Salle');
        $salle = new Salle();
        foreach ($listSalle as $list){
            if($list->getId() == $id){
                $salle->setId($id);
                $salle->setDispo($list->getDispo());
                $salle->setNbPlaces($list->getNbPlaces());
                $salle->setNumSalle($list->getNumSalle());
            }
        }

        return $salle;
    }

    public function add(Salle $salle)
    {
        /*$response = $this->base->prepare('INSERT INTO user (email, mdp) VALUES(:email, :mdp)');
        $response->bindValue(':name', $user->getEmail());
        $response->bindValue(':mdp', $user->getMdp());

        $response->execute();

        $user->hydrate(['id' => $this->base->lastInsertId()]);*/
    }

    public function findAll()
    {
        $reponse = $this->base->prepare('SELECT * FROM salle;');
        $resultats = $reponse->execute();
        if($resultats==true){
            $listSalle=$reponse->fetchAll(\PDO::FETCH_CLASS, 'App\Model\Salle');
            return $listSalle;
        }
        return false;
    }

    public function findById($id) {
        $response = $this->base->prepare('SELECT * FROM salle WHERE id = :id;');
        $response->bindValue(':id', $id);
        $result = $response->execute();
        if ($result == true) {
            if ($salle_temp = $response->fetch()) {
                return new Salle($salle_temp);
            }
            return false;
        }

        return false;
    }

    public function save($numSalle,$placeSalle,$dispo)
    {
        $response = $this->base->prepare('INSERT INTO salle (numSalle, nbPlaces, dispo) VALUES(:numSalle, :placeSalle, :dispo)');
        $response->bindValue(':numSalle', $numSalle);
        $response->bindValue(':placeSalle', $placeSalle);
        $response->bindValue(':dispo', $dispo);

        $response->execute();
    }

    public function modifyById($id,$dispo,$numSalle,$nbPlaces){
        $response = $this->base->prepare('UPDATE salle SET dispo = :dispo, numSalle = :numSalle, nbPlaces = :nbPlaces WHERE id = :id');
        $response->bindValue(':id', $id);
        $response->bindValue(':dispo', $dispo);
        $response->bindValue(':numSalle', $numSalle);
        $response->bindValue(':nbPlaces', $nbPlaces);
        return $response->execute();
    }

    public function delete($id)
    {
        $response = $this->base->prepare('DELETE FROM salle  WHERE id = :id;');
        $response->bindValue(':id', $id);

        $response->execute();
        if($response->rowcount()==null) {
            return false;
        }else{
            return true;
        }
    }
}