<?php
session_start();
$notification = (isset($_SESSION["numberOfBillsNonPaid"])) ? $_SESSION["numberOfBillsNonPaid"] : '';
?>
@extends('layouts.realEstate', ['notification' => $notification, 'services' => $actived_services, 'profilNotif' => $_SESSION['profilNotif']])

@section('content')


<div class="container">
  <div class="row rowloc rowmobile" style="margin-top:14%;z-index: 1100;">
  <div class="col-md-12" style="margin-top:10px;margin-bottom:20px;text-align:center;">
   <h3><strong>Mes informations personnelles</strong></h3></div>
  </div>

    <div class="row" style="margin-top:50px;z-index: 1100;">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default personalInfoPanel">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('infos-proprietaire') }}">
                      {{csrf_field()}}
                      <div class="row" style="margin-bottom:35px">
                        <div class="col-md-7" style="font-size:18px"> <strong>Mes données personnelles</strong></div>
                        <div class="col-md-3">
                          <button style="background:rgba(137,180,213,1);color:white" class="btn btn-sm">
                            <span class="glyphicon glyphicon-edit">
                            </span>Modifier mes données personnelles
                          </button>
                          <input type="hidden" name="update_perso_data" value="true"/>
                        </div>
                      <!-- <ul>
                          <li><strong>Nomm: </strong> {{ Auth::user()->name }}</li>
                          <li><strong>Type de client:</strong> Classique</li>
                          <li><strong>Adresse mail: </strong> {{ Auth::user()->email }}</li>
                          <li><strong>Numéro de compteur: </strong>{{ Auth::user()->customerId }}</li>
                          <li><strong>Adresse de facturation: </strong> {{Auth::user()->address}}  </li>
                      </ul> -->
                      </div>
                    </form>
                  @if(!isset($_POST['update_perso_data']))
                    <div style="margin-left:2%;margin-bottom:10px">
                      <p><strong>CIVILITE</strong></p>
                      <span class="recapData">{{ Auth::user()->civilite }}</span>
                    </div>
                  <div class="col-md-6" style="margin-bottom:10px">
                    <p><strong>PRENOM</strong></p>
                    <span class="recapData">{{ Auth::user()->first_name }}</span>
                  </div>

                  <div class="col-md-6" style="margin-bottom:10px">
                    <p><strong>NOM</strong></p>
                    <span class="recapData">{{ Auth::user()->name }}</span>
                  </div>

                  <div class="col-md-6" style="margin-bottom:10px">
                    <p><strong>CNI</strong></p>
                    <span class="recapData">{{Auth::user()->customerId}}</span>
                  </div>


                  <div class="col-md-6" style="margin-bottom:10px">
                    <p><strong>ADRESSE</strong></p>
                    <span class="recapData">{{Auth::user()->address}}</span>
                  </div>

                    <div class="row" style="margin-bottom:10px;margin-left:18px">
                      <p><strong>RECEVOIR LA NEWSLETTER</strong></p>
                      <span class="recapData">OUI</span>
                    </div>
                  @endif

                  @if(isset($_POST['update_perso_data']))
                  <form method="post" action="{{ route('infos-proprietaire.update') }}">
                    {{csrf_field()}}
                    <div class="row" style="margin-bottom:2px;margin-left:5px">
                        <div class="form-group col-md-3">
                          <label for="exampleFormControlSelect1">CIVILITE</label>
                          <select class="form-control" name="salutation" id="exampleFormControlSelect1">
                            <option value="" disabled="disabled">--Votre civilité--</option>
                            @if(Auth::user()->civilite == 'Mme')
                              <option value="Mme">Madame</option>
                              <option value="Mr">Monsieur</option>
                            @endif
                            @if(Auth::user()->civilite == 'Mr')
                              <option value="Mr">Monsieur</option>
                              <option value="Mme">Madame</option>
                            @endif
                          </select>
                        </div>
                      </div>

                    <div class="col-md-6" style="margin-bottom:10px">
                      <p><strong>PRENOM:</strong></p>
                      <input pattern="[a-zA-Z ]{2,30}" title="le prénom renseigné n'est pas correct." class="col-form-label" name="first_name" value="{{ Auth::user()->first_name }}" style="border-bottom:3px solid #084f78 !important" required>
                    </div>

                    <div class="col-md-6" style="margin-bottom:10px">
                      <p><strong>NOM:</strong></p>
                      <input pattern="[a-zA-Z ]{2,30}" title="le nom renseigné n'est pas correct." class="col-form-label" name="name" value="{{ Auth::user()->name }}" style="border-bottom:3px solid #084f78 !important" required>
                    </div>


                    <div class="col-md-6" style="margin-bottom:10px">
                      <p><strong>ADRESSE DE FACTURATION:</strong></p>
                      <input pattern="(?=.*[-a-zA-Z0-9]?){1,5}(([,. ]?){1}[-a-zA-Z0-9àâäéèêëïîôöùûüç'°]+)*" title="l'adresse renseigné n'est pas valide." class="col-form-label" name="address" value="{{Auth::user()->address}}" style="border-bottom:3px solid #084f78 !important" required>
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
                    <input type="hidden" name="page" value="proprietaire" />
                  </form>
                  @endif

                </div>
            </div>
            <div class="panel panel-default personalInfoPanel">
              <div class="panel-body">
                <div class="row" style="margin-bottom:35px">
                  <div class="col-md-7" style="font-size:18px"> <strong>Mes coordonnées de contact</strong></div>
                </div>


                @if(!isset($_POST['update_email']))
                  <form method="post" action="{{ route('infos-proprietaire') }}">
                    {{csrf_field()}}
                    <div class="col-md-6" style="margin-bottom:10px">
                    <p><strong>EMAIL</strong>
                      @if (empty(Auth::user()->date_verify_email))
                        <i style="color:red" itle="Veuillez valider votre adresse mail en cliquant le lien de vérification depuis votre compte email" class="fas fa-exclamation-circle"></i>
                      @endif
                      </p>
                      <span class="recapData">{{ Auth::user()->email }}</span>
                      <div>
                        <button style="background:rgba(137,180,213,1);color:white;margin-top:8px" class="btn">
                          <span class="glyphicon glyphicon-edit"></span> Modifier
                        </button>
                      </div>
                    </div>
                    <input type="hidden" name="update_email" value="true"/>
                    <input type="hidden" name="page" value="proprietaire" />
                  </form>
                @endif

                @if(isset($_POST['update_email']))
                  <form method="post" action="{{ route('infos-proprietaire.update') }}">
                    {{csrf_field()}}
                    <div class="col-md-6" style="margin-bottom:10px">
                      <p><strong>EMAIL:</strong></p>
                      <input pattern="\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+" title="l'adresse mail n'est pas valide." class="col-form-label" name="email" value="{{Auth::user()->email}}" style="border-bottom:3px solid #084f78 !important">
                      <div>
                        <button type="submit" name="action_email" value='save' style="margin-top:8px" class="btn btn-primary">
                          <span class="glyphicon glyphicon-edit"></span> Enregistrer
                        </button>
                        <button type="submit" name="action_email" value='cancel' style="margin-top:8px" class="btn btn-warning">
                          <span class="glyphicon glyphicon-edit"></span> Annuler
                        </button>
                      </div>
                    </div>
                    <input type="hidden" name="page" value="proprietaire" />
                  </form>
                @endif

                @if(!isset($_POST['update_phone']))
                    <div class="col-md-6" style="margin-bottom:10px">
                        <p><strong>T&Eacute;L&Eacute;PHONE</strong>
                        @if (empty(Auth::user()->date_activation_code))
                          <i style="color:red" title="Veuillez valider votre numéro de téléphone en cliquant sur le bouton vérifier" class="fas fa-exclamation-circle"></i>
                        @endif
                        </p>
                      <span class="recapData">{{ Auth::user()->phone }}</span>
                      @if (!empty(Auth::user()->date_activation_code))
                        <span class="glyphicon glyphicon-ok-circle text-success " style="font-size:15px"></span>
                      @endif
                      <div class="row">
                        @if (empty(Auth::user()->date_activation_code))
                        <div class="col-md-3">
                          @if (Auth::user()->attempt_sms_sent < 3)
                            <form method="post" action="../infos-proprietaire">
                              {{csrf_field()}}
                              <button class="btn btn-success" style="color:white;margin-top:8px">
                                <span class="glyphicon glyphicon-saved"></span> Vérifier
                              </button>
                              <input type="hidden" name="verify_phone" value="yes"/>
                              <input type="hidden" name="phone" value="{{ Auth::user()->phone }}"/>
                              <input type="hidden" name="service" value="propriétaire"/>
                            </form>
                          @endif
                      </div>
                        @endif
                        <div class="col-md-3">
                          <form method="post" action="../infos-proprietaire">
                            {{csrf_field()}}
                            <button style="background:rgba(137,180,213,1);color:white;margin-top:8px" class="btn">
                              <span class="glyphicon glyphicon-edit"></span> Modifier
                            </button>
                            <input type="hidden" name="update_phone" value="true"/>
                            <input type="hidden" name="service" value="propriétaire"/>
                          </form>
                        </div> 
                      </div>
                    </div>
                @endif

                @if(isset($_POST['update_phone']))
                  <form method="post" action="{{ route('infos-proprietaire.update') }}">
                    {{csrf_field()}}
                    <div class="col-md-6" style="margin-bottom:10px">
                      <p><strong>PHONE:</strong></p>
                      <input <input pattern="(\+[1-9]{1}[0-9]{3,14}) |([0-9]{9,14})" title="le numéro de téléphone n'est pas valide." class="col-form-label" name="phone" value="{{Auth::user()->phone}}" style="border-bottom:3px solid #084f78 !important">
                      <div>
                        <button type="submit" name="action_phone" value='save' style="margin-top:8px" class="btn btn-primary">
                          <span class="glyphicon glyphicon-edit"></span> Enregistrer
                        </button>
                        <button type="submit" name="action_phone" value='cancel' style="margin-top:8px" class="btn btn-warning">
                          <span class="glyphicon glyphicon-edit"></span> Annuler
                        </button>
                      </div>
                    </div>
                    <input type="hidden" name="page" value="proprietaire" />
                  </form>
                @endif


            </div>
        </div>
        <!-- les infos banciares -->

        <div class="panel panel-default personalInfoPanel">
          <div class="panel-body">
            <div class="row" style="margin-bottom:35px">
              <div class="col-md-6" style="font-size:18px"> <strong>Mes informations bancaires</strong></div>
            </div>
            <div class="col-md-7" style="margin-bottom:10px;">
              <p><strong>ADRESSE DE FACTURATION:</strong></p>
              <span class="recapData"><strong>{{ Auth::user()->address }}</strong></span>
              </div>
              <div class="col-md-3">
                <button style="background:rgba(137,180,213,1);color:white;margin-top:8px" class="btn btn-sm" disabled="disabled">
                  <span class="glyphicon glyphicon-edit"> </span> Ajouter un moyen de paiement
                </button>
              </div>


              <div class="col-md-6" style="margin-bottom:10px">
                <p><strong>MOYEN DE PAIEMENT:</strong></p>
                <span>Compte OrangeMoney : <strong class="recapData">{{ substr(Auth::user()->phone,0,2) }}******{{ substr(Auth::user()->phone,-2,2) }}</strong> </br>
                Paiement :<strong class="recapData"> ponctuel</strong> <br />
                Statut : <strong style="color:green"> Valide</strong></span>
                <div>
                  <button style="background:rgba(137,180,213,1);color:white;margin-top:8px" class="btn" disabled="disabled">
                  <span class="glyphicon glyphicon-edit"></span> Modifier
                  </button></div>
              </div>


        </div>
    </div>

    </div>
</div>
</div>

<div class="modal fade" id="exampleModal" style="top:20%" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="../infos-proprietaire">
      {{csrf_field()}}
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Vérification du numéro de téléphone</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input name="verification_code" type="text" placeholder="code à 5 chiffres" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">Vérifier</button>
        <input type="hidden" name="verify" value="yes" />
      </div>
    </div>
  </form>
  </div>
</div>

<?php

if($withPopup == "true"){
  echo '<script>
        $(document).ready(function() {
          $("#exampleModal").modal("show");
      });
  </script>';
}
 ?>

@endsection
