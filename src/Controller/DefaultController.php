<?php


namespace App\Controller;

use App\Model\Repository\CreneauRepository;
use App\Model\ClavierCrypte;
use App\Model\Repository\Repository;
use App\Model\Repository\ReservationRepository;
use App\Model\Repository\SalleRepository;
use App\Model\Repository\UserRepository;
use App\model\Repository\DispoRepository;

class  DefaultController
{
    public static function index()
    {
        $emplacement = $_SERVER["DOCUMENT_ROOT"];
        //envoi d'un message
        DefaultController::alertMessage("success", "<h3>It works</h3>Dossier www : ".$emplacement);
    }


    public static function accueil()
    {
        if (!isset($_SESSION['id'])) {
            $clavierCrypte = new ClavierCrypte();
            $_SESSION["tab"] = $clavierCrypte->createTabCorrespondance();// on le sauvegarde en session
            $tabCor=$_SESSION['tab'];
            require_once __DIR__ . "/../View/Connexion/connexion.php";
        }

        require __DIR__ . '/../View/Accueil/accueil.php';

    }

    public static function connexion(){
        if (isset($_POST['emailForm']) && isset($_POST['mdpCode'])) {
            echo 'infos sended : '.$_POST['emailForm']."   ".$_POST['mdpCode'].'<br>';
        }

        if (isset($_SESSION['id'])) {
            //envoi d'un message
            DefaultController::alertMessage("warning", "Vous êtes déjà connecté");
        } else {
            if (isset($_POST['emailForm']) && isset($_POST['mdpCode'])) {

                $base = Repository::connect();
                $userRepository = new UserRepository($base);

                if(isset($_SESSION["tab"])) {

                    $tableau = $_SESSION["tab"];// on recupère le tableau mélangé
                    unset($_SESSION['tab']);// on supprime le tableau dans la session

                    $clavierCrypte = new ClavierCrypte();
                    $mdpReel = $clavierCrypte->mdpConvertedFromTabCorrespondance($_POST["mdpCode"], $tableau);
                }else{
                    $mdpReel = null;
                }
                if ($userRepository->login($_POST['emailForm'], $mdpReel)) {

                    //envoi d'un message
                    DefaultController::alertMessage("success", "Vous êtes connecté.");

                    //envoi de la redirection auto
                    self::redirectionAuto( "/index.php/reservation", "RESERVATIONS", 5);


                } else {
                    //envoi d'un message
                    DefaultController::alertMessage("danger", "Ce compte n'existe pas !<br>Veuillez réessayer.");

                    //envoi de la redirection auto
                    self::redirectionAuto( "/", "ACCUEIL", 5);

                }
            }
        }

    }

    public static function reservation()
    {
        require __DIR__ . '/../View/Reservations/main.php';
    }

    public static function reservationBDD(){
        $base = Repository::connect();
        $idUser = $_POST["idUser"];
        $idSalle = $_POST["idSalle"];
        $idCreneau = $_POST["idCreneau"];
        $jour = $_POST["date"];

        echo "<h1> valeurs :::::: ".$idCreneau."  ".$idSalle." ".$idUser."  </h1>";

        $reservationRepository = new ReservationRepository($base);
        $salleRepository = new SalleRepository($base);
        $dispoRepository = new DispoRepository($base);

        $verif = $reservationRepository->add($idSalle,$idUser,$idCreneau,$jour); // On créer une reservation
        if($verif == true){
            $salle = $salleRepository->find(intval($idSalle));
            $salles = $reservationRepository->countResaBySalle($idSalle, $idCreneau);
            echo "<h1> count : ".$salles." et nbPlaces : ".$salle->getNbPlaces()."</h1>";
            if($salles > $salle->getNbPlaces()){   //La salle est pleine a ce creneau
                $dispoRepository->deleteByArguments(intval($idSalle),intval($idCreneau));
            }
        }

    }

    public static function afficherReservation(){
        $base = Repository::connect();
        //affichage de salles
        $salleRepository = new SalleRepository($base);
        $salles = $salleRepository->findAll();
        //affichages creneaux
        $creneauRepository = new CreneauRepository($base);
        $creneaux = $creneauRepository->findAll();
        //Les dispos
        $dispoRepository = new DispoRepository($base);
        $dispos = $dispoRepository->findAll();
        //Les resas
        $reservationRepository = new ReservationRepository($base);
        $resas = $reservationRepository;
        require __DIR__ . '/../../includes/modals/tableResa.php';;
    }

    public static function mesReservations()
    {
        $base = Repository::connect();
        //Les resas
        $reservationRepository = new ReservationRepository($base);
        $mesResa = $reservationRepository->findAllByIdUser($_SESSION['id']);
        if(count($mesResa)>0) {
            //affichage de salles
            $salleRepository = new SalleRepository($base);
            //affichages creneaux
            $creneauRepository = new CreneauRepository($base);
            require __DIR__ . '/../View/MesReservations/main.php';
        }else{
            //envoi d'un message
            self::alertMessage("warning", "Vous n'avez pas de reservations !");
        }
    }

    public static function deconnexion() {
        session_destroy();
        $_SESSION = null;

        //envoi d'un message
        self::alertMessage("success", "Vous avez bien été déconnecté !");
        //envoi de la redirection auto
        self::redirectionAuto("/", "ACCUEIL", 5);
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

    public static function redirectionAuto($lien, $nomPage, $dureeEnSecondeAvantRedirection)
    {
        require __DIR__ . '/../View/redirection_auto.php';
    }

    public static function generatePassword()
    {
        require __DIR__ . '/../View/generatePassword.php';
        if(isset($_POST["mdp"])){
            //envoi d'un message
            self::alertMessage("success", "Password hashed:<br><small>".password_hash($_POST["mdp"], PASSWORD_ARGON2I)."</small>");
        }

    }


}
