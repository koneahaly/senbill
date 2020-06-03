<?php
session_start();
$notification = (isset($_SESSION["numberOfBillsNonPaid"])) ? $_SESSION["numberOfBillsNonPaid"] : '';
?>
@extends('layouts.realEstate', ['notification' => $notification])

@section('content')
<div class="container">
  <!--TITLE OF THE PAGE-->
  <div class="row" style="margin-top:10%">
  <div class="col-md-12" style="margin-top:10px;margin-bottom:20px;text-align:center;">
   <h3><strong>Mes locataires</strong></h3></div>
  </div>
<!-- END TITLE OF THE PAGE-->

  <!--<h4>TABLEAU DES TRANSACTIONS  </h4> -->




</div>
@endsection
