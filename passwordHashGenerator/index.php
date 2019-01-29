<?php

// Hashage et affichage du mdp envoyé
if (isset($_GET['password']))
{
    $hash = password_hash($_GET['password'], PASSWORD_DEFAULT);

    echo '<strong>Votre Mot de Passe : </strong>' . $_GET['password'] . '<br>';
    echo '<strong>Hash : </strong>' . $hash . '<br><br>';
}


// formulaire
echo '  <form>
            <fieldset>

                <!-- Form Name -->
                <legend>Password Hash Generator</legend>

                <!-- Text input-->
                <div>
                    <label control-label" for="password">Votre mot de passe :</label>  
                    <div>
                        <input id="password" name="password" type="text" placeholder="" required="">
                    </div>
                </div>

                <br>

                <!-- Button -->
                <div>
                    <input type="submit" value="Submit">
                </div>

            </fieldset>
        </form>';