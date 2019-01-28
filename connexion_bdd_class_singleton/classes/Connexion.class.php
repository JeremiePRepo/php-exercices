<?php

class Connexion
{
    const ADRESSE_BDD = 'mysql:localhost;dbname=test;charset=UTF8';
    private static $isInstantiated = null;

    public static function instanceConnexion()
    {
        if(!self::$isInstantiated)
        {
            self::$isInstantiated = new Connexion;
        } else 
        {
            echo 'Je ne suis pas créé, il existe déjà une instance de Connexion.<br>';
        }
    }

    private function __construct()
    {
        try {
            $maBDD = new PDO(self::ADRESSE_BDD, 'root', 'dadfba16');
            echo 'Je suis connecté à la BDD';
        } catch (PDOException $uneErreur) {
            echo $uneErreur;
        }
    }
}

// class Singleton
// {
//     private static $isInstantiated = null;

//     public static function instanceOf(){
//         if(!self::$isInstantiated)
//         {
//             new Singleton;
//             self::$isInstantiated = true;
//         } else {
//             echo 'Je ne suis pas créé, il existe déjà une instance de Singleton.<br>';
//         }
//     }

//     private function __construct()
//     {
//         echo 'je suis créé<br>';
//     }
// }