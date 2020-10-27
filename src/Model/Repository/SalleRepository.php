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


        return false;
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
}