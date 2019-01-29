<?php
// On utilise le typage strict
declare(strict_types=1);

/* 
 * Cette classe permet la construction des pages publiques du site
 * Elle hérite de la classe abstraite PageHTML
 * 
 */

// Inclusions
require_once 'Classes/PageHTML.classe.php';
require_once 'Classes/AccesDonnees.classe.php';

class PagePublique extends PageHTML
{
    // Constantes
    // Constantes correspondant aux URL des pages affichées dans le menu des pages publiques
    const INDEX = "index.php";
    const ARTICLE = "article.php";
    const INDEX_PRIVE = "redactionArticle.php";
    // Prefixe Titre
    const TITRE_PREFIX = "MiniBlog";
    
    // Attributs
    private $base; // Accès aux données persistantes
    
    // Méthodes
    
    /*
     * Construction d'une page publique
     * 
     * Le titre des pages est initialisé avec un prefixe suivi d'une partie au choix en parametre
     */
    public function __construct(string $titre="") 
    {
        $this->base = AccesDonnees::recupInstance();
        parent::__construct(self::TITRE_PREFIX . " - " . $titre);
    }
    
    /**
     * On affiche un lien d'accès à la partie privée à la fin de chaque page publique
     */
    public function __destruct() 
    {
        $this->maPage[self::CORPS] .= "    <nav>\n";
        $this->maPage[self::CORPS] .= "      <ul>\n";
        $this->ajouteLienMenu("Accès privé", self::INDEX_PRIVE);
        $this->maPage[self::CORPS] .= "      </ul>\n";
        $this->maPage[self::CORPS] .= "    </nav>\n";
        parent::__destruct();
    }


    /*
     * Méthode pour ajouter un formulaire de connexion à une page
     * 
     * Elle prend en paramètre :
     *  - le nom du du champs qui contiendra le login dans $_POST
     *  - le nom du champs qui contiendra le mot de passe dans $_POST
     *  - la taille max de ces 2 champs
     *  - Un message d'erreur (optionnel)
     */
    public function ajouteFormulaireAuthentification(string $champsLogin, string $champsMotDePasse, int $tailleMax, string $messageErreur = "")
    {
        // On affiche un message d'erreur le cas échéant
        if (!empty($messageErreur)) {
            $this->maPage[self::CORPS] .= "    <p>" . htmlentities($messageErreur,ENT_QUOTES|ENT_HTML5,"UTF-8") . "</p>\n";
        }
        // On utilise systematiquement le script qui affiche le formulaire comme action
        $this->maPage[self::CORPS] .= "    <form action='" . pathinfo($_SERVER["PHP_SELF"])["basename"]. "' method='post'>\n";
        $this->maPage[self::CORPS] .= "      <fieldset>\n";
        $this->maPage[self::CORPS] .= "        <legend>" . htmlentities("Connexion",ENT_QUOTES|ENT_HTML5,"UTF-8") . "</legend>\n";
        $this->maPage[self::CORPS] .= "        <label for='" . $champsLogin . "'>" . htmlentities("Identifiant",ENT_QUOTES|ENT_HTML5,"UTF-8") . "</label>\n";
        $this->maPage[self::CORPS] .= "        <input type='test' name='" . $champsLogin . "' maxlength='" . $tailleMax . "' autofocus><br>\n";
        $this->maPage[self::CORPS] .= "        <label for='" . $champsMotDePasse . "'>" . htmlentities("Mot de passe",ENT_QUOTES|ENT_HTML5,"UTF-8") . "</label>\n";
        $this->maPage[self::CORPS] .= "        <input type='password' name='" . $champsMotDePasse . "' maxlength='" . $tailleMax . "'><br>\n";
        $this->maPage[self::CORPS] .= "        <input type='submit' value='Se connecter'>\n";
        $this->maPage[self::CORPS] .= "      </fieldset >\n";
        $this->maPage[self::CORPS] .= "    </form >\n";
    }
    
    /*
     * Définition de la fonction abstraite d'ajout du menu à la page
     */
    protected function ajouteMenu()
    {
        $this->maPage[self::CORPS] .= "    <nav>\n";
        $this->maPage[self::CORPS] .= "      <ul>\n";
        $this->ajouteLienMenu("Accueil", self::INDEX);
        $this->maPage[self::CORPS] .= "      </ul>\n";
        $this->maPage[self::CORPS] .= "    </nav>\n";
    }
    
    /*
     * Ajoute la liste des articles à une page publique
     */
    public function ajouteListeArticles()
    {
        $this->maPage[self::CORPS] .= "    <section>\n";
        $this->maPage[self::CORPS] .= "      <h1>" . htmlentities("Derniers articles",ENT_QUOTES|ENT_HTML5,"UTF-8") ."</h1>\n";
        $this->maPage[self::CORPS] .= "      <ul>\n";
        foreach ($this->base->listeTitres() as $id => $titre) {
            $this->maPage[self::CORPS] .= "        <li><a href='" . self::ARTICLE . "?id=". $id . "'>".htmlentities($titre)."</a></li>\n";
        }
        $this->maPage[self::CORPS] .= "      </ul>\n";
        $this->maPage[self::CORPS] .= "    </section>\n";
    }
    
    /*
     * Ajoute un article à la page
     * Paramètre : id
     * Identifiant de l'article, si l'identifiant est invalide, redirection vers l'accueil du site
     */
    public function ajouteArticle(int $id)
    {
        $article = $this->base->recupArticle($id);
        if (empty($article)) {
            // L'article récupérer est vide, l'identifiant est invalide
            // On redirige sur la page d'accueil
            header("Location: " . self::INDEX);
            exit();
        }
        $this->maPage[self::CORPS] .= "    <article>\n";
        $this->maPage[self::CORPS] .= "      <h2>" . htmlentities($article[AccesDonnees::CHAMPS_TITRE],ENT_QUOTES|ENT_HTML5,"UTF-8") . 
                                      " par <em>" . htmlentities($article[AccesDonnees::CHAMPS_AUTEUR],ENT_QUOTES|ENT_HTML5,"UTF-8") ."</em></h2>\n";
        $this->maPage[self::CORPS] .= "      <p>" . htmlentities($article[AccesDonnees::CHAMPS_CONTENU],ENT_QUOTES|ENT_HTML5,"UTF-8") . "</p>\n";
        $this->maPage[self::CORPS] .= "    </article>\n";
    }
}

