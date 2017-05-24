

        <!-- Google fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

        <!-- D3.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.6/d3.min.js" charset="utf-8"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <style>
            @media print {
              #printPageButton {
                display: none;
              }
              body
                {
                  margin: 25mm 25mm 25mm 25mm;
                }
              .row{
                width:800px;
              }
              * { -webkit-print-color-adjust: exact; }
              #results{page-break-before: always; }
            }
        </style>
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
            <h1><?=$model->idEvent->client->fullName?></h1>
          </div>
        </div><div class="row">
          <div class="col-sm-6 col-sm-offset-3">
            <h2>Профиль результатов</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-8 col-sm-offset-1">
            <div id="barchart_values1" style="width: 400px; text-align: center; margin:0 auto; "></div>
            <div id="barchart_values2" style="width: 400px; text-align: center; margin:0 auto; "></div>
            <div id="barchart_values3" style="width: 400px; text-align: center; margin:0 auto; "></div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
            <h2>Рекомендации по направлениям обучения</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-sm-offset-2">
            <div class="circle1" style="margin:0 auto; width:400px"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
            <h2 id="results" style="margin-top:100px;">Рекомендации</h2>
            <?php foreach($helper->texts as $key => $val){?>
            <div class="row" style="text-rendering:auto;">
             <?=utf8_decode(mb_convert_encoding($val->asXML(), 'UTF-8', 'HTML-ENTITIES'))?>
            </div>
            <?php }?>
          </div>
        </div>
        <button id="printPageButton" onClick="window.print();">Печать</button>
<script src="/js/radar.js"></script>   
<script>
      
      /* Radar chart design created by Nadieh Bremer - VisualCinnamon.com */
      
            ////////////////////////////////////////////////////////////// 
            //////////////////////// Set-Up ////////////////////////////// 
            ////////////////////////////////////////////////////////////// 

            var margin = {top: 50, right: 80, bottom: 50, left: 80},
                width = Math.min(400, window.innerWidth - 10) - margin.left - margin.right,
                height = Math.min(width, window.innerHeight - margin.top - margin.bottom - 20);
                    
            ////////////////////////////////////////////////////////////// 
            ////////////////////////// Data ////////////////////////////// 
            ////////////////////////////////////////////////////////////// 

            var data = [
                      [//iPhone
                        <?=implode(',', $circle1)?>
                        // {axis:"Battery Life",value:1},
                        // {axis:"Lol",value:0},
                        // {axis:"Brand",value:0},
                        // {axis:"Contract Cost",value:1},
                        // {axis:"Design And Quality",value:7},
                        // {axis:"Have Internet Connectivity",value:6},
                        // {axis:"Large Screen",value:5.5},
                        // {axis:"Price Of Device",value:3},
                        // {axis:"To Be A Smartphone",value:10}          
                      ],
                    ];
            ////////////////////////////////////////////////////////////// 
            //////////////////// Draw the Chart ////////////////////////// 
            ////////////////////////////////////////////////////////////// 

            var color = d3.scale.ordinal()
                .range(["#EDC951","#CC333F","#00A0B0"]);
                
            var radarChartOptions = {
              w: width,
              h: height,
              margin: margin,
              maxValue: 10,
              levels: 10,
              roundStrokes: true,
              color: color
            };
            //Call function to draw the Radar chart
            RadarChart(".circle1", data, radarChartOptions);

            /////////////////////////////////////////////////////////
</script>
<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      <?php $j=0; foreach($helper->profileResults as $i => $res){ $j++;?>
      var data<?=$j?> = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        <?php foreach($res as $key => $val){
          echo "['" . $key . "', " . $val . ", ''],";
        }?>
        // ["Copper", 8.94, ""],
        // ["Silver", 10.49, ""],
        // ["Gold", 19.30, ""],
        // ["Platinum", 26.45, ""]
      ]);

      var view<?=$j?> = new google.visualization.DataView(data<?=$j?>);
      view<?=$j?>.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options<?=$j?> = {
        title: "<?=$i?>",
        width: 800,
        height: 300,
        bar: {groupWidth: "100%"},
        legend: { position: "none" },
        hAxis: {minValue: 0},
        chartArea: {width: '50%'}
      };
      var chart<?=$j?> = new google.visualization.BarChart(document.getElementById("barchart_values<?=$j?>"));
      chart<?=$j?>.draw(view<?=$j?>, options<?=$j?>);
      <?php }?>
  }
  </script>