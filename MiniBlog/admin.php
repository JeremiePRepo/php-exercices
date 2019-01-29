<?php
// On utilise le typage strict
declare(strict_types=1);
/* 
 * Page d'administration des utilisateurs
 * Page privée -  seul les utilisateurs authentifiés peuvent y acceder
 */

// Inclusions
require_once 'Classes/PagePrivee.classe.php';
require_once 'Classes/Authentificateur.classe.php';

// On récupère le gestionnaire de l'authentification
$utilisateur = Authentificateur::recupInstance();

// Construction de la page
$maPage = new PagePrivee("Gestion des utilisateurs");

// On traite le formulaire d'ajout d'utilisateur
try {
    // Si la création a eu lieu et s'est bien passé
    if($utilisateur->traiteFormulaireCreationUtilisateur()) {
        // On affiche une information pour prévenir l'utilisateur
        $maPage->ajouteParagrapheInfoSimple("Utilisateur " . $_POST[Authentificateur::CHAMPS_LOGIN] . " créé(e)");
    }
} 
catch (CreationUtilisateurException $erreur) {
    // Affichage du formulaire avec ajout du message d'erreur
    $maPage->ajouteFormulaireCreationUtilisateur(Authentificateur::CHAMPS_LOGIN, 
                                                 Authentificateur::CHAMPS_MOT_DE_PASSE, 
                                                 Authentificateur::TAILLE_CHAMPS,
                                                 $erreur->getMessage());
    exit();
}

// On affiche le formulaire de création d'utilisateur
// Permet la création d'utilisateurs en boucle
$maPage->ajouteFormulaireCreationUtilisateur(Authentificateur::CHAMPS_LOGIN, 
                                             Authentificateur::CHAMPS_MOT_DE_PASSE, 
                                             Authentificateur::TAILLE_CHAMPS);



