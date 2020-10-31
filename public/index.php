<?php
// on démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon.
// https://www.php.net/manual/fr/function.ob-start.php
//ob_start();

session_start();
require __DIR__.'/../vendor/autoload.php';

use App\Controller\AdminController;
use App\Controller\DefaultController;



// route the request internally
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ('/index.php' == $uri || '/' == $uri) {
    require __DIR__ . '/../src/View/Commons/header.php';
    DefaultController::index();
    DefaultController::accueil();
    require __DIR__ . '/../src/View/Commons/footer.php';
}  elseif ('/index.php/connexion' == $uri) {
    require __DIR__ . '/../src/View/Commons/header.php';
    DefaultController::connexion();
    require __DIR__ . '/../src/View/Commons/footer.php';
} elseif ('/index.php/deconnexion' == $uri) {
    require __DIR__ . '/../src/View/Commons/header.php';
    DefaultController::deconnexion();
    require __DIR__ . '/../src/View/Commons/footer.php';
} elseif ('/index.php/reservation' == $uri) {
    require __DIR__ . '/../src/View/Commons/header.php';
    DefaultController::reservation();
    require __DIR__ . '/../src/View/Commons/footer.php';
} elseif ('/index.php/reservationBDD' == $uri) {
    DefaultController::reservationBDD();
} elseif ('/index.php/afficherReservation' == $uri) {
    DefaultController::afficherReservation();
} elseif ('/index.php/mesreservations' == $uri) {
    require __DIR__ . '/../src/View/Commons/header.php';
    DefaultController::mesReservations();
    require __DIR__ . '/../src/View/Commons/footer.php';
} elseif ('/index.php/afficherMesReservations' == $uri) {
    DefaultController::afficherMesReservations();
} elseif ('/index.php/annulerReservation' == $uri) {
    DefaultController::annulerReservation();
} elseif ('/index.php/generatePassword' == $uri) {
    require __DIR__ . '/../src/View/Commons/header.php';
    DefaultController::generatePassword();
    require __DIR__ . '/../src/View/Commons/footer.php';
} elseif ('/index.php/admin' == $uri) {
    require __DIR__ . '/../src/View/Commons/header.php';
    AdminController::admin();
    require __DIR__ . '/../src/View/Commons/footer.php';
} elseif ('/index.php/afficherUser' == $uri) {
    AdminController::afficherUser();
} elseif ('/index.php/deleteUser' == $uri) {
    AdminController::deleteUser();
} elseif ('/index.php/modifierUser' == $uri) {
    AdminController::modifierUser();
} elseif ('/index.php/modiferUserBdd' == $uri) {
    AdminController::modiferUserBdd();
} elseif ('/index.php/ajouterUser' == $uri) {
    AdminController::ajouterUser();
} elseif ('/index.php/ajouterUserBdd' == $uri) {
    AdminController::ajouterUserBdd();
} elseif ('/index.php/afficherDispo' == $uri) {
    AdminController::afficherDispo();
} elseif ('/index.php/deleteDispo' == $uri) {
    AdminController::deleteDispo();
} elseif ('/index.php/deleteDispoVerif' == $uri) {
    AdminController::deleteDispoVerif();
} elseif ('/index.php/ajouterDispo' == $uri) {
    AdminController::ajouterDispo();
} elseif ('/index.php/ajouterDispoBdd' == $uri) {
    AdminController::ajouterDispoBdd();
} elseif ('/index.php/afficherSalles' == $uri) {
    AdminController::afficherSalles();
} elseif ('/index.php/ajouterSalle' == $uri) {
    AdminController::ajouterSalle();
} elseif ('/index.php/ajouterSalleBdd' == $uri) {
    AdminController::ajouterSalleBdd();
} elseif ('/index.php/deleteSalle' == $uri) {
    AdminController::deleteSalle();
} elseif ('/index.php/deleteSalleVerif' == $uri) {
    AdminController::deleteSalleVerif();
} elseif ('/index.php/modifierSalle' == $uri) {
    AdminController::modifierSalle();
} elseif ('/index.php/modiferSalleBdd' == $uri) {
    AdminController::modiferSalleBdd();
}  elseif ('/index.php/afficherCreneau' == $uri) {
    AdminController::afficherCreneau();
} elseif ('/index.php/modifierCreneau' == $uri) {
    AdminController::modifierCreneau();
} elseif ('/index.php/modiferCreneauBdd' == $uri) {
    AdminController::modiferCreneauBdd();
} else {
    require __DIR__ . '/../src/View/Commons/header.php';
    DefaultController::erreur404();
    require __DIR__ . '/../src/View/Commons/footer.php';
}



//on affiche le contenu de ce tampon
//ob_end_flush();

//var_dump($_SESSION);
//phpinfo();

