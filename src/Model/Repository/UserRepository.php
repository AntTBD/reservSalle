<?php


namespace App\Model\Repository;

use App\Model\User;


class UserRepository
{
    protected $base;

    public function __construct(Repository $base)
    {
        $this->base = $base;
    }



    public function add(User $user)
    {
        $response = $this->base->prepare('INSERT INTO user (email, mdp) VALUES(:email, :mdp)');
        $response->bindValue(':name', $user->getEmail());
        $response->bindValue(':mdp', $user->getMdp());

        $response->execute();

        $user->hydrate(['id' => $this->base->lastInsertId()]);
    }

    public function exists(User $user) {
        $response = $this->base->prepare('SELECT COUNT(*) FROM user WHERE email = :email;');
        $response->bindValue(':email', $user->getEmail());
        $response->execute();

        return (bool) $response->fetchColumn();
    }

    public function findByEmail($email)
    {
        $response = $this->base->prepare('SELECT * FROM user WHERE email = :email');
        $response->bindValue(':email', $email);
        $response->execute();

        return $response->fetch();
    }

    public function login($email, $mdp)
    {
        if ($result = $this->findByEmail($email)) {
            if (password_verify($mdp, $result['mdp'])) {
            //if ($mdp==$result['mdp']) {
                $user = $this->find($result['id']);
                $_SESSION['id'] = $user->getId();
                $_SESSION['email'] =  $user->getEmail();
                return $user;
            }
            return false;
        }
        return false;

    }

    public function find($id)
    {
        $response = $this->base->prepare('SELECT * FROM user WHERE id = :id');
        $response->bindValue(':id', $id);
        $result = $response->execute();
        if ($result === true) {
            if ($user_temp = $response->fetch()) {
                return new User($user_temp);
            }
        }
        return false;

    }

    public function findAll()
    {
        $listUsers=array();
        $reponse = $this->base->prepare('SELECT * FROM user;');
        $resultats = $reponse->execute();
        if($resultats==true){
            $listUsers=$reponse->fetchAll(\PDO::FETCH_CLASS, 'App\Model\User');
            return $listUsers;
        }
        return false;

    }
}