<?php

/*----------------------------------------*\
    Requires
\*----------------------------------------*/

// On appelle les différentes classes
require_once('classes/NomClasse.classe.php');
require_once('classes/Article.classe.php');


/*----------------------------------------*\
    Les Objets
\*----------------------------------------*/

// On Instancie une classe
$monObjet = new NomClasse();


// On appelle une méthode
// (elle n'affiche rien car elle est vide)
$monObjet -> uneMethode();


// On instancie un article
$monArticle = new Article();


// On utilise les méthodes de cet objet article
// pour afficher son contenu
echo '<h3>' . $monArticle -> getTitre() . '</h3>';
echo '<br>';
echo $monArticle -> getContenu();
echo '<br>';


// On utilise une méthode pour modifier un titre
$monArticle -> setTitre('J\'ai changé le titre');
echo '<br>';
echo '<h3>' . $monArticle -> getTitre() . '</h3>';


// On crée un autre article,
// on modifie, et on affiche son contenu grâce à ses méthodes
$unAutreArticle = new Article();
$unAutreArticle -> setTitre('Titre du deuxième article');
$unAutreArticle -> setContenu('Contenu du deuxième article');
$unAutreArticle -> afficheArticle();