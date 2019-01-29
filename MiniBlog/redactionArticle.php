<?php
// On utilise le typage strict
declare(strict_types=1);

/* 
 * Page d'ajout d'article
 * Page privée - seul les utilisateurs authentifiés peuvent y acceder
 */

// Inclusions
require_once 'Classes/PagePrivee.classe.php';


// Construction de la page
$maPage = new PagePrivee("Rédaction d'article");

// Message affiché en résultat du traitement du formulaire
$message = "";

// On traite le formulaire le cas échéant
if (isset($_POST[PagePrivee::CHAMPS_TITRE]) && isset($_POST[PagePrivee::CHAMPS_TEXTE])) {
    // On a un formulaire à traiter
    // On vérifie la taille du titre
    if(mb_strlen($_POST[PagePrivee::CHAMPS_TITRE]) > PagePrivee::TAILLE_MAX_CHAMPS) {
        $message = "Titre trop long";
    }
    else {
        // On enregistre l'article
        // en cas d'erreur lors de l'enregistrement - l'utilisateur sera redirigé vers la page d'erreur
        AccesDonnees::recupInstance()->creationArticle(Authentificateur::recupInstance()->recupLogin(), 
                                                       $_POST[PagePrivee::CHAMPS_TITRE], 
                                                       $_POST[PagePrivee::CHAMPS_TEXTE]);
        $message = "Article ajouté";
    }
}

// On ajoute le formulaire avec affichage du message
// Permet la rédaction d'article en boucle
$maPage->ajouteFormulaireCreationArticle($message);