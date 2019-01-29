<?php
// On utilise le typage strict
declare(strict_types=1);

/* 
 * Classe en charge de la gestion de l'authentification et de l'utilisateur
 * Cette classe est en charge du démarrage de la session
 * Elle utilise la session pour stocker les informations d'un utilisateur
 * 
 * Pour ne permettre qu'un démarrage de session, on utilise un singleton
 */

// Inclusions
require_once 'Classes/AccesDonnees.classe.php';
require_once 'Classes/LoginException.classe.php';

class Authentificateur
{
    // Constantes
    // Définition des champs et taille pour le formulaire de connexion
    const CHAMPS_LOGIN = "login";
    const CHAMPS_MOT_DE_PASSE = "motDePasse";
    const TAILLE_CHAMPS = AccesDonnees::TAILLE_CHAMPS_TEXTE;
    // Définition des champs de $_SESSION
    const LOGIN = "login"; // Le champs login est défini si l'utilisateur est connecté
    
    // Attributs de classe
    private static $instance = null;

    // Attributs
    
    // Méthode de classe
    public static function recupInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Authentificateur();
        }
        return self::$instance;
    }


    // Méthodes
    private function __construct()
    {
        session_start();
    }
    
    
    /*
     * Méthode permettant le traitement du formulaire de connexion
     * Elle lance une LoginException si un problème a été rencontré lors du traitement de la connexion
     */
    public function traiteFormulaireConnexion()
    {
        // On vérifie s'il y a un formulaire à traiter
        if (isset($_POST[self::CHAMPS_LOGIN]) && isset($_POST[self::CHAMPS_MOT_DE_PASSE])) {
            // On valide la taille des entrées
            // On utilise les fonctions travaillant sur les chaînes multibytes car le charset est fixé à UTF-8
            if(mb_strlen($_POST[self::CHAMPS_LOGIN]) > self::TAILLE_CHAMPS) {
                throw new LoginException(LoginException::LOGIN_TROP_LONG);
            }
            if(mb_strlen($_POST[self::CHAMPS_MOT_DE_PASSE]) > self::TAILLE_CHAMPS) {
                throw new LoginException(LoginException::MOT_DE_PASSE_TROP_LONG);
            }
            // On vérifie si les identifiants fournis sont valides
            if (!AccesDonnees::recupInstance()->identifiantsValides($_POST[self::CHAMPS_LOGIN], $_POST[self::CHAMPS_MOT_DE_PASSE])) {
                throw new LoginException(LoginException::INFORMATIONS_INCORRECTES);
            }
            // On valide la connexion
            $_SESSION[self::LOGIN] = $_POST[self::CHAMPS_LOGIN];
        }
        // S'il n'y a pas de formulaire à traiter on ne fait rien
    }
    
    /*
     * Méthode permettant le traitement du formulaire de création d'utilisateur
     * Elle lance une CreationUtilisateurException si un problème a été rencontré lors du traitement de la connexion
     * Elle renvoie vrai si l'utilisateur a bien été créé, faux sinon
     */
    public function traiteFormulaireCreationUtilisateur() : bool
    {
        // On vérifie s'il y a un formulaire à traiter
        if (isset($_POST[self::CHAMPS_LOGIN]) && isset($_POST[self::CHAMPS_MOT_DE_PASSE])) {
            // On valide la taille des entrées
            // On utilise les fonctions travaillant sur les chaînes multibytes car le charset est fixé à UTF-8
            if(mb_strlen($_POST[self::CHAMPS_LOGIN]) > self::TAILLE_CHAMPS) {
                throw new CreationUtilisateurException(CreationUtilisateurException::LOGIN_TROP_LONG);
            }
            if(mb_strlen($_POST[self::CHAMPS_MOT_DE_PASSE]) > self::TAILLE_CHAMPS) {
                throw new CreationUtilisateurException(CreationUtilisateurException::MOT_DE_PASSE_TROP_LONG);
            }
            AccesDonnees::recupInstance()->creationUtilisateur($_POST[self::CHAMPS_LOGIN], $_POST[self::CHAMPS_MOT_DE_PASSE]);
            // Création OK
            return true;
        }
        // S'il n'y a pas de formulaire à traiter on ne fait rien
        return false;
    }
    
    /*
     * Permet de savoir si l'utilisateur est correctement connecté
     */
    public function estConnecte() : bool
    {
        return isset($_SESSION[self::LOGIN]);
    }
    
    /*
     * Récupère le login de l'utilisateur courant
     */
    public function recupLogin() : string
    {
        if (isset($_SESSION[self::LOGIN])) {
            return $_SESSION[self::LOGIN];
        }
        else {
            return "Anonyme";
        }
    }
    
    /*
     * Fonction de deconnexion d'un utilisateur
     * 
     * Cette fonction detruit le contenu de la session
     */
    public function deconnecte()
    {
        session_destroy();
    }
}

