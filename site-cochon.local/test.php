<?php

// On inclu les constantes nécessaires au fonctionnement de la classe
include_once './params.inc.php';

// On charge automatiquement les classes
spl_autoload_register(function ($class) {
    include 'lib/' . $class . '.class.php';
});



// WebPage::createInstance()->setPageContent(DataBase::connect()->checkEmail('email'));
// DataBase::connect()->checkEmail('email');






// $connection; 

// try 
// {
//     $connection = new PDO(DB_TYPE     . 
//                                 ':host='    . DB_HOST . 
//                                 ';dbname='  . DB_NAME . 
//                                 ';charset=' . DB_CHAR, 
//                                 DB_USER, 
//                                 DB_PASS);
// }
// catch (PDOException $error)
// {
//     // On envoie le message d'erreur dans la section alerte de la page Web
//     WebPage::createInstance()->addAlertMessage(DB_CONNECTION_ERROR_MESSAGE . $error);
// }

// try
// {
//     $DBResponse = $connection->prepare('  SELECT COUNT(1) 
//                                                 FROM DB_USER_TABLE 
//                                                 WHERE DB_USER_EMAIL_FIELD 
//                                                 LIKE ?');
// }
// catch (PDOException $error)
// {
//     // On envoie le message d'erreur dans la section alerte de la page Web
//     WebPage::createInstance()->addAlertMessage($error->getMessage());
//     exit;
// }
// if($DBResponse === false)
// {
//     // On envoie le message d'erreur dans la section alerte de la page Web
//     WebPage::createInstance()->addAlertMessage($connection->errorInfo()[2]);
//     exit;
// }
// if ($DBResponse->bindValue(1,'coucou',PDO::PARAM_STR) === false) {
//     // On envoie le message d'erreur dans la section alerte de la page Web
//     WebPage::createInstance()->addAlertMessage($DBResponse->errorInfo()[2]);
//     exit;
// } 
// if($DBResponse->execute() === false)
// {
//     // On envoie le message d'erreur dans la section alerte de la page Web
//     WebPage::createInstance()->addAlertMessage($connection->errorInfo()[2]);
//     exit;
// }
// // La requete s'est bien effectuée
// var_dump($DBResponse->fetch());






DataBase::connect();