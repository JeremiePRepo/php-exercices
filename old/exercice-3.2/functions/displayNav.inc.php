<?php
function displayNav(){
    echo "<nav class=\"header-nav\">" . PHP_EOL ;
    echo "    <button type=\"button\" class=\"header-nav-btn\"><i class=\"fas fa-bars\"></i> Menu</button>" . PHP_EOL ;
    echo "    <ul class=\"header-nav-content is-close\">" . PHP_EOL ;
    echo "        <li";
    if ($_SERVER['PHP_SELF'] == "/exercice-3.2/index.php") { echo " class=\"current\""; }
    echo "><a href=\"/exercice-3.2\">Accueil</a></li>" . PHP_EOL ;
    echo "        <li";
    if ($_SERVER['PHP_SELF'] == "/exercice-3.2/page-2.php") { echo " class=\"current\""; }
    echo "><a href=\"/exercice-3.2/page-2.php\">Server Informations</a></li>" . PHP_EOL ;
    echo "        <li";
    if ($_SERVER['PHP_SELF'] == "/exercice-3.2/page-3.php") { echo " class=\"current\""; }
    echo "><a href=\"/exercice-3.2/page-3.php\">Converter</a></li>" . PHP_EOL ;
    echo "    </ul>" . PHP_EOL ;
    echo "</nav>" . PHP_EOL ;
}