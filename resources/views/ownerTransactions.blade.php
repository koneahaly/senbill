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
   <h3><strong>Transactions</strong></h3>
   <div>
     <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
     <lottie-player src="{{url('images/lottie/transactions1.json')}}"  background="transparent"  speed="1"  style="width: 200px; height: 100px;display: inline-block;"  loop  autoplay></lottie-player>
   </div>
 </div>
  </div>
<!-- END TITLE OF THE PAGE-->

  <!--<h4>TABLEAU DES TRANSACTIONS  </h4> -->
<div class="row">
  <div class="col-md-12">
    <br/>
      <table id="transTable" class="mdl-data-table" style="width:100%">
        <thead style="background: rgba(137,180,213,1);color:#fff">
            <tr>
              <th>Date d'échéance</th>
              <th>Motif</th>
              <th>Locataire</th>
              <th>Montant</th>
              <th>Etat du paiement</th>
              <th>Moyen de paiement</th>
            </tr>
        </thead>
        <tbody style="background-color:#fff;color:#455469">
            <tr>
              <td> 10/08/2020</td>
              <td> <span style="color: #4a49b0;font-size: 16px;">Garantie </span>
                <div> Propriété: Maison HLM</div>
              </td>
              <td><i class="fas fa-user-circle fa-2x reIcon"></i>
                <span style="font-size: 12px;color: #0f541b;">Modou Fofana </span>
              </td>
              <td class="reAmount"><span class="green">+</span> 625000 FCFA </td>
                <td style="color:#28863e;font-weight: 700;"> payé </td>
                <td> Orange Money</td>
            </tr>
            <tr>
              <td> 10/09/2020 </td>
              <td><span style="color: #4a49b0;font-size: 16px;">Loyer </span>
                <div> Propriété: Maison Mariste</div>
              </td>
              <td><i class="fas fa-user-circle fa-2x  reIcon"></i>
                <span style="font-size: 12px;color: #0f541b;">Ahmadou Aly Koné </span>
              </td>
              <td class="reAmount"><span class="green">+</span> 325000 FCFA </td>
                <td style="color:#28863e;font-weight: 700;"> en attente </td>
                <td> Orange Money</td>
            </tr>
        </tbody>
      </table>
  </div>
  </div>


</div>
@endsection
@section('scripts')
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.material.min.js"></script>
<script>
$(document).ready(function() {
    $('#transTable').DataTable( {
        autoWidth: true,
        columnDefs: [
            {
                targets: ['_all'],
                className: 'mdc-data-table__cell'
            }
        ],
        "paging":   true,
        "lengthChange": false,
        "pageLength": 5,
        "info":     false,
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json"
        }
    } );
} );

</script>

@endsection
