<?php
session_start();
$notification = (isset($_SESSION["numberOfBillsNonPaid"])) ? $_SESSION["numberOfBillsNonPaid"] : '';

$mapping_type_services = ['eau' => 'type_service_1', 'electricite' => 'type_service_2', 'tv' => 'type_service_3', 'mobile' => 'type_service_4',
                          'locataire' => 'type_service_5', 'proprietaire' => 'type_service_6', 'scolarite' => 'type_service_7',
                          'sport' => 'type_service_8'];

if($actived_services->{$mapping_type_services[$_SESSION['current_service']]} == 'prepaid')
  $wording_offer = "Prépayée";
if($actived_services->{$mapping_type_services[$_SESSION['current_service']]} == 'postpaid')
  $wording_offer = "Postpayée";
if($actived_services->{$mapping_type_services[$_SESSION['current_service']]} != 'postpaid' and $actived_services->{$mapping_type_services[$_SESSION['current_service']]} != 'prepaid')
  $wording_offer = "Inconnue";
?>

@extends('layouts.appv2', ['notification' => $notification, 'service' => $_SESSION['current_service'], 'services' => $actived_services, 'profilNotif' => $_SESSION['profilNotif']])

@section('content')

<div class="container-fluid page-body-wrapper">
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body" style="text-align:center">
              <h4 class="card-title" >Le contrat est au nom de </h4>
              <strong style="margin-top:10px;text-transform: capitalize;">{{ Auth::user()->first_name.' '.Auth::user()->name}}</strong>
              <div class="panel-heading contract-panel-heading" style="height: 100px;padding-top: 5%;">

               <div class="row" style="height: 100px;">
                <div class="col-xl-3 col-md-6">
                  <div class="card contract-header-card">
                    <!-- Card body -->
                    <div class="card-body-contract">
                      <div class="row" style="margin-left: 1%;">
                        <div class="col-md-8">
                          <h5 class="card-title text-uppercase text-muted mb-0">Type d'offre</h5>
                          <span class="h4 font-weight-bold mb-0">{{ $wording_offer }}</span>
                        </div>
                        <div class="col-auto">
                          <div>
                            <i class="fas fa-id-badge fa-3x contract-header-icon" style="color: rgba(77,138,185,1);"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-md-6">
                  <div class="card contract-header-card">
                    <!-- Card body -->
                    <div class="card-body-contract">
                      <div class="row" style="margin-left: 1%;">
                        <div class="col-md-8">
                          <h5 class="card-title text-uppercase text-muted mb-0">Statut du contrat</h5>
                          <span class="h4 font-weight-bold mb-0">{{ ($wording_offer == 'Inconnue') ? 'Inactif' : 'Actif' }}</span>
                        </div>
                        <div class="col-auto">
                          <div>
                            <i class="fas fa-dice-one fa-3x" <?php echo ($wording_offer == "Inconnue") ? 'style="color: red"' : 'style="color: forestgreen"' ?> ></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-md-6">
                  <div class="card contract-header-card">
                    <!-- Card body -->
                    <div class="card-body-contract">
                      <div class="row" style="margin-left: 1%;">
                        <div class="col-md-8">
                          <h5 class="card-title text-uppercase text-muted mb-0">Début du contrat</h5>
                          <span class="h4 font-weight-bold mb-0">@php echo substr(Auth::user()->created_at, 0, 10); @endphp</span>
                        </div>
                        <div class="col-auto">
                          <div>
                            <i class="fas fa-calendar-alt fa-3x" style="color: rgba(77,138,185,1);"></i>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-md-6">
                  <div class="card contract-header-card">
                    <!-- Card body -->
                    <div class="card-body-contract">
                      <div class="row" style="margin-left: 1%;">
                        <div class="col-md-8">
                          <h5 class="card-title text-uppercase text-muted mb-0">Référence contrat</h5>
                          <span class="h4 font-weight-bold mb-0">{{ Auth::user()->customerId }}</span>
                        </div>
                        <div class="col-auto">
                          <div>
                            <i class="fas fa-file-invoice fa-3x " style="color: rgba(77,138,185,1);"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


             </div>
             <div class="panel panel-default contractContentMobile" id= "contract-panel">

                 <div class="panel-body contractContent">
                     @if (session('status'))
                         <div class="alert alert-success">
                             {{ session('status') }}
                         </div>
                     @endif

                     <div class="row" style="margin-bottom:35px">
                       <div class="col-md-9" style="font-size:18px"></div>
                       <div class="col-md-3"><button style="background:grey;color:white" class="btn" disabled="disabled">
                         JE DÉMÉNAGE
                         </button></div>
                   </div>

                   <div class="row  text-center" style="margin-bottom:20px;display: contents;">
                     @if($wording_offer != 'Inconnue')
                       <span class="mdi mdi-check-circle-outline text-success " style="font-size:30px"></span>
                       <p style="color:green;font-size:20px">Contrat actif</p>
                     @endif
                     @if($wording_offer == 'Inconnue')
                       <span class="mdi mdi-close-circle-outline text-danger " style="font-size:30px"></span>
                       <p style="color:red;font-size:20px">Contrat inactif</p>
                     @endif
                   </div>
                   <div class="row  text-center" style="margin-bottom:20px;">
                   <div class="col-md-6" style="margin-bottom:20px;">
                     <p>OFFRE</p>
                     <span class="recapData"><strong>{{ $wording_offer }}</strong></span>
                   </div>

                   <div class="col-md-6" style="margin-bottom:20px;">
                     <p>D&Eacute;TAIL DE VOTRE TARIF</p>
                     <span class="glyphicon glyphicon-download"><strong><a href=""> consulter la grille tarifaire </a></strong></span>
                   </div>
                   </div>
                   <div class="row  text-center" style="margin-bottom:20px;">
                     <div class="col-md-6" style="margin-bottom:20px;">
                       <p>STATUT</p>
                       <span class="recapData"><strong> {{ ($wording_offer == 'Inconnue') ? 'INACTIF' : 'ACTIF' }} </strong></span>
                     </div>

                     <div class="col-md-6" style="margin-bottom:20px;">
                       <p>DATE DE D&Eacute;BUT DU CONTRAT</p>
                       <span class="recapData"><strong> {{Auth::user()->created_at}} </strong></span>
                     </div>
                    </div>
                   <div class="col-md-12" style="margin-bottom:40px;" >
                     <span class="glyphicon glyphicon-minus"> </span>
                   </div>


                   <!--<div class="col-md-6 col-md-offset-0" style="margin-bottom:20px;">
                     <p>POINT DE LIVRAISON</p>
                     <span  class="recapData"><strong>{{Auth::user()->address}}</strong></span>
                   </div>-->
                   <div class="row  text-center" style="margin-bottom:20px;">

                   <div class="col-md-6 col-md-offset-0" style="margin-bottom:20px;">
                     <p>R&Eacute;F&Eacute;RENCE DU CONTRAT</p>
                     <span class="recapData"><strong>{{ Auth::user()->customerId }}</strong></span>
                   </div>
                   @if($_SESSION['current_service'] == 'electricite')
                     <div class="col-md-6 col-md-offset-0" style="margin-bottom:20px;">
                       <p>OPTION ET PUISSANCE SOUSCRITE</p>
                       <span class="recapData"><strong>9 KVA - Base</strong></span>
                     </div>
                   @endif
                   </div>
                   <div class="row  text-center" style="margin-bottom:20px;">

                   <div class="col-md-6 col-md-offset-0" style="margin-bottom:20px;">
                     <p>ADRESSE DE LA RESIDENCE</p>
                     <span class="recapData"><strong>{{ Auth::user()->address }}</strong></span>
                   </div>

                   <div class="col-md-6 col-md-offset-0" style="margin-bottom:20px;">
                     <p>ADRESSE DE FACTURATION</p>
                     <span class="recapData"><strong>{{ Auth::user()->address }}</strong></span>
                   </div>
                   </div>



                   @if($_SESSION['current_service'] == 'eau')
                     <div class="col-md-6 col-md-offset-0" style="margin-bottom:20px;">
                       <p>OFFRE</p>
                       <span class="recapData"><strong>Eau</strong></span>
                     </div>
                   @endif

                   @if($_SESSION['current_service'] == 'tv')
                     <div class="col-md-6 col-md-offset-0" style="margin-bottom:20px;">
                       <p>OFFRE</p>
                       <span class="recapData"><strong>Canal Afrique</strong></span>
                     </div>
                   @endif

                   @if($_SESSION['current_service'] == 'mobile')
                     <div class="col-md-6 col-md-offset-0" style="margin-bottom:20px;">
                       <p>OFFRE</p>
                       <span class="recapData"><strong>Live Box Family</strong></span>
                     </div>
                   @endif

                   @if($_SESSION['current_service'] == 'locataire')
                     <div class="col-md-6 col-md-offset-0" style="margin-bottom:20px;">
                       <p>OFFRE</p>
                       <span class="recapData"><strong>Location</strong></span>
                     </div>
                   @endif

                   <div class="col-md-6 col-md-offset-0" style="margin-bottom:20px;">
                     <p>TYPE DE FACTURATION</p>
                     <span class="recapData"><strong> BIMESTRE </strong></span>
                   </div>

                   <div class="col-md-12" style="margin-bottom:40px;" >
                     <span class="glyphicon glyphicon-minus"> </span>
                   </div>
                   <div class="col-md-12" style="margin-bottom:40px;" >
                     <blockquote class="blockquote blockquote-primary">

                     <p>LIEN DE PARRAINAGE</p>
                     <span>
                       Si vous souhaitez parrainer un(e) proche, vous avez la possibilité
                        de lui partager votre lien personnalisé depuis lequel il ou elle
                        pourra souscrire son contrat <a href="127.0.0.1/parrainage/{{ Auth::user()->customerId }}">ici </a>.
                         Le gain est de 10000 FCFA dans la cagnotte du parrain et 10000 FCFA dans celle du filleul, dès
                         lors que le contrat du filleul aura été activé.
                     </span>
                     </blockquote>
                   </div>

                 </div>


     </div>
     </div>
            </div>

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

@endsection
