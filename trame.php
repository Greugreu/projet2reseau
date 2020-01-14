<?php

$fichier = file_get_contents('capture.json');

$json = json_decode($fichier, true);
//    echo "<pre>";
//    var_dump($json[0]);
//    echo "</pre>";

//$ipAddrSrc = $json[0]['_source']['layers']['ip']['ip.src'];
//echo "<br>" . $ipAddrSrc;

require_once("inc/header.php"); ?>

<table id="table">
    <caption>Capture Trame</caption>
    <thead>
    <th>Adresse IP Source</th>
    <th>Adresse IP Destination</th>
    <th>Adresse MAC Source</th>
    <th>Adresse MAC Destination</th>
    <th>Protocole</th>
    <th>Port Source</th>
    <th>Port Destination</th>

    </thead>
    <tbody>
    <?php
    $nb = count($json);
    echo $nb;

    for ($i = 0; $i < $nb; $i++) {
        echo '<tr>';
        $row = $json[$i]['_source']['layers'];
        if (isset($row['ip'])) {
            echo '<td>' . $json[$i]['_source']['layers']['ip']['ip.src'] . '</td>';
            echo '<td>' . $json[$i]['_source']['layers']['ip']['ip.dst'] . '</td>';
        }
        if (isset($row['eth'])) {
            echo '<td>' . $json[$i]['_source']['layers']['eth']['eth.src'] . '</td>';
            echo '<td>' . $json[$i]['_source']['layers']['eth']['eth.dst'] . '</td>';
        }
        if (isset($row['udp'])) {
            echo '<td>UDP</td>';
            echo '<td>' . $json[$i]['_source']['layers']['udp']['udp.srcport'] . '</td>';
            echo '<td>' . $json[$i]['_source']['layers']['udp']['udp.dstport'] . '</td>';
        }
        if (isset($row['tcp'])) {
            echo '<td>TCP</td>';
            echo '<td>' . $json[$i]['_source']['layers']['tcp']['tcp.srcport'] . '</td>';
            echo '<td>' . $json[$i]['_source']['layers']['tcp']['tcp.dstport'] . '</td>';
        }
        echo '</tr>';
    }
    ?>
    </tbody>
</table>
</body>
</html>