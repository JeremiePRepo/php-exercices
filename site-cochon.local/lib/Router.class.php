<?php

/*\
--------------------------------------------
    Router.class.php
--------------------------------------------
    Cette classe est destinée à résoudre les 
    urls.

    Patron de conception : singleton.

    Pour instancier le Router : 
    Router::createInstance();

    Pour utiliser une méthode :
    Router::createInstance()->
        getActualPage();
--------------------------------------------
\*/

// On utilise le typage strict
declare(strict_types=1);

class Router
{

    /*\
     | -------------------------------------
     | Attributs
     | -------------------------------------
    \*/

    const PAGES_LIST = array(   'accueil',
                                '404',
                                'login',
                                'signup');

    // Router
    private static $routerInstance = null;

    // int
    private $actualPage = 3;
    
    /*\
     | -------------------------------------
     | Méthodes
     | -------------------------------------
    \*/

    // __construct()

    // En private car singleton
    private function __construct()
    {
        // On actualise $actualPage avec le code de la page courante
        $this->setActualPage();
    }

    /*------------------------------------*/

    // createInstance()

    // Permets d'instancier la page
    public static function createInstance() : Router
    {
        // Si Il n'existe pas déjà de connexion
        if(!self::$routerInstance)                 
        {
            // On instancie par la méthode __construct
            self::$routerInstance = new Router;   
        }
        return self::$routerInstance; 
    }

    /*------------------------------------*/

    // setActualPage()

    // Mets à jour $actualPage en fonction du paramètre d'url.
    public function setActualPage()
    {
        if (filter_has_var(INPUT_GET , 'page'))
        {
            switch ($_GET['page']) {
                case 'login':
                    $this->actualPage = 3;
                    break;

                case 'signup':
                    $this->actualPage = 4;
                    break;
                
                default:
                // 404
                $this->actualPage = 2;
                break;
            }
            return;
        }
        // Pas de paramètre GET = page d'accueil
        $this->actualPage = 1;
        return;
    }

    /*------------------------------------*/

    // getActualPage()

    // Retourne $actualPage.
    public function getActualPage()
    {
        return $this->actualPage;
    }
}