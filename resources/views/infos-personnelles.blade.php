<?php
session_start();
$notification = (isset($_SESSION["numberOfBillsNonPaid"])) ? $_SESSION["numberOfBillsNonPaid"] : '';
?>

@extends('layouts.app', ['notification' => $notification])

@section('content')


<div class="container">
  <div class="row" style="margin-top:10%">
  <div class="col-md-12" style="margin-top:10px;margin-bottom:20px;text-align:center;">
   <h3><strong>Mes informations personnelles</strong></h3></div>
  </div>

    <div class="row" style="margin-top:50px">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('infos-personnelles') }}">
                      {{csrf_field()}}
                      <div class="row" style="margin-bottom:35px">
                        <div class="col-md-7" style="font-size:18px"> <strong>Mes données personnelles</strong></div>
                        <div class="col-md-3">
                          <button style="background:grey;color:white" class="btn btn-sm">
                            <span class="glyphicon glyphicon-edit">
                            </span>Modifier mes données personnelles
                          </button>
                          <input type="hidden" name="update_perso_data" value="true"/>
                        </div>
                      <!-- <ul>
                          <li><strong>Nom: </strong> {{ Auth::user()->name }}</li>
                          <li><strong>Type de client:</strong> Classique</li>
                          <li><strong>Adresse mail: </strong> {{ Auth::user()->email }}</li>
                          <li><strong>Numéro de compteur: </strong>{{ Auth::user()->customerId }}</li>
                          <li><strong>Adresse de facturation: </strong> {{Auth::user()->address}}  </li>
                      </ul> -->
                      </div>
                    </form>
                  @if(!isset($_POST['update_perso_data']))
                    <div class="row" style="margin-bottom:10px;margin-left:18px">
                      <p><strong>CIVILITE</strong></p>
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
                  @endif

                  @if(isset($_POST['update_perso_data']))
                  <form method="post" action="{{ route('infos-personnelles.update') }}">
                    {{csrf_field()}}
                    <div class="row" style="margin-bottom:2px;margin-left:5px">
                        <div class="form-group col-md-3">
                          <label for="exampleFormControlSelect1">CIVILITE</label>
                          <select class="form-control" name="salutation" id="exampleFormControlSelect1">
                            <option value="" disabled="disabled">--Votre civilité--</option>
                            <option value="madame">Madame</option>
                            <option value="monsieur">Monsieur</option>
                          </select>
                        </div>
                      </div>

                    <div class="row" style="margin-bottom:18px;margin-left:18px">
                      <p><strong>NOM:</strong></p>
                      <input type="text" class="col-form-label" name="name" value="{{ Auth::user()->name }}" style="border-bottom:3px solid #084f78 !important">
                    </div>

                    <div class="row" style="margin-bottom:18px;margin-left:18px">
                      <p><strong>PRENOM:</strong></p>
                      <input type="text" class="col-form-label" name="name" value="{{ Auth::user()->name }}" style="border-bottom:3px solid #084f78 !important">
                    </div>

                    <!-- <div class="row" style="margin-bottom:10px;margin-left:30px">
                      <p><strong>ADRESSE MAIL</strong></p>
                      <span>{{ Auth::user()->email }}</span>
                    </div> -->

                    <div class="row" style="margin-bottom:18px;margin-left:18px">
                      <p><strong>ADRESSE DE FACTURATION:</strong></p>
                      <input type="text" class="col-form-label" name="address" value="{{Auth::user()->address}}" style="border-bottom:3px solid #084f78 !important">
                    </div>
                    <br />
                    <div class="row form-check" style="margin-bottom:10px;margin-left:18px">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">RECEVOIR LA NEWSLETTER</label>
                    </div>
                    <div class="row" style="margin-bottom:10px;margin-left:18px">
                      <button type="submit" name="action" value="save" style="margin-top:8px" class="btn btn-primary">
                        <span class="glyphicon glyphicon-save"></span> Enregister
                      </button>
                      <button type="submit" name="action" value="cancel" style="margin-top:8px" class="btn btn-warning">
                        <span class="glyphicon glyphicon-remove-circle"></span> Annuler
                      </button>
                    </div>
                  </form>
                  @endif

                </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="row" style="margin-bottom:35px">
                  <div class="col-md-7" style="font-size:18px"> <strong>Mes coordonnées de contact</strong></div>
                </div>


                @if(!isset($_POST['update_email']))
                  <form method="post" action="{{ route('infos-personnelles') }}">
                    {{csrf_field()}}
                    <div class="col-md-6" style="margin-bottom:10px">
                      <p><strong>EMAIL</strong></p>
                      <span>{{ Auth::user()->email }}</span>
                      <div>
                        <button style="background:grey;color:white;margin-top:8px" class="btn">
                          <span class="glyphicon glyphicon-edit"></span> Modifier
                        </button>
                      </div>
                    </div>
                    <input type="hidden" name="update_email" value="true"/>
                  </form>
                @endif

                @if(isset($_POST['update_email']))
                  <form method="post" action="{{ route('infos-personnelles.update') }}">
                    {{csrf_field()}}
                    <div class="col-md-6" style="margin-bottom:10px">
                      <p><strong>EMAIL:</strong></p>
                      <input type="text" class="col-form-label" name="email" value="{{Auth::user()->email}}" style="border-bottom:3px solid #084f78 !important">
                      <div>
                        <button type="submit" name="action_email" value='save' style="margin-top:8px" class="btn btn-primary">
                          <span class="glyphicon glyphicon-edit"></span> Enregistrer
                        </button>
                        <button type="submit" name="action_email" value='cancel' style="margin-top:8px" class="btn btn-warning">
                          <span class="glyphicon glyphicon-edit"></span> Annuler
                        </button>
                      </div>
                    </div>
                  </form>
                @endif

                @if(!isset($_POST['update_phone']))
                  <form method="post" action="{{ route('infos-personnelles') }}">
                    {{csrf_field()}}
                    <div class="col-md-6" style="margin-bottom:10px">
                      <p><strong>PHONE</strong></p>
                      <span>{{ Auth::user()->phone }}</span>
                      <div>
                        <button style="background:grey;color:white;margin-top:8px" class="btn">
                          <span class="glyphicon glyphicon-edit"></span> Modifier
                        </button>
                      </div>
                    </div>
                    <input type="hidden" name="update_phone" value="true"/>
                  </form>
                @endif

                @if(isset($_POST['update_phone']))
                  <form method="post" action="{{ route('infos-personnelles.update') }}">
                    {{csrf_field()}}
                    <div class="col-md-6" style="margin-bottom:10px">
                      <p><strong>PHONE:</strong></p>
                      <input type="text" class="col-form-label" name="phone" value="{{Auth::user()->phone}}" style="border-bottom:3px solid #084f78 !important">
                      <div>
                        <button type="submit" name="action_phone" value='save' style="margin-top:8px" class="btn btn-primary">
                          <span class="glyphicon glyphicon-edit"></span> Enregistrer
                        </button>
                        <button type="submit" name="action_phone" value='cancel' style="margin-top:8px" class="btn btn-warning">
                          <span class="glyphicon glyphicon-edit"></span> Annuler
                        </button>
                      </div>
                    </div>
                  </form>
                @endif


            </div>
        </div>
        <!-- les infos banciares -->

        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row" style="margin-bottom:35px">
              <div class="col-md-6" style="font-size:18px"> <strong>Mes informations bancaires</strong></div>
            </div>
            <div class="col-md-7" style="margin-bottom:10px;">
              <p><strong>ADRESSE DE FACTURATION:</strong></p>
              <span><strong>{{ Auth::user()->address }}</strong></span>
              </div>
              <div class="col-md-3">
                <button style="background:grey;color:white;margin-top:8px" class="btn btn-sm" disabled="disabled">
                  <span class="glyphicon glyphicon-edit"> </span> Ajouter un moyen de paiement
                </button>
              </div>


            <div class="col-md-6" style="margin-bottom:10px">
              <p><strong>MOYEN DE PAIEMENT:</strong></p>
              <span>Compte OrangeBank : <strong>06******45</strong> </br>
              Paiement :<strong> récurrent</strong> <br />
              Statut : <strong style="color:green"> Valide</strong></span>
              <div>
                <button style="background:grey;color:white;margin-top:8px" class="btn" disabled="disabled">
                <span class="glyphicon glyphicon-edit"></span> Modifier
                </button></div>
            </div>


        </div>
    </div>

    </div>
</div>
@endsection
