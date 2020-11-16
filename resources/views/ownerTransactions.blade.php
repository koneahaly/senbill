<?php
session_start();
$_SESSION["numberOfBillsNonPaid"] = $numberOfBillsNonPaid;
$notification = (isset($_SESSION["numberOfBillsNonPaid"])) ? $_SESSION["numberOfBillsNonPaid"] : '';
?>
@extends('layouts.realEstate', ['notification' => $notification, 'services' => $actived_services])

@section('content')
<div class="container">
  <div class="row lottie-lines" style="margin-top:4%;">
      <lottie-player src="{{url('images/lottie/lines.json')}}"  background="transparent"  speed="0.1"  style="width: 500px; height: 500px; position:absolute;z-index:1000;margin-left:-20%;margin-top: 2.5%;"  loop  autoplay></lottie-player>
      <lottie-player src="{{url('images/lottie/lines.json')}}"  background="transparent"  speed="0.1"  style="width: 500px; height: 500px; position:absolute;z-index:1000;margin-left:70%;margin-top: 2.5%;"  loop  autoplay></lottie-player>
  </div>
  <!--TITLE OF THE PAGE-->
  <div class="row rowmobile" style="margin-top:14%;z-index: 1100;">
  <div class="col-md-12" style="margin-top:10px;margin-bottom:20px;text-align:center;">
   <h3><strong>Transactions</strong></h3>
 </div>
  </div>
  <lottie-player src="{{url('images/lottie/bubble.json')}}" class="lottie-bubbles" background="transparent"  speed="1"  style="width: 80px; height: 80px; position:absolute;z-index:1000;margin-left:-8%;margin-top: 15%;"  loop  autoplay></lottie-player>
  <lottie-player src="{{url('images/lottie/bubble.json')}}" class="lottie-bubbles" background="transparent"  speed="1"  style="width: 100px; height: 100px; position:absolute;z-index:1000;margin-left:84%;margin-top: -8%;"  loop  autoplay></lottie-player>
  <lottie-player src="{{url('images/lottie/bubble.json')}}" class="lottie-bubbles" background="transparent"  speed="1"  style="width: 60px; height: 60px; position:absolute;z-index:1000;margin-left:1%;margin-top: -2%;"  loop  autoplay></lottie-player>
<!-- END TITLE OF THE PAGE-->

  <!--<h4>TABLEAU DES TRANSACTIONS  </h4> -->
<div class="row">
  <div class="col-md-12">
    <br/>
      <table id="transTable" class="mdl-data-table"  width=100% style="width:100%;z-index: 1100;">
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
          @foreach($data_bills as $value)
            <tr>
              <td> {{ $value->deadline }}</td>
              <td> <span style="color: #4a49b0;font-size: 16px;">{{ $value->title}} </span>
                <div> Propriété: {{ $data_infos_housing[$value->customerId][2] }}</div>
              </td>
              <td><i class="fas fa-user-circle fa-2x reIcon"></i>
                <span style="font-size: 12px;color: #0f541b;">{{ $data_infos_housing[$value->customerId][1] }}</span>
              </td>
              <td class="reAmount"><span class="green">+</span> {{ $value->amount }} FCFA </td>
                <td style="color:#28863e;font-weight: 700;"> {{ $value->status }} </td>
                <td> {{ ($value->status == 'paid') ? $value->payment_method  : 'n/a'}}</td>
            </tr>
          @endforeach
            <!--<tr>
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
            </tr>-->
        </tbody>
      </table>
  </div>
  </div>

</div>
<?php
$id = explode('/',$_SERVER['REQUEST_URI']);
if(!empty($id[2])){
  $filter_name = '"search": {
    "search": "'.$data_infos_housing[$id[2]][1].'"
  },';
}
else{
  $filter_name = '';
}
 ?>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
@endsection
@section('scripts')
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.material.min.js"></script>
<script>
$(document).ready(function() {
    $('#transTable').DataTable( {
        <?php echo $filter_name; ?>
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
