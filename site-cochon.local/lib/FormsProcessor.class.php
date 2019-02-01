<?php

/*\
--------------------------------------------
    FormsProcessor.class.php
--------------------------------------------
    Cette classe est destinée à traiter tous 
    les formulaire. Le mieux est de 
    l'instancier assez tôt, en début de 
    script.

    Patron de conception : singleton.

    Pour instancier la WebPage : 
    FormsProcessor::processAll();
--------------------------------------------
\*/

// On utilise le typage strict
declare(strict_types=1);

class FormsProcessor
{

    /*\
     | -------------------------------------
     | Attributs
     | -------------------------------------
    \*/

    
    private static $formsProcessorInstance = null;  // WebPage
    private static $dataBase;                       // DataBase
    private static $actualPageCode;                 // int
    private static $actualPageDatas = array();      // array
    private $infoMessage = '';                      // string

    // Error Messages
    const FORM_ERROR_INVALID_EMAIL = 'Email invalide, merci de recommencer';

    /*\
     | -------------------------------------
     | Méthodes
     | -------------------------------------
    \*/

    // __construct()

    // En private car singleton
    private function __construct()
    {
        
        // On traite le formulaire d'inscription
        // $message = $this->signUp();

        switch (self::$actualPageCode) {
            
            case 3:
                // Page Loggin, on traite le formulaire de login
                $this->infoMessage = $this->loginForm();
                break;

            case 4:
                // Page inscription, on traite le formulaire signup
                $this->infoMessage = $this->signUp();
                break;

            case 7:
                // Ajout de tirelire
                $this->infoMessage = $this->addPiggyBank();
                break;
            
            default:
                break;
        }

    }

    ////////////////////////////////////////

    // getInfomessage()

    // Getter pour $infoMessage
    public function getInfoMessage() : string
    {
        return $this->infoMessage;
    }

    ////////////////////////////////////////

    // getActualPageDatas()

    // Getter pour $actualPageDatas
    public function getActualPageDatas() : array
    {
        return self::$actualPageDatas;
    }

    ////////////////////////////////////////

    // processAll()

    // Permets d'instancier la page
    public static function processAll(DataBase $dataBase, int $actualPageCode) : FormsProcessor
    {
        // FormProcessor aura besoin du code de la page pour savoir quel formulaire traiter
        self::$actualPageCode = $actualPageCode;

        // La classe aura besoin d'une connexion BDD
        self::$dataBase = $dataBase;

        // Si Il n'existe pas déjà une instance de FormProcessor
        if(!self::$formsProcessorInstance)                 
        {
            // On instancie par la méthode __construct
            self::$formsProcessorInstance = new FormsProcessor;   
        }
        return self::$formsProcessorInstance; 
    }

    ////////////////////////////////////////

    // loginForm()

    // Traite la première partie du formulaire de login/inscription
    public function loginForm() : string
    {
        // Si l'utilisateur est loggé, on l'envoie en page principale
        // TODO : Créer une méthode pour tester si loggé
        if(isset($_SESSION['logged']) === true)
        {
            $host  = $_SERVER['HTTP_HOST'];
            $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            header("Location: http://$host$uri/");
        }

        // Le formulaire d'inscription a-t-il été remplis ?
        if( !filter_has_var(INPUT_POST , 'login-email') OR
            !filter_has_var(INPUT_POST , 'login-pass'))
        {
            // Le formulaire de login n'a pas été rempli.
            return '';
        }

        // Le formulaire de login a été rempli
        $email = $_POST['login-email'];
        $password = $_POST['login-pass'];

        // L'email est-il valide ?
        if(!(filter_var($email, FILTER_VALIDATE_EMAIL)))
        {
            // L'email est invalide
            return self::FORM_ERROR_INVALID_EMAIL;
        }
        
        // L'email extste-t-il ? oui === 1, non === 0, erreur === [2,3,4 ou 5]
        switch (self::$dataBase->checkEmail($_POST['login-email'])) {
            case 1:
                // L'email existe déja

                // On vérifie le password
                // TODO
                break;
            
            case 0:
                // L'email n'existe pas
        
                // On enregistre les infos passés dans les variables de session
                $_SESSION['login-mail'] = $email;
                $_SESSION['login-pass'] = $password;
                
                // On demande l'affichage du formulaire de création de compte
                header("Location: ?page=signup");
                break;
            
            default:
                // Il y a eu une erreur, on reste sur la page Login
                // TODO : renvoyer une alerte demandant de contacter l'admin 
                return 'Erreur. Ben ouai.';
        }

        // L'email existe déjà, on vérifie le mot de passe
        if(password_verify($password, self::$dataBase->getPassHashByEmail($email)[0]) === false)
        {
            return 'Mauvais mot de passe';
        }

        // Les mots de passes correspondent
        $_SESSION['logged'] = true;
        $_SESSION['user-id'] = self::$dataBase->getUserIdByEmail($_POST['login-email']);

        // On redirige vers la page principale
        header("Location: " . Router::createInstance()->getSiteURL());
    }

    ////////////////////////////////////////

    // signUp()

    // Traite la deuxième partie du formulaire d'inscription
    public function signUp() : string
    {        
        // On vérifie que l'utilisateur viens de la page login
        if( (isset($_SESSION['login-mail'], $_SESSION['login-pass']) === false))
        {
            // L'utilisateur ne viens pas du formulaire de login, on le redirige
            header("Location: ?page=login");
        }

        // L'objet WebPage aura besoin de d'nfos
        self::$actualPageDatas = array( 'login-mail' => $_SESSION['login-mail'],
                                        'login-pass' => $_SESSION['login-pass']);

        // Les variables de session ne sont maintenant plus utiles, on les détruits
        // TODO : vvv mettre à la fin du traitement et en page login vvv
        // TODO : où créer un classe Session
        // unset($_SESSION['login-mail']);
        // unset($_SESSION['login-pass']);
        // TODO : ^^^ mettre à la fin du traitement et en page login ^^^

        // Le formulaire d'inscription a-t-il été remplis ?
        if( !filter_has_var(INPUT_POST , 'signup-email') OR
            !filter_has_var(INPUT_POST , 'signup-name')  OR
            !filter_has_var(INPUT_POST , 'signup-pass')  OR
            !filter_has_var(INPUT_POST , 'signup-pass-confirm'))
        {
            // Le formulaire d'inscription n'a pas encore été rempli.
            return 'E-mail inconnu, voulez-vous créer un compte ?';
        }

        // L'utilisateur a rempli le formulaire d'inscription, on le traite

        // L'email extste-t-il ? oui === 1, non === 0, erreur === [2,3,4 ou 5]
        switch (self::$dataBase->checkEmail($_POST['signup-email'])) {
            case 1:
                // L'email existe déja. On redirige vers le login en le signalant.
                // TODO : Transmettre le message : "Email déjà existant, voulez-vous vous connecter ?"
                // TODO : Transmettre l'email pour pré-remplir le formulaire de login.
                header("Location: ?page=login");
                break;

            case 0:                
                // On vérifie si les mots de passe correspondent
                if($_POST['signup-pass'] !== $_POST['signup-pass-confirm'])
                {
                    // les mots de passe ne correspondent pas, 
                    // On enregistre le name en session avant de recharger la page
                    // TODO : Trouver où la détruire
                    $_SESSION['signup-name'] = $_POST['signup-name'];
                    // on alerte l'utilisateur.
                    return 'Les mots de passes ne correspondent pas.';
                }
                break;
            
            default:
                return 'Erreur de base de donnée';
                break;
        }

        // Tout à l'aire bien remplis, on enregistre l'utilisateur en base
        if((self::$dataBase->createNewUser($_POST['signup-email'], $_POST['signup-name'], password_hash($_POST['signup-pass'], PASSWORD_DEFAULT))) === false)
        {
            return 'Problème lors de l\'enregistrement';
        }

        // La création du nouvel utilisateur s'est bien déroulé
        $_SESSION['user-id'] = self::$dataBase->getUserIdByEmail($_POST['signup-email']);
        $_SESSION['logged'] = true;

        // On redirige vers la page principale
        header("Location: " . Router::createInstance()->getSiteURL());
    }

    ////////////////////////////////////////

    // addPiggyBank()

    // Ajoute une tirelire
    public function addPiggyBank() : string
    {
        if( !filter_has_var(INPUT_POST , 'piggybank-name') OR
            !filter_has_var(INPUT_POST , 'piggybank-start-amount'))
        {
            // Le formulaire n'a pas été rempli
            return '';
        }

        $name   = $_POST['piggybank-name'];
        $amount = $_POST['piggybank-start-amount'];
        $userID = intval($_SESSION['user-id']);

        // TODO : ajouter le montant initial

        // Ajout en BDD
        if((self::$dataBase->addPiggyBank($userID, $name)) === false)
        {
            return 'Problème lors de l\'enregistrement';
        }

        // On prépare un petit message de réussite
        $_SESSION['info-message'] = 'Nouvelle tirelire créée';

        // On redirige vers la liste des tirelires
        header("Location: ?page=piggybanks");
    }
}