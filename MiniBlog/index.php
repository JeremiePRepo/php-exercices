<?php
// On utilise le typage strict
declare(strict_types=1);
/* 
 * Page d'accueil du MiniBlog
 */

// Inclusions
require_once 'Classes/PagePublique.classe.php';

// On construit une page
$maPage = new PagePublique("Accueil");
// La page d'accueil comporte la liste des articles
$maPage->ajouteListeArticles();

