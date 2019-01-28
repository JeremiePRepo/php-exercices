<?php

/*----------------------------------------*\
    Functions
\*----------------------------------------*/

function buildPage(){
    $output =   HEAD_START .
                TITLE .
                HEAD_END .
                '<h1>' . TITLE . '</h1>' .
                NAV .
                displayPageContent() .
                BODY_END;
    return $output;
}