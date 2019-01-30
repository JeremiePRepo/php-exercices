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
        getActualPageCode();
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

    private static $routerInstance = null;  // Router
    private $actualPageCode = 3;            // int
    
    /*\
     | -------------------------------------
     | Méthodes
     | -------------------------------------
    \*/

    // __construct()

    // En private car singleton
    private function __construct()
    {
        // On actualise $actualPageCode avec le code de la page courante
        $this->setActualPageCode();
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

    // setActualPageCode()

    // Mets à jour $actualPageCode en fonction du paramètre d'url.
    public function setActualPageCode()
    {
        // TODO : Le script peut être simplifier
        if (filter_has_var(INPUT_GET , 'page'))
        {
            switch ($_GET['page']) {
                case 'login':
                    if(isset($_SESSION['logged']) === true)
                    {
                        $this->actualPageCode = 1;  // Accueil
                        return;
                    }
                    $this->actualPageCode = 3;      // Login
                    break;

                case 'signup':
                    if(isset($_SESSION['logged']) === true)
                    {
                        $this->actualPageCode = 1;  // Accueil
                        return;
                    }
                    $this->actualPageCode = 4;      // Signup
                    break;
                
                default:
                $this->actualPageCode = 2;          // 404
                break;
            }
            return;
        }
        // Pas de paramètre GET = page d'accueil, si l'utilisateur est connecté
        if(isset($_SESSION['logged']) === false)
        {
            $this->actualPageCode = 3;              // Login
            return;
        }
        $this->actualPageCode = 1;                  // Accueil
        return;
    }

    /*------------------------------------*/

    // getActualPageCode()

    // Retourne $actualPageCode.
    public function getActualPageCode() : int
    {
        return $this->actualPageCode;
    }
}