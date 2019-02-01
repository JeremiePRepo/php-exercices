<?php

/*\
--------------------------------------------
    WebPage.class.php
--------------------------------------------
    Cette classe est destinée à afficher la 
    page Web. Si une méthode doit renvoyer 
    du HTML, elle se trouvera sûrement ici.

    Patron de conception : singleton.

    Pour instancier la WebPage : 
    WebPage::createInstance();

    // TODO : Passer WebPage en classe 
    // TODO | abstraite, et créer des 
    // TODO | classes enfants pour les 
    // TODO | différentes pages.
--------------------------------------------
\*/

// On utilise le typage strict
declare(strict_types=1);

// On inclu les constantes nécessaires au fonctionnement de la classe
include_once './params.inc.php';

class WebPage
{

    /*\
     | -------------------------------------
     | Attributs
     | -------------------------------------
    \*/

    
    private static $webPageInstance = null; // WebPage
    private static $actualPageCode;         // int
    private static $actualPageDatas;        // array
    private $HTMLStyles = '';               // string
    private $pageContent = '';              // string
    private $alertMessages = '';            // string

    
    /*\
     | -------------------------------------
     | Méthodes
     | -------------------------------------
    \*/

    // __construct()

    // En private car singleton
    private function __construct()
    {
        $this->fetchPageContent();

        // La page précédente nous a-t-elle laissé un petit mot ?
        if(isset($_SESSION['info-message']) === true)
        {
            // Ajout du message dans la section info
            $this->alertMessages .= $_SESSION['info-message'];

            // Destruction de la variable de session.
            unset($_SESSION['info-message']);
        }
    }

    ////////////////////////////////////////

    // createInstance()

    // Permets d'instancier la page
    public static function createInstance(int $actualPageCode, array $actualPageDatas) : WebPage
    {
        // La classe aura besoin de savoir sur quelle page on est
        self::$actualPageCode = $actualPageCode;

        // Et éventuellement quelques infos venant du traitement de formulaires
        self::$actualPageDatas = $actualPageDatas;

        // Si Il n'existe pas déjà de connexion
        if(!self::$webPageInstance)                 
        {
            // On instancie par la méthode __construct
            self::$webPageInstance = new WebPage;   
        }
        return self::$webPageInstance; 
    }

    ////////////////////////////////////////
    
    // getHTMLStyles()
    
    // Permets de retourner les balises styles rentrées en paramètres
    public function getHTMLStyles() : string
    {
        foreach (SITE_STYLES as $this->style)   
        {
            $this->HTMLStyles .= $this->style;
        }
        return $this->HTMLStyles;
    }

    ////////////////////////////////////////
    
    // setPageContent()
    
    // Remplace tout le contenu principal de la page, à utiliser pour le debug
    public function setPageContent($content)
    {
        $this->pageContent = $content;
    }

    ////////////////////////////////////////
    
    // fetchPageContent()
    
    // Construit le contenu de la page
    public function fetchPageContent()
    {
        // On récupère le code de la page actuelle
        switch (self::$actualPageCode) {
            case 1:
                // Page principale

                // On récupère l'ID de l'utilisateur
                $userID = intval($_SESSION['user-id']);

                // On lui dit bonjour
                $this->alertMessages .= 'Bonjour ' . htmlspecialchars(DataBase::connect()->getUserNameById($userID)) . LINE_BREAK;

                // On récupère les tirelires de l'utilisateur dans un array
                $piggyBank = DataBase::connect()->getPiggyBanksByUserId($userID);

                // L'utilisateur a-til déjà créé une tirelire ?
                if(empty($piggyBank) === true)
                {
                    // Ici l'utilisateur n'a pas encore créé de tirelire
                    $this->pageContent = '<p>Vous n\'avez encore aucune tirelire. Ce serait une bonne idée d\'en <a href="' . Router::createInstance()->getSiteURL() . '?page=new-piggybank">créer une</a>.</p>';
                    break;
                }
                // Ici, l'utilisateur à déjà créé au moins une tirelire

                /////////////////////////////////////////////////////////////
                $this->pageContent = '<p>[WIP] Page Principale [WIP]</p>';
                break;
            
            case 3:
                // Page login
                $this->pageContent = '  <p>Vous êtes sur un formulaire magique : entrez vos informations pour vous connecter OU créer un compte.</p><br>
                                        <form method="post">
                                            <fieldset>
                                            
                                                <!-- Form Name -->
                                                <legend>Se connecter ou créer un compte</legend>
                                                
                                                <!-- Text input-->
                                                <div>
                                                    <label for="login-email">Votre email</label>  
                                                    <div>
                                                        <input name="login-email" type="email" placeholder="" required="">
                                                    </div>
                                                </div>
                                                
                                                <!-- Password input-->
                                                <div>
                                                    <label control-label" for="login-pass">Mot de passe</label>
                                                    <div>
                                                        <input name="login-pass" type="password" placeholder="" required="">
                                                    </div>
                                                </div>
                                                
                                                <!-- Button -->
                                                <div>
                                                    <div>
                                                        <input type="submit" value="Valider">
                                                    </div>
                                                </div>

                                            </fieldset>
                                        </form>';
                break;
            
            case 4:
                // Page de création de compte
                $this->pageContent = '  <form method="post">
                                            <fieldset>
                                            
                                                <!-- Form Name -->
                                                <legend>Créer un compte</legend>
                                                
                                                <!-- Text input-->
                                                <div>
                                                    <label for="signup-email">E-mail</label>  
                                                    <div>
                                                        <input name="signup-email" type="email" placeholder="" required="" value="' . self::$actualPageDatas["login-mail"] . '">
                                                    </div>
                                                </div>
                                                
                                                <!-- Text input-->
                                                <div>
                                                    <label for="signup-name">Nom d\'utilisateur</label>  
                                                    <div>
                                                        <input name="signup-name" type="text" placeholder="" required="" value="' . (isset($_SESSION["signup-name"]) ? $_SESSION["signup-name"] : "" ) . '">
                                                    </div>
                                                </div>
                                                
                                                <!-- Password input-->
                                                <div>
                                                    <label for="signup-pass">Mot de passe</label>
                                                    <div>
                                                        <input name="signup-pass" type="password" placeholder="" required="" value="' . self::$actualPageDatas["login-pass"] . '">
                                                    </div>
                                                </div>
                                                
                                                <!-- Password input-->
                                                <div>
                                                    <label for="signup-pass-confirm">Confirmez votre mot de passe</label>
                                                    <div>
                                                        <input name="signup-pass-confirm" type="password" placeholder="" required="">
                                                    </div>
                                                </div>
                                                
                                                <!-- Button -->
                                                <div>
                                                    <div>
                                                        <input type="submit" value="Créer un compte">
                                                    </div>
                                                </div>
                                            
                                            </fieldset>
                                        </form>
                                        <a href="?page=login">< Page de login</a>';
                break;

            case 6:
                // PiggyBanks
                $this->pageContent = '<h3>Mes tirelires</h3><br>';

                $user = User::createInstance(intval($_SESSION['user-id']));

                // On envoie la liste des tirelires
                $user->setPiggyBanks(DataBase::connect());

                // On récupère la liste des tirelires
                $piggyBanks = $user->getPiggyBanks();

                $this->pageContent .= '<ul>';
                foreach ($piggyBanks as $piggyBank) {
                    $this->pageContent .= '<li>' . $piggyBank["name"] . ' <a href="?page=delete-piggybank&piggybank-id=' . $piggyBank["id"] . '">[X]</a></li>';
                }
                $this->pageContent .= '</ul>';

                if (empty($piggyBanks)) {
                    $this->pageContent .= '<p>Aucune</p>';
                }

                $this->pageContent .= '<a href="?page=new-piggybank">Créer une nouvelle tirelire.</a>';
                break;

            case 7:
                // New Piggybank
                $this->pageContent = '<h3>Nouvelle tirelire</h3><br>';
                
                $this->pageContent .= '  <form method="post">
                                            <fieldset>
                                            
                                            <!-- Form Name -->
                                            <legend>Nouvelle tirelire</legend>
                                            
                                            <!-- Text input-->
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="piggybank-name">Nom de la tirelire</label>  
                                                <div class="col-md-4">
                                                    <input id="piggybank-name" name="piggybank-name" type="text" placeholder="" class="form-control input-md" required="">
                                                </div>
                                            </div>
                                            
                                            <!-- Number input-->
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="piggybank-amount">Montant initial</label>  
                                                <div class="col-md-4">
                                                    <input type="number" name="piggybank-start-amount" min="0" value="0" step=".01"><span> €</span>
                                                </div>
                                            </div>
                                            
                                            <!-- Button -->
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <input type="submit" value="Créer">
                                                </div>
                                            </div>
                                            
                                            </fieldset>
                                        </form>';

                break;

            case 9:
                // New Movement

                $this->pageContent = '<h3>Nouveau mouvement</h3><br>';

                $this->pageContent .= ' <form class="form-horizontal">
                                        <fieldset>
                                        
                                        <!-- Form Name -->
                                        <legend>Nouveau mouvement</legend>
                                        
                                        <!-- Multiple Radios -->
                                        <div class="form-group">
                                        <label class="col-md-4 control-label" for="type">Type de mouvement</label>
                                        <div class="col-md-4">
                                        <div class="radio">
                                            <label for="type-0">
                                            <input type="radio" name="type" id="type-0" value="1" checked="checked">
                                            Ressource
                                            </label>
                                            </div>
                                        <div class="radio">
                                            <label for="type-1">
                                            <input type="radio" name="type" id="type-1" value="2">
                                            Payement
                                            </label>
                                            </div>
                                        </div>
                                        </div>

                                        <!-- Number input-->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="piggybank-amount">Montant</label>  
                                            <div class="col-md-4">
                                                <input type="number" name="amount" min="0" value="0" step=".01"><span> €</span>
                                            </div>
                                        </div>
                                        
                                        <!-- Multiple Radios -->
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="piggybank">Tirelire</label>
                                            <div class="col-md-4">
                                                <div class="radio">
                                                    <label for="piggybank-0">
                                                        <input type="radio" name="piggybank" id="piggybank-0" value="1" checked="checked">
                                                        Option one
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label for="piggybank-1">
                                                        <input type="radio" name="piggybank" id="piggybank-1" value="2">
                                                        Option two
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Date -->
                                        <label for="movement-date">Date</label>
                                        <input type="date" id="start" name="movement-date" value="' . date("Y-m-d") . '" min="1900-01-01" max="2100-01-01">
                                            
                                        <!-- Button -->
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <input type="submit" value="Créer">
                                            </div>
                                        </div>
                                        
                                        </fieldset>
                                        </form>';
                break;

            default:
                // Page 404
                $this->pageContent = '  <p>Page 404</p>
                                        <a href="' . Router::createInstance()->getSiteURL() . '">< Retour à la réalité</a>';
        }
    }

    ////////////////////////////////////////
    
    // getPageContent()
    
    // Renvois le contenu de la page
    public function getPageContent() : string
    {
        return $this->pageContent;
    }

    ////////////////////////////////////////
    
    // getMenu()
    
    // Renvois le contenu de la page
    public function getMenu() : string
    {
        // menu
        return '<nav>
                    <ul class="menu main">
                        <li>
                            <a href="' . Router::createInstance()->getSiteURL() . '">Vue globale</a>
                        </li>
                        <li>
                            <a href="' . Router::createInstance()->getSiteURL() . '?page=deconnection">Déconnexion</a>
                        </li>
                    </ul>
                </nav>
                <nav>
                    <ul class="menu sub">
                        <li>
                            <a href="' . Router::createInstance()->getSiteURL() . '?page=piggybanks">Gérer les tirelires</a>
                        </li>
                        <li>
                            <a href="' . Router::createInstance()->getSiteURL() . '?page=new-movement">Nouveau mouvement</a>
                        </li>
                    </ul>
                </nav>';
    }

    ////////////////////////////////////////
    
    // addAlertMessage()
    
    // Met en place les messages d'alertes
    public function addAlertMessage($message)
    {
        $this->alertMessages .= $message;
    }

    ////////////////////////////////////////
    
    // displayPage()
    
    // Permets de retourner les balises styles rentrées en paramètres
    public function displayPage() : string
    {

        // Mise en forme des messages d'alert s'il y en a
        $HTMLAlertMessages = ''; // string
        if ($this->alertMessages !== '') {
            $HTMLAlertMessages = '<pre>' . $this->alertMessages . '</pre>';
        }

        // Si nous sommes en page d'accueil, on affiche le cochon et le menu
        $logo = ''; // string
        $menu = ''; // string
        if (isset($_SESSION['logged']) === true) {
            $logo = SITE_LOGO;
            $menu = $this->getMenu();
        }

        // On affiche la page
        return '    <!DOCTYPE html>
                    <html lang="' . SITE_LANG . '">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <meta http-equiv="X-UA-Compatible" content="ie=edge">
                        ' . $this->getHTMLStyles() . '
                        <title>' . SITE_TITLE . '</title>
                    </head>
                    <body>
                        <h1>' . $logo . SITE_TITLE . '</h1>
                        ' . $HTMLAlertMessages . '
                        ' . $menu . '
                        ' . $this->pageContent . '
                    </body>
                    </html>';
    }

    ////////////////////////////////////////
    
    // __destruct()

    public function __destruct()
    {
        echo $this->displayPage();
    }
}