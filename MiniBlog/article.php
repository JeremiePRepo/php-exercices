<?php
// On utilise le typage strict
declare(strict_types=1);
/* 
 * Page d'affichage d'un article
 */

// Inclusions
require_once 'Classes/PagePublique.classe.php';

// On construit une page
$maPage = new PagePublique();

// On vérifie la présence de GET
if(isset($_GET["id"])) {
    // On affiche l'article correspondant à l'id
    // Si l'id n'existe pas ou est invalide, l'utilisateur sera redirigé
    $maPage->ajouteArticle(intval($_GET["id"]));
}
else {
    // Aucun identifiant fourni - On redirige sur l'index
    header("Location: " . PagePublique::INDEX);
    exit();
}


