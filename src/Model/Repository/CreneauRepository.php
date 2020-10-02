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

    public function add($creneau)
    {
        /*$response = $this->base->prepare('INSERT INTO characters (name, password, hp, ap) VALUES(:name, :password, :hp, :ap)');
        $response->bindValue(':name', $creneau->getName());
        $response->bindValue(':password', $creneau->getPassword());
        $response->bindValue(':hp', $creneau->getHp());
        $response->bindValue(':ap', $creneau->getAp());

        $response->execute();

        $creneau->hydrate(['id' => $this->base->lastInsertId()]);*/
    }

    public function exists(Creneau $creneau)
    {
        $response = $this->base->prepare('SELECT COUNT(*) FROM creneau WHERE heureDebut = :heureDebut');
        $response->bindValue(':heureDebut', $creneau->getHeureDebut());
        $response->execute();

        return (bool) $response->fetchColumn();
    }


}