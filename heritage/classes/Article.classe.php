<?php

/*\
 | Ceci est la classe Article,
 | elle sert à représenter des articles
\*/

class Article
{

    /*----------------------------------------*\
        Attributs
    \*----------------------------------------*/

    private $titre = 'Titre générique';
    private $contenu = 'Contenu générique';

    /*----------------------------------------*\
        Méthodes
    \*----------------------------------------*/

    /*\
     | Getters
    \*/

    public function getTitre() : string
    {
        return $this -> titre;
    }
    public function getContenu() : string
    {
        return $this -> contenu;
    }

    /*\
     | Setters
    \*/

    public function setTitre(string $nouvelleValeur)
    {
        $this -> titre = $nouvelleValeur;
    }
    public function setContenu(string $nouvelleValeur)
    {
        $this -> contenu = $nouvelleValeur;
    }

    /*\
     | Autres fonctions
    \*/

    public function afficheArticle()
    {
        echo '<h3>' . $this -> titre . '</h3><p>' . $this -> contenu . '</p>';
    }
}
