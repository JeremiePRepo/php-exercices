<?php
// On utilise le typage strict
declare(strict_types=1);

/*
 * Classe d'exception servant à représenter les erreurs sur les entrées dans les formulaires de connexion
 */

class LoginException extends Exception
{
    // Constantes
    // Définition des codes d'erreur
    const LOGIN_TROP_LONG = 1;
    const MOT_DE_PASSE_TROP_LONG = 2;
    const INFORMATIONS_INCORRECTES = 3;
    
    // Méthode
    /*
     * On redéfini le constructeur pour ne pas avoir à rentrer les messages d'erreur
     */
    public function __construct(int $code)
    {
        switch ($code) {
            case self::LOGIN_TROP_LONG:
                parent::__construct("Login trop long", $code);
                break;
            case self::MOT_DE_PASSE_TROP_LONG:
                parent::__construct("Mot de passe trop long",$code);
                break;
            case self::INFORMATIONS_INCORRECTES:
                parent::__construct("Login ou mot de passe incorrect",$code);
                break;
            default:
                parent::__construct("Erreur inattendue",$code);
                break;
        }      
    }
}
