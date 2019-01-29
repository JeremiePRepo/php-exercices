<?php
// On utilise le typage strict
declare(strict_types=1);

/* 
 * Classe permettant l'accès aux données persistantes de l'application
 * Elles sont stockées dans une base mysql
 * Cette classe est un singleton notamment pour limiter à une connexion simultanée à la base
 * 
 */

// Inclusions
require_once 'Classes/CreationUtilisateurException.classe.php';

class AccesDonnees
{
    // Constantes
    // Acces à la base
    const DRIVER = "mysql";
    const HOTE = "localhost";
    const BASE = "MiniBlog";
    const LOGIN = "root";
    const MOT_DE_PASSE = "dadfba16";
    
    // Structure de la base
    const TAILLE_CHAMPS_TEXTE = 100;
    // Table des utilisateurs
    const TABLE_UTILISATEUR = "utilisateurs";
    const CHAMPS_LOGIN = "login";
    const CHAMPS_MOT_DE_PASSE = "mot_de_passe";
    // Table des articles
    const TABLE_ARTICLES = "articles";
    const CHAMPS_ID = "id";
    const CHAMPS_TITRE = "titre";
    const CHAMPS_CONTENU = "contenu";
    const CHAMPS_AUTEUR = "auteur";
    
    // Attributs de classe
    private static $instance = null;
    
    // Attributs
    private $base;
    
    // Méthodes de classes
    /*
     * Cette méthode permet de récuperer l'unique instance de la classe
     * Si cette instance n'existe pas encore, elle la créé
     */
    public static function recupInstance() : self
    {
        if(self::$instance === null) {
            self::$instance = new AccesDonnees();
        }
        return self::$instance;
    }
    
    // Méthodes
    /*
     * Le constructeur initie la connexion à la base de donnée
     */
    private function __construct()
    {
        try {
            $this->base = new PDO(self::DRIVER . ":host=" . self::HOTE . ";dbname=" . self::BASE. ";charset=UTF8",
                                  self::LOGIN, self::MOT_DE_PASSE);
        }
        catch (PDOException $erreur) {
            // Traitement d'erreur minimaliste
            // Redirection vers une page d'erreur
            header("Location: erreur.html");
            exit();
        }
    }
    
    /*
     * Fonction permettant d'indiquer si un couple login/mot de passe est valide
     * 
     * Si les identifiants sont valides : renvoie true
     * En cas d'identifiants invalides
     *  - Lance une LoginException
     * Redirige vers une page d'erreur en cas de problème d'accès à la base
     * 
     */
    public function identifiantsValides(string $login,string $motDePasse) :bool
    {
        try {
            $requete = $this->base->prepare("SELECT " . self::CHAMPS_MOT_DE_PASSE . " FROM " . 
                                             self::TABLE_UTILISATEUR . " WHERE " . 
                                             self::CHAMPS_LOGIN . " = :login ");
        }
        catch (PDOException $erreur) {
            // Traitement d'erreur minimaliste
            // Redirection vers une page d'erreur
            header("Location: erreur.html");
            exit();
        }
        if (!$requete->bindValue(":login",$login, PDO::PARAM_STR)) {
            // Traitement d'erreur minimaliste
            // Redirection vers une page d'erreur
            header("Location: erreur.html");
            exit();
        }
        if (!$requete->execute()) {
            // Traitement d'erreur minimaliste
            // Redirection vers une page d'erreur
            header("Location: erreur.html");
            exit();
        }
        $resultat = $requete->fetch();
        if ($resultat === false) {
            // Il n'y a pas de ligne => login invalide
            throw new LoginException(LoginException::INFORMATIONS_INCORRECTES);
        }
        if (!password_verify($motDePasse, $resultat[self::CHAMPS_MOT_DE_PASSE])) {
            // Mot de passe invalide
            throw new LoginException(LoginException::INFORMATIONS_INCORRECTES);
        }
        // Identification valide
        // TODO : Une mise à jour des empreintes de mots de passe en cas de changement 
        // D'algorithme PASSWORD_DEFAUT est à prévoir
        if ($requete->closeCursor() === false) {
            // TODO : Journaliser l'erreur
        }
        return true;        
    }
    
    /*
     * Fonction de création d'un utilisateur dans la base
     * 
     * En cas de tentative de création d'un login déjà existant
     *  - Lance une CreationUtilisateurException
     * Redirige vers une page d'erreur en cas de problème d'accès à la base
     */
    public function creationUtilisateur(string $login, string $motDePasse)
    {
        try {
            $requete = $this->base->prepare("INSERT INTO " . self::TABLE_UTILISATEUR . "(" . 
                                            self::CHAMPS_LOGIN . ", " . self::CHAMPS_MOT_DE_PASSE . 
                                            ") VALUES (:login, :mdp)");
        }
        catch (PDOException $erreur) {
            // Traitement d'erreur minimaliste
            // Redirection vers une page d'erreur
            header("Location: erreur.html");
            exit();
        }
        if (!$requete->bindValue(":login",$login, PDO::PARAM_STR) ||
            !$requete->bindValue(":mdp",password_hash($motDePasse, PASSWORD_DEFAULT), PDO::PARAM_STR)) {
            // Traitement d'erreur minimaliste
            // Redirection vers une page d'erreur
            header("Location: erreur.html");
            exit();
        }
        if (!$requete->execute()) {
            // Si le login est déjà dans la base
            if ($requete->errorInfo()[0] === '23000') {
                throw new CreationUtilisateurException(CreationUtilisateurException::LOGIN_DEJA_UTILISE);
            }
            else {
                // Traitement d'erreur minimaliste
                // Redirection vers une page d'erreur
                header("Location: erreur.html");
                exit();
            }
        }
        if ($requete->closeCursor() === false) {
            // TODO : Journaliser l'erreur
        }
    }
    
    /*
     * Fonction de création d'un article
     * 
     * Redirige vers une page d'erreur en cas de problème d'accès à la base
     */
    public function creationArticle(string $auteur, string $titre, string $contenu)
    {
        try {
            $requete = $this->base->prepare("INSERT INTO " . self::TABLE_ARTICLES . "(" . 
                                            self::CHAMPS_TITRE . ", " . 
                                            self::CHAMPS_CONTENU . ", " . 
                                            self::CHAMPS_AUTEUR . 
                                            ") VALUES (:titre, :contenu, :auteur)");
        }
        catch (PDOException $erreur) {
            // Traitement d'erreur minimaliste
            // Redirection vers une page d'erreur
            header("Location: erreur.html");
            exit();
        }
        if (!$requete->bindValue(":titre",$titre, PDO::PARAM_STR) ||
            !$requete->bindValue(":contenu",$contenu, PDO::PARAM_STR) ||
            !$requete->bindValue(":auteur",$auteur, PDO::PARAM_STR)) {
            // Traitement d'erreur minimaliste
            // Redirection vers une page d'erreur
            header("Location: erreur.html");
            exit();
        }
        if (!$requete->execute()) {
            // Traitement d'erreur minimaliste
            // Redirection vers une page d'erreur
            header("Location: erreur.html");
            exit();
        }
        if ($requete->closeCursor() === false) {
            // TODO : Journaliser l'erreur
        }
    }
    
    /*
     * Fonction permettant de récupérer la liste des titres d'articles
     * 
     * Renvoie la liste des articles sous la forme [id] => [titre]
     */
    public function listeTitres() : array
    {
        $resultats = $this->base->query("SELECT " . self::CHAMPS_ID . " , " . self::CHAMPS_TITRE . 
                                       " FROM " . self::TABLE_ARTICLES);
        $lesTitres = array();
        foreach ($resultats as $ligne) {
            $lesTitres[$ligne[self::CHAMPS_ID]] = $ligne[self::CHAMPS_TITRE];
        }
        $resultats->closeCursor();
        return $lesTitres;      
    }
    
    /*
     * Fonction permettant de récupérer un article d'identifiant donné
     * 
     * Renvoie le tableau associatif contenant les champs de l'article
     * Renvoie un tableau vide en cas d'identifiant invalide
     * Redirige vers une page d'erreur en cas de problème d'accès à la base
     */
    public function recupArticle(int $id) : array
    {
        try {
            $requete = $this->base->prepare("SELECT * FROM " . 
                                             self::TABLE_ARTICLES . " WHERE " . 
                                             self::CHAMPS_ID . " = :id ");
        }
        catch (PDOException $erreur) {
            // Traitement d'erreur minimaliste
            // Redirection vers une page d'erreur
            header("Location: erreur.html");
            exit();
        }
        if (!$requete->bindValue(":id",$id, PDO::PARAM_INT)) {
            // Traitement d'erreur minimaliste
            // Redirection vers une page d'erreur
            header("Location: erreur.html");
            exit();
        }
        if (!$requete->execute()) {
            // Traitement d'erreur minimaliste
            // Redirection vers une page d'erreur
            header("Location: erreur.html");
            exit();
        }
        $resultat = $requete->fetch();
        if ($resultat === false) {
            // Identifiant d'article invalide
            return array();
        }
        return $resultat;
        if ($requete->closeCursor() === false) {
            // TODO : Journaliser l'erreur
        }       
    }
}

