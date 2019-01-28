<?php

/*----------------------------------------*\
    Classe Livre
    Il doit être possible (au moins) 
    d'initialiser des livres, de récupérer 
    leurs titres, de modifier leurs titres, 
    de les afficher sur une PageWeb donnée
\*----------------------------------------*/

class Livre
{


    /************\
     | Attributs
    \************/

    private $titre;
    private $auteur;


    /************\
     | Méthodes
    \************/

    // Constructeur
    public function __construct(string $nouveauTitre, string $nouvelAuteur)
    {
        $this -> titre = $nouveauTitre;
        $this -> auteur = $nouvelAuteur;
    }

    // Setters
    public function setTitre(string $nouveauTitre)
    {
        $this -> titre = $nouveauTitre;
    }

    // Getters
    public function getTitre() : string
    {
        return $this -> titre;
    }
    public function getAuteur() : string
    {
        return $this -> auteur;
    }
}