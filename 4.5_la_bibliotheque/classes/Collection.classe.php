<?php

/*----------------------------------------*\
    Classe Collection
    Il doit être possible (au moins) 
    d'ajouter un livre à une collection 
    et d'afficher une collection sur 
    une PageWeb donnée
\*----------------------------------------*/

// On fait appel à la classe Livre
require_once'classes/Livre.classe.php';

class Collection
{


    /************\
     | Attributs
    \************/

    private $listeDeLivres = array();


    /************\
     | Méthodes
    \************/

    // Ajouter un livre
    public function ajouterLivre(Livre $nouveauLivre)
    {
        // On vérifie si l'exemplaire est déjà présent dans la collection
        if (in_array($nouveauLivre, ($this -> listeDeLivres), false))
        {
            // Si déjà présent, on modifie le titre du livre
            $nouveauLivre -> setTitre('(exemplaire supplémentaire) ' . ($nouveauLivre -> getTitre()));
        } 
        // On range le livre dans la bibliothèque
        array_push(($this -> listeDeLivres), $nouveauLivre);
    }

    // Retourner une collection,
    // sous forme de liste des titres de livres
    public function retournerListeDesTitres()
    {
        // On trie les livres pas ordre alphabétiques, parce que c'est mieux
        sort($this -> listeDeLivres);

        $output = '<ul>';

        // On parcours la liste afin de construire les li
        foreach (($this -> listeDeLivres) as $livre) {
            $output .= '<li>' . htmlentities($livre -> getTitre()) . ' de ' . htmlentities($livre -> getAuteur()) . '</li>';
        }

        $output .= '</ul>';
        return $output;
    }
}