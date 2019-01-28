<?php
/*----------------------------------------*\
    Constants
\*----------------------------------------*/

define('HEAD', '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">

                    <!-- Google Font-->
                    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">

                    <!-- NES.css framework -->
                    <link href="https://unpkg.com/nes.css/css/nes.min.css" rel="stylesheet" />
                    <title>Connection</title>
                </head>');

define('BODY_START', '<body>');

define('BODY_END', '</body>
                    </html>');

define('CONNECTION_FORM','  <form class="form-horizontal" method="post">
                                <fieldset>

                                <!-- Form Name -->
                                <legend>Connection</legend>

                                <!-- Password input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="password">Type the password</label>
                                    <div class="col-md-4">
                                        <input id="password" name="password" type="password" class="form-control input-md" required="">
                                        <span class="help-block">Tip : the password is "42"</span>
                                    </div>
                                </div>

                                <!-- Button -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="validate"></label>
                                    <div class="col-md-4">
                                    <input type="submit" name="Submit" value="Connection" />
                                    </div>
                                </div>

                                </fieldset>
                            </form>');

define ('PASSWORD', '42');



/*----------------------------------------*\
    Vars
\*----------------------------------------*/

$isConnected = '';



/*----------------------------------------*\
    Functions
\*----------------------------------------*/

function checkPassword(){
    if ((filter_input(INPUT_POST, 'password') && ($_POST['password'] === PASSWORD))) {
        return true;
    } else {
        return false;
    }
}

function displayContent($page = "index.php"){
    $output =   HEAD.
                BODY_START;

    if(checkPassword()){
        $output .= '<p>Vous êtes connecté ça fait zizir !</p><button>deconnect</button>';
    } else {
        $output .= CONNECTION_FORM;
    }

    $output .= BODY_END;

    echo ($output);
}



/*----------------------------------------*\
    Call functions
\*----------------------------------------*/

displayContent();