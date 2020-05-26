<?php
session_start();
$notification = (isset($_SESSION["numberOfBillsNonPaid"])) ? $_SESSION["numberOfBillsNonPaid"] : '';
?>

@extends('layouts.app', ['notification' => $notification])

@section('content')
<div class="container">
    <div class="row" style="margin-top:10%">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel-heading" style="margin-top:10px;margin-bottom:20px;line-height: 2.4;">
            <h3>Le contrat est au nom de </h3>
           <strong style="margin-top:10px">{{ Auth::user()->first_name.' '.Auth::user()->name}}</strong></div>
            <div class="panel panel-default">

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
                    <span><strong>@php $wording_offer = (Auth::user()->user_type == 2) ? "Woyofal" : "Classique"; echo $wording_offer; @endphp</strong></span>
                  </div>

                  <div class="col-md-6" style="margin-bottom:20px;">
                    <p>D&Eacute;TAIL DE VOTRE TARIF</p>
                    <span class="glyphicon glyphicon-download"><strong><a href=""> consulter la grille tarifaire </a></strong></span>
                  </div>

                  <div class="col-md-6" style="margin-bottom:20px;">
                    <p>STATUT</p>
                    <span><strong> ACTIF </strong></span>
                  </div>

                  <div class="col-md-6" style="margin-bottom:20px;">
                    <p>DATE DE D&Eacute;BUT DU CONTRAT</p>
                    <span><strong> {{Auth::user()->created_at}} </strong></span>
                  </div>

                  <div class="col-md-12" style="margin-bottom:40px;" >
                    <span class="glyphicon glyphicon-minus"> </span>
                  </div>


                  <div class="col-md-6 col-md-offset-0" style="margin-bottom:20px;">
                    <p>POINT DE LIVRAISON</p>
                    <span><strong>{{Auth::user()->address}}</strong></span>
                  </div>

                  <div class="col-md-6 col-md-offset-0" style="margin-bottom:20px;">
                    <p>R&Eacute;F&Eacute;RENCE DU CONTRAT</p>
                    <span><strong>{{ Auth::user()->customerId }}</strong></span>
                  </div>

                  <div class="col-md-6 col-md-offset-0" style="margin-bottom:20px;">
                    <p>ADRESSE DE LA RESIDENCE</p>
                    <span><strong>{{ Auth::user()->address }}</strong></span>
                  </div>

                  <div class="col-md-6 col-md-offset-0" style="margin-bottom:20px;">
                    <p>ADRESSE DE FACTURATION</p>
                    <span><strong>{{ Auth::user()->address }}</strong></span>
                  </div>

                  <div class="col-md-6 col-md-offset-0" style="margin-bottom:20px;">
                    <p>OPTION ET PUISSANCE SOUSCRITE</p>
                    <span><strong>9 KVA - Base</strong></span>
                  </div>
                  <div class="col-md-6 col-md-offset-0" style="margin-bottom:20px;">
                    <p>TYPE DE FACTURATION</p>
                    <span><strong> BIMESTRE </strong></span>
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
                        Le gain est de 20€ dans la cagnotte du parrain et 20€ dans celle du filleul, dès
                        lors que le contrat du filleul aura été activé.
                    </span>
                  </div>



                </div>


    </div>

    </div>
</div>
@endsection
