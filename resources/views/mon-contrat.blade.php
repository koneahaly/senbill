<?php
session_start();
$notification = (isset($_SESSION["numberOfBillsNonPaid"])) ? $_SESSION["numberOfBillsNonPaid"] : '';

$mapping_type_services = ['distribution' => 'type_service_1', 'servicepublic' => 'type_service_2', 'telecom' => 'type_service_3', 'sante' => 'type_service_4',
                          'locataire' => 'type_service_5', 'proprietaire' => 'type_service_6', 'scolarite' => 'type_service_7',
                          'sport' => 'type_service_8'];

if($actived_services->{$mapping_type_services[$_SESSION['current_service']]} == 'prepaid')
  $wording_offer = "Prépayée";
if($actived_services->{$mapping_type_services[$_SESSION['current_service']]} == 'postpaid')
  $wording_offer = "Postpayée";
if($actived_services->{$mapping_type_services[$_SESSION['current_service']]} != 'postpaid' and $actived_services->{$mapping_type_services[$_SESSION['current_service']]} != 'prepaid')
  $wording_offer = "Inconnue";
?>

@extends('layouts.app', ['notification' => $notification, 'service' => $_SESSION['current_service'], 'services' => $actived_services, 'profilNotif' => $_SESSION['profilNotif']])

@section('content')
<div class="container">
  <div class="row lottie-lines" style="margin-top:4%;">
  </div>
    <div class="row rowmobile" style="margin-top:10%;z-index: 1100;">
      <lottie-player src="{{url('images/lottie/bubble.json')}}" class="lottie-bubbles"  background="transparent"  speed="1"  style="width: 80px; height: 80px; position:absolute;z-index:1000;margin-left:-8%;margin-top: 18%;"  loop  autoplay></lottie-player>
      <lottie-player src="{{url('images/lottie/bubble.json')}}" class="lottie-bubbles" background="transparent"  speed="1"  style="width: 100px; height: 100px; position:absolute;z-index:1000;margin-left:80%;margin-top: 2.5%;"  loop  autoplay></lottie-player>
      <lottie-player src="{{url('images/lottie/bubble.json')}}" class="lottie-bubbles" background="transparent"  speed="1"  style="width: 60px; height: 60px; position:absolute;z-index:1000;margin-left:1%;margin-top: 2%;"  loop  autoplay></lottie-player>
        <div class="col-md-10 col-md-offset-1">
          <div class="panel-heading contract-panel-heading">
            <h3>Le contrat est au nom de </h3>
           <strong style="margin-top:10px;text-transform: capitalize;">{{ Auth::user()->first_name.' '.Auth::user()->name}}</strong>

           <div class="row" style="margin-left: 1%;">
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
                      <h5 class="card-title text-uppercase text-muted mb-0">Date de cr&eacute;ation du contrat</h5>
                      <span class="h4 font-weight-bold mb-0">{{ ( null !== $actived_contracts) ? substr($actived_contracts->created_at, 0, 10) : '' }}</span>
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

                <div class="panel-body">
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

                  <div class="row  text-center" style="margin-bottom:20px">
                    @if($wording_offer != 'Inconnue')
                      <span class="glyphicon glyphicon-ok-circle text-success " style="font-size:30px"></span>
                      <p style="color:green;margin-left:-3%;font-size:20px">Contrat actif</p>
                    @endif
                    @if($wording_offer == 'Inconnue')
                      <span class="glyphicon glyphicon-remove-circle text-danger " style="font-size:30px"></span>
                      <p style="color:red;margin-left:-3%;font-size:20px">Contrat inactif</p>
                    @endif
                  </div>

                  <div class="col-md-6" style="margin-bottom:20px;">
                    <p>OFFRE</p>
                    <span class="recapData"><strong>{{ $wording_offer }}</strong></span>
                  </div>

                  <div class="col-md-6" style="margin-bottom:20px;">
                    <p>D&Eacute;TAIL DE VOTRE TARIF</p>
                    <span class="glyphicon glyphicon-download"><strong><a href=""> consulter la grille tarifaire </a></strong></span>
                  </div>

                  <div class="col-md-6" style="margin-bottom:20px;">
                    <p>STATUT</p>
                    <span class="recapData"><strong> {{ ($wording_offer == 'Inconnue') ? 'INACTIF' : 'ACTIF' }} </strong></span>
                  </div>

                  <div class="col-md-6" style="margin-bottom:20px;">
                    <p>DATE DE D&Eacute;BUT DU CONTRAT</p>
                    <span class="recapData"><strong> {{ ( null !== $actived_contracts) ? substr($actived_contracts->start_date, 0, 10) : '' }} </strong></span>
                  </div>

                  <div class="col-md-12" style="margin-bottom:40px;" >
                    <span class="glyphicon glyphicon-minus"> </span>
                  </div>


                  <!--<div class="col-md-6 col-md-offset-0" style="margin-bottom:20px;">
                    <p>POINT DE LIVRAISON</p>
                    <span  class="recapData"><strong>{{Auth::user()->address}}</strong></span>
                  </div>-->

                  <div class="col-md-6 col-md-offset-0" style="margin-bottom:20px;">
                    <p>R&Eacute;F&Eacute;RENCE DU CONTRAT</p>
                    <span class="recapData"><strong>{{ Auth::user()->customerId }}</strong></span>
                  </div>

                  <div class="col-md-6 col-md-offset-0" style="margin-bottom:20px;">
                    <p>ADRESSE DE LA RESIDENCE</p>
                    <span class="recapData"><strong>{{ Auth::user()->address }}</strong></span>
                  </div>

                  <div class="col-md-6 col-md-offset-0" style="margin-bottom:20px;">
                    <p>ADRESSE DE FACTURATION</p>
                    <span class="recapData"><strong>{{ Auth::user()->address }}</strong></span>
                  </div>

                  @if($_SESSION['current_service'] == 'electricite')
                    <div class="col-md-6 col-md-offset-0" style="margin-bottom:20px;">
                      <p>OPTION ET PUISSANCE SOUSCRITE</p>
                      <span class="recapData"><strong>9 KVA - Base</strong></span>
                    </div>
                  @endif

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
                    <span class="recapData"><strong> {{ ( null !== $actived_contracts) ? $actived_contracts->frequency : '' }} </strong></span>
                  </div>

                  <div class="col-md-12" style="margin-bottom:40px;" >
                    <span class="glyphicon glyphicon-minus"> </span>
                  </div>
                  <div class="col-md-12" style="margin-bottom:40px;" >
                    <p>LIEN DE PARRAINAGE</p>
                    <span>
                      Si vous souhaitez parrainer un(e) proche, vous avez la possibilité
                       de lui partager votre lien personnalisé depuis lequel il ou elle
                       pourra souscrire son contrat <a href="127.0.0.1/parrainage/{{ Auth::user()->customerId }}">ici </a>.
                        Le gain est de 10000 FCFA dans la cagnotte du parrain et 10000 FCFA dans celle du filleul, dès
                        lors que le contrat du filleul aura été activé.
                    </span>
                  </div>



                </div>


    </div>

    </div>
</div>
</div>
@endsection
