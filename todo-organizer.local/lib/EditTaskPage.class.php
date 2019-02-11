<?php

/*\
--------------------------------------------
EditTaskPage.class.php
--------------------------------------------
Cette classe est destinée à afficher la
page Web. Si une méthode doit renvoyer
du HTML, elle se trouvera sûrement ici.

Patron de conception : singleton.
--------------------------------------------
\*/

// On utilise le typage strict
declare (strict_types = 1);

class EditTaskPage extends AbstractWebPage {

    /*\
    ----------------------------------------
    Attributs
    ----------------------------------------
    \*/

    private static $PageInstance = null; // WebPage

    /*\
    ----------------------------------------
    Méthodes
    ----------------------------------------
    \*/

    /**
     * __construct
     * En private car singleton.
     * @return void
     */
    private function __construct() {
    }

    /**
     * display.
     *
     * @return EditTaskPage
     */
    public static function display(): EditTaskPage {

        // Si Il n'existe pas déjà de connexion
        if (!self::$PageInstance) {
            // On instancie par la méthode __construct
            self::$PageInstance = new EditTaskPage();
        }
        return self::$PageInstance;
    }

    /**
     * getHtmlContent
     *
     * @return string
     */
    public function getHtmlContent(): string {
        return $this->newPonderatorForm();
    }

    /**
     * getTitle
     *
     * @return string
     */
    public function getTitle(): string {
        return 'Ceci est un titre';
    }
}