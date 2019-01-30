<?php

/*\
--------------------------------------------
    params.php
--------------------------------------------
    Ce fichier rassemble toutes les options 
    de configuration pour paramétrer 
    l'installation du site
--------------------------------------------
\*/

/*----------------------------------------*\
    Website Infos
\*----------------------------------------*/

define ('SITE_TITLE', 'Site cochon');
define ('SITE_LANG', 'fr');
define ('SITE_STYLES', array(   '<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">',
                                '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css" type="text/css">',
                                '<link rel="stylesheet" href="https://unpkg.com/sakura.css/css/sakura-dark.css" type="text/css">',
                                '<link rel="stylesheet" href="public/css/style.css" type="text/css">'));

/*----------------------------------------*\
    DB infos
\*----------------------------------------*/

// Informations de connexion
define ('DB_TYPE', 'mysql');
define ('DB_HOST', 'localhost');
define ('DB_NAME', 'comptaperso.local');
define ('DB_CHAR', 'UTF8');
define ('DB_USER', 'root');
define ('DB_PASS', 'dadfba16');

// Noms des tables et champs
define ('DB_USER_TABLE',        'user');
define ('DB_USER_ID_FIELD',     'id');
define ('DB_USER_EMAIL_FIELD',  'email');
define ('DB_USER_PASS_FIELD',   'password');
define ('DB_USER_NAME_FIELD',   'user_name');

define ('DB_BANK_TABLE',        'bank_account');
define ('DB_BANK_ID_FIELD',     'id');
define ('DB_BANK_NAME_FIELD',   'name');
define ('DB_BANK_PK_USER_FIELD','pk_user');

// Messages d'erreur
define ('DB_CONNECTION_ERROR_MESSAGE',  'Erreur de connexion : ');
define ('DB_PREPARATION_ERROR_MESSAGE', 'Erreur dans la préparation de la requête SQL');
define ('DB_EXECUTION_ERROR_MESSAGE',   'Erreur dans l\'éxécution de la requête SQL');