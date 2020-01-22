@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="panel-heading" style="margin-top:10px;margin-bottom:20px">MES INFORMATIONS PERSONNELLES</div>
            <div class="panel panel-default">

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row" style="margin-bottom:35px">
                      <div class="col-md-7" style="font-size:18px"> <strong>Mes données personnelles</strong></div>
                      <div class="col-md-3"><button style="background:grey;color:white" class="btn btn-sm">
                        <span class="glyphicon glyphicon-edit">
                        </span> Modifier mes données personnelles
                        </button></div>
                    <!-- <ul>
                        <li><strong>Nom: </strong> {{ Auth::user()->name }}</li>
                        <li><strong>Type de client:</strong> Classique</li>
                        <li><strong>Adresse mail: </strong> {{ Auth::user()->email }}</li>
                        <li><strong>Numéro de compteur: </strong>{{ Auth::user()->customerId }}</li>
                        <li><strong>Adresse de facturation: </strong> {{Auth::user()->address}}  </li>
                    </ul> -->
                  </div>
                  <div class="row" style="margin-bottom:10px;margin-left:18px">
                    <p><strong>CIVILITE</strong></p>
                    <span>Monsieur</span>
                  </div>

                  <div class="row" style="margin-bottom:10px;margin-left:18px">
                    <p><strong>NOM</strong></p>
                    <span> {{ Auth::user()->name }}</span>
                  </div>

                  <div class="row" style="margin-bottom:10px;margin-left:18px">
                    <p><strong>PRENOM</strong></p>
                    <span> {{ Auth::user()->name }}</span>
                  </div>

                  <!-- <div class="row" style="margin-bottom:10px;margin-left:30px">
                    <p><strong>ADRESSE MAIL</strong></p>
                    <span>{{ Auth::user()->email }}</span>
                  </div> -->

                  <div class="row" style="margin-bottom:10px;margin-left:18px">
                    <p><strong>ADRESSE DE FACTURATION</strong></p>
                    <span>{{Auth::user()->address}}</span>
                  </div>

                  <div class="row" style="margin-bottom:10px;margin-left:18px">
                    <p><strong>RECEVOIR LA NEWSLETTER</strong></p>
                    <span>OUI</span>
                  </div>

                </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="row" style="margin-bottom:35px">
                  <div class="col-md-7" style="font-size:18px"> <strong>Mes coordonnées de contact</strong></div>
                </div>
                <div class="col-md-6" style="margin-bottom:10px">
                  <p><strong>EMAIL</strong></p>
                  <span>{{ Auth::user()->email }}</span>
                  <div>
                    <button style="background:grey;color:white;margin-top:8px" class="btn">
                      <span class="glyphicon glyphicon-edit"></span> Modifier
                    </button></div>
                </div>


                <div class="col-md-6" style="margin-bottom:10px">
                  <p><strong>TELEPHONE</strong></p>
                  <span>{{ Auth::user()->phone }}</span>
                  <div>
                    <button style="background:grey;color:white;margin-top:8px" class="btn">
                    <span class="glyphicon glyphicon-edit"></span> Modifier
                    </button></div>
                </div>


            </div>
        </div>
        <!-- les infos banciares -->

        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row" style="margin-bottom:35px">
              <div class="col-md-6" style="font-size:18px"> <strong>Mes informations bancaires</strong></div>
            </div>
            <div class="col-md-7" style="margin-bottom:10px;">
              <p><strong>ADRESSE DE FACTURATION</strong></p>
              <span>{{ Auth::user()->address }}</span>
              </div>
              <div class="col-md-3">
                <button style="background:grey;color:white;margin-top:8px" class="btn btn-sm">
                  <span class="glyphicon glyphicon-edit"> </span> Ajouter un moyen de paiement
                </button>
              </div>


            <div class="col-md-6" style="margin-bottom:10px">
              <p><strong>MOYEN DE PAIEMENT</strong></p>
              <span>Compte OrangeBank : 06******45 </br>
              Paiement : récurrent <br />
              Statut : Valide</span>
              <div>
                <button style="background:grey;color:white;margin-top:8px" class="btn">
                <span class="glyphicon glyphicon-edit"></span> Modifier
                </button></div>
            </div>


        </div>
    </div>

    </div>
</div>
@endsection
