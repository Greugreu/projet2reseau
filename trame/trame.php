<?php
$fichier = file_get_contents('./capture.json');

$json = json_decode($fichier, true);

$entete = array_keys($json[0]);
?>

<table>
    <caption>Capture Trame</caption>
    <thead>
    <?php
    foreach ($entete as $entetes)
        echo "<th>" . $entetes . "</th>";
    ?>
    </thead>
    <tbody>
    <?php
    foreach ($json as $trames) {
        echo "<tr>";
        foreach ($trames as $carac)
            echo "<td>" . $carac . "</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>