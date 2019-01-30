<?php

/*----------------------------------------*\
    Constants
\*----------------------------------------*/

define('HEAD_START', '
<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Metas -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Style -->
    <link rel="stylesheet" href="https://unpkg.com/sakura.css/css/sakura-dark.css" type="text/css">
    <title>');

define('HEAD_END', '</title></head><body>');

define('NAV', '
<nav>
<ul>
    <li><a href="/">Homepage</a></li>
    <li><a href="/2.1">Exercice 2.1 : Hello World</a></li>
    <li><a href="/3.2">Exercice 3.2 : Page d\'informations techniques</a></li>
    <li><a href="/3.9">Exercice 3.9 : Le journal en ligne (étape 1)</a></li>
    <li><a href="/4.0_PHP_oop">PHP Orienté Objet</a></li>
    <li><a href="/4.0_PHP_oop/pageWeb.php">Afficher une page Web à l\'aide des objets</a></li>
    <li><a href="/4.5_la_bibliotheque/">Exercice 4.5 : La bibliothèque</a></li>
    <li><a href="/4.5_2_singleton/">le singleton</a></li>
    <li><a href="/connexion_bdd/">Connexion à une BDD</a></li>
    <li><a href="/connexion_bdd_classes/">Connexion à une BDD en créant une classe</a></li>
    <li><a href="/connexion_bdd_class_sinleton/">Connexion à une BDD en utilisant singleton</a></li>
    <li><a href="/connexion_et_requete/">Connexion et requête vers une bdd</a></li>
    <li><a href="/heritage/">Héritage : Page Web Privée</a></li>
    <li><a href="/MiniBlog/">Correction : exemple MiniBlog</a></li>
    <li><a href="' . $_SERVER["REQUEST_URI"] . 'site-cochon.local/">TP : Comptaperso</a></li>
    <li><a href="/passwordHashGenerator/">Generateur de hash php</a></li>
</ul>
</nav>');

define('BODY_END', '</body></html>');