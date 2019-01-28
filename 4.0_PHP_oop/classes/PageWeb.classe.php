<?php

/*----------------------------------------*\
    La classe PageWeb sert à gérer, 
    construire et afficher des pages Web
\*----------------------------------------*/

class PageWeb
{
    
    /************\
     | Attributs
    \************/

    private $titre;
    private $contenu;
    private $head = '   <!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <meta http-equiv="X-UA-Compatible" content="ie=edge">
                            <link rel="stylesheet" href="https://unpkg.com/sakura.css/css/sakura-dark.css" type="text/css">';
    private $body = '   </head>
                        <body>';
    private $footer = ' </body>
                        </html>';

    /************\
     | Méthodes
    \************/

    // Constructeur
    public function __construct(string $nouveauTitre, string $nouveauContenu)
    {
        $this -> titre = $nouveauTitre;
        $this -> contenu = $nouveauContenu;
    }

    // Getters
    public function getTitre()
    {
        return $this -> titre;
    }
    public function getContenu()
    {
        return $this -> contenu;
    }

    // Autres méthodes
    public function affichePage()
    {
        echo    $this -> head .
                '<title>' . $this -> titre . '</title>' .
                $this -> body .
                '<h1>' . $this -> titre . '</h1>' .
                $this -> contenu .
                $this -> footer;
    }

    // Destructeur
    public function __destruct()
    {
        $this -> affichePage();
    }
}    
