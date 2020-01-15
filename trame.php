<?php

$fichier = file_get_contents('capture_axel.json');

$json = json_decode($fichier, true);
//    echo "<pre>";
//    var_dump($json[0]);
//    echo "</pre>";

//$ipAddrSrc = $json[0]['_source']['layers']['ip']['ip.src'];
//echo "<br>" . $ipAddrSrc;


require_once("inc/header.php"); ?>

    <canvas id="myChart"></canvas>
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
        $tabIp = array();

        for ($i = 0; $i < $nb; $i++) {
            echo '<tr>';
            $row = $json[$i]['_source']['layers'];
            if (isset($row['frame'])) {
                echo '<td>' . $json[$i]['_source']['layers']['frame']['frame.time'] . '</td>';
            } else {
                echo '<td></td>';
            }
            if (isset($row['ip'])) {
                echo '<td>' . $json[$i]['_source']['layers']['ip']['ip.src'] . '</td>';
                echo '<td>' . $json[$i]['_source']['layers']['ip']['ip.dst'] . '</td>';
                array_push($tabIp, $json[$i]['_source']['layers']['ip']['ip.dst']);

                foreach ($tabIp as $ipDest) {
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://freegeoip.app/json/" . $ipDest,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 120,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "GET",
                        CURLOPT_HTTPHEADER => array(
                            "accept: application/json",
                            "content-type: application/json"
                        ),
                    ));

                    $response = curl_exec($curl);
                    $err = curl_error($curl);

                    curl_close($curl);

                    if ($err) {
                        echo "cURL Error #:" . $err;
                    } else {
                        //echo $response;
                        $test = json_decode($response);;
                        $countryName = $test->country_name;
                        //debug($longitude);
                        //debug($latitude);
                        //var_dump($test);
                        //var_dump($test->ip);
                        //echo $response
                        $z = [
                            'country_name' => $countryName
                        ];
                        if (empty($z['country_name'])) {
                            unset($z['country_name']);
                        } else {
                            //$countryName = $z['country_name'];
//                            echo "<pre>";
//                            var_dump($z);
//                            echo "</pre>";
                            //echo $z['country_name'][0];
                            $tab[] = $z;

                            //$result = array_merge($z);
                            echo "<pre>";
                            var_dump($tab);
                            echo "</pre>";
                        }
                    }
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
        }

        ?>
        </tbody>
    </table>
    <!-- Stat a faire :
    Nb de connexion à la minute en splittant frame.time
    Voir pour géoloc les @ip
    Voir pour reconnaitre Netflix, Fb, etc...-->
    <script>
        console.log(<?=$tcp?>)
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'doughnut',

            // The data for our dataset
            data: {
                labels: ['TCP', 'UDP'],
                datasets: [{
                    label: 'TCP / UDP',
                    backgroundColor: [
                        'rgb(148, 68, 15)',
                        'rgb(0, 0, 0)'

                    ],
                    borderColor: 'rgb(255, 255, 255)',
                    data: [<?=$tcp?>, <?=$udp;?>]
                }]
            },
            // Configuration options go here
            options: {}
        });
    </script>
<?php require_once("inc/footer.php");