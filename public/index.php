<?php
// on démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon.
// https://www.php.net/manual/fr/function.ob-start.php
//ob_start();

session_start();

require __DIR__ . '/../src/View/Commons/header.php';

use App\Controller\DefaultController;

// route the request internally
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ('/index.php' == $uri || '/' == $uri) {
    DefaultController::index();
    DefaultController::accueil();
}  elseif ('/index.php/connexion' == $uri) {
    DefaultController::connexion();
} elseif ('/index.php/deconnexion' == $uri) {
    DefaultController::deconnexion();
} elseif ('/index.php/reservation' == $uri) {
    DefaultController::reservation();
} elseif ('/index.php/generatePassword' == $uri) {
    DefaultController::generatePassword();
} else {
    DefaultController::erreur404();
}

require __DIR__ . '/../src/View/Commons/footer.php';

//on affiche le contenu de ce tampon
//ob_end_flush();

//var_dump($_SESSION);
//phpinfo();