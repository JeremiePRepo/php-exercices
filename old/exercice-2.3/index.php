<?php
$resultats = array( "Équipe A" => [8, 12, 3, 15, 22, 1],
                    "Équipe B" => [9, 7, 2, 6, 12, 13],
                    "Équipe C" => [2, 2, 3, 7, 5, 6],
                    "Équipe D" => [14, 12, 13, 20, 18, 6],
                    "Équipe E" => [18, 10, 13, 5, 19, 11]
);
$sums = array();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercice 2.3 : Affichage d'un tableau</title>
    <style>
    body {
        text-align: center;
    }
</style>
</head>
<body>
    <h1>Les résultats</h1>
    <table>
    <th>Nom</th>
    <?php
        for ($i=1; $i <= (count($resultats)+3); $i++) { 
            if ($i === (count($resultats)+2)) {
                echo '<th>Moyenne</th>';
            } elseif ($i === (count($resultats)+3)) {
                echo '<th>Résultat</th>';
            } else {
                echo '<th>Match ' . $i . '</th>';
            }
        }
        foreach ($resultats as $team => $scores) {
            echo '<tr><th>' . $team . '</th>';
            // array_push($sums, $team);
            foreach ($scores as $key => $score) {
                echo '<td>' . $score . '</td>';
            }
            $sums[$team] = array_sum($resultats[$team]);
            echo '<td>' . round((array_sum($resultats[$team]))/count($resultats[$team]), 2) . '</td><td>' . array_sum($resultats[$team]) . '</td></tr>';
        }
    ?>
    </table>
    <h2>Résultats triés</h2>
    <pre>
    <?php
        arsort($sums);
        print_r($sums);
    ?>
    </pre>
</body>
</html>