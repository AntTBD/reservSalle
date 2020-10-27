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

} elseif ('/index.php/verifConnect' == $uri) {
    require __DIR__ . '/../src/View/Commons/header.php';
    DefaultController::verifConnect();
    require __DIR__ . '/../src/View/Commons/footer.php';
} elseif ('/index.php/reservationBDD' == $uri) {
    require __DIR__ . '/../src/View/Commons/header.php';
    DefaultController::reservationBDD();
    require __DIR__ . '/../src/View/Commons/footer.php';
} elseif ('/index.php/afficherReservation' == $uri) {
    DefaultController::afficherReservation();

} elseif ('/index.php/generatePassword' == $uri) {
    require __DIR__ . '/../src/View/Commons/header.php';
    DefaultController::generatePassword();
    require __DIR__ . '/../src/View/Commons/footer.php';
} else {
    require __DIR__ . '/../src/View/Commons/header.php';
    DefaultController::erreur404();
    require __DIR__ . '/../src/View/Commons/footer.php';
}


//on affiche le contenu de ce tampon
//ob_end_flush();

//var_dump($_SESSION);
//phpinfo();
