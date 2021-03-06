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
        ob_start();// start buffer to get file content
        include(__DIR__ . '/../View/Accueil/base.php');
        DefaultController::alertMessage("success", ob_get_clean());// gets content of include file and discards buffer
    }


    public static function accueil()
    {

        if (!isset($_SESSION['id'])) {
            $clavierCrypte = new ClavierCrypte();
            $_SESSION["tab"] = $clavierCrypte->createTabCorrespondance();// on le sauvegarde en session
            $tabCor = $_SESSION['tab'];
            $token = self::generer_token('reserv');
            if (isset($_GET['testToken']) && $_GET['testToken'] == true) {
                $testToken = true;
            } else {
                $testToken = false;
            }
            require_once __DIR__ . "/../View/Connexion/connexion.php";
        }
        require __DIR__ . '/../View/Accueil/accueil.php';

    }

    public static function connexion()
    {
        if (isset($_POST['emailForm']) && isset($_POST['mdpCode'])) {
            echo "infos sended : " . $_POST['emailForm'] . "   " . $_POST['mdpCode'] . '<br>';
        }
        if (isset($_SESSION['id'])) {
            //envoi d'un message
            DefaultController::alertMessage("warning", "Vous êtes déjà connecté");
        } else {
            if (self::verifier_token(600, 'reserv')) {// on verifie le token si non connecté
                if (isset($_POST['emailForm']) && isset($_POST['mdpCode'])) {

                    $base = Repository::connect();
                    $userRepository = new UserRepository($base);

                    if (isset($_SESSION["tab"])) {  //Verifie le mdp

                        $tableau = $_SESSION["tab"];// on recupère le tableau mélangé
                        unset($_SESSION['tab']);// on supprime le tableau dans la session

                        $clavierCrypte = new ClavierCrypte();
                        $mdpReel = $clavierCrypte->mdpConvertedFromTabCorrespondance($_POST["mdpCode"], $tableau);
                    } else {
                        $mdpReel = null;
                    }
                    if ($userRepository->login($_POST['emailForm'], $mdpReel)) {

                        //envoi d'un message
                        DefaultController::alertMessage("success", "Vous êtes connecté.");

                        //envoi de la redirection auto
                        self::redirectionAuto("/index.php/reservation", "RESERVATIONS", 5);
                    } else {
                        //envoi d'un message
                        DefaultController::alertMessage("danger", "Ce compte ou mot de passe est erroné !<br>Veuillez réessayer.");

                        //envoi de la redirection auto
                        self::redirectionAuto("/", "ACCUEIL", 5);
                    }
                }
            } else {
                //envoi d'un message
                DefaultController::alertMessage("danger", "Mauvais Token");
            }
        }


    }

    public static function reservation()
    {
        if (isset($_SESSION['id'])) {
            require __DIR__ . '/../View/Reservations/main.php';
        } else {
            //envoi d'un message
            DefaultController::alertMessage("danger", "Veuillez vous connecter !");
        }
    }

    public static function reservationBDD()
    {
        if (isset($_SESSION['id'])) {
            if (isset($_POST['idUser']) && isset($_POST['idSalle']) && isset($_POST['idCreneau']) && isset($_POST['date'])) {
                $base = Repository::connect();
                $idUser = $_POST["idUser"];
                $idSalle = $_POST["idSalle"];
                $idCreneau = $_POST["idCreneau"];
                $jour = $_POST["date"];

                $reservationRepository = new ReservationRepository($base);
                $salleRepository = new SalleRepository($base);
                $dispoRepository = new DispoRepository($base);

                $verifAddResa = $reservationRepository->add($idSalle, $idUser, $idCreneau, $jour); // On créer une reservation
                if ($verifAddResa == true) {
                    //envoi d'un message
                    DefaultController::alertMessage("success", "La réservation a bien été ajoutée.");
                } else {
                    //envoi d'un message
                    DefaultController::alertMessage("danger", "Une erreur s'est produite lors de l'ajout d'une réservation' !");
                }
            }
        } else {
            //envoi d'un message
            DefaultController::alertMessage("danger", "Veuillez vous connecter !");
        }

    }

    public static function afficherReservation()
    {
        if (isset($_SESSION['id'])) {
            $base = Repository::connect();
            //affichage de salles
            $salleRepository = new SalleRepository($base);
            $salles = $salleRepository->findAll();
            usort($salles, function($a, $b) {
                return $a->getNumSalle() - $b->getNumSalle();
            });// tri croissant des salles
            //affichages creneaux
            $creneauRepository = new CreneauRepository($base);
            $creneaux = $creneauRepository->findAll();
            //Les dispos
            $dispoRepository = new DispoRepository($base);
            $dispos = $dispoRepository->findAll();
            //Les resas
            $reservationRepository = new ReservationRepository($base);
            $resas = $reservationRepository;
            require __DIR__ . '/../View/Reservations/tableResa.php';
        } else {
            //envoi d'un message
            DefaultController::alertMessage("danger", "Veuillez vous connecter !");
        }
    }

    public static function mesReservations()
    {
        if (isset($_SESSION['id'])) {
            require __DIR__ . '/../View/MesReservations/main.php';
        } else {
            //envoi d'un message
            DefaultController::alertMessage("danger", "Veuillez vous connecter !");
        }
    }

    public static function afficherMesReservations()
    {
        if (isset($_SESSION['id'])) {
            $base = Repository::connect();
            //Les resas
            $reservationRepository = new ReservationRepository($base);
            $mesResa = $reservationRepository->findAllByIdUser($_SESSION['id']);
            if (count($mesResa) > 0) {

                //affichage de salles
                $salleRepository = new SalleRepository($base);
                //affichages creneaux
                $creneauRepository = new CreneauRepository($base);

                // tri croissant de mesResas
                usort($mesResa, function($a, $b) use($salleRepository, $creneauRepository) {
                    $val = strtotime($a->getJour()) - strtotime($b->getJour());
                    if($val==0){
                        $val = $creneauRepository->find($a->getIdCreneau())->getId() - $salleRepository->find($b->getIdCreneau())->getId();
                    }
                    return $val;
                });// tri croissant de mesResas


                require __DIR__ . '/../View/MesReservations/tableMesResa.php';
            } else {
                //envoi d'un message
                DefaultController::alertMessage("warning", "Vous n'avez pas de reservations !");
            }
        } else {
            //envoi d'un message
            DefaultController::alertMessage("danger", "Veuillez vous connecter !");
        }
    }

    public static function annulerReservation()
    {
        if (isset($_SESSION['id'])) {
            if (isset($_POST['idReservation'])) {
                $base = Repository::connect();
                $idReservation = $_POST["idReservation"];


                $reservationRepository = new ReservationRepository($base);
                $resa = $reservationRepository->find($idReservation);
                if ($resa != false) {
                    $verifDeleteResa = $reservationRepository->delete($idReservation); // On créer une reservation

                    if ($verifDeleteResa == true) {
                        //envoi d'un message
                        DefaultController::alertMessage("success", "La réservation a bien été annulée.");
                    } else {
                        //envoi d'un message
                        DefaultController::alertMessage("danger", "Une erreur s'est produite lors de la suppression d'une reservation !");
                    }
                } else {
                    //envoi d'un message
                    DefaultController::alertMessage("danger", "Réservation non trouvée !");
                }
            }
        } else {
            //envoi d'un message
            DefaultController::alertMessage("danger", "Veuillez vous connecter !");
        }
    }

    public static function deconnexion()
    {
        session_unset();
        session_destroy();

        //envoi d'un message
        DefaultController::alertMessage("success", "Vous avez bien été déconnecté !");
        //envoi de la redirection auto
        DefaultController::redirectionAuto("/", "ACCUEIL", 5);
    }



    public static function erreur404()
    {
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
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


    public static function generer_token($nom = '')
    {
        $token = uniqid(rand(), true);
        $_SESSION[$nom . '_token'] = $token;
        $_SESSION[$nom . '_token_time'] = time();
        return $token;
    }

    public static function verifier_token($temps, $nom = '')
    {
        if (isset($_SESSION[$nom . '_token']) && isset($_SESSION[$nom . '_token_time']) && isset($_POST['token'])) {
            if ($_SESSION[$nom . '_token'] == $_POST['token']) {
                if ($_SESSION[$nom . '_token_time'] >= (time() - $temps)) {
                    //on detruit les tokens après s'en etre servi
                    unset($_SESSION[$nom . '_token']);
                    unset($_SESSION[$nom . '_token_time']);
                    return true;
                }
            }
        }
        //on detruit les tokens après s'en etre servi
        unset($_SESSION[$nom . '_token']);
        unset($_SESSION[$nom . '_token_time']);
        return false;
    }

}
