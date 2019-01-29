<?php
// On utilise le typage strict
declare(strict_types=1);

/* 
 * Cette classe permet la construction des pages privée du site
 * Elle hérite de la classe abstraite PageHTML
 * 
 */

// Inclusions
require_once 'Classes/Authentificateur.classe.php';
require_once 'Classes/PageHTML.classe.php';
require_once 'Classes/AccesDonnees.classe.php';

class PagePrivee extends PageHTML
{
    // Constantes
    // Constantes correspondant aux URL affichée dans les pages privees
    const CONNEXION = "connexion.php";
    const DECONNEXION = "deconnexion.php";
    const AJOUTE_ARTICLE = "redactionArticle.php";
    const AJOUTE_UTILISATEUR = "admin.php";
    const INDEX = "index.php";
    // Constantes correspondant aux champs de formulaires
    const CHAMPS_TITRE = "titre";
    const CHAMPS_TEXTE = "texte";
    const TAILLE_MAX_CHAMPS = AccesDonnees::TAILLE_CHAMPS_TEXTE;
    // Prefixe Titre
    const TITRE_PREFIX = "MiniBlog - ";
    
    // Attributs
    private $utilisateur;
    
    // Méthodes
    
    /*
     * Construction d'un Page privée
     * Les pages privées ne sont accessible qu'aux utilisateurs connectés
     * Un utilisateur non connecté sera redirigé vers la page de connexion
     * Le titre passé en paramètre sera préfixé par TITRE_PREFIX
     */
    public function __construct(string $titre = "") 
    {
        // On initialise l'utilisateur
        $this->utilisateur = Authentificateur::recupInstance();
        // La seule page "privée" accessible à un utilisateur non connecté est la page de connexion
        if (!$this->utilisateur->estConnecte()) {
            header("Location: " . self::CONNEXION);
            exit();
        }
        parent::__construct(self::TITRE_PREFIX . $titre);
    }
    
    /*
     * Définition de la fonction abstraite d'ajout du menu à la page
     * 
     * Affiche le menu des pages privées
     */
    protected function ajouteMenu()
    {
        $this->maPage[self::CORPS] .= "    <nav>\n";
        $this->maPage[self::CORPS] .= "      <ul>\n";
        $this->ajouteLienMenu("Accueil", self::INDEX);
        $this->ajouteLienMenu("Rédiger un article", self::AJOUTE_ARTICLE);
        $this->ajouteLienMenu("Ajouter un utilisateur", self::AJOUTE_UTILISATEUR);
        $this->ajouteLienMenu("Se deconnecter", self::DECONNEXION);
        $this->maPage[self::CORPS] .= "      </ul>\n";
        $this->maPage[self::CORPS] .= "    </nav>\n";
    }
    
    /*
     * Méthode pour ajouter un formulaire d'ajout d'un utilisateur
     * 
     * Elle prend en paramètre :
     *  - le nom du du champs qui contiendra le login dans $_POST
     *  - le nom du champs qui contiendra le mot de passe dans $_POST
     *  - la taille max de ces 2 champs
     *  - Un message (optionnel) pour l'affichage
     */
    public function ajouteFormulaireCreationUtilisateur(string $champsLogin, string $champsMotDePasse, int $tailleMax, string $messageErreur = "")
    {
        // On affiche un message le cas échéant
        if (!empty($messageErreur)) {
            $this->maPage[self::CORPS] .= "    <p>" . htmlentities($messageErreur) . "</p>\n";
        }
        // On utilise systematiquement le script qui affiche le formulaire comme action
        $this->maPage[self::CORPS] .= "    <form action='" . pathinfo($_SERVER["PHP_SELF"])["basename"]. "' method='post'>\n";
        $this->maPage[self::CORPS] .= "      <fieldset>\n";
        $this->maPage[self::CORPS] .= "        <legend>" . htmlentities("Création d'un utilisateur",ENT_QUOTES|ENT_HTML5,"UTF-8") . "</legend>\n";        
        $this->maPage[self::CORPS] .= "        <label for='" . $champsLogin . "'>" . htmlentities("Identifiant",ENT_QUOTES|ENT_HTML5,"UTF-8") . "</label>\n";
        $this->maPage[self::CORPS] .= "        <input type='text' name='" . $champsLogin . "' maxlength='" . $tailleMax . "' autofocus><br>\n";
        $this->maPage[self::CORPS] .= "        <label for='" . $champsMotDePasse . "'>" . htmlentities("Mot de passe",ENT_QUOTES|ENT_HTML5,"UTF-8") . "</label>\n";
        $this->maPage[self::CORPS] .= "        <input type='password' name='" . $champsMotDePasse . "' maxlength='" . $tailleMax . "'><br>\n";
        $this->maPage[self::CORPS] .= "        <input type='submit' value=\"" . htmlentities("Créer l'utilisateur",ENT_QUOTES|ENT_HTML5,"UTF-8") . "\">\n";
        $this->maPage[self::CORPS] .= "      </fieldset >\n";
        $this->maPage[self::CORPS] .= "    </form >\n";
    }
    
    /*
     * Méthode pour ajouter un formulaire de redaction d'article
     * 
     * Elle prend en paramètre optionnel:
     *  - Un message qu'elle affiche
     */
    public function ajouteFormulaireCreationArticle(string $message = "")
    {
        // On affiche un message le cas échéant
        if (!empty($message)) {
            $this->maPage[self::CORPS] .= "    <p>" . htmlentities($message,ENT_QUOTES|ENT_HTML5,"UTF-8") . "</p>\n";
        }
        // On utilise systematiquement le script qui affiche le formulaire comme action
        $this->maPage[self::CORPS] .= "    <form action='" . pathinfo($_SERVER["PHP_SELF"])["basename"]. "' method='post'>\n";
        $this->maPage[self::CORPS] .= "      <fieldset>\n";
        $this->maPage[self::CORPS] .= "        <legend>" . htmlentities("Rédaction d'un article") . "</legend>\n";
        $this->maPage[self::CORPS] .= "        <label for='" . self::CHAMPS_TITRE . "'>" . htmlentities("Titre",ENT_QUOTES|ENT_HTML5,"UTF-8") . "</label>\n";
        $this->maPage[self::CORPS] .= "        <input type='text' name='" . self::CHAMPS_TITRE . "' maxlength='" . self::TAILLE_MAX_CHAMPS . "' autofocus><br>\n";
        $this->maPage[self::CORPS] .= "        <textarea name='" . self::CHAMPS_TEXTE . "' rows='10' cols='80'></textarea><br>\n";
        $this->maPage[self::CORPS] .= "        <input type='submit' value=\"" . htmlentities("Valider",ENT_QUOTES|ENT_HTML5,"UTF-8") . "\">\n";
        $this->maPage[self::CORPS] .= "      </fieldset >\n";
        $this->maPage[self::CORPS] .= "    </form >\n";
    }
    
}

