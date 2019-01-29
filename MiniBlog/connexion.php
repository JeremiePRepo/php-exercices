<?php
// On utilise le typage strict
declare(strict_types=1);

/* 
 * Page de connexion
 */

// Inclusions
require_once 'Classes/PagePublique.classe.php';
require_once 'Classes/Authentificateur.classe.php';

// On récupère le gestionnaire de l'authentification
$utilisateur = Authentificateur::recupInstance();

// On construit une page affichant l'erreur est redemandant de se connecter
$maPage = new PagePublique("Connexion");

// On traite le formulaire de connexion
// Les erreurs sont traité par le biais d'exception
try {
    $utilisateur->traiteFormulaireConnexion();
}
catch (LoginException $erreur) {
    $maPage->ajouteFormulaireAuthentification(Authentificateur::CHAMPS_LOGIN, 
                                              Authentificateur::CHAMPS_MOT_DE_PASSE, 
                                              Authentificateur::TAILLE_CHAMPS,
                                              $erreur->getMessage());
    exit();
}

// Si l'utilisateur est déjà connecté
if ($utilisateur->estConnecte()) {
    // On lui indique son état
    $maPage->ajouteParagrapheInfoSimple("Vous êtes connecté");
    $maPage->modifTitre("Bienvenue " . $utilisateur->recupLogin());
    exit();
}
// Sinon : on affiche un formulaire de connexion
$maPage->ajouteFormulaireAuthentification(Authentificateur::CHAMPS_LOGIN, 
                                          Authentificateur::CHAMPS_MOT_DE_PASSE, 
                                          Authentificateur::TAILLE_CHAMPS);

