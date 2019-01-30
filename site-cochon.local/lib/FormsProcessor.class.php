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

    // WebPage
    private static $formsProcessorInstance = null; 

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
        // On traite le formulaire de login si remplis
        $this->loginForm();
    }

    /*------------------------------------*/

    // createInstance()

    // Permets d'instancier la page
    public static function processAll() : FormsProcessor
    {
        // Si Il n'existe pas déjà de connexion
        if(!self::$formsProcessorInstance)                 
        {
            // On instancie par la méthode __construct
            self::$formsProcessorInstance = new FormsProcessor;   
        }
        return self::$formsProcessorInstance; 
    }

    /*------------------------------------*/

    // loginForm()

    // Traite la première partie du formulaire d'inscription
    public function loginForm()
    {
        // Le formulaire d'inscription a-t-il été remplis ?
        if( !filter_has_var(INPUT_POST , 'login-email') OR
            !filter_has_var(INPUT_POST , 'login-pass'))
        {
            // Le formulaire de login n'a pas été rempli.
            return;
        }

        // Le formulaire de login a été rempli
        $email = $_POST['login-email'];
        $password = $_POST['login-pass'];

        // L'email est-il valide ?
        if(!(filter_var($email, FILTER_VALIDATE_EMAIL)))
        {
            // L'email est invalide
            WebPage::createInstance()->addAlertMessage(self::FORM_ERROR_INVALID_EMAIL);
            return;
        }

        // L'email extste-t-il ? oui === 1, non === 0, erreur === [2,3,4 ou 5]
        $existence = DataBase::connect()->checkEmail($_POST['login-email']);

        if($existence === 1)
        {
            // L'email existe déja

            // On vérifie le password
        }

        if($existence === 0)
        {
            // L'email n'existe pas
    
            // On demande l'affichage du formulaire de création de compte
        }
        // Il y a eu une erreur, on reste sur la page Login
        // TODO : renvoyer une alerte demandant de contacter l'admin 
    }
}