<?php


//Twig
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
//session en variable globale
$twig->addGlobal("session", $_SESSION);