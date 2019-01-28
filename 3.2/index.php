<?php

/*----------------------------------------*\
    Includes
\*----------------------------------------*/

include '../includes/parts.inc.php';
include '../includes/functions.inc.php';



/*----------------------------------------*\
    Constants
\*----------------------------------------*/

define('TITLE', 'Informations techniques');



/*----------------------------------------*\
    Page Functions
\*----------------------------------------*/

function displayPageContent(){
    $output = '<p>Voici les infos techniques données par la variable superglobale $_SERVER :</p><pre><code><ul>';
    foreach ($_SERVER as $key => $value) {
        $output .= '<li><strong>' . $key . '</strong> : ' . $value . '</li>';
    }
    $output .= '</ul></code></pre>';
    return $output;
}



/*----------------------------------------*\
    App Start
\*----------------------------------------*/

echo (buildPage());