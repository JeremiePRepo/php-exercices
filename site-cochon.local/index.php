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

// On crée la page Web
WebPage::createInstance();

// On traite les formulaires
FormsProcessor::processAll();