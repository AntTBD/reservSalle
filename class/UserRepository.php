<?php


namespace App;


class UserRepository
{
    private $base;

    public function __construct(PDO $base)
    {
        $this->base = $base;
    }



    public function add(User $user)
    {
        /*$response = $this->base->prepare('INSERT INTO characters (name, password, hp, ap) VALUES(:name, :password, :hp, :ap)');
        $response->bindValue(':name', $creneau->getName());
        $response->bindValue(':password', $creneau->getPassword());
        $response->bindValue(':hp', $creneau->getHp());
        $response->bindValue(':ap', $creneau->getAp());

        $response->execute();

        $creneau->hydrate(['id' => $this->base->lastInsertId()]);*/
    }

    public function findByEmail(string $email)
    {
        $response = $this->base->prepare('SELECT * FROM user WHERE email = :email');
        $response->bindValue(':email', $email);
        $response->execute();

        return $response->fetch();
    }

    public function login(string $email, string $mdp)
    {
        if ($result = $this->findByName($email)) {
            if (password_verify($mdp, $result['mdp'])) {
                $user = $this->find($result['id']);
                $_SESSION['id'] = $user->getId();
                $_SESSION['email'] =  $user->getName();
                return $user;
            }
            return false;
        }
        return false;

    }

    public function find(int $id)
    {
        $response = $this->base->prepare('SELECT * FROM user WHERE id = :id');
        $response->bindValue(':id', $id);
        $result = $response->execute();
        if ($result === true) {
            $records = $response->fetchAll(PDO::FETCH_CLASS, 'User');
            return $records;
        }

        return false;

    }
}