<?php

/*----------------------------------------*\
    Deux cas de figures :

    1 - Chaque livre ne peut être présent 
    qu'une seule fois dans une collection

    2 - Il est possible d'ajouter plusieurs 
    fois le même livre dans une collection, 
    dans ce cas, l'exemplaire ajouté verra 
    son nom suffixé par (exemplaire 
    supplémentaire)
\*----------------------------------------*/

/*\
 | On inclut les classes
\*/

require_once('classes/Livre.classe.php');
require_once('classes/Collection.classe.php');
require_once('classes/PageWeb.classe.php');


/*\
 | On crée quelques livres
\*/

$guerreEtPaix       = new Livre('Guerre et paix', 'Léon Tolstoï');
$roman1984          = new Livre('1984', 'Georges Orwell');
$promesseDeLAube    = new Livre('La promesse de l\'aube', 'Romain Gary');


/*\
 | On crée quelques doublons
\*/

$deuxiemeRoman1984          = new Livre('1984', 'Georges Orwell');
$deuxiemePromesseDeLAube    = new Livre('La promesse de l\'aube', 'Romain Gary');


/*\
 | On crée une collection
\*/

$maBibliotheque = new Collection;


/*\
 | On ajoute les livres à la collection
\*/

$maBibliotheque -> ajouterLivre($guerreEtPaix);
$maBibliotheque -> ajouterLivre($guerreEtPaix);
$maBibliotheque -> ajouterLivre($roman1984);
$maBibliotheque -> ajouterLivre($promesseDeLAube);
$maBibliotheque -> ajouterLivre($deuxiemeRoman1984);
$maBibliotheque -> ajouterLivre($deuxiemePromesseDeLAube);


/*\
 | On affiche la collection dans une page Web
 | La page s'affiche automatiquement dans le destruct
\*/

$maPageWeb = new PageWeb(   'Ma bibliothèque',
                            ($maBibliotheque -> retournerListeDesTitres()));