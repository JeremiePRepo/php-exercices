<?php
function displayPage3(){
    $output = "<h1>Bienvenue dans The Converter</h1>";
    $output .= "<p>Ceci est une révolution.</p>";

    /*\
     | Form generator
     | https://bootsnipp.com/forms
    \*/
    $output .= '<form class="form-horizontal">
                <fieldset>
                
                <!-- Form Name -->
                <legend>Convertisseur révolutionnaire</legend>
                
                <!-- Text input-->
                <div class="form-group">
                <label class="col-md-4 control-label" for="valueToConvert">Valeur à convertir</label>  
                <div class="col-md-4">
                <input id="valueToConvert" name="valueToConvert" type="text" placeholder="Valeur" class="form-control input-md" required="">
                    
                </div>
                </div>
                
                <!-- Select Basic -->
                <div class="form-group">
                <label class="col-md-4 control-label" for="unitToConvert">Unité</label>
                <div class="col-md-4">
                    <select id="unitToConvert" name="unitToConvert" class="form-control">
                    <option value="1">centimètres</option>
                    <option value="2">pieds</option>
                    <option value="3">pouces</option>
                    <option value="4">kilometres</option>
                    <option value="5">mètres</option>
                    <option value="6">milles</option>
                    <option value="7">verges</option>
                    </select>
                </div>
                </div>
                
                <!-- Select Basic -->
                <div class="form-group">
                <label class="col-md-4 control-label" for="convertIn">Convertir en</label>
                <div class="col-md-4">
                    <select id="convertIn" name="convertIn" class="form-control">
                    <option value="1">centimètres</option>
                    <option value="2">pieds</option>
                    <option value="3">pouces</option>
                    <option value="4">kilometres</option>
                    <option value="5">mètres</option>
                    <option value="6">milles</option>
                    <option value="7">verges</option>
                    </select>
                </div>
                </div>
                
                <!-- Button -->
                <div class="form-group">
                <label class="col-md-4 control-label" for="validate"></label>
                <div class="col-md-4">
                    <button id="validate" name="validate" class="btn btn-default">Convertir</button>
                </div>
                </div>
                
                </fieldset>
                </form>';
    return $output;
}