<?php

/*----------------------------------------*\
    On va créer une nouvelle page Web 
    grâce à un une classe PageWeb
\*----------------------------------------*/

// On inclus les classes
include_once 'classes/PageWeb.classe.php';
include_once 'classes/PageWebPrivee.classe.php';
include_once 'classes/Article.classe.php';

// On instancie les articles
$premierArticle     = new Article;
$deuxiemeArticle    = new Article;

// On défini les attributs
$premierArticle     -> setTitre('Titre de mon premier article');
$premierArticle     -> setContenu('Contenu de mon premier article');
$deuxiemeArticle    -> setTitre('Titre du deuxième article');
$deuxiemeArticle    -> setContenu('Contenu formidable du deuxième article');

// On instancie la Page Web en entrant les contenu en paramètres
$nouvellePageWebPrivee    = new PageWebPrivee(  'Le titre de ma page privée',
                                    '<a href="/"><< Retour aux exercices</a><br><br>' .
                                    $premierArticle     -> getTitre()   . '<br>' .
                                    $premierArticle     -> getContenu() . '<br><br>' .
                                    $deuxiemeArticle    -> getTitre()   . '<br>' .
                                    $deuxiemeArticle    -> getContenu());
