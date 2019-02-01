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
                                'deconnection',
                                'piggybanks',
                                'new-piggybank',
                                'delete-piggybank',
                                'new-movement');

    private static $routerInstance = null;  // Router
    private static $infoMessage = '';       // string
    private $actualPageCode = 3;            // int
    private $siteURL;                       // string
    
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

        // On stock l'URL du site
        $this->setSiteURL();
    }

    ////////////////////////////////////////

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

    ////////////////////////////////////////

    // getInfoMessage()

    // Permet d'obtenir les messages d'infos à afficher
    public static function getInfoMessage() : string
    {
        return self::$infoMessage;
    }

    ////////////////////////////////////////

    // setSiteURL()

    // Construit l'url du site
    public function setSiteURL()
    {
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $this->siteURL = SITE_PROTOCOL . $host . $uri . '/';
    }

    ////////////////////////////////////////

    // getSiteURL()

    // Retourne l'url du site
    public function getSiteURL() : string
    {
        return $this->siteURL;
    }

    ////////////////////////////////////////

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
                // On redirige vers la page principale
                header("Location: " . $this->siteURL);
            }

            if(($_GET['page'] === 'deconnection'))
            {
                // On détruit la session
                session_unset();
                session_destroy();

                // On redirige vers la page login
                header("Location: " . $this->siteURL . "?page=login");
            }

            if(($_GET['page'] === 'signup') AND $logged === false)
            {
                $this->actualPageCode = 4;  // Signup
                return;
            }

            if(($_GET['page'] === 'signup') AND $logged === true)
            {
                // On redirige vers la page principale
                header("Location: " . $this->siteURL);
            }

            if(($_GET['page'] === 'piggybanks') AND $logged === true)
            {
                $this->actualPageCode = 6;  // PiggyBanks
                return;
            }

            if(($_GET['page'] === 'new-piggybank') AND $logged === true)
            {
                $this->actualPageCode = 7;  // New PiggyBank
                return;
            }

            if(($_GET['page'] === 'delete-piggybank') AND $logged === true)
            {
                $this->actualPageCode = 8;  // Delete PiggyBank
                
                // On vérifie qu'il existe bien un paramètre avec un ID de tirelire
                if (!filter_has_var(INPUT_GET , 'piggybank-id')) 
                {
                    $this->actualPageCode = 1; // Accueil
                    // Pas d'ID de tirelire, on redirige
                    header("Location: " . $this->siteURL);
                }

                // On vérifie que la tirelire appartient bien au User
                $dataBase = DataBase::connect();
                $user = User::createInstance(intval($_SESSION['user-id']));
                $user->setPiggyBanks($dataBase);
                $piggyBanks = $user->getPiggyBanks();
                echo'<pre>';var_dump( $piggyBanks);echo'</pre>';

                $found = false;
                foreach ($piggyBanks as $piggyBank) 
                {
                    if(in_array($_GET['piggybank-id'],$piggyBank))
                    {
                        $found = true;
                    }
                }
                
                // Si la tirelire n'appartient pas au user, on redirige
                if ($found === false) {
                    $this->actualPageCode = 1; // Accueil
                    // Pas d'ID de tirelire, on redirige
                    header("Location: " . $this->siteURL);
                }

                // On peux supprimer la tirelire en toute sécurité
                if(($dataBase->deletePiggyBank(intval($_GET['piggybank-id']))) === false)
                {
                    // Il Y a eu une erreur
                    // TODO : Message d'erreur
                }

                // Tirelire supprimé, Retour à la liste des tirelires
                $this->actualPageCode = 6;  // PiggyBanks
                // TODO : le message ne s'affiche pas ??
                $_SESSION['info-message'] = 'Tirelire supprimée';
                header("Location: ?page=piggybanks");

                return;
            }
            
            if(($_GET['page'] === 'new-movement') AND $logged === true)
            {
                $this->actualPageCode = 9;  // New PiggyBank
                return;
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

    ////////////////////////////////////////

    // getActualPageCode()

    // Retourne $actualPageCode.
    public function getActualPageCode() : int
    {
        return $this->actualPageCode;
    }
}