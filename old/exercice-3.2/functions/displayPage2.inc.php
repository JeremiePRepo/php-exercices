<?php
function displayPage2(){
    echo "name :" . getcwd() . "<br>";
    echo "name :" . dirname(__FILE__) . "<br>";
    echo "name :" . basename(__FILE__, '.inc.php') . "<br>";
    echo "name :" . basename(__DIR__);
    echo "<ul>";
    foreach ($_SERVER as $key => $value) {
        echo "<li><strong>" . $key . "</strong> : " . $value . "</li>";
    }
    echo "</ul>";
}