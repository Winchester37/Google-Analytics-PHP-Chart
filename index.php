<?php
require 'googlegapi.class.php';
define('ga_profile_id','Profil idsi buraya girilecek');

$ga = new gapi("google verdiği mail adresi girilecek", "p12 uzantılı dosya yazılacak");


$ga->requestReportData(ga_profile_id, array('date', 'userDefinedValue'),array('pageviews', 'uniquePageviews', 'visits', 'visitors', 'exitRate', 'avgTimeOnPage', 'entranceBounceRate', 'newVisits'), 'date');




            $results = $ga->getResults();    
        ?>
		    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

        <script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Gün');
                data.addColumn('number', 'Ziyaretci');
                data.addRows([
                    <?php
                        foreach($results as $result) {
                            echo '["'.date('M j',strtotime($result->getDate())).'", '.$result->getVisits().'],';
                        }
                    ?>
                ]);

                var chart = new google.visualization.AreaChart(document.getElementById('chart'));
                chart.draw(data, {width: 910, height: 250, title: 'Son Bir Aylık Verileriniz;',
                    colors:['#058dc7','#e6f4fa'],
                    areaOpacity: 0.1,
                    hAxis: {textPosition: 'in', showTextEvery: 5, slantedText: false, textStyle: { color: '#058dc7', fontSize: 10 } },
                    pointSize: 5,
                    legend: 'none',
                    chartArea:{left:0,top:30,width:"100%",height:"100%"}
                });
            }
        </script>

        <div id="chart"></div>
       