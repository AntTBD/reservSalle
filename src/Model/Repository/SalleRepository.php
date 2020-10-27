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
}