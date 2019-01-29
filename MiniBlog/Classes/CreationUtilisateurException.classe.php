<?php
// On utilise le typage strict
declare(strict_types=1);

/*
 * Classe d'exception servant à représenter les erreurs sur les entrées dans les formulaires de création d'utilisateur
 */

class CreationUtilisateurException extends Exception
{
    // Constantes
    // Définition des codes d'erreur
    const LOGIN_TROP_LONG = 1;
    const MOT_DE_PASSE_TROP_LONG = 2;
    const LOGIN_DEJA_UTILISE = 3;
    
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
            case self::LOGIN_DEJA_UTILISE:
                parent::__construct("Ce login est déjà utilisé",$code);
                break;
            default:
                parent::__construct("Erreur inattendue",$code);
                break;
        }      
    }
}
