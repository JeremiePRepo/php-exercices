<?php

/*----------------------------------------*\
    Includes
\*----------------------------------------*/

include 'includes/parts.inc.php';
include 'includes/functions.inc.php';



/*----------------------------------------*\
    Constants
\*----------------------------------------*/

define('TITLE', 'Accueil');
define ('CONTENT','<p>Choisissez votre exercice.</p>');



/*----------------------------------------*\
Page Functions
\*----------------------------------------*/

function displayPageContent(){
$output = '<p>Choisissez votre exercice.</p>';
return $output;
}



/*----------------------------------------*\
    App Start
\*----------------------------------------*/

echo (buildPage());