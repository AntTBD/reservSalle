<?php


namespace App\Controller;


use App\Model\Repository\Repository;
use App\Model\Repository\UserRepository;

class  DefaultController
{
    public static function index()
    {
        $emplacement = $_SERVER["DOCUMENT_ROOT"];
        require __DIR__ . '/../View/base.php';
    }


    public static function accueil()
    {
        require __DIR__ . '/../View/Accueil/accueil.php';
    }

    public static function verifConnect(){

        if (isset($_SESSION['id'])) {
            //envoi d'un message
            DefaultController::alertMessage("warning", "Vous êtes déjà connecté");
        } else {
            if (isset($_POST['emailForm']) && isset($_POST['mdp'])) {

                $base = Repository::connect();
                $userRepository = new UserRepository($base);

                if ($userRepository->login($_POST['emailForm'], $_POST['mdp'])) {
                    //envoi d'un message
                    DefaultController::alertMessage("success", "Vous êtes connecté.");

                    header("Location: /index.php/reservation");
                    exit();

                } else {
                    //envoi d'un message
                    DefaultController::alertMessage("danger", "Ce compte n'existe pas !");

                    $_SESSION["state"] = "errorMdp";
                    header("Location: /");
                    exit();

                }
            }
        }

//A FAIRE : message d'erreur sur le mot de passe !
// ant: utilise le controller avec la fonction alertMessage($typeAlert, $messageAlert)


    }

    public static function reservation()
    {
        //self::connectToBase();
        require __DIR__ . '/../View/Reservations/main.php';
    }

    public static function deconnexion() {
        session_destroy();
        $_SESSION = null;
        require __DIR__ . '/../View/Connexion/deconnexion.php';
    }

    public static function connexion(){
        $base = Repository::connect();
        if (isset($_SESSION['id'])) {
            //envoi d'un message
            self::alertMessage("warning", "Vous êtes déjà connecté");
        } else {
            if (isset($_POST['email']) && isset($_POST['password'])) {

                $userRepository = new UserRepository($base);

                if ($userRepository->login($_POST['email'], $_POST['mdp'])) {
                    //envoi d'un message
                    self::alertMessage("success", "Vous êtes connecté.");
                    //appel le fichier index.php
                    //header('Location: /');
                } else {
                    //envoi d'un message
                    self::alertMessage("danger", "Ce compte n'existe pas !");
                }
            }
            //require __DIR__ . '/../View/Connexion/connexion.php';
        }
    }

    public static function erreur404()
    {
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
        require __DIR__ . '/../View/404.php';
    }


    // à appeler pour afficher une alerte
    // $typeAlert = danger/warning/success/...
    // $messageAlert = message de l'alert
    public static function alertMessage($typeAlert, $messageAlert)
    {
        require __DIR__ . '/../View/alertMessage.php';
    }

}
