<?php

class Connexion
{
    private $adresseBDD = 'mysql:localhost;dbname=test;charset=UTF8';

    public function __construct()
    {
        try {
            $maBDD = new PDO($this->adresseBDD, 'root', 'dadfba16');
            echo 'Je suis connecté à la BDD';
        } catch (PDOException $uneErreur) {
            echo $uneErreur;
        }
    }
}