<?php
session_start();

require("function/functions.php");
require("function/debug.php");
/*if (is_logged()) {*/
    require_once("inc/header.php");

    $fichier = file_get_contents('capturemin.json');

    $json = json_decode($fichier, true);



    ?>

    <canvas id="chartProt"></canvas>
    <canvas id="chartMachine"></canvas>
    <canvas id="chartCountry"></canvas>

    <!--    --><?php
//    $testDate = explode(".", $json[1]['_source']['layers']['frame']['frame.time']);
//    echo $testDate[0].'<br>';
//    echo strtotime($testDate[0]);?>
    <table id="table">
        <thead>
        <th>Date et heure</th>
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
        $udp = 0;
        $tcp = 0;
        $tab = array();
        $intel = 0;
        $apple = 0;
        $autre = 0;

        for ($i = 0; $i < $nb; $i++) {
            echo '<tr>';
            $row = $json[$i]['_source']['layers'];
            if (isset($row['frame'])) {
                $date = explode(".", $json[$i]['_source']['layers']['frame']['frame.time']);
                echo '<td>' . $date[0] . '</td>';
            } else {
                echo '<td></td>';
            }
            if (isset($row['ip'])) {
                echo '<td>' . $json[$i]['_source']['layers']['ip']['ip.src'] . '</td>';
                echo '<td>' . $json[$i]['_source']['layers']['ip']['ip.dst'] . '</td>';

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://freegeoip.app/json/" . $json[$i]['_source']['layers']['ip']['ip.dst'],
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "accept: application/json",
                        "content-type: application/json"
                    ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                $test = json_decode($response);


                $countryName = $test->country_name;
                $z = [
                    'country_name' => $countryName
                ];
                if ($z['country_name'] === "") {
                    unset($z['country_name']);
                } else {
                    $countryName = $z['country_name'];
                    $tab[] .= $countryName;
                }
            } else {
                echo '<td></td>';
                echo '<td></td>';
            }
            if (isset($row['eth'])) {
                echo '<td>' . $json[$i]['_source']['layers']['eth']['eth.src'] . '</td>';
                echo '<td>' . $json[$i]['_source']['layers']['eth']['eth.dst'] . '</td>';
            } else {
                echo '<td></td>';
                echo '<td></td>';
            }
            if (isset($row['udp'])) {
                echo '<td>UDP</td>';
                echo '<td>' . $json[$i]['_source']['layers']['udp']['udp.srcport'] . '</td>';
                echo '<td>' . $json[$i]['_source']['layers']['udp']['udp.dstport'] . '</td>';
                $udp++;
            } else if (isset($row['tcp'])) {
                echo '<td>TCP</td>';
                echo '<td>' . $json[$i]['_source']['layers']['tcp']['tcp.srcport'] . '</td>';
                echo '<td>' . $json[$i]['_source']['layers']['tcp']['tcp.dstport'] . '</td>';
                $tcp++;
            } else {
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
            }

            echo '</tr>';
            if (isset($row['eth']['eth.src_tree'])) {
                if ($row['eth']['eth.src_tree']['eth.addr.oui_resolved'] === "Apple, Inc.") {
                    $apple++;
                } else if ($row['eth']['eth.src_tree']['eth.addr.oui_resolved'] === "Intel Corporate") {
                    $intel++;
                } else {
                    $autre++;
                }
            }
        }
        $nbCountry = array_count_values($tab);
        $labels = '';
        $colors = '';
        $val = '';

        foreach ($nbCountry as $key => $nb) {
            $color1 = rand(0, 255);
            $color2 = rand(0, 255);
            $color3 = rand(0, 255);
            $labels .= "'" . $key . "',";
            $colors .= "'rgb(" . $color1 . ", " . $color2 . ", " . $color3 . ", 0.5)' ,";
            $val .= $nbCountry[$key] . ",";
        }
        ?>
        </tbody>
    </table>

    <!-- Stat a faire :
    Nb de connexion à la minute en splittant frame.time
    Voir pour géoloc les @ip
    Voir pour reconnaitre Netflix, Fb, etc...-->
    <script>
        var ctx1 = document.getElementById('chartProt').getContext('2d');
        var chart1 = new Chart(ctx1, {
            // The type of chart we want to create
            type: 'pie',
            // The data for our dataset
            data: {
                labels: ['TCP', 'UDP'],
                datasets: [{
                    label: 'protocoles',
                    backgroundColor: [
                        'rgb(148, 68, 15)',
                        'rgb(0, 0, 0)'
                    ],
                    borderColor: 'rgb(255, 255, 255)',
                    data: [<?=$tcp?>, <?=$udp;?>]
                }]
            },
            // Configuration options go here
            options: {
                legend: {display: false},
                title: {
                    display: true,
                    text: 'Protocole utilisé'
                }
            }
        });

        var ctx2 = document.getElementById('chartCountry').getContext('2d');
        var chart2 = new Chart(ctx2, {
            // The type of chart we want to create
            type: 'horizontalBar',
            // The data for our dataset
            data: {
                labels: [<?= $labels ?>],
                datasets: [{
                    label: 'IP destination country',
                    backgroundColor: [
                        <?= $colors ?>
                    ],
                    borderColor: 'rgb(255, 255, 255)',
                    data: [<?=$val?>]
                }]
            },
            // Configuration options go here
            options: {
                display: 'auto',
                minBarLength: 0,
                scaleStartValue: 0,
                scalesStepWidth: 100,
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            max: 10,
                            step: 1
                        }
                    }]

                },
                legend: {display: false},
                title: {
                    display: true,
                    text: 'Nombre de communication par pays'
                }
            }
        });

        var ctx3 = document.getElementById('chartMachine').getContext('2d');
        var chart3 = new Chart(ctx3, {
            // The type of chart we want to create
            type: 'polarArea',
            // The data for our dataset
            data: {
                labels: ['Intel', 'Apple', 'Autres'],
                datasets: [{
                    label: 'machines',
                    backgroundColor: [
                        'rgb(0, 139, 139)',
                        'rgb(178, 34, 34)',
                        'rgb(255, 215, 0)'
                    ],
                    borderColor: 'rgb(255, 255, 255)',
                    data: [<?=$intel?>, <?=$apple;?>, <?=$autre;?>]
                }]
            },
            // Configuration options go here
            options: {
                title: {
                    display: true,
                    text: 'Marque carte réseau'
                }
            }
        });
    </script>
    <?php require_once("inc/footer.php");
/*} else {
    header('Location: 404.php');

}*/
