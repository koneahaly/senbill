<?php
session_start();
$notification = (isset($_SESSION["numberOfBillsNonPaid"])) ? $_SESSION["numberOfBillsNonPaid"] : '';
?>

@extends('layouts.app', ['notification' => $notification])
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nvd3/1.8.6/nv.d3.css">
<?php

function calc_month($param){
  $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  $month_int = date('n') - 1;
  if($param == 1)
    return $months[$month_int];
  if($param > 1){
    $month_int = $month_int - ($param - 1);
    if($month_int < 0){
      $month_int = 12 - abs($month_int);
    }
    return $months[$month_int];
  }
}

$dataPoints1 = array(
  array("label"=> calc_month(6), "y"=> $my_infos_conso[calc_month(6)]),
  array("label"=> calc_month(5), "y"=> $my_infos_conso[calc_month(5)]),
  array("label"=> calc_month(4), "y"=> $my_infos_conso[calc_month(4)]),
  array("label"=> calc_month(3), "y"=> $my_infos_conso[calc_month(3)]),
  array("label"=> calc_month(2), "y"=> $my_infos_conso[calc_month(2)]),
  array("label"=> calc_month(1), "y"=> $my_infos_conso[calc_month(1)])
);
$dataPoints2 = array(
  array("label"=> calc_month(6), "y"=> 64.61),
  array("label"=> calc_month(5), "y"=> 70.55),
  array("label"=> calc_month(4), "y"=> 72.50),
  array("label"=> calc_month(3), "y"=> 81.30),
  array("label"=> calc_month(2), "y"=> 63.60),
  array("label"=> calc_month(1), "y"=> 69.38)

);

?>
<!DOCTYPE HTML>
<html>
<head>
<style>

html { overflow-y: hidden; }

#chartContainer {
  position: absolute;
  top: 50%;
  left: 50%;
  transform:translate(-50%, -50%);
}
</style>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2",
  title:{
    text: "Détail de la consommation globale."
  },
  legend:{
    cursor: "pointer",
    verticalAlign: "center",
    horizontalAlign: "right",
    itemclick: toggleDataSeries
  },
  data: [{
    type: "column",
    name: "Consommations réelles",
    indexLabel: "{y}",
    yValueFormatString: "#0.## Kw",
    showInLegend: true,
    dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
  },{
    type: "column",
    name: "Consommations estimées",
    indexLabel: "{y}",
    yValueFormatString: "#0.## Kw",
    showInLegend: true,
    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();

function toggleDataSeries(e){
  if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  }
  else{
    e.dataSeries.visible = true;
  }
  chart.render();
}

}
</script>
</head>
<body>
  <div id="app" class="s2sn-wrapper-login-container s2sn-js-login" style="background-image: url({{url('images/white-background/19366_Fotor1.jpg')}}) !important;">
    <div id="chartContainer" style="height: 40%; width: 50%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  </div>

</body>
</html>
