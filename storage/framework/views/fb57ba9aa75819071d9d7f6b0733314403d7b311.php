<?php
session_start();
$notification = (isset($_SESSION["numberOfBillsNonPaid"])) ? $_SESSION["numberOfBillsNonPaid"] : '';
?>
<?php

function calc_month($param){
  $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
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

<link rel="stylesheet" type="text/css" href="<?php echo e(url('css/nv.d3.css')); ?>">
<?php $__env->startSection('content'); ?>

<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body" style="text-align:center">
              <h4 class="card-title" >Mon Suivi de consommation</h4>
              </div>
            </div>
          </div>
          <div id="chart11" style="background: white;height: 700px;" class="col-lg-12 grid-margin stretch-card">
            <svg></svg>
          </div>
        </div>

      </div>
      <!-- content-wrapper ends   -->

      <!-- partial   -->
</div>
<!-- partial:partials/_footer.html   -->
<footer class="footer">
  <div class="footer-wrap">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © services2sn 2020</span>
      <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Solution de <a href="https://www.services2sn.com/" target="_blank">Services2sn.com</a></span>
    </div>
  </div>
</footer>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.3/d3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/nvd3/1.8.6/nv.d3.js"></script>
<script src="http://nvd3.org/assets/js/data/stream_layers.js"></script>
<script>

$(document).ready(function() {
nv.addGraph(function() {
    var screen_width = $(window).width();
    var showControlsBoolean = true;
    if(screen_width <= 480 && screen_width > 320){
      showControlsBoolean = false;
    }

    var chart = nv.models.multiBarChart()
      .duration(350)
      .reduceXTicks(true)   //If 'false', every single x-axis tick label will be rendered.
      .rotateLabels(0)      //Angle to rotate x-axis labels.
      .showControls(showControlsBoolean)   //Allow user to switch between 'Grouped' and 'Stacked' mode.
      .controlLabels({"grouped":"Groupé","stacked":"Empilé"})
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.appv2', ['notification' => $notification, 'service' => $_SESSION['current_service'], 'services' => $actived_services, 'profilNotif' => $_SESSION['profilNotif']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>