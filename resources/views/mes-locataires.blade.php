<?php
session_start();
$notification = (isset($_SESSION["numberOfBillsNonPaid"])) ? $_SESSION["numberOfBillsNonPaid"] : '';
?>
@extends('layouts.realEstate', ['notification' => $notification, 'services' => $actived_services])

@section('content')
<div class="container">
  <div class="row lottie-lines" style="margin-top:4%; display:none;">
      <lottie-player src="{{url('images/lottie/lines.json')}}"  background="transparent"  speed="0.1"  style="width: 500px; height: 500px; position:absolute;z-index:1000;margin-left:-20%;margin-top: 2.5%;"  loop  autoplay></lottie-player>
      <lottie-player src="{{url('images/lottie/lines.json')}}"  background="transparent"  speed="0.1"  style="width: 500px; height: 500px; position:absolute;z-index:1000;margin-left:70%;margin-top: 2.5%;"  loop  autoplay></lottie-player>
  </div>
  <!--TITLE OF THE PAGE-->
  <div class="row rowloc" style="margin-top:14%;z-index: 1100;">
  <div class="col-md-12" style="margin-top:10px;margin-bottom:20px;text-align:center;flex-basis:100%;max-width:100%;">
   <h3><strong>Mes locataires</strong></h3>
 </div>
  </div>
  <lottie-player src="{{url('images/lottie/bubble.json')}}" class="lottie-bubbles" background="transparent"  speed="1"  style="width: 80px; height: 80px; position:absolute;z-index:1000;margin-left:-8%;margin-top: 15%;"  loop  autoplay></lottie-player>
  <lottie-player src="{{url('images/lottie/bubble.json')}}" class="lottie-bubbles" background="transparent"  speed="1"  style="width: 100px; height: 100px; position:absolute;z-index:1000;margin-left:84%;margin-top: -8%;"  loop  autoplay></lottie-player>
  <lottie-player src="{{url('images/lottie/bubble.json')}}" class="lottie-bubbles" background="transparent"  speed="1"  style="width: 60px; height: 60px; position:absolute;z-index:1000;margin-left:1%;margin-top: -2%;"  loop  autoplay></lottie-player>
<!-- END TITLE OF THE PAGE-->
<!--CONTENT OF THE PAGE-->
  <div class="panel panel-default" style="background-color: #f5f9fc;z-index: 1100;">
    <div class="panel-body propPanelBody">
      <!--<h4>DEBUT HEADER  </h4> -->
      <div class="panel-heading">
      <header-sidebar class="u-fillWidth propHeader">
         <div class="m-header-sidebar propHeader ">
            <div class="sidebar-list">
               <nav-list>
                  <property-nav>
                     <header-list>
                        <div class="m-nav">
                           <div class="m-dots heading">
                              <div></div>
                                 <span>Locataires</span>
                              <!---->
                           </div>
                           <div class="nav-total">
                              <div>
                                 <total> <span>{{ $nb_locataires }}</span> <span style="text-transform:none" > locataire(s) au total</span> </total>
                              </div>
                           </div>

                        </div>
                     </header-list>
                  </property-nav>
               </nav-list>
            </div>
         </div>
      </header-sidebar>
      </div>

  <!--<h4>FIN HEADER  </h4> -->
  <div class="panel-wrapper column">
 <div class="wrapper-list">
    <div class="row">
       <!--   DEBUT CARTE LOCATAIRE 1-->
       @foreach($data_locations as $data_location)
         <div class="col-xs-24 col-sm-12 col-md-8 col-lg-6">
            <div item="item" class="u-flex--flex">
               <div class="m-panel panel-users--list">
                  <div class="m-panel__body">
                     <div class="detail-user">
                        <div class="user-item">
                           <div title="Voir/gérer profil" size="tiny" width="70" >
                              <div class="m-profile-info column">
                                 <div class="profile-img">
                                    <a  title="Voir/gérer profil">
                                       <avatar name="profile-photo"  width="70" size="tiny" class="m-avatar">
                                          <!----> <!--Si civilité = homme alors -->
                                          @if($data_location->civilite == 'Mr')
                                            <img imageonload="" class="img-responsive s-image--loading_success" alt="avatar" src="{{url('images/icon-homme.png')}}">
                                          @endif
                                          @if($data_location->civilite == 'Mme')
                                            <img imageonload="" class="img-responsive s-image--loading_success" alt="avatar" src="{{url('images/icon-femme.png')}}">
                                          @endif
                                       </avatar>
                                    </a>
                                 </div>
                                 <!---->
                                 <div class="info">
                                    <div class="info-name">
                                       <div class="type">
                                       </div>
                                       <div class="name">
                                          <a>
                                             <h2>{{ $data_location->first_name.' '.$data_location->name}}</h2>
                                          </a>
                                          <!----> <!----> <!----> <!---->
                                          <div class="info-status">
                                             <div class="is-connect">
                                                <i class="fas fa-dice-one" style="color:#38c738;"></i>
                                                <!-- SI ANCIEN LOCATAIRE (INACTIF) ALORS
                                                <i class="fas fa-dice-one" style="color:#a1a6b3;"></i>
                                              -->
                                                <div class="m-title-tooltip">
                                                   <div class="tooltip-label">Actif</div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="loc-phone"> <p>{{ $data_location->phone }}</p> </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!----> <!---->
                        <div class="detail-roommates">
                           <!----> <!-- SI ANCIEN LOCATAIRE ALORS REMPLACER  CLASSE occupied par old-->
                           <div class="rent-property occupied">
                              <p>{{ $data_housing_title[$data_location->customerId] }}</p>
                           </div>
                           <!---->
                        </div>
                        <!----> <!---->
                     </div>
                     <div class="move-out">
                        <div class="m-action-btn-icon">
                           <a class="col-xs-12 display_rent rent_{{ $data_location->customerId }}"  title="Loyer"  href="../transactions-proprietaire/{{ $data_location->customerId }}">
                              <div class="icon-svg">
                                 <e-svg-icon set-class="i-svg--master-darker i-svg--24 i-svg--stroke-2" xlink="#icon-line-finance" class="e-svg-icon">
                                    <svg class="i-svg--master-darker i-svg--24 i-svg--stroke-2" id="svgElement" viewBox="0 0 48 48">
                                       <g fill="none" stroke-linecap="round" stroke-miterlimit="10">
                                          <path d="M40 16.84c-2.738-6.11-8.87-10.364-15.999-10.364-9.358 0-16.98 7.342-17.476 16.577"></path>
                                          <path d="M12.36 19.18L7 24l-5-4.82m6 12.456C10.738 37.745 16.872 42 24 42c9.358 0 16.98-7.342 17.475-16.577"></path>
                                          <path d="M35.64 29.296l5.36-4.82 5 4.82m-19.375-9.204s-.883-1.832-3.095-1.857c-3.483-.039-4.976 4.889-.875 6.299 6.355 2.184 4.057 7.291.936 7.32-2.61.023-3.667-1.778-3.781-2.034m3.6-13.805l.081 18.125"></path>
                                       </g>
                                    </svg>
                                 </e-svg-icon>
                              </div>
                              <p>Loyer</p>
                           </a>
                           <a class="col-xs-12 display_contract contract_{{ $data_location->customerId }}" title="Contrat" onclick="openLeaseDetails()">
                              <div class="icon-svg">
                                 <e-svg-icon set-class="i-svg--master-darker i-svg--stroke-2 i-svg--24" xlink="#icon-line-lease" class="e-svg-icon">
                                    <svg class="i-svg--master-darker i-svg--stroke-2 i-svg--24" id="svgElement" viewBox="0 0 48 48">
                                       <g fill="none" stroke-linecap="round" stroke-miterlimit="10">
                                          <path stroke-linejoin="round" d="M31 46H8a2 2 0 01-2-2V4a2 2 0 012-2h32a2 2 0 012 2v34l-11 8z"></path>
                                          <path stroke-linejoin="round" d="M41 38H30v7"></path>
                                          <path d="M19 11h10"></path>
                                          <path stroke-dasharray="4" d="M12 20h24m-24 4h11"></path>
                                          <path stroke-linejoin="round" d="M24.564 30.372a10.519 10.519 0 003.325-1.962c.076.756.15 3.81-.04 4.544s-.704 1.435-1.438 1.629c-.588.154-1.206-.032-1.78-.234l3.85-1.822c.47.336 1.17.086 1.516-.376.346-.462.43-1.062.504-1.635.446.766.736 1.623.846 2.503.248.006.469-.177.581-.398.112-.221.138-.474.162-.72l.344-3.586c-.07 1.58.068 3.17.409 4.716a3.125 3.125 0 001.335-1.52l3.533-1.314"></path>
                                       </g>
                                    </svg>
                                 </e-svg-icon>
                              </div>
                              <p>Contrat</p>
                           </a>
                        </div>
                     </div>
                  </div>
                  <div class="m-panel__footer">
                     <!---->
                     <!----> <a class="m-btn-link--view" href=""></a>
                     <div class="property-view"> <a class="m-btn-link--view modify_occupant occupant_{{ $data_location->customerId }}" title="détails" style="text-transform: none;" onclick="openFormEditLocataire()"> Modifier <i class="far fa-edit"></i></a> </div>
                  </div>
               </div>
            </div>
         </div>
         <input type="hidden" class="modify_nom_{{ $data_location->customerId }}" value="{{ $data_location->name }}" />
         <input type="hidden" class="modify_prenom_{{ $data_location->customerId }}" value="{{ $data_location->first_name }}" />
         <input type="hidden" class="modify_civilite_{{ $data_location->customerId }}" value="{{ $data_location->civilite }}" />
         <input type="hidden" class="modify_dob_{{ $data_location->customerId }}" value="{{ $data_location->dob }}" />
         <input type="hidden" class="modify_pob_{{ $data_location->customerId }}" value="{{ $data_location->pob }}" />
         <input type="hidden" class="modify_email_{{ $data_location->customerId }}" value="{{ $data_location->email }}" />
         <input type="hidden" class="modify_address_{{ $data_location->customerId }}" value="{{ $data_location->address }}" />
         <input type="hidden" class="modify_phone_{{ $data_location->customerId }}" value="{{ $data_location->phone }}" />
         <input type="hidden" class="modify_cni_{{ $data_location->customerId }}" value="{{ $data_location->customerId }}" />

         <input type="hidden" class="modify_caution_{{ $data_location->customerId }}" value="{{ $data_contracts_compact[$data_location->customerId][0] }}" />
         <input type="hidden" class="modify_loyer_{{ $data_location->customerId }}" value="{{ $data_contracts_compact[$data_location->customerId][1] }}" />
         <input type="hidden" class="modify_start_date_{{ $data_location->customerId }}" value="{{ $data_contracts_compact[$data_location->customerId][2] }}" />
         <input type="hidden" class="modify_end_date_{{ $data_location->customerId }}" value="{{ $data_contracts_compact[$data_location->customerId][3] }}" />
         <input type="hidden" class="modify_frequency_{{ $data_location->customerId }}" value="{{ $data_contracts_compact[$data_location->customerId][4] }}" />
         <input type="hidden" class="modify_delay_{{ $data_location->customerId }}" value="{{ $data_contracts_compact[$data_location->customerId][5] }}" />
       @endforeach
        <!-- FIN CARTE LOCATAIRE 1-->
       <!---->
    </div>
 </div>
</div>
@if ($errors->any())
  <div class="alert alert-danger">
    <p style="text-align:center"><strong> L'enregistrement n'a pas pu être effectué !</strong></p>
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif

  </div>


      <!---FORMULAIRE MODIF LOCATAIRE-->
      <div class="container-contact100 loc-edit-popup" id="locEditForm">
        <div class="wrap-contact100">
          <form class="contact100-form validate-form" method="post" action="{{ route('mes-locataires.update') }}">
            {{csrf_field()}}
            <span class="contact100-form-title">
              Modifier un locataire
            </span>
              <div class="wrap-input100 input100-select bg1 rs1-wrap-input100">
                <span class="label-input100">Civilité *</span>
                <div>
                  <select class="js-select-civ" name="civilite">
                    <option disabled>Civilité</option>
                    <option value="Mr">Monsieur</option>
                    <option value="Mme">Madame</option>
                  </select>
                  <div class="dropDownSelect2"></div>
                </div>
              </div>
              <div class="rs1-wrap-input100">
              </div>
            <div class="wrap-input100 validate-input bg1 rs1-wrap-input100 form-group{{ $errors->has('first_name') ? ' has-error' : '' }}" data-validate = "Entrez le prénom">
              <span class="label-input100 control-label">Prénom *</span>
              <input class="input100 update_prenom" type="text" name="first_name" required placeholder="Entrez le prénom du locataire" value="Yacine">
              @if ($errors->has('first_name'))
                  <span class="help-block">
                      <strong>{{ $errors->first('first_name') }}</strong>
                  </span>
              @endif
            </div>

            <div class="wrap-input100 bg1 rs1-wrap-input100 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <span class="label-input100 control-label">Nom *</span>
              <input class="input100 update_nom" type="text" name="name" required  placeholder="Entrez le nom du locataire" value="Ndiaye">
              @if ($errors->has('name'))
                  <span class="help-block">
                      <strong>{{ $errors->first('name') }}</strong>
                  </span>
              @endif
            </div>
            <div class="wrap-input100 input100-select bg1 rs1-wrap-input100">
              <span class="label-input100">Date de naissance </span>
              <input class="input100 update_dob" type="text" name="dateOB" placeholder="Entrez la date" value="03/05/1993">
            </div>
            <div class=" wrap-input100 bg1 rs1-wrap-input100">
              <span class="label-input100">Lieu de naissance </span>
              <input class="input100 update_pob" type="text" name="placeOB" placeholder="Entrez le lieu de naissance du locataire" value="Dakar">
            </div>
            <div class="wrap-input100 validate-input bg1 rs1-wrap-input100 form-group{{ $errors->has('email') ? ' has-error' : '' }}" data-validate = "Entrez l'adresse mail" >
              <span class="label-input100 control-label">Email *</span>
              <input class="input100 update_email" type="email" name="email" placeholder="Entrez l'adresse mail du locataire" value="yacinenana@gmail.com">
              @if ($errors->has('email'))
                  <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
            </div>

            <div class="wrap-input100 bg1 rs1-wrap-input100 form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
              <span class="label-input100 control-label">Téléphone * </span>
              <input class="input100 update_phone" type="tel" pattern="[0-9]{*}" name="phone" required placeholder="Entrez le téléphone du locataire" value="773228879">
              @if ($errors->has('phone'))
                  <span class="help-block">
                      <strong>{{ $errors->first('phone') }}</strong>
                  </span>
              @endif
            </div>
            <div class="wrap-input100 validate-input bg1 form-group{{ $errors->has('customerId') ? ' has-error' : '' }}" data-validate="Entrez svp un cni pour le logement">
              <span class="label-input100 control-label">Numéro CNI *</span>
              <input class="input100 update_cni" type="text" pattern="[0-9,A-Z,a-z]{13}" required name="customerId" placeholder="Entrez le numéro de Carte d'identité nationale du locataire" value="A000305199377">
              @if ($errors->has('customerId'))
                  <span class="help-block">
                      <strong>{{ $errors->first('customerId') }}</strong>
                  </span>
              @endif
            </div>
            <div class="wrap-input100 bg1 rs1-wrap-input100 form-group{{ $errors->has('bail') ? ' has-error' : '' }}">
              <span class="label-input100 control-label">Caution *</span>
              <input class="input100 update_caution" type="number" pattern="[0-9]{0,10}" name="bail" required  placeholder="Entrez le montant de la caution">
              @if ($errors->has('bail'))
                  <span class="help-block">
                      <strong>{{ $errors->first('bail') }}</strong>
                  </span>
              @endif
            </div>
            <div class="wrap-input100 bg1 rs1-wrap-input100 form-group{{ $errors->has('monthly_pm') ? ' has-error' : '' }}">
              <span class="label-input100 control-label">Loyer *</span>
              <input class="input100 update_loyer" type="number" pattern="[0-9]{0,10}" name="monthly_pm" required  placeholder="Entrez le montant du loyer">
              @if ($errors->has('monthly_pm'))
                  <span class="help-block">
                      <strong>{{ $errors->first('monthly_pm') }}</strong>
                  </span>
              @endif
            </div>
            <div class="wrap-input100 bg1 rs1-wrap-input100 form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
              <span class="label-input100 control-label">Date de début *</span>
              <input class="input100 update_start_date" type="text" name="start_date" required value="">
              @if ($errors->has('start_date'))
                  <span class="help-block">
                      <strong>{{ $errors->first('start_date') }}</strong>
                  </span>
              @endif
            </div>
            <div class="wrap-input100 bg1 rs1-wrap-input100">
              <span class="label-input100">Date de fin </span>
              <input class="input100 update_end_date" type="text" name="end_date" value="">
            </div>
            <div class="wrap-input100 input100-select bg1 rs1-wrap-input100">
              <span class="label-input100">Fréquence de paiement *</span>
              <div>
                <select class="js-select-freq update_frequency" name="frequency" required>
                  <option disabled>Fréquence</option>
                  <option value="mensuel">mensuel</option>
                  <option value="bimestriel">bimestriel</option>
                </select>
                <div class="dropDownSelect2"></div>
              </div>
            </div>
            <div class="wrap-input100 bg1 rs1-wrap-input100">
              <span class="label-input100">Délai de paiement *</span>
              <input class="input100 update_delay" type="number" pattern="[0-9]{0,5}" name="delay" required  value="">
            </div>



            <div class="container-contact100-form-btn">
              <button type="submit" class="contact100-form-btn">
                <span>
                  Sauvegarder
                  <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                </span>
              </button>
            </div>
            <input type="hidden" class="occupant_id" name="occupant_id" value="" />
          </form>
        </div>
      </div>

      <!--- FIN FORMULAIRE MODIF LOCATAIRE-->

      <!---DEBUT DETAILS CONTRAT-->
            <div class="container-contact100 leaseDetails-popup" id="leaseDetails">
              <div class="m-panel panel-users--body">
               <div class="m-tabs--users">
                  <a class="tab active"  title="Contrat"  href="">
                     <div class="icon-svg">
                        <e-svg-icon set-class="i-svg--26 i-svg--stroke-2" xlink="#icon-line-lease" class="e-svg-icon">
                           <svg class="i-svg--26 i-svg--stroke-2" id="svgElement" viewBox="0 0 48 48">
                              <g fill="none" stroke-linecap="round" stroke-miterlimit="10">
                                 <path stroke-linejoin="round" d="M31 46H8a2 2 0 01-2-2V4a2 2 0 012-2h32a2 2 0 012 2v34l-11 8z"></path>
                                 <path stroke-linejoin="round" d="M41 38H30v7"></path>
                                 <path d="M19 11h10"></path>
                                 <path stroke-dasharray="4" d="M12 20h24m-24 4h11"></path>
                                 <path stroke-linejoin="round" d="M24.564 30.372a10.519 10.519 0 003.325-1.962c.076.756.15 3.81-.04 4.544s-.704 1.435-1.438 1.629c-.588.154-1.206-.032-1.78-.234l3.85-1.822c.47.336 1.17.086 1.516-.376.346-.462.43-1.062.504-1.635.446.766.736 1.623.846 2.503.248.006.469-.177.581-.398.112-.221.138-.474.162-.72l.344-3.586c-.07 1.58.068 3.17.409 4.716a3.125 3.125 0 001.335-1.52l3.533-1.314"></path>
                              </g>
                           </svg>
                        </e-svg-icon>
                     </div>
                     <span>Contrat</span>
                  </a>
               </div>
               <div class="m-panel__body">
                  <!-- VUE CONTRAT -->
                  <div class="body-leases" >
                     <div class="u-flex--flex">
                        <div class="panel-leases--card">
                           <div class="card-info">
                              <div class="info-address">
                                 <i class="fas fa-map-marker-alt"></i>
                                 <span class="address_contract">Hann Maristes 2 villa Y46</span>
                              </div>
                           </div>
                        </div>
                        <div class="unit">
                           <div>
                              <div class="lease">
                                 <div class="m-panel__heading active">
                                    <div class="heading-title">
                                      <span>Contrat</span>
                                    </div>
                                    <div class="heading-dots">
                                       <div class="title-ended">
                                          <!---->
                                       </div>
                                       <!-- REMPLACER PAR status-inactive si contrat inactif, soit un ancien locataire  -->
                                       <span class="m-status m-r-10 status-active"> Actif </span>
                                    </div>
                                 </div>
                                 <div class="panel-leases panel-leases--view" >
                                    <div item="lease" class="u-flex--flex lease-view">
                                       <div>
                                          <article>
                                             <h5 class="panel-view-title">Informations du locataire</h5>
                                             <section class="lease-residents">
                                                <div class="row">
                                                   <div class="col-xs-24 col-sm-14">
                                                      <div size="tiny" width="56"  class="m-b-10">
                                                         <div class="m-profile-info horizontal">
                                                            <div class="profile-img">
                                                               <a class='avatar'>
                                                                  <avatar name="profile-photo" item="$ctrl.item" width="56" size="tiny" class="m-avatar">
                                                                    <!----> <!--Si civilité = homme alors -->
                                                                    <!--<img imageonload="" class="img-responsive s-image--loading_success avatar_contract_h" alt="avatar" src="{{url('images/icon-homme.png')}}">
                                                                    <img imageonload="" class="img-responsive s-image--loading_success avatar_contract_f" alt="avatar" src="{{url('images/icon-femme.png')}}"> -->
                                                                  </avatar>
                                                               </a>
                                                            </div>
                                                            <div class="info">
                                                               <div class="info-name">
                                                                  <div class="type">
                                                                  </div>
                                                                  <div class="name">
                                                                     <a>
                                                                        <h2 class="full_name_contract">Yacine Ndiaye</h2>
                                                                     </a>
                                                                     <div class="info-status">
                                                                        <div class="is-connect">
                                                                           <i class="fas fa-dice-one" style="color:#38c738;"></i>
                                                                           <!-- SI ANCIEN LOCATAIRE (INACTIF) ALORS
                                                                           <i class="fas fa-dice-one" style="color:#a1a6b3;"></i>
                                                                         -->
                                                                           <div class="m-title-tooltip">
                                                                              <div class="tooltip-label">Actif</div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="loc-phone"> <p class="phone_contract">773228879</p> </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </section>
                                          </article>
                                       </div>
                                       <article class="lease-details">
                                          <h5 class="panel-view-title">Détails de la location</h5>
                                          <div class="row">
                                             <div class="col-xs-24 col-sm-8">
                                                <div class="view-block">
                                                   <h3>Date de début</h3>
                                                   <span class="start_date_contract">03/06/2020</span>
                                                </div>
                                             </div>
                                             <div class="col-xs-24 col-sm-8">
                                                <div class="view-block">
                                                   <h3>Date de fin</h3>
                                                   <span class="end_date_contract">03/06/2021</span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-xs-24 col-sm-8">
                                                <div class="view-block">
                                                   <h3>Type de location</h3>
                                                   <span class="frequency_contract">Mensuel</span>
                                                </div>
                                             </div>
                                          </div>
                                       </article>
                                       <article class="lease-transaction">
                                          <h5 class="panel-view-title">Transactions</h5>
                                          <div>
                                             <section>
                                                <div>
                                                   <div class="row bottom-xs">
                                                      <div class="col-xs-24 col-sm-14">
                                                         <div class="transaction-item">
                                                            <div class="view-block m-b-0">
                                                               <div class="title-block">
                                                                  <h3 class="u-fontSize16">
                                                                     <span>Loyer</span>
                                                                  </h3>
                                                                  <span>
                                                                     <span class="loyer_contract">325 000 FCFA</span><span class="slash_frequency_contract">/ Mois</span>
                                                                  </span>
                                                               </div>
                                                               <div class="title-block">
                                                                  <h3 class="u-fontSize16">Jour d'échéance</h3>
                                                                  <span class="delay_contract"> 5 </span>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>

                                                   </div>
                                                </div>
                                             </section>
                                          </div>
                                          <div>
                                             <section>
                                                <div class="row">
                                                   <div class="col-xs-24 col-sm-14">
                                                      <div class="transaction-item">
                                                         <div class="view-block">
                                                            <div class="title-block">
                                                               <h3 class="u-fontSize16">
                                                                  Caution
                                                               </h3>
                                                               <div class="deposit-block">
                                                                  <div class="title-block deposit-amount"> <span class="amount-total caution_contract">600 000 FCFA</span></div>
                                                                  <!--<div class="title-block">
                                                                     <h3>Payé le</h3>
                                                                     <span>10/06/2020</span>
                                                                  </div>-->
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </section>

                                          </div>
                                       </article>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            </div>

  <!--- FIN DETAILS CONTRAT-->
</div>
<div>
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  <lottie-player src="{{url('images/lottie/pyramid.json')}}"  background="transparent"  speed="1"  style="width: 100%; height: 200px;display: inline-block;"  loop  autoplay></lottie-player>
</div>
</div>
@endsection

@section('scripts')
<script src="{{url('js/mainForm.js')}}"></script>
<script src="{{url('vendor/animsition/js/animsition.min.js')}}"></script>

<!--===============================================================================================-->
<script src="{{url('vendor/select2/select2.min.js')}}"></script>
<script>
$(document).ready(function() {
  $(".js-select-civ,.js-select-freq").each(function(){
    $(this).select2({
      minimumResultsForSearch: 20,
      dropdownParent: $(this).next('.dropDownSelect2')
    });

  })
  } );
</script>
<!--===============================================================================================-->
<script>
  function openFormEditLocataire() {
    if (document.getElementById("leaseDetails").style.display != "none"){
      closeLeaseDetails();
    }
    document.getElementById("locEditForm").style.display = "flex";
  }

  function closeFormEditLocataire() {
    document.getElementById("locEditForm").style.display = "none";
  }
  function openLeaseDetails() {
    if (document.getElementById("locEditForm").style.display != "none"){
      closeFormEditLocataire();
    }
    document.getElementById("leaseDetails").style.display = "flex";
  }

  function closeLeaseDetails() {
    document.getElementById("leaseDetails").style.display = "none";
  }

</script>
<!--===============================================================================================-->
<script src="{{url('vendor/daterangepicker/moment.min.js')}}"></script>
<script src="{{url('vendor/daterangepicker/daterangepicker.js')}}"></script>
<script>
$(function() {
  $('input[name="dateOB"],input[name="start_date"],input[name="end_date"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'),10),
    locale: {
      format: 'DD/MM/YYYY',
    separator: " - ",
        applyLabel: "Valider",
        cancelLabel: "Annuler",
        fromLabel: "De",
        toLabel: "A",
        weekLabel: "S",
        daysOfWeek: [
            "Dim",
            "Lu",
            "Ma",
            "Me",
            "Je",
            "Ve",
            "Sa"
        ],
        monthNames: [
            "Janvier",
            "Février",
            "Mars",
            "Avril",
            "Mai",
            "Juin",
            "Juillet",
            "Août",
            "Septembre",
            "Octobre",
            "Novembre",
            "Décembre"
        ],
        firstDay: 1
    }
  });
});

$(document).ready(function() {
  $('.modify_occupant').click(function(){
    $('option').removeAttr('selected');
    var nameClass = this.className.split(' ');
    var occupant_id = nameClass[2].split('_');
    var civ_occupant = $('.modify_civilite_'+occupant_id[1]).val();
    var nom_occupant = $('.modify_nom_'+occupant_id[1]).val();
    var prenom_occupant = $('.modify_prenom_'+occupant_id[1]).val();
    var dob = $('.modify_dob_'+occupant_id[1]).val();
    var pob = $('.modify_pob_'+occupant_id[1]).val();
    var email_occupant = $('.modify_email_'+occupant_id[1]).val();
    var phone_occupant = $('.modify_phone_'+occupant_id[1]).val();
    var cni_occupant = $('.modify_cni_'+occupant_id[1]).val();

    var cuation_occupant = $('.modify_caution_'+occupant_id[1]).val();
    var loyer_occupant = $('.modify_loyer_'+occupant_id[1]).val();
    var start_date_occupant = $('.modify_start_date_'+occupant_id[1]).val();
    var end_date_occupant = $('.modify_end_date_'+occupant_id[1]).val();
    var delay_occupant = $('.modify_delay_'+occupant_id[1]).val();
    var frequency_occupant = $('.modify_frequency_'+occupant_id[1]).val();

    $('.update_nom').val(nom_occupant);
    $('.update_prenom').val(prenom_occupant);
    $('.update_dob').val(dob);
    $('.update_pob').val(pob).change();
    $("select option[value="+civ_occupant+"]").attr('selected','selected');
    $('.js-select-civ').val(civ_occupant).change();
    $('.update_email').val(email_occupant);
    $('.update_phone').val(phone_occupant);
    $('.update_cni').val(cni_occupant);
    $('.occupant_id').val(occupant_id[1]);

    $('.update_caution').val(cuation_occupant);
    $('.update_loyer').val(loyer_occupant);
    $('.update_start_date').val(start_date_occupant);
    $('.update_end_date').val(end_date_occupant);
    $('.update_delay').val(delay_occupant).change();
    $("select option[value="+frequency_occupant+"]").attr('selected','selected');
    $('.js-select-freq').val(frequency_occupant).change();
  });

  $('.display_contract').click(function(){
    var nameClass = this.className.split(' ');
    var occupant_id = nameClass[2].split('_');
    var civ_occupant = $('.modify_civilite_'+occupant_id[1]).val();
    var nom_occupant = $('.modify_nom_'+occupant_id[1]).val();
    var prenom_occupant = $('.modify_prenom_'+occupant_id[1]).val();
    var address_occupant = $('.modify_address_'+occupant_id[1]).val();
    var phone_occupant = $('.modify_phone_'+occupant_id[1]).val();

    var cuation_occupant = $('.modify_caution_'+occupant_id[1]).val();
    var loyer_occupant = $('.modify_loyer_'+occupant_id[1]).val();
    var start_date_occupant = $('.modify_start_date_'+occupant_id[1]).val();
    var end_date_occupant = $('.modify_end_date_'+occupant_id[1]).val();
    var delay_occupant = $('.modify_delay_'+occupant_id[1]).val();
    var frequency_occupant = $('.modify_frequency_'+occupant_id[1]).val();

    $('.address_contract').html(address_occupant);
    $('.full_name_contract').html(prenom_occupant+' '+nom_occupant);
    $('.phone_contract').html(phone_occupant);
    if(civ_occupant == 'Mr'){
      $('.avatar').children().html('<img imageonload="" class="img-responsive s-image--loading_success avatar_contract_h" alt="avatar" src="{{url("images/icon-homme.png")}}">');
      $('.avatar_contract_f').remove();
    }
    if(civ_occupant == 'Mme'){
      $('.avatar').children().html('<img imageonload="" class="img-responsive s-image--loading_success avatar_contract_f" alt="avatar" src="{{url("images/icon-femme.png")}}">');
      $('.avatar_contract_h').remove();
    }
    $('.caution_contract').html(cuation_occupant);
    $('.loyer_contract').html(loyer_occupant);
    $('.start_date_contract').html(start_date_occupant);
    $('.end_date_contract').html(end_date_occupant);
    $('.delay_contract').html(delay_occupant);
    $('.frequency_contract').html(frequency_occupant);
    $('.slash_frequency_contract').html(' / '+frequency_occupant);
  });

});
</script>
<?php
$id = explode('/',$_SERVER['REQUEST_URI']);
if(!empty($id[2])){
  echo '<script>
        $(document).ready(function() {
          var occupant_class = "contract_'.$id[2].'";
          $("."+occupant_class).trigger( "click" );
      });
  </script>';
}
 ?>
@endsection
