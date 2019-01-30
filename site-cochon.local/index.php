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

// On appelle les variables de session
session_start();

// On charge automatiquement les classes
spl_autoload_register(function ($class) {
    include 'lib/' . $class . '.class.php';
});

// On se connecte à la BDD
$dataBase = DataBase::connect();

// On Vérifie sur quelle page on est
$actualPageCode = Router::createInstance()->getActualPageCode();

// On traite les formulaires
$infoMessage        = FormsProcessor::processAll($dataBase, $actualPageCode)->getInfoMessage();
$actualPageDatas    = FormsProcessor::processAll($dataBase, $actualPageCode)->getActualPageDatas();

// On envoie le(s) message(s) de réussite ou d'écheque à la page
WebPage::createInstance($actualPageCode, $actualPageDatas)->addAlertMessage($infoMessage);