<?php
session_start();

require("function/functions.php");
require("function/debug.php");
if (is_logged()) {
    require_once("inc/header.php");

?>
   <div class="upload">
       <form class="uploadfrm" action="trame.php" method="post" enctype="multipart/form-data">
           <label for="json_file" class="label_file">Uploadez une trame JSON:</label>
           <input type="file" name="json_file" id="json_file">
           <input type="submit" value="Charger la trame" name="submitted">
       </form>
   </div>
<?php
if (!empty($_POST['submitted'])) {
    $uploaded_file = $_FILES['json_file']['name'];
    $path = pathinfo($uploaded_file);
    $fileext = $path['extension'];
    $allowed = array("json");
    if (!(in_array($fileext, $allowed))) {
        echo "La trame doit être en JSON";
    } else {
        $dir = dirname(__FILE__) . "/";
        $name = "fichier_du_" . date("YmdHis") . "." . $fileext;

        if (move_uploaded_file($_FILES["json_file"]["tmp_name"],
            $dir . $name)) {
            $file = file_get_contents($name);
            $json = json_decode($file, true);


            ?>
            <div id="graph">
                <div id="graphCirc1">
                    <canvas id="chartProt"></canvas>
                </div>
                <div id="graphCirc2">
                    <canvas id="chartMachine"></canvas>
                </div>
                <canvas id="chartCountry"></canvas>
            </div>
            <div id="tab">
                <table id="table">
                    <thead>
                    <th id="fitText">Date et heure</th>
                    <th id="fitText">Adresse IP Source</th>
                    <th id="fitText">Adresse IP Destination</th>
                    <th id="fitText">Adresse MAC Source</th>
                    <th id="fitText">Adresse MAC Destination</th>
                    <th id="fitText">Protocole</th>
                    <th id="fitText">Port Source</th>
                    <th id="fitText">Port Destination</th>
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
                            echo '<td id="fitText">' . $date[0] . '</td>';
                        } else {
                            echo '<td></td>';
                        }
                        if (isset($row['ip'])) {
                            echo '<td id="fitText">' . $json[$i]['_source']['layers']['ip']['ip.src'] . '</td>';
                            echo '<td id="fitText">' . $json[$i]['_source']['layers']['ip']['ip.dst'] . '</td>';
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
                            echo '<td id="fitText">' . $json[$i]['_source']['layers']['eth']['eth.src'] . '</td>';
                            echo '<td id="fitText">' . $json[$i]['_source']['layers']['eth']['eth.dst'] . '</td>';
                        } else {
                            echo '<td></td>';
                            echo '<td></td>';
                        }
                        if (isset($row['udp'])) {
                            echo '<td id="fitText">UDP</td>';
                            echo '<td id="fitText">' . $json[$i]['_source']['layers']['udp']['udp.srcport'] . '</td>';
                            echo '<td id="fitText">' . $json[$i]['_source']['layers']['udp']['udp.dstport'] . '</td>';
                            $udp++;
                        } else if (isset($row['tcp'])) {
                            echo '<td id="fitText">TCP</td>';
                            echo '<td id="fitText">' . $json[$i]['_source']['layers']['tcp']['tcp.srcport'] . '</td>';
                            echo '<td id="fitText">' . $json[$i]['_source']['layers']['tcp']['tcp.dstport'] . '</td>';
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
                        $mavVal = max($nbCountry);
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <script>
                var ctx1 = document.getElementById('chartProt').getContext('2d');
                var chart1 = new Chart(ctx1, {
                    type: 'pie',
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
                    options: {
                        legend: {display: false},
                        title: {
                            display: true,
                            text: 'Protocoles utilisés'
                        }
                    }
                });

                var ctx2 = document.getElementById('chartCountry').getContext('2d');
                var chart2 = new Chart(ctx2, {
                    type: 'horizontalBar',
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
                    options: {
                        display: 'auto',
                        minBarLength: 0,
                        scaleStartValue: 0,
                        scalesStepWidth: 100,
                        scales: {
                            xAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    max: <?=$mavVal +1;?>,
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
                    type: 'polarArea',
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
                    options: {
                        legend: {display: false},
                        title: {
                            display: true,
                            text: 'Marques cartes réseaux'
                        }
                    }
                });
                $("#fittext").fitText(1.1, {minFontSize: '50px', maxFontSize: '75px'});
            </script>
            <?php
        } else {
            echo "Erreur dans l'upload du fichier";
        }
    }
}
require_once("inc/footer.php");
} else {
    header('Location: 404.php');

}
