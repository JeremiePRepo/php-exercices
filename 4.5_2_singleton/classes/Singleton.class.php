<?php

class Singleton
{
    private static $isInstantiated = null;

    public static function instanceOf(){
        if(!self::$isInstantiated)
        {
            new Singleton;
            self::$isInstantiated = true;
        } else {
            echo 'Je ne suis pas créé, il existe déjà une instance de Singleton.<br>';
        }
    }

    private function __construct()
    {
        echo 'je suis créé<br>';
    }
}