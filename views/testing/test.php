

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
                margin-left: 50px: 
                text-align:center;
              }
              * { -webkit-print-color-adjust: exact; }
            }
        </style>
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
            <h1><?=$model->idEvent->client->fullName?></h1>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
            <h2>График 1</h2>
            <div id="barchart_values" style="width: 400px; text-align: center; margin:0 auto; "></div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
            <h2>График 2</h2>
            <div class="circle1" style="margin:0 auto; width:400px"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
            <h2>Рекомендации</h2>
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

            var margin = {top: 0, right: 0, bottom: 0, left: 0},
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
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        <?php foreach($helper->profileResults['ИНТЕРЕСЫ'] as $key => $val){
          echo "['" . $key . "', " . $val . ", ''],";
        }?>
        // ["Copper", 8.94, ""],
        // ["Silver", 10.49, ""],
        // ["Gold", 19.30, ""],
        // ["Platinum", 26.45, ""]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Интересы",
        width: 400,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
      chart.draw(view, options);
  }
  </script>