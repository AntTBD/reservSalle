<?php


namespace App\Controller;


use App\Model\Repository\CreneauRepository;
use App\Model\Repository\DispoRepository;
use App\Model\Repository\Repository;
use App\Model\Repository\ReservationRepository;
use App\Model\Repository\SalleRepository;
use App\Model\Repository\UserRepository;

class AdminController
{


    private static function isAdmin()
    {
        if (isset($_SESSION["id"])) {
            if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) {
                return true;

            } else {
                DefaultController::alertMessage("danger", "Vous n'avez les droits !");
                return false;
            }
        } else {
            DefaultController::alertMessage("danger", "Vous n'êtes pas conecté !");
            return false;
        }
    }

    public static function admin()
    {
        if (self::isAdmin()) {
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

            require __DIR__ . '/../View/admin/admin.php';
        }


    }

    public static function afficherUser()
    {
        if (self::isAdmin()) {
            $base = Repository::connect();
            $userRepository = new UserRepository($base);
            $users = $userRepository->findAll();

            require __DIR__ . '/../View/admin/afficherUser.php';
        }
    }

    public static function deleteUser()
    {
        if (self::isAdmin()) {
            if (isset($_POST["id"])) {
                $base = Repository::connect();
                $userRepository = new UserRepository($base);
                $user = $userRepository->delete($_POST["id"]);

                if ($user) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    public static function modifierUser()
    {
        if (self::isAdmin()) {
            $token = DefaultController::generer_token('modifier_user');
            if (isset($_POST["id"])) {

                $base = Repository::connect();
                $userRepository = new UserRepository($base);
                $user = $userRepository->find($_POST["id"]);

                require __DIR__ . '/../View/admin/modifierUserForm.php';
            }
        }
    }

    public static function modiferUserBdd()
    {
        if (self::isAdmin()) {
            if (DefaultController::verifier_token(120, 'modifier_user')) {
            if (isset($_POST["id"]) && isset($_POST["email"]) && isset($_POST["admin"])) {
                $base = Repository::connect();
                $userRepository = new UserRepository($base);
                if (isset($_POST['mdp'])) {
                    $userRepository->modifyByIdWithMdp($_POST["id"], $_POST["email"], $_POST["admin"], password_hash($_POST["mdp"], PASSWORD_ARGON2I));
                } else {
                    $userRepository->modifyById($_POST["id"], $_POST["email"], $_POST["admin"]);
                }
                return $userRepository;
            }
            } else {
                //envoi d'un message
                DefaultController::alertMessage("danger", "Mauvais Token");
            }
        }
    }

    public static function ajouterUser()
    {
        if (self::isAdmin()) {
            $token = DefaultController::generer_token('ajouter_user');
            require __DIR__ . '/../View/admin/modifierUserForm.php';
        }
    }

    public static function ajouterUserBdd()
    {
        if (self::isAdmin()) {
            if (DefaultController::verifier_token(120, 'ajouter_user')) {
            if (isset($_POST["email"]) && isset($_POST["mdp"]) && isset($_POST["admin"])) {
                $base = Repository::connect();
                $userRepository = new UserRepository($base);
                $userRepository->save($_POST["email"], password_hash($_POST["mdp"], PASSWORD_ARGON2I), $_POST["admin"]);
                return $userRepository;
            }
            } else {
                //envoi d'un message
                DefaultController::alertMessage("danger", "Mauvais Token");
            }
        }
    }

    public static function afficherDispo()
    {
        if (self::isAdmin()) {
            $base = Repository::connect();
            $dispoRepository = new DispoRepository($base);
            $dispos = $dispoRepository->findAll();
            //to get all salles
            $salleRepository = new SalleRepository($base);
            //to get all creneaux
            $creneauRepository = new CreneauRepository($base);

            // tri croissant des dispos
            usort($dispos, function ($a, $b) use ($salleRepository, $creneauRepository) {
                $val = strtotime($a->getDate()) - strtotime($b->getDate());
                if ($val == 0) {
                    $val = $salleRepository->find($a->getIdSalle())->getNumSalle() - $salleRepository->find($b->getIdSalle())->getNumSalle();
                    if ($val == 0) {
                        $val = $creneauRepository->find($a->getIdCreneau())->getId() - $salleRepository->find($b->getIdCreneau())->getId();
                    }
                }
                return $val;
            });// tri croissant des dispos

            require __DIR__ . '/../View/admin/afficherDispo.php';
        }
    }
    public static function deleteDispoVerif()
    {
        if (self::isAdmin()) {
            $token = DefaultController::generer_token('delete_dispo');
            echo $token;
        }
    }
    public static function deleteDispo()
    {
        if (self::isAdmin()) {
            if (DefaultController::verifier_token(120, 'delete_dispo')) {
            if (isset($_POST["idSalle"]) && isset($_POST["idCreneau"])) {
                $base = Repository::connect();
                $dispoRepository = new DispoRepository($base);
                $user = $dispoRepository->deleteByArguments($_POST["idSalle"], $_POST["idCreneau"]);

                if ($user) {
                    return true;
                } else {
                    return false;
                }
            }
            } else {
                //envoi d'un message
                DefaultController::alertMessage("danger", "Mauvais Token");
            }
        }
    }


    public static function ajouterDispo()
    {
        if (self::isAdmin()) {
            $token = DefaultController::generer_token('ajouter_dispo');
            $base = Repository::connect();
            //to get all salles
            $salleRepository = new SalleRepository($base);
            $salles = $salleRepository->findAll();
            usort($salles, function ($a, $b) {
                return $a->getNumSalle() - $b->getNumSalle();
            });// tri croissant des salles
            //to get all creneaux
            $creneauRepository = new CreneauRepository($base);
            $creneaux = $creneauRepository->findAll();
            require __DIR__ . '/../View/admin/addDispoForm.php';
        }
    }

    public static function ajouterDispoBdd()
    {
        if (self::isAdmin()) {
            if (DefaultController::verifier_token(120, 'ajouter_dispo')) {
            if (isset($_POST["jour"]) && isset($_POST["idSalle"]) && isset($_POST["idCreneau"])) {
                $base = Repository::connect();
                $dispoRepository = new DispoRepository($base);
                $dispoDate = explode('/', $_POST["jour"]);
                $dispoDateString = $dispoDate[0] . "-" . $dispoDate[1] . "-" . $dispoDate[2];
                $dispoRepository->add($dispoDateString, $_POST["idSalle"], $_POST["idCreneau"]);
                return $dispoRepository;
            }
            } else {
                //envoi d'un message
                DefaultController::alertMessage("danger", "Mauvais Token");
            }
        }
    }

    public static function afficherSalles()
    {
        if (self::isAdmin()) {
            $base = Repository::connect();
            $salleRepository = new SalleRepository($base);
            $salles = $salleRepository->findAll();
            usort($salles, function ($a, $b) {
                return $a->getNumSalle() - $b->getNumSalle();
            });// tri croissant des salles
            require __DIR__ . '/../View/admin/afficherSalle.php';
        }
    }

    public static function ajouterSalle()
    {
        if (self::isAdmin()) {
            $token = DefaultController::generer_token('ajouter_salle');
            require __DIR__ . '/../View/admin/modifierSalleForm.php';
        }
    }

    public static function ajouterSalleBdd()
    {
        if (self::isAdmin()) {
            if (DefaultController::verifier_token(120, 'ajouter_salle')) {
            if (isset($_POST["numSalle"]) && isset($_POST["nbPlace"]) && isset($_POST["dispo"])) {
                $base = Repository::connect();
                $salleRepository = new SalleRepository($base);
                $salleRepository->save($_POST["numSalle"], $_POST["nbPlace"], $_POST["dispo"]);
                return 0;
            }
            } else {
                //envoi d'un message
                DefaultController::alertMessage("danger", "Mauvais Token");
            }
        }
    }

    public static function deleteSalleVerif()
    {
        if (self::isAdmin()) {
            $token = DefaultController::generer_token('delete_salle');
            echo $token;
        }
    }
    public static function deleteSalle()
    {
        if (self::isAdmin()) {
            if (DefaultController::verifier_token(120, 'delete_salle')) {
            if (isset($_POST["id"])) {
                $base = Repository::connect();
                $salleRepository = new SalleRepository($base);
                $salle = $salleRepository->delete($_POST["id"]);

                if ($salle) {
                    return true;
                } else {
                    return false;
                }
            }
            } else {
                //envoi d'un message
                DefaultController::alertMessage("danger", "Mauvais Token");
            }
        }
    }

    public static function modifierSalle()
    {
        if (self::isAdmin()) {
            $token = DefaultController::generer_token('modif_salle');
            if (isset($_POST["id"])) {

                $base = Repository::connect();
                $salleRepository = new SalleRepository($base);
                $salle = $salleRepository->find($_POST["id"]);
                require __DIR__ . '/../View/admin/modifierSalleForm.php';
            }
        }
    }

    public static function modiferSalleBdd()
    {
        if (self::isAdmin()) {
            if (DefaultController::verifier_token(120, 'modif_salle')) {
                if (isset($_POST["id"]) && isset($_POST["dispo"]) && isset($_POST["numSalle"]) && isset($_POST["nbPlace"])) {
                    $base = Repository::connect();
                    $salleRepository = new SalleRepository($base);
                    $salleRepository->modifyById($_POST["id"], $_POST["dispo"], $_POST["numSalle"], $_POST["nbPlace"]);
                    return $salleRepository;
                }
            } else {
                //envoi d'un message
                DefaultController::alertMessage("danger", "Mauvais Token");
            }
        }

    }

    public static function afficherCreneau()
    {
        if (self::isAdmin()) {
            $base = Repository::connect();
            $creneauRepository = new CreneauRepository($base);
            $creneaux = $creneauRepository->findAll();
            require __DIR__ . '/../View/admin/afficherCreneau.php';
        }
    }

    public static function modifierCreneau()
    {
        if (self::isAdmin()) {
            $token = DefaultController::generer_token('modif_creneau');
            if (isset($_POST["id"])) {
                $base = Repository::connect();
                $creneauRepository = new CreneauRepository($base);
                $creneau = $creneauRepository->find($_POST["id"]);
                require __DIR__ . '/../View/admin/modifierCreneauForm.php';
            }
        }

    }

    public static function modiferCreneauBdd()
    {
        if (self::isAdmin()) {
            if (DefaultController::verifier_token(120, 'modif_creneau')) {
                if (isset($_POST["id"]) && isset($_POST["heureDebut"])) {
                    $base = Repository::connect();
                    $creneauRepository = new CreneauRepository($base);
                    $creneauRepository->modifyById($_POST["id"], $_POST["heureDebut"]);
                    return $creneauRepository;
                }
            } else {
                //envoi d'un message
                DefaultController::alertMessage("danger", "Mauvais Token");
            }
        }
    }
}
