<?php

// $adresseBDD = 'mysql:localhost;dbname=test;charset=UTF8';

// try {
//     $maBDD = new PDO($adresseBDD, 'root', 'dadfba16');
//     echo 'Je suis connecté à la BDD';
// } catch (PDOException $uneErreur) {
//     echo '$uneErreur';
// }


require_once 'classes/Connexion.class.php';

$BDDConnect = new Connexion;


// include_once 'classes/Singleton.class.php';

// Singleton::instanceOf();
// Singleton::instanceOf();

// $test = new Singleton;
