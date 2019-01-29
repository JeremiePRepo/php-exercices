<?php

/*----------------------------------------*\
    Tout ce qui concerne le dialogue avec 
    la base de données

    La classe est en singleton, il faut 
    utiliser la méthode de classe 
    connexion pour instancier un 
    unique objet DataBase

    Pour faire une requête : 
    $resultat = 
    DataBase::connect()->request();

    Pour instancier un objet, puis faire 
    une requête :
    $objetBDD = DataBase::connect();
    $resultat = $objetBDD->request();
\*----------------------------------------*/

/*\
 | -------------------------------------
 | Global Constants Includes
 | -------------------------------------
\*/

include_once './inc/params.inc.php';

class DataBase
{

    /*\
     | -------------------------------------
     | Attributs
     | -------------------------------------
    \*/

    private static $dataBaseInstance = null;    // Object DataBase
    private $connection;                        // Object PDO

    /*\
     | -------------------------------------
     | Méthodes
     | -------------------------------------
    \*/

    private function __construct()  // En private car singleton
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
            echo DB_CONNECTION_ERROR_MESSAGE . $error;
        }
    }

    /*-------------------------------------*/

    public static function connect() : DataBase
    {
        if(!self::$dataBaseInstance)                // Si Il n'existe pas déjà de connexion
        {
            self::$dataBaseInstance = new DataBase; // On se connecte par la méthode __construct
        }
        return self::$dataBaseInstance; 
    }

    /*-------------------------------------*/

    public function request() : array
    {
        $this->SQLPrepare = $this->connection->prepare('SELECT * FROM user');
        if($this->SQLPrepare)
        {
            if($this->SQLPrepare->execute())
            {
                return $this->SQLPrepare->fetchAll();
            }
            else
            {
                return DB_EXECUTION_ERROR_MESSAGE;
            }
        }
        else
        {
            return DB_PREPARATION_ERROR_MESSAGE;
        }
    }

    /*-------------------------------------*/

    public function fetchUserByEmail($email, $password) //: UserAccount
    {
        $this->DBResponse = $this->connection->prepare('SELECT `id`, `user_name` FROM `user` WHERE `email` LIKE :email AND `password` = :password');
        if($this->DBResponse)
        {
            if($this->DBResponse->execute(array(':email' => $email, ':password' => $password)))
            {
                return $this->DBResponse->fetchAll();
            }
            else
            {
                return  DB_EXECUTION_ERROR_MESSAGE;
            }
        }
        else
        {
            return DB_PREPARATION_ERROR_MESSAGE;
        }
    }

    /*-------------------------------------*/

    public function checkEmailAlreadyExists(string $email) : int
    {
        $this->DBResponse = $this->connection->prepare('SELECT `id` FROM `user` WHERE `email` LIKE ?');
        if($this->DBResponse)
        {
            if($this->DBResponse->execute(array($email)))
            {
                if(!empty($this->DBResponse->fetchAll()))   // TODO : Améliorer FetchAll : éviter les doublons
                {
                    return 1;    // L'email existe déjà en BDD
                }
                else
                {
                    return 2;   // L'email n'existe pas en BDD
                }
            }
            else
            {
                return  3;      // DB_EXECUTION_ERROR_MESSAGE
            }
        }
        else
        {
            return 4;           // DB_PREPARATION_ERROR_MESSAGE
        }
    }

    /*-------------------------------------*/
    
    /*
     * Fonction de création d'un utilisateur dans la base
     * 
     * En cas de tentative de création d'un login déjà existant
     *  - Lance une CreationUtilisateurException
     * Redirige vers une page d'erreur en cas de problème d'accès à la base
     */
    public function creationUtilisateur(string $login, string $motDePasse)
    {
        try {
            $requete = $this->base->prepare("INSERT INTO " . self::TABLE_UTILISATEUR . "(" . 
                                            self::CHAMPS_LOGIN . ", " . self::CHAMPS_MOT_DE_PASSE . 
                                            ") VALUES (:login, :mdp)");
        }
        catch (PDOException $erreur) {
            // Traitement d'erreur minimaliste
            // Redirection vers une page d'erreur
            header("Location: erreur.html");
            exit();
        }
        if (!$requete->bindValue(":login",$login, PDO::PARAM_STR) ||
            !$requete->bindValue(":mdp",password_hash($motDePasse, PASSWORD_DEFAULT), PDO::PARAM_STR)) {
            // Traitement d'erreur minimaliste
            // Redirection vers une page d'erreur
            header("Location: erreur.html");
            exit();
        }
        if (!$requete->execute()) {
            // Si le login est déjà dans la base
            if ($requete->errorInfo()[0] === '23000') {
                throw new CreationUtilisateurException(CreationUtilisateurException::LOGIN_DEJA_UTILISE);
            }
            else {
                // Traitement d'erreur minimaliste
                // Redirection vers une page d'erreur
                header("Location: erreur.html");
                exit();
            }
        }
        if ($requete->closeCursor() === false) {
            // TODO : Journaliser l'erreur
        }
    }
}