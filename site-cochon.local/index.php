<?php

/*\
--------------------------------------------
    index.php
--------------------------------------------
    Point d'entrée du site. C'est ici que 
    l'on démarre la session, charge les 
    classes, et que l'on instancie les 
    classes nécessaires à son 
    fonctionnement.
--------------------------------------------
\*/

// On utilise le typage strict
declare(strict_types=1);

// On charge automatiquement les classes
spl_autoload_register(function ($class) {
    include 'lib/' . $class . '.class.php';
});

// On appelle les variables de session
session_start();

// On se connecte à la BDD
$dataBase = DataBase::connect();

// On Vérifie sur quelle page on est
$actualPageCode = Router::createInstance()->getActualPageCode();
$infoMessage    = Router::createInstance()->getInfoMessage();

// On traite les formulaires
$infoMessage        .= FormsProcessor::processAll($dataBase, $actualPageCode)->getInfoMessage();
$actualPageDatas     = FormsProcessor::processAll($dataBase, $actualPageCode)->getActualPageDatas();

// On crée une instance de la page Web
$webPage = WebPage::createInstance($actualPageCode, $actualPageDatas);

// Si l'utilisateur est connecté, on s'arrête ici
if (isset($_SESSION['logged']) === false) {
    
    // On envoie le(s) message(s) d'infos à la page
    $webPage->addAlertMessage($infoMessage);
    die;
}

// A partir d'ici, l'utilisateur est connecté

// On instancie la classe User
$user = User::createInstance(intval($_SESSION['user-id']));

// On envoie la liste des tirelires
$user->setPiggyBanks($dataBase);

// On envoie le(s) message(s) d'infos à la page
$webPage->addAlertMessage($infoMessage);