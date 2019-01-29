<?php

/*\
--------------------------------------------
    WebPage.class.php
--------------------------------------------
    Cette classe est destinée à afficher la 
    page Web. Si une méthode doit renvoyer 
    du HTML, elle se trouvera sûrement ici.

    Patron de conception : singleton.

    Pour instancier la WebPage : 
    WebPage::createInstance();
--------------------------------------------
\*/

// On utilise le typage strict
declare(strict_types=1);

// On inclu les constantes nécessaires au fonctionnement de la classe
include_once './params.inc.php';

class WebPage
{

    /*\
     | -------------------------------------
     | Attributs
     | -------------------------------------
    \*/

    // WebPage
    private static $webPageInstance = null; 

    // string
    private $HTMLStyles = '';

    // string
    private $pageContent = '';

    // string
    private $alertMessages = '';
    
    /*\
     | -------------------------------------
     | Méthodes
     | -------------------------------------
    \*/

    // __construct()

    // En private car singleton
    private function __construct()
    {           
        // Renplis le contenu de la page
        FormsProcessor::createInstance()->allForms();
        $this->fetchPageContent();
    }

    /*------------------------------------*/

    // createInstance()

    // Permets d'instancier la page
    public static function createInstance() : WebPage
    {
        // Si Il n'existe pas déjà de connexion
        if(!self::$webPageInstance)                 
        {
            // On instancie par la méthode __construct
            self::$webPageInstance = new WebPage;   
        }
        return self::$webPageInstance; 
    }

    /*------------------------------------*/
    
    // getHTMLStyles()
    
    // Permets de retourner les balises styles rentrées en paramètres
    public function getHTMLStyles() : string
    {
        foreach (SITE_STYLES as $this->style)   
        {
            $this->HTMLStyles .= $this->style;
        }
        return $this->HTMLStyles;
    }

    /*------------------------------------*/
    
    
    // setPageContent()
    
    // Remplace tout le contenu principal de la page, à utiliser pour le debug
    public function setPageContent($content)
    {
        $this->pageContent = $content;
    }

    /*------------------------------------*/
    
    
    // fetchPageContent()
    
    // Construit le contenu de la page
    public function fetchPageContent()
    {
        // On récupère le code de la page actuelle
        switch (Router::createInstance()->getActualPage()) {
            case 1:
                // Page principale
                $this->pageContent = 'Page Principale';
                break;
            
            case 3:
                // Page principale
                $this->pageContent = '  <form class="form-horizontal" method="post">
                                            <fieldset>
                                            
                                            <!-- Form Name -->
                                            <legend>Se connecter ou créer un compte</legend>
                                            
                                            <!-- Text input-->
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="login_email">Votre email</label>  
                                                <div class="col-md-4">
                                                    <input id="login_email" name="login-email" type="text" placeholder="" class="form-control input-md" required="">
                                                </div>
                                            </div>
                                            
                                            <!-- Password input-->
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="login-pass">Mot de passe</label>
                                                <div class="col-md-4">
                                                    <input id="login-pass" name="login-pass" type="password" placeholder="" class="form-control input-md" required="">
                                                </div>
                                            </div>
                                            
                                            <!-- Button -->
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <input type="submit" value="Valider">
                                                </div>
                                            </div>

                                            </fieldset>
                                        </form>';
                break;
            
            case 4:
                // Page principale
                $this->pageContent = 'Page Signup';
                break;
            
            default:
                // Page 404
                $this->pageContent = 'Page 404';
        }
    }

    /*------------------------------------*/
    
    
    // getPageContent()
    
    // Renvois le contenu de la page
    public function getPageContent() : string
    {
        return $this->pageContent;
    }

    /*------------------------------------*/
    
    
    // addAlertMessage()
    
    // Met en place les messages d'alertes
    public function addAlertMessage($message)
    {
        $this->alertMessages .= $message . '<br>';
    }

    /*------------------------------------*/
    
    // displayPage()
    
    // Permets de retourner les balises styles rentrées en paramètres
    public function displayPage() : string
    {
        // On affiche la page
        return '    <!DOCTYPE html>
                    <html lang="' . SITE_LANG . '">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <meta http-equiv="X-UA-Compatible" content="ie=edge">
                        ' . $this->getHTMLStyles() . '
                        <title>' . SITE_TITLE . '</title>
                    </head>
                    <body>
                        <pre>' . $this->alertMessages . '</pre>
                        <h1>' . SITE_TITLE . '</h1>
                        ' . $this->pageContent . '
                    </body>
                    </html>';
    }

    /*------------------------------------*/
    
    // __destruct()

    public function __destruct()
    {
        // echo $this->displayPage();
    }
}