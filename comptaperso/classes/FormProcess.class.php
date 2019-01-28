<?php

/*----------------------------------------*\
    Cette classe sert à vérifier si un 
    formulaire à été rempli, et à le 
    traiter.

    Traiter un formulaire à l'extérieur de 
    la classe :
    $formProcesser=FormProcess::process();
    $formProcesser->processLogIn();
\*----------------------------------------*/

class FormProcess
{

    /*\
     | -------------------------------------
     | Attributs
     | -------------------------------------
    \*/

    private static $formProcessInstance = null; // Object FormProcess
    
    /*\
     | -------------------------------------
     | Méthodes
     | -------------------------------------
    \*/

    private function construct()
    {

    }

    /*-------------------------------------*/

    public function process() : FormProcess
    {
        if(!self::$formProcessInstance)                     // Si Il n'existe pas déjà d'instance
        {
            self::$formProcessInstance = new FormProcess;   // On instancie par la méthode __construct
        }
        return self::$formProcessInstance;
    }

    /*-------------------------------------*/

    public function processLogIn() //: bool
    {
        if (filter_has_var(INPUT_POST , 'email') AND 
            filter_has_var(INPUT_POST , 'password'))   // Le formulaire a-t-il été remplis ?
        {
            $this->user = DataBase::connect()->fetchUserByEmail($_POST['email'], $_POST['password']);

            echo '<pre>';
            var_dump($this->user);
            echo '</pre>';
        }
        else
        {
            return false;
        }
    }

    /*-------------------------------------*/

    public function processSignUp() //: bool
    {
        if (filter_has_var(INPUT_POST , 'signup-name') AND 
            filter_has_var(INPUT_POST , 'signup-email') AND
            filter_has_var(INPUT_POST , 'signup-password-1') AND
            filter_has_var(INPUT_POST , 'signup-password-2'))   // Le formulaire a-t-il été remplis ?
        {
            // Vérifier l'intégrité du mail
            // Et vérifier la correspondance des MDP
            if ((filter_var($_POST['signup-email'], FILTER_VALIDATE_EMAIL)) AND 
                ($_POST['signup-password-1'] === $_POST['signup-password-2'])) 
            {
                // Vérifier que l'email n'existe pas déjà 
                if(DataBase::connect()->checkEmailAlreadyExists($_POST['signup-email']))
                {
                    echo 'L\'email existe déjà';
                    // TODO : Envoyer un message d'alerte à Webpage.class
                }
                else
                {
                    echo 'L\'email n\'existe pas, bravo';
                    // Envoyer les données en BDD
                }
                switch (DataBase::connect()->checkEmailAlreadyExists($_POST['signup-email'])) {

                    case 1:
                        echo 'L\'email existe déjà';
                        // TODO : Envoyer un message d'alerte à Webpage.class
                        break;

                    case 2:
                        echo 'L\'email n\'existe pas, bravo';
                        // Envoyer les données en BDD
                        break;
                    
                    case 3:
                        echo DB_EXECUTION_ERROR_MESSAGE;
                        // TODO : Envoyer un message d'alerte à Webpage.class
                        break;
                    
                    case 4:
                        echo DB_PREPARATION_ERROR_MESSAGE;
                        // TODO : Envoyer un message d'alerte à Webpage.class
                        break;
                    
                    default:
                        echo 'Erreur inconnue dans le test d\'existance du mails';
                        // TODO : Envoyer un message d'alerte à Webpage.class
                        break;
                }
            }
            else
            {
                echo 'L\'email est invalide ou les mdp ne correspondent pas';
                // TODO : Envoyer un message d'alerte à Webpage.class
            }
        }
        else
        {
            return false;
        }
    }

}