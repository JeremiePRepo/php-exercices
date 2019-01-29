<?php
// On utilise le typage strict
declare(strict_types=1);

/* 
 * Cette classe abstraite sert de classe mere pour 
 * des classes permettant la création et l'affichage de page Web
 * 
 * La page sera représentée par un tableau de chaines de caractères
 */

abstract class PageHTML
{
    // Constantes
    /*
     * Ces constantes permettent d'indexer le tableau $maPage 
     * Pour que les différents éléments de la page apparaissent dans le bon sens
     */
    const DEBUT_ENTETE = 0;
    const TITRE = 1;
    const FIN_ENTETE = 2;
    const CORPS = 3;
    const FIN = 4;
    // Taille maximum autorisée pour le contenu de <title></title>
    const MAX_TITLE_SIZE = 60;
    
    // Attributs
    // Tableau contenant l'ensemble de chaînes de caractères qui constitue la page
    protected $maPage;


    // Méthode      
    /*
     * Méthode d'ajout de l'entête de la page
     * 
     * Cette fonction est privée et sera appelée par le constructeur pour garantir 
     * la présence d'une et une seule entête à chaque page
     */
    private function ajouteEntete(string $titre)
    {
        $this->maPage[self::DEBUT_ENTETE] = "<!DOCTYPE HTML>\n";
        $this->maPage[self::DEBUT_ENTETE] .= "<html lang='fr'>\n";
        $this->maPage[self::DEBUT_ENTETE] .= "  <head>\n";
        $this->maPage[self::DEBUT_ENTETE] .= "    <meta charset='UTF-8' />\n";
        $this->maPage[self::DEBUT_ENTETE] .= "    <title>";
        $this->modifTitre($titre);
        $this->maPage[self::FIN_ENTETE] = "</title>\n";
        $this->maPage[self::FIN_ENTETE] .= "  </head>\n";
        $this->maPage[self::FIN_ENTETE] .= "  <body>\n";
        $this->maPage[self::CORPS] = "";
    }
    
    /*
     * Méthode d'ajout de la fin de la page
     * 
     * Cette fonction est privée et sera appelée par le destructeur pour garantir
     * la présence d'une et une seule fin à chaque page
     */
    private function ajouteFin()
    {
        $this->maPage[self::FIN] = "  </body>\n";
        $this->maPage[self::FIN] .= "</html>\n";
    }
    
    /*
     * Méthode permettant l'affichage de la page
     * 
     * Cette fonction est privée et sera appelée par le destructeur pour garantir
     * un unique affichage de la page
     * qui aura lieu forcément à la fin des scripts
     */
    private function affiche()
    {
        // On parcours le tableau Page pour l'afficher
        foreach ($this->maPage as $element) {
            echo $element;
        }
    }
    
    /*
     * Toutes les pages doivent pouvoir ajouter un menu
     * Ce menu sera d'ailleurs automatiquement ajouté en premier à toutes les pages
     */
    protected abstract function ajouteMenu();
    
    /*
     * Constructeur de Page
     * Initialise la page en ajoutant un entête suivi d'un menu
     */
    public function __construct(string $titre="MiniBlog") 
    {
        // On initialise la page en créant l'entête
        $this->ajouteEntete($titre);
        $this->ajouteMenu();
    }
    
    /*
     * Destructeur de Page
     * Ajoute la fin de la page et affiche
     */
    public function __destruct() 
    {
        // On ferme proprement la page
        $this->ajouteFin();
        // On l'affiche
        $this->affiche();
    }
    
    /*
     * Méthode permettant de modifier le titre de la page
     * 
     * Le titre doit être une chaine d'au plus MAX_TITLE_SIZE caracteres
     */
    public function modifTitre(string $titre)
    {
        if (mb_strlen($titre) > self::MAX_TITLE_SIZE) {
            throw new Exception("Titre trop long - Merci d'utiliser un titre de moins de ". self::MAX_TITLE_SIZE . " caractères");
        }
        $this->maPage[self::TITRE] = $titre;
    }
    
    /*
     * Méthode permettant l'ajout d'un élément de menu
     * Un lien encapsulé dans une balise <li></li>
     * Ce lien est mis en évidence (avec <em>) lorsqu'il s'agit de la page courante
     * 
     * Ces liens devant être inserer dans un menu, 
     * on utilise une visibilité protected pour que seule les classes filles puissent l'appeler
     */
    protected function ajouteLienMenu(string $texte, string $cible) 
    {
        $this->maPage[self::CORPS] .= "        <li><a href='" . $cible . "'>";
        if (pathinfo($_SERVER["PHP_SELF"])["basename"] === $cible) {
             $this->maPage[self::CORPS] .= "<em>" . htmlentities($texte,ENT_QUOTES|ENT_HTML5,"UTF-8") . "</em>";
        }
        else {
            $this->maPage[self::CORPS] .= htmlentities($texte);
        }
        $this->maPage[self::CORPS] .= "</a></li>\n";
    }
    
    /*
     * Ajoute un paragraphe dont le contenu (texte brut) est en paramètre
     */
    public function ajouteParagrapheInfoSimple(string $contenu)
    {
        $this->maPage[self::CORPS] .= "    <p>"  . htmlentities($contenu,ENT_QUOTES|ENT_HTML5,"UTF-8") . "</p>\n";
    }
    
}

