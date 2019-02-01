<?php

/*\
--------------------------------------------
    User.class.php
--------------------------------------------
    Cette classe représente l'utilisateur

    Patron de conception : singleton.

    Pour instancier la DataBase : 
    User::createInstance(
        intval($_SESSION['user-id']));
--------------------------------------------
\*/

// On utilise le typage strict
declare(strict_types=1);

class User
{

    /*\
     | -------------------------------------
     | Attributs
     | -------------------------------------
    \*/

    
    private static $userInstance = null;// User
    private static $id;                 // int
    private $piggyBanks;                // array
    private $movements;                 // array
    private $email;                     // string
    private $name;                      // string

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

    ////////////////////////////////////////

    // createInstance()

    // Permets d'instancier le uesr
    public static function createInstance(int $id) : User
    {
        // L'utilisateur doit avoir un ID
        self::$id = $id;

        // Si Il n'existe pas déjà de connexion
        if(!self::$userInstance)
        {
            // On instancie par la méthode __construct
            self::$userInstance = new User;   
        }
        return self::$userInstance;
    }
    
    ////////////////////////////////////////

    // setPiggyBanks()

    // Remplis la liste des tirelires
    public function setPiggyBanks(DataBase $dataBase)
    {
        $this->piggyBanks = $dataBase->getPiggyBanksByUserId(self::$id);
    }
    
    ////////////////////////////////////////

    // getPiggyBanks()

    // Remplis la liste des tirelires
    public function getPiggyBanks() : array
    {
        return $this->piggyBanks;
    }
}