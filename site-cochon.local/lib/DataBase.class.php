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
    private $connection;                       

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
            $this->connection = new PDO(DB_TYPE     . 
                                        ':host='    . DB_HOST . 
                                        ';dbname='  . DB_NAME . 
                                        ';charset=' . DB_CHAR, 
                                        DB_USER, 
                                        DB_PASS);
        }
        catch (PDOException $error)
        {
            // On envoie le message d'erreur dans la section alerte de la page Web
            WebPage::createInstance()->addAlertMessage(DB_CONNECTION_ERROR_MESSAGE . $error);
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
            $DBResponse = $this->connection->prepare('  SELECT COUNT(1) 
                                                        FROM DB_USER_TABLE 
                                                        WHERE DB_USER_EMAIL_FIELD 
                                                        LIKE ?');
        }
        catch (PDOException $error)
        {
            // On envoie le message d'erreur dans la section alerte de la page Web
            WebPage::createInstance()->addAlertMessage($error->getMessage());
            exit;
        }
        if($DBResponse === false)
        {
            // On envoie le message d'erreur dans la section alerte de la page Web
            WebPage::createInstance()->addAlertMessage($this->connection->errorInfo()[2]);
            exit;
        }
        if ($DBResponse->bindValue(1,$email,PDO::PARAM_STR) === false) {
            // On envoie le message d'erreur dans la section alerte de la page Web
            WebPage::createInstance()->addAlertMessage($DBResponse->errorInfo()[2]);
            exit;
        } 
        if($DBResponse->execute() === false)
        {
            // On envoie le message d'erreur dans la section alerte de la page Web
            WebPage::createInstance()->addAlertMessage($this->connection->errorInfo()[2]);
            exit;
        }
        // La requete s'est bien effectuée
        var_dump($DBResponse->fetch());
    }
}