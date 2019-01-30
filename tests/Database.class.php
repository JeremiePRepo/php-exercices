<?php

/*\
--------------------------------------------
    DataBase.class.php
--------------------------------------------
    Cette classe est destinée à traiter 
    toutes les requêtes en base de donnée. 
    S'il y a du SQL, c'est ici que ça se 
    passe.

    Patron de conception : singleton.

    Pour instancier la DataBase : 
    DataBase::connect();

    Pour utiliser une méthode :
    DataBase::connect()->checkEmail('email');
--------------------------------------------
\*/

// On utilise le typage strict
declare(strict_types=1);

// On inclu les constantes nécessaires au fonctionnement de la classe
include_once './params.inc.php';

class DataBase
{

    /*\
     | -------------------------------------
     | Attributs
     | -------------------------------------
    \*/

    // DataBase
    private static $dataBaseInstance = null; 

    // Object PDO
    private $connectionPDO;                       

    /*\
     | -------------------------------------
     | Méthodes
     | -------------------------------------
    \*/

    // __construct()

    // En private car singleton
    private function __construct()
    {
        try 
        {
            $this->connectionPDO = new PDO(DB_TYPE     . 
                                        ':host='    . DB_HOST . 
                                        ';dbname='  . DB_NAME . 
                                        ';charset=' . DB_CHAR, 
                                        DB_USER, 
                                        DB_PASS);
        }
        catch (PDOException $error)
        {
            // On envoie le message d'erreur dans la section alerte de la page Web
            // WebPage::createInstance()->addAlertMessage(DB_connectionPDO_ERROR_MESSAGE . $error);
            echo '<pre>'.$error.'</pre>';
        }
    }

    /*------------------------------------*/

    // createInstance()

    // Permets d'instancier la page
    public static function connect() : DataBase
    {
        // Si Il n'existe pas déjà de connexion
        if(!self::$dataBaseInstance)                 
        {
            // On instancie par la méthode __construct
            self::$dataBaseInstance = new DataBase;   
        }
        return self::$dataBaseInstance; 
    }

    /*------------------------------------*/

    // checkEmail()

    // Retourne true ou false si l'email existe ou non dans la base
    public function checkEmail(string $email) //: bool
    {
        try
        {
            $PDOStatement = $this->connectionPDO->prepare('  SELECT COUNT(1) 
                                                        FROM '.DB_USER_TABLE.'
                                                        WHERE '.DB_USER_EMAIL_FIELD.'
                                                        LIKE :email');
        }
        catch (PDOException $error)
        {
            // On envoie le message d'erreur dans la section alerte de la page Web
            // WebPage::createInstance()->addAlertMessage($error->getMessage());
            echo '<pre>ERR Prepare : '.$error.'</pre>';
            exit;
        }
        if($PDOStatement === false)
        {
            // On envoie le message d'erreur dans la section alerte de la page Web
            // WebPage::createInstance()->addAlertMessage($this->connectionPDO->errorInfo()[2]);
            echo '<pre>ERR Response : '.$this->connectionPDO->errorInfo()[2].'</pre>';
            exit;
        }
        if ($PDOStatement->bindValue(':email',$email,PDO::PARAM_STR) === false) {
            // On envoie le message d'erreur dans la section alerte de la page Web
            // WebPage::createInstance()->addAlertMessage($PDOStatement->errorInfo()[2]);
            echo '<pre>ERR bindvalues : '.$PDOStatement->errorInfo()[2].'</pre>';
            exit;
        } 
        if($PDOStatement->execute() === false)
        {
            // On envoie le message d'erreur dans la section alerte de la page Web
            // WebPage::createInstance()->addAlertMessage($this->connectionPDO->errorInfo()[2]);
            echo '<pre>ERR Execute : '.$this->connectionPDO->errorInfo()[2].$PDOStatement->debugDumpParams().'</pre>';
            exit;
        }
        // La requete s'est bien effectuée
        $response = $PDOStatement->fetch(PDO::FETCH_NUM);
        echo $response[0];
    }
}