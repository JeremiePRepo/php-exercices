<?php

function getMainContent(){
    $output = '<h1>Affichage des articles en fonction de la variable get</h1>';

    if (filter_has_var(INPUT_GET, 'article')) {
        $output .= '<p>Numéro de l\'article : ';
        $output .= $_GET['article'] . '</p>';
    } else {
        $output .= '<p>Aucun article en paramètre</p>';
    }
    return $output;
}

function getMenu(){
    $output = '<ul>';
    for($i=0; $i<=count(ARTICLES); $i++){
        $output .= '<li>article ' . $i . '</li>';
    }

    foreach(ARTICLES as $id => $article){
        foreach($article as $id => $content){
            $output .= '<li>article ' . $id . ' titre : '.$content.' contenu</li>';
        }
    }

    $output .= '</ul>';
    return $output;
}