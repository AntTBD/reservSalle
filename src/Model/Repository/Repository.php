<?php


namespace App\Model\Repository;
use PDO;

class Repository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public static function connect()
    {
        try{
            require_once __DIR__ . '/../../../includes/config.inc.php';//importation de la config de la BDD
            $pdo = new PDO("mysql:host=".$database['host'].";dbname=".$database['base'].";charset=UTF8",$database['user'],$database['password']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            return new self($pdo);
        }catch (PDOException $e){
            echo 'Échec lors de la connexion : '.$e->getMessage();
            return null;
        }
    }


    public function query($query)
    {
        return $this->pdo->query($query);
    }

    public function prepare($query, $parameter = null)
    {
        $response =  $this->pdo->prepare($query);
        if (null !== $parameter) {
            $response->execute($parameter);
        }
        return $response;

    }

    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
}
