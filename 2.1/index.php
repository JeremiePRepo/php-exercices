<?php

/*----------------------------------------*\
    Includes
\*----------------------------------------*/

include '../includes/parts.inc.php';
include '../includes/functions.inc.php';



/*----------------------------------------*\
    Constants
\*----------------------------------------*/

define('TITLE', 'Hello World');
define ('CONTENT','<p>Ça veux dire bonjour.</p>');



/*----------------------------------------*\
    Page Functions
\*----------------------------------------*/

function displayPageContent(){
    $output = '<p>Ça veux dire bonjour.</p>';
    return $output;
}



/*----------------------------------------*\
    App Start
\*----------------------------------------*/

echo (buildPage());