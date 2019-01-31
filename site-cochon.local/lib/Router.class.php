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
                                'signup',
                                'deconnection');

    private static $routerInstance = null;  // Router
    private static $infoMessage = '';       // string
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

    // getInfoMessage()

    // Permet d'obtenir les messages d'infos à afficher
    public static function getInfoMessage() : string
    {
        return self::$infoMessage;
    }

    /*------------------------------------*/

    // setActualPageCode()

    // Mets à jour $actualPageCode en fonction du paramètre d'url.
    public function setActualPageCode()
    {
        $logged = false;

        // L'utilisateur est-il loggé ?
        if(isset($_SESSION['logged']) === true)
        {
            $logged = true;
        }

        if (filter_has_var(INPUT_GET , 'page'))
        {

            if(($_GET['page'] === 'login') AND $logged === false)
            {
                $this->actualPageCode = 3;  // Login
                return;
            }

            if(($_GET['page'] === 'login') AND $logged === true)
            {
                // TODO : Factoriser le code
                // On redirige vers la page principale
                $host  = $_SERVER['HTTP_HOST'];
                $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                header("Location: http://$host$uri/");
            }

            if(($_GET['page'] === 'deconnection'))
            {
                // On détruit la session
                session_unset();
                session_destroy();

                // TODO : Factoriser le code
                // On redirige vers la page login
                $host  = $_SERVER['HTTP_HOST'];
                $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                header("Location: http://$host$uri/?page=login");
            }

            if(($_GET['page'] === 'signup') AND $logged === false)
            {
                $this->actualPageCode = 4;  // Signup
                return;
            }

            if(($_GET['page'] === 'signup') AND $logged === true)
            {
                // TODO : Factoriser le code
                // On redirige vers la page principale
                $host  = $_SERVER['HTTP_HOST'];
                $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                header("Location: http://$host$uri/");
            }

            // Le paramètre page est invalide
            $this->actualPageCode = 2;      // 404
            return;
        }

        // Pas de paramètre Get page

        // L'utilisateur est loggé, tout est normal. Page d'accueil
        if($logged === true)
        {
            $this->actualPageCode = 1;      // Accueil
            self::$infoMessage = "Bienvenue sur le site de la tirelire-cochon :)";
            return;
        }

        // L'utilisateur n'est pas loggé, et pas de paramètre 'Page'
        // On l'invite à se connecter
        $this->actualPageCode = 3;          // Login
    }

    /*------------------------------------*/

    // getActualPageCode()

    // Retourne $actualPageCode.
    public function getActualPageCode() : int
    {
        return $this->actualPageCode;
    }
}