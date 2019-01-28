<?php

/*----------------------------------------*\
    Includes
\*----------------------------------------*/

include '../includes/parts.inc.php';
include '../includes/functions.inc.php';



/*----------------------------------------*\
    Constants
\*----------------------------------------*/

define('TITLE', 'Le journal en ligne (étape 1)');



/*----------------------------------------*\
    Page Functions
\*----------------------------------------*/

function displayPageContent(){
    // Déclaration des variables :
    $output = '';
    $articlesCount = 0;

    // Le dossier existe-t-il
    if( file_exists( 'articles/' ) ){
        $output .= '<p>Le dossier "articles" existe.</p>';
        $output .= '<p>Liste des fichiers dans le dossier "articles" :</p>';
        foreach ( scandir( 'articles/' ) as $id => $fichier ){
            $output .= '<p>Fichier n°' . $id . '; <br>Nom de fichier : ' . $fichier . '</p>';

            //On vérifie que le nom du ficher est "article?.txt"
            if ( preg_match( '/article[0-9]+\.txt/', $fichier ) ){
                $articlesCount++;
            }
        };
        $output .= '<strong>Nombre d\'articles : ' . $articlesCount . '</strong>';
    } else {
        $output .= '<p>Le dossier "articles" n\'existe pas.</p>';
    }
    $output .= buildArticlesMenu($articlesCount);
    return $output;
}

function buildArticlesMenu($nbArticles){
    $output = '<nav>';
    for( $i=0; $i<=$nbArticles; $i++ ){
        $output .= '<li><a>Article ' . $i . '</a></li>';
    }
    $output .= '</nav>';

}



/*----------------------------------------*\
    App Start
\*----------------------------------------*/

echo (buildPage());