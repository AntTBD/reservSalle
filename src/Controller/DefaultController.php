<?php


namespace App\Controller;


use App\Model\Repository\Repository;
use App\Model\Repository\ReservationRepository;
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
        $tabCorrespondance=Array('Y','Z','A','B','C','D','E','F','G','H');// tableau des variables possibles
        shuffle($tabCorrespondance);// on melange le tableau
        $_SESSION["tab"] = $tabCorrespondance;// on le sauvegarde en session
        require __DIR__ . '/../View/Accueil/accueil.php';

    }

    public static function verifConnect(){
        echo 'infos sended : '.$_POST['emailForm']."   ".$_POST['mdp'].'<br>';
        if (isset($_SESSION['id'])) {
            //envoi d'un message
            DefaultController::alertMessage("warning", "Vous êtes déjà connecté");
        } else {
            if (isset($_POST['emailForm']) && isset($_POST['mdp'])) {

                $base = Repository::connect();
                $userRepository = new UserRepository($base);

                $tableau = $_SESSION["tab"];// on recupère le tableau mélangé
                unset($_SESSION['tab']);// on supprime le tableau
                $motdepasse = $_POST["mdp"];// on recupère le mdp en lettre
                $mdpReel = "";
                for ($i=0; $i<strlen($motdepasse); $i++){
                    $mdpReel.= self::convert($motdepasse[$i], $tableau);// on converti chaque lettre en chiffre
                }
                //echo 'mdpReel '.$mdpReel.'<br>';


                if ($userRepository->login($_POST['emailForm'], $mdpReel)) {
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
    private static function convert ( $lettre, $tabCorrespondance ) {
        // on recupère les correspondances
        $tab = array(
            $tabCorrespondance[0] => "0",
            $tabCorrespondance[1] => "1",
            $tabCorrespondance[2] => "2",
            $tabCorrespondance[3] => "3",
            $tabCorrespondance[4] => "4",
            $tabCorrespondance[5] => "5",
            $tabCorrespondance[6] => "6",
            $tabCorrespondance[7] => "7",
            $tabCorrespondance[8] => "8",
            $tabCorrespondance[9] => "9"
        );
        $lettre = strtr("$lettre", $tab);//on remplace les carractères grace aux pairs de la table
        return $lettre;
    }

    public static function reservation()
    {
        $base = Repository::connect();
        $reservationRepository = new ReservationRepository($base);
        $reservationRepository->countsalle();
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
