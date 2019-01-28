<?php

$adresseBDD = 'mysql:localhost;dbname=test;charset=UTF8';

try {
    $maBDD = new PDO($adresseBDD, 'root', 'dadfba16');
    echo 'Je suis connecté à la BDD';
} catch (PDOException $uneErreur) {
    echo '$uneErreur';
}