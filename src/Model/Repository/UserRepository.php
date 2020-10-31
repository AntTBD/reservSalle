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

    public function save($email,$mdp,$admin)
    {
        $response = $this->base->prepare('INSERT INTO user (email, mdp, admin) VALUES(:email, :mdp, :admin)');
        $response->bindValue(':email', $email);
        $response->bindValue(':mdp', $mdp);
        $response->bindValue(':admin', $admin);

        $response->execute();
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

            if (password_verify($mdp, $result['mdp'])) { //string password  , string $hash
            //if ($mdp==$result['mdp']) {
                if($user = $this->find($result['id'])) {
                    //$user = $this->find($result['id']);
                    $_SESSION['id'] = $user->getId();
                    $_SESSION['email'] = $user->getEmail();
                    $_SESSION['admin'] = $user->getAdmin();
                    return $user;
                }
                return false;
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

    public function delete($id)
    {
        $response = $this->base->prepare('DELETE FROM user WHERE id = :id;');
        $response->bindValue(':id', $id);
        return $response->execute();

    }

    public function modifyById($id,$email,$admin){
        if($email != 0 || $email != false ) {

            $response = $this->base->prepare('UPDATE user SET admin = :admin, email = :email WHERE id = :id');
            $response->bindValue(':id', $id);
            $response->bindValue(':admin', $admin);
            $response->bindValue(':email', $email);
            return $response->execute();
        }

    }

    public function modifyByIdWithMdp($id,$email,$admin, $mdp){
        if($email != 0 || $email != false ) {

            $response = $this->base->prepare('UPDATE user SET admin = :admin, email = :email, mdp = :mdp WHERE id = :id');
            $response->bindValue(':id', $id);
            $response->bindValue(':admin', $admin);
            $response->bindValue(':email', $email);
            $response->bindValue(':mdp', $mdp);
            return $response->execute();
        }

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