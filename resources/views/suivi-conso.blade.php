<?php
session_start();
$notification = (isset($_SESSION["numberOfBillsNonPaid"])) ? $_SESSION["numberOfBillsNonPaid"] : '';
?>
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
  array("x"=> calc_month(6), "y"=> (!empty($my_infos_conso[calc_month(6)])) ? $my_infos_conso[calc_month(6)] : 50.00 ),
  array("x"=> calc_month(5), "y"=> (!empty($my_infos_conso[calc_month(5)])) ? $my_infos_conso[calc_month(5)] : 60.00 ),
  array("x"=> calc_month(4), "y"=> (!empty($my_infos_conso[calc_month(4)])) ? $my_infos_conso[calc_month(4)] : 68.00 ),
  array("x"=> calc_month(3), "y"=> (!empty($my_infos_conso[calc_month(3)])) ? $my_infos_conso[calc_month(3)] : 70.00 ),
  array("x"=> calc_month(2), "y"=> (!empty($my_infos_conso[calc_month(2)])) ? $my_infos_conso[calc_month(2)] : 50.00 ),
  array("x"=> calc_month(1), "y"=> (!empty($my_infos_conso[calc_month(1)])) ? $my_infos_conso[calc_month(1)] : 40.00 )
);
$dataPoints2 = array(
  array("x"=> calc_month(6), "y"=> (!empty($my_infos_conso[calc_month(6)]) && !empty($my_infos_conso[calc_month(5)])) ? ($my_infos_conso[calc_month(6)] + $my_infos_conso[calc_month(5)])/2 : (50+60)/2),
  array("x"=> calc_month(5), "y"=> (!empty($my_infos_conso[calc_month(5)]) && !empty($my_infos_conso[calc_month(4)])) ? ($my_infos_conso[calc_month(5)] + $my_infos_conso[calc_month(4)])/2 : (60+68)/2),
  array("x"=> calc_month(4), "y"=> (!empty($my_infos_conso[calc_month(4)]) && !empty($my_infos_conso[calc_month(3)])) ? ($my_infos_conso[calc_month(4)] + $my_infos_conso[calc_month(3)])/2 : (70+68)/2),
  array("x"=> calc_month(3), "y"=> (!empty($my_infos_conso[calc_month(3)]) && !empty($my_infos_conso[calc_month(2)])) ? ($my_infos_conso[calc_month(3)] + $my_infos_conso[calc_month(2)])/2 : (70+50)/2),
  array("x"=> calc_month(2), "y"=> (!empty($my_infos_conso[calc_month(2)]) && !empty($my_infos_conso[calc_month(1)])) ? ($my_infos_conso[calc_month(2)] + $my_infos_conso[calc_month(1)])/2 : (50+40)/2),
  array("x"=> calc_month(1), "y"=> (!empty($my_infos_conso[calc_month(1)]) && !empty($my_infos_conso[calc_month(6)])) ? ($my_infos_conso[calc_month(1)] + $my_infos_conso[calc_month(6)])/2 : (40+50)/2)

);

$dataPoints3 = array(
  array("x"=> calc_month(6), "y"=> (!empty($my_infos_conso_euro[calc_month(6)])) ? $my_infos_conso_euro[calc_month(6)] : 0.00 ),
  array("x"=> calc_month(5), "y"=> (!empty($my_infos_conso_euro[calc_month(5)])) ? $my_infos_conso_euro[calc_month(5)] : 0.00 ),
  array("x"=> calc_month(4), "y"=> (!empty($my_infos_conso_euro[calc_month(4)])) ? $my_infos_conso_euro[calc_month(4)] : 0.00 ),
  array("x"=> calc_month(3), "y"=> (!empty($my_infos_conso_euro[calc_month(3)])) ? $my_infos_conso_euro[calc_month(3)] : 0.00 ),
  array("x"=> calc_month(2), "y"=> (!empty($my_infos_conso_euro[calc_month(2)])) ? $my_infos_conso_euro[calc_month(2)] : 0.00 ),
  array("x"=> calc_month(1), "y"=> (!empty($my_infos_conso_euro[calc_month(1)])) ? $my_infos_conso_euro[calc_month(1)] : 0.00 )
);


$dataPoints4 = array(
  array("x"=> calc_month(6), "y"=> 3064.61),
  array("x"=> calc_month(5), "y"=> 3070.55),
  array("x"=> calc_month(4), "y"=> 3072.50),
  array("x"=> calc_month(3), "y"=> 3081.30),
  array("x"=> calc_month(2), "y"=> 3063.60),
  array("x"=> calc_month(1), "y"=> 3069.38)

);

?>
@extends('layouts.app', ['notification' => $notification, 'service' => $_SESSION['current_service']])
<link rel="stylesheet" type="text/css" href="{{url('css/nv.d3.css')}}">
@section('content')

<div class="container">
  <div class="row" style="margin-top:4%;">
      <lottie-player src="{{url('images/lottie/lines.json')}}"  background="transparent"  speed="0.1"  style="width: 500px; height: 500px; position:absolute;z-index:1000;margin-left:-20%;margin-top: 2.5%;"  loop  autoplay></lottie-player>
      <lottie-player src="{{url('images/lottie/lines.json')}}"  background="transparent"  speed="0.1"  style="width: 500px; height: 500px; position:absolute;z-index:1000;margin-left:70%;margin-top: 2.5%;"  loop  autoplay></lottie-player>
  </div>
  <div class="row" style="margin-top:10%;z-index: 1100;">
  <div class="col-md-12" style="margin-top:10px;margin-bottom:20px;text-align:center;">
   <h3><strong>Mon Suivi de consommation</strong></h3>
  </div>
  </div>
  <lottie-player src="{{url('images/lottie/bubble.json')}}"  background="transparent"  speed="1"  style="width: 80px; height: 80px; position:absolute;z-index:1000;margin-left:-8%;margin-top: 15%;"  loop  autoplay></lottie-player>
  <lottie-player src="{{url('images/lottie/bubble.json')}}"  background="transparent"  speed="1"  style="width: 100px; height: 100px; position:absolute;z-index:1000;margin-left:80%;margin-top: -1.5%;"  loop  autoplay></lottie-player>
  <lottie-player src="{{url('images/lottie/bubble.json')}}"  background="transparent"  speed="1"  style="width: 60px; height: 60px; position:absolute;z-index:1000;margin-left:1%;margin-top: -2%;"  loop  autoplay></lottie-player>
  <div class="row">
    <div id="chart11" style="height: 70%; width: 80%; z-index:1100;margin-left:10%" class="col-md-11 offset-md-2">
      <svg></svg>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.3/d3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/nvd3/1.8.6/nv.d3.js"></script>
<script src="http://nvd3.org/assets/js/data/stream_layers.js"></script>
<script>

$(document).ready(function() {
nv.addGraph(function() {
    var chart = nv.models.multiBarChart()
      .duration(350)
      .reduceXTicks(true)   //If 'false', every single x-axis tick label will be rendered.
      .rotateLabels(0)      //Angle to rotate x-axis labels.
      .showControls(true)   //Allow user to switch between 'Grouped' and 'Stacked' mode.
      .groupSpacing(0.1)    //Distance between each group of bars.
    ;
    var unitFormat = function(d) { return d3.format(',.1f')(d)  + ' Watt'};

//    chart.xAxis
  //      .tickFormat(d3.format(',f'));

    chart.yAxis
        .tickFormat(unitFormat);

    d3.select('#chart11 svg')
        .datum(
          [
            {
            "key": "Consommation réelle",
            "values": <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
            },
            {
              "key": "Consommation estimée",
              "values": <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
            }
          ]
          )
        .call(chart);

    nv.utils.windowResize(chart.update);

    return chart;
});

});



</script>
@endsection
