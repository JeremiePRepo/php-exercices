<?php

class Connexion
{
    const ADRESSE_BDD = 'mysql:host=localhost;dbname=blog;charset=UTF8';
    private static $isInstantiated = null;
    private $maBDD; // Object
    private $requete = 'SELECT * FROM articles';

    public static function instanceConnexion()
    {
        if(!self::$isInstantiated)
        {
            self::$isInstantiated = new Connexion; 
        } 
        return self::$isInstantiated;
    }

    private function __construct()
    {
        try 
        {
            $this->maBDD = new PDO(self::ADRESSE_BDD, 'blogapp', 'aaaa');
            echo 'Je suis connecté à la BDD<br>';
        } catch (PDOException $uneErreur) 
        {
            echo 'Erreur de connexion : ' . $uneErreur;
        }
    }

    public function faireUneRequeteQuery()
    {
        $this->resultats = $this->maBDD->query($this->requete);
        return $this->resultats;
    }

    public function faireUneRequetePrepare()
    {
        // On prépare la requête, retourne un booleen
        $this->SQLPrepare = $this->maBDD->prepare($this->requete);

        // Si la requête est bien préparé, on l'exécute
        if($this->SQLPrepare)
        {
            // Si la requête est exécutable, on récupre la valeur
            if($this->SQLPrepare->execute())
            {
                // Penser à checker les paramètres fetchAll
                $this->result = $this->SQLPrepare->fetchAll();
                return $this->result;
            } 
            else
            {
                // On envoie un message d'erreur execution failed
            }
        }
        else
        {
            // On envoie un message d'erreur preparation failed
        }
    }
}

