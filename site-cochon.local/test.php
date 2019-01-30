<?php

// On charge automatiquement les classes
spl_autoload_register(function ($class) {
    include 'lib/' . $class . '.class.php';
});


WebPage::createInstance()->addAlertMessage('Message test');