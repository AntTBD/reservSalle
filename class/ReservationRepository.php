<?php


namespace App;


class ReservationRepository
{
    private $base;

    public function __construct(PDO $base)
    {
        $this->base = $base;
    }

    public function add(Salle $salle, User $user, Creneau $creneau)
    {
        /*$response = $this->base->prepare('INSERT INTO characters (name, password, hp, ap) VALUES(:name, :password, :hp, :ap)');
        $response->bindValue(':name', $creneau->getName());
        $response->bindValue(':password', $creneau->getPassword());
        $response->bindValue(':hp', $creneau->getHp());
        $response->bindValue(':ap', $creneau->getAp());

        $response->execute();

        $creneau->hydrate(['id' => $this->base->lastInsertId()]);*/
    }

}