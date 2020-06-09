<?php
session_start();
$notification = (isset($_SESSION["numberOfBillsNonPaid"])) ? $_SESSION["numberOfBillsNonPaid"] : '';
?>

@extends('layouts.app', ['notification' => $notification])

@section('content')
<div class="container">
    <div class="row" style="margin-top:10%">
        <div class="col-md-8 col-md-offset-2">
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
                      <span class="h4 font-weight-bold mb-0">@php $wording_offer = (Auth::user()->user_type == 2) ? "Woyofal" : "Classique"; echo $wording_offer; @endphp</span>
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
                      <span class="h4 font-weight-bold mb-0">Actif</span>
                    </div>
                    <div class="col-auto">
                      <div>
                        <i class="fas fa-dice-one fa-3x" style="color: forestgreen;"></i>
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
            <div class="panel panel-default" id= "contract-panel">

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
                    <span class="glyphicon glyphicon-ok-circle text-success " style="font-size:30px"></span>
                    <p style="color:green;margin-left:-3%;font-size:20px">Contrat actif</p>
                  </div>

                  <div class="col-md-6" style="margin-bottom:20px;">
                    <p>OFFRE</p>
                    <span class="recapData"><strong>@php $wording_offer = (Auth::user()->user_type == 2) ? "Woyofal" : "Classique"; echo $wording_offer; @endphp</strong></span>
                  </div>

                  <div class="col-md-6" style="margin-bottom:20px;">
                    <p>D&Eacute;TAIL DE VOTRE TARIF</p>
                    <span class="glyphicon glyphicon-download"><strong><a href=""> consulter la grille tarifaire </a></strong></span>
                  </div>

                  <div class="col-md-6" style="margin-bottom:20px;">
                    <p>STATUT</p>
                    <span class="recapData"><strong> ACTIF </strong></span>
                  </div>

                  <div class="col-md-6" style="margin-bottom:20px;">
                    <p>DATE DE D&Eacute;BUT DU CONTRAT</p>
                    <span class="recapData"><strong> {{Auth::user()->created_at}} </strong></span>
                  </div>

                  <div class="col-md-12" style="margin-bottom:40px;" >
                    <span class="glyphicon glyphicon-minus"> </span>
                  </div>


                  <div class="col-md-6 col-md-offset-0" style="margin-bottom:20px;">
                    <p>POINT DE LIVRAISON</p>
                    <span  class="recapData"><strong>{{Auth::user()->address}}</strong></span>
                  </div>

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

                  <div class="col-md-6 col-md-offset-0" style="margin-bottom:20px;">
                    <p>OPTION ET PUISSANCE SOUSCRITE</p>
                    <span class="recapData"><strong>9 KVA - Base</strong></span>
                  </div>
                  <div class="col-md-6 col-md-offset-0" style="margin-bottom:20px;">
                    <p>TYPE DE FACTURATION</p>
                    <span class="recapData"><strong> BIMESTRE </strong></span>
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
                        Le gain est de 10000FCFA dans la cagnotte du parrain et 10000FCFA dans celle du filleul, dès
                        lors que le contrat du filleul aura été activé.
                    </span>
                  </div>



                </div>


    </div>

    </div>
</div>
@endsection
