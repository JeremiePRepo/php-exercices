<?php

require_once 'classes/Connexion.class.php';

$objetBDD = Connexion::instanceConnexion();





// var_dump($objetBDD);

$resultats = $objetBDD->faireUneRequeteQuery();

foreach ($resultats as $value) {
    echo'<pre>';
    var_dump($value);
    echo'</pre>';
}





echo '-----------------------------';

$resultatsPrepare = $objetBDD->faireUneRequetePrepare();

foreach ($resultatsPrepare as $value) {
    echo'<pre>';
    var_dump($value);
    echo'</pre>';
}
