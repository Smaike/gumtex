<?php 
$circle1 = $helper->firstCircleParams;
$circle2 = $helper->secondCircleParams;
?>
<style>
    @media print {
      #printPageButton {
        display: none;
      }
      html, body {
        width: 210mm;
        overflow: visible;
      }
      * { -webkit-print-color-adjust: exact; }
      h2,h1,h3,p,td,span,div{
        color:#101088;
      }
      .split{
        page-break-after: always;
        padding-top: 50px;
      }
      .row{
        width: 210mm;
      }
      .charts{
        padding: 0;
        margin: auto;
        display: block;
        width: 200mm!important;
        height: 100mm!important;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
      }
    }
    @page {
      size: A4;
      margin: ;
    }
    #pageFooter {
        display: table-footer-group;
    }
    #pageFooter:after {
        counter-increment: page;
        content: counter(page);
    }
    body{
      color:#101088!important;
    }
    .report tbody tr td{
      background: url("/images/report/tr-bg.jpg") repeat-x!important;
      background-position: center!important;
    }
    .report tbody tr td:first-child, .report tbody tr td:last-child{
      background: none!important;
      text-align: center;
    }
    .end:before {            
        position : relative;
        content : attr(tooltip);
        opacity : 1;
        margin-left:90%;
        width:30px;
        height: 30px;
        padding: 6px 4px;
        border:solid red 1px;
        border-radius:40px;
        background-color: #fff!important;
        min-width: 30px;
        text-align: center;
        display: inline-block;
        margin-top: -5px;
        font-size: 14px;
        line-height: 14px;
        padding: 7px 3.5px;
    }
    .end{
      max-width: 75%;
      min-width: 5%;
    }
    .graph-1{
      width:11%;
      border-right:2px solid red;
    }
    .graph-1:nth-child(2), .graph-1:nth-child(5){
      width:14%;
    }
    .graph-1:nth-child(5){
      border-right:none;
    }
    #profile-results:before{
      content:"";
      background-image: url('/images/report/result.png')!important;
      background-size: contain!important;
      background-repeat: no-repeat!important;
      left:-50px;
      top:20px;
      position: absolute;
      width:45px;
      height: 48px;
      display: inline-block;
    }
    .code{
      background-image: url('/images/report/krug.png')!important;
      background-size: contain!important;
      background-repeat: no-repeat!important;
      width: 100px;
      height: 96px;
      font-size: 30px;
      line-height: 30px;
      padding: 33px 0px;
      text-align: center;
      float: right;
    }
    h2,h1,h3,p,td,span,div{
      color:#101088!important;
    }

</style>
<div class="split">
  <div class="row">
    <div class="col-sm-12 col-sm-offset-0">
  <div class="row">
    <div class="col-xs-4 col-xs-offset-4" style="text-align: center; margin-top:100px;">
      <img src="/images/report/titul01.png">
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <h1 style="text-align: center; font-size: 42px; margin-top: 50px; border-bottom:3px solid #101088; padding-bottom: 20px"><?=$model->idEvent->client->fio?></h1>
    </div>
  </div>
  <div class="row" style="margin-top: 100px;">
    <div class="col-xs-6" style="text-align: right">
      <img src="/images/report/chel.png">
    </div>
    <div class="col-xs-6">
      <h3 style="text-align: right; font-size: 20px; margin-top: 0px">ИНФОРМАЦИЯ О РЕСПОНДЕНТЕ</h3>
      <table border="0" cellspacing="0" align="right" cellpadding="0" style="border-collapse: collapse; width:80%;">
        <tr>
          <td>
            ВОЗРАСТ
          </td>
          <td align="right">
            17 ЛЕТ
          </td>
        </tr>
        <tr>
          <td>
            ПОЛ
          </td>
          <td align="right">
            МУЖСКОЙ
          </td>
        </tr>
        <tr>
          <td>
            КЛАСС
          </td>
          <td align="right">
            10
          </td>
        </tr>
        <tr>
          <td>
            ХОББИ
          </td>
          <td align="right">
            спорт, шахматы
          </td>
        </tr>
      </table>
    </div>
  </div>
  <div class="row" style="margin-top: 100px;">
    <div class="col-xs-6" style="text-align: right">
      <div class="code">
        1234
      </div>
    </div>
    <div class="col-xs-6">
      <h3 style="text-align: right; font-size: 20px; margin-top: 0px">ИНФОРМАЦИЯ О ТЕСТИРОВАНИИ</h3>
      <h3 style="text-align: right; font-size: 14px; margin-top: 0px; color:#ff7200!important">ПРОФОРИЕНТАТОР...</h3>
      <table border="0" cellspacing="0" align="right" cellpadding="0" style="border-collapse: collapse; width:80%;">
        <tr>
          <td>
            ДАТА ТЕСТИРОВАНИЯ
          </td>
          <td align="right">
            29.05.17 14:00:00
          </td>
        </tr>
        <tr>
          <td>
            ВРЕМЯ ЗАВЕРШЕНИЯ
          </td>
          <td align="right">
            29.05.17 16:00:00
          </td>
        </tr>
        <tr>
          <td>
            ПРОДОЛЖИТЕЛЬНОСТЬ
          </td>
          <td align="right">
            2:00:00
          </td>
        </tr>
      </table>
    </div>
  </div>
  <div class="row" style="margin-top: 300px;">
    <div class="col-sm-3">
      КОНСУЛЬТИРОВАЛ:___________________________
    </div>
  </div>
    </div>
  </div>
</div>
<div class="split">
  <div class="row">
    <div class="col-sm-12 col-sm-offset-0">
  <div class="row">
    <div class="col-sm-12" id="profile-results">
      <h2 style="border-bottom:10px solid #ff7200;">Профиль результатов</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 left-border">
    <?php foreach ($helper->profileResults as $type => $results) {?>
      <h3 align="center">Факторы по блоку <?=$type?></h3>
      <table class="report" width="800" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse; margin:0 auto">
        <?php foreach($results as $k => $row){?>
        <tr height="35">
          <td style="width:25%"><?=$k?></td>
          <?=$helper->renderCentralTds($row)?>
          <td style="width:25%"><?=$k?></td>
        </tr>
        <?php } ?>
      </table>
    <?php }?>
    </div>
  </div>
    </div>
  </div>
</div>
<div class="split">
  <div class="row">
    <div class="col-xs-10 col-xs-offset-1">
          <h2>Направления обучения</h2>
          <canvas id="myChart" class="charts" width="400" height="200"></canvas>
          <h2>Компетенции</h2>
          <canvas id="myChart2" class="charts" width="400" height="200"></canvas>
    </div>
  </div>
</div>
<div class="split">
<div class="row">
    <div class="col-sm-12 col-sm-offset-0">
      <div class="row">
        <div class="col-sm-12">
          <h2 id="results" style="margin-top:100px;">Рекомендации</h2>
          <?php foreach($helper->texts as $key => $val){?>
          <div class="row" style="text-rendering:auto;">
           <?=utf8_decode(mb_convert_encoding($val->asXML(), 'UTF-8', 'HTML-ENTITIES'))?>
          </div>
          <?php }?>
        </div>
      </div>
</div></div>
</div>
<button id="printPageButton" onClick="window.print();">Печать</button>
<script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'radar',
    data: {
        labels: ['<?=implode("','",array_keys($circle1))?>'],
        datasets: [{
            data: [<?=implode(",",$circle1)?>],
            backgroundColor: [
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1,
            pointRadius: [<?=implode(",",$helper->getCirclePointSize($circle1))?>],
            pointBackgroundColor: ['<?=implode("','",$helper->getCirclePointColor($circle1))?>'],
        }]
    },
    options: {
      elements :{
        line: {
          tension :0,
          borderWidth :3
        }
      },
      legend: {
        display: false,
      },
      scale: {
          ticks: {
              suggestedMin: 0,
              suggestedMax: 10
          },
          pointLabels: {
            fontSize: 12,
          }
      },

    },
    id: 'myChart'
});
<?php if(!empty($circle2)){?>
var ctx2 = document.getElementById("myChart2");
var myChart2 = new Chart(ctx2, {
    type: 'radar',
    data: {
        labels: ['<?=implode("','",array_keys($circle2))?>'],
        datasets: [{
            data: [<?=implode(",",$circle2)?>],
            backgroundColor: [
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1,
            pointRadius: [<?=implode(",",$helper->getCirclePointSize($circle2))?>],
            pointBackgroundColor: ['<?=implode("','",$helper->getCirclePointColor($circle2))?>'],
        }]
    },
    options: {
      elements :{
        line: {
          tension :0,
          borderWidth :3
        }
      },
      legend: {
        display: false,
      },
      scale: {
          ticks: {
              suggestedMin: 0,
              suggestedMax: 10
          },
          pointLabels: {
            fontSize: 12,
          }
      }
    },
    id: 'myChart2'
});
<?php }?>
</script>