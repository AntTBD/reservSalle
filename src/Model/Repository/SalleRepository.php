<?php


namespace App\Model\Repository;


class SalleRepository
{
    private $base;

    public function __construct(Repository $base)
    {
        $this->base = $base;
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