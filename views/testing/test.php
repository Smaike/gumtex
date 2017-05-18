<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/ >
        <title>Smoothed D3.js Radar Chart</title>

        <!-- Google fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

        <!-- D3.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.6/d3.min.js" charset="utf-8"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <style>
            body {
                font-family: 'Open Sans', sans-serif;
                font-size: 11px;
                font-weight: 300;
                fill: #242424;
                text-align: center;
                text-shadow: 0 1px 0 #fff, 1px 0 0 #fff, -1px 0 0 #fff, 0 -1px 0 #fff;
                cursor: default;
            }
            
            .legend {
                font-family: 'Raleway', sans-serif;
                fill: #333333;
            }
            
            .tooltip {
                fill: #333333;
            }
        </style>
    
    </head>
    <body>
        <div id="barchart_values" style="width: 600px; height: 300px;"></div>
        <div class="circle1"></div>
        <script src="/js/radar.js"></script>   
        <script>
      
      /* Radar chart design created by Nadieh Bremer - VisualCinnamon.com */
      
            ////////////////////////////////////////////////////////////// 
            //////////////////////// Set-Up ////////////////////////////// 
            ////////////////////////////////////////////////////////////// 

            var margin = {top: 100, right: 100, bottom: 100, left: 100},
                width = Math.min(700, window.innerWidth - 10) - margin.left - margin.right,
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
        ["Copper", 8.94, ""],
        ["Silver", 10.49, ""],
        ["Gold", 19.30, ""],
        ["Platinum", 26.45, ""]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Density of Precious Metals, in g/cm^3",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
      chart.draw(view, options);
  }
  </script>
    </body>
</html>