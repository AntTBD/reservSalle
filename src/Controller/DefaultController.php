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
        require __DIR__ . '/../View/base.php';
    }


    public static function accueil()
    {
        $clavierCrypte = new ClavierCrypte();
        $_SESSION["tab"] = $clavierCrypte->createTabCorrespondance();// on le sauvegarde en session

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

                $clavierCrypte = new ClavierCrypte();
                $mdpReel=$clavierCrypte->mdpConvertedFromTabCorrespondance($_POST["mdp"]);

                if ($userRepository->login($_POST['emailForm'], $mdpReel)) {
                    //envoi d'un message
                    DefaultController::alertMessage("success", "Vous êtes connecté.");

                    echo "<p>Redirection dans <span id=\"compt\"></span> seconde<span id=\"s\"></span>.
                    <script>
                        var compt = document.getElementById('compt'),
                            s = document.getElementById('s'),
                            durRest = 5;

                        function refreshTimer(){
                            compt.innerHTML = durRest;
                            s.innerHTML = (durRest > 1) ? \"s\" : null;

                            if (durRest <= 0)
                                window.location.href = '/index.php/reservation';
                            else {
                                durRest--;
                                setTimeout(refreshTimer, 1000);
                            }
                        }
                        refreshTimer();
                    </script>";

                    //header("Location: /index.php/reservation");
                    //exit();

                } else {
                    //envoi d'un message
                    DefaultController::alertMessage("danger", "Ce compte n'existe pas !");

                    $_SESSION["state"] = "errorMdp";
                    echo "<p>Redirection dans <span id=\"compt\"></span> seconde<span id=\"s\"></span>.
                    <script>
                        var compt = document.getElementById('compt'),
                            s = document.getElementById('s'),
                            durRest = 5;

                        function refreshTimer(){
                            compt.innerHTML = durRest;
                            s.innerHTML = (durRest > 1) ? \"s\" : null;

                            if (durRest <= 0)
                                window.location.href = '/';
                            else {
                                durRest--;
                                setTimeout(refreshTimer, 1000);
                            }
                        }
                        refreshTimer();
                    </script>";

                    //header("Location: /");
                    //exit();

                }
            }
        }

//A FAIRE : message d'erreur sur le mot de passe !
// ant: utilise le controller avec la fonction alertMessage($typeAlert, $messageAlert)


    }

    public static function reservation()
    {
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
