<?php
// on démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon.
// https://www.php.net/manual/fr/function.ob-start.php
//ob_start();

session_start();
require __DIR__.'/../vendor/autoload.php';

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
    require __DIR__ . '/../src/View/Commons/header.php';
    DefaultController::reservationBDD();
    require __DIR__ . '/../src/View/Commons/footer.php';
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
    DefaultController::admin();
    require __DIR__ . '/../src/View/Commons/footer.php';
} elseif ('/index.php/afficherUser' == $uri) {
    DefaultController::afficherUser();
} elseif ('/index.php/deleteUser' == $uri) {
    DefaultController::deleteUser();
} elseif ('/index.php/modifierUser' == $uri) {
    DefaultController::modifierUser();
} elseif ('/index.php/modiferUserBdd' == $uri) {
    DefaultController::modiferUserBdd();
} elseif ('/index.php/ajouterUser' == $uri) {
    DefaultController::ajouterUser();
} elseif ('/index.php/ajouterUserBdd' == $uri) {
    DefaultController::ajouterUserBdd();
} elseif ('/index.php/afficherDispo' == $uri) {
    DefaultController::afficherDispo();
} elseif ('/index.php/deleteDispo' == $uri) {
    DefaultController::deleteDispo();
} elseif ('/index.php/ajouterDispo' == $uri) {
    DefaultController::ajouterDispo();
} elseif ('/index.php/ajouterDispoBdd' == $uri) {
    DefaultController::ajouterDispoBdd();
} elseif ('/index.php/afficherSalles' == $uri) {
    DefaultController::afficherSalles();
} elseif ('/index.php/ajouterSalle' == $uri) {
    DefaultController::ajouterSalle();
} elseif ('/index.php/ajouterSalleBdd' == $uri) {
    DefaultController::ajouterSalleBdd();
} elseif ('/index.php/deleteSalle' == $uri) {
    DefaultController::deleteSalle();
} elseif ('/index.php/modifierSalle' == $uri) {
    DefaultController::modifierSalle();
} elseif ('/index.php/modiferSalleBdd' == $uri) {
    DefaultController::modiferSalleBdd();
}  elseif ('/index.php/afficherCreneau' == $uri) {
    DefaultController::afficherCreneau();
} elseif ('/index.php/modifierCreneau' == $uri) {
    DefaultController::modifierCreneau();
} elseif ('/index.php/modiferCreneauBdd' == $uri) {
    DefaultController::modiferCreneauBdd();
} else {
    require __DIR__ . '/../src/View/Commons/header.php';
    DefaultController::erreur404();
    require __DIR__ . '/../src/View/Commons/footer.php';
}



//on affiche le contenu de ce tampon
//ob_end_flush();

//var_dump($_SESSION);
//phpinfo();

