<?php
// On utilise le typage strict
declare(strict_types=1);

/* 
 * URL de deconnexion
 * La deconnexion une fois effectuée renvoie sur l'index
 */

// Inclusions
require_once 'Classes/PagePublique.classe.php';
require_once 'Classes/Authentificateur.classe.php';

// On crée un objet pour la gestion de l'authentification
$utilisateur = Authentificateur::recupInstance();
// On deconnecte
$utilisateur->deconnecte();
// Redirection vers l'index
header("Location: " . PagePublique::INDEX);