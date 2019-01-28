<?php
function callDisplay($section){
    require_once "display" . $section . ".inc.php";
    return call_user_func('display' . $section);
}