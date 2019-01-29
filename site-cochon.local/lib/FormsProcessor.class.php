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
    FormsProcessor::createInstance();
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

    /*\
     | -------------------------------------
     | Méthodes
     | -------------------------------------
    \*/

    // __construct()

    // En private car singleton
    private function __construct()
    {
    }

    /*------------------------------------*/

    // createInstance()

    // Permets d'instancier la page
    public static function createInstance() : FormsProcessor
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

    // allForms()

    // Lance tous les traitement de formulaires
    public function allForms()
    {
        $this->loginForm();
    }

    /*------------------------------------*/

    // loginForm()

    // Traite la première partie du formulaire d'inscription
    public function loginForm()
    {
        // Le formulaire d'inscription a-t-il été remplis ?
        if( filter_has_var(INPUT_POST , 'login-email') AND
            filter_has_var(INPUT_POST , 'login-pass'))
        {
            // L'email extste-t-il ?
            if(DataBase::connect()->checkEmail($_POST['login-email']))
            {
                echo 'l\'email existe déjà';
            }
        }
    }
}