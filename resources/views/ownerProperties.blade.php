<?php
session_start();
$notification = (isset($_SESSION["numberOfBillsNonPaid"])) ? $_SESSION["numberOfBillsNonPaid"] : '';
?>
@extends('layouts.realEstate', ['notification' => $notification])

@section('content')
<div class="container">
  <!--TITLE OF THE PAGE-->
  <div class="row" style="margin-top:10%">
  <div class="col-md-12" style="margin-top:10px;margin-bottom:20px;text-align:center;flex-basis:100%;max-width:100%;">
   <h3><strong>Mes logements</strong></h3>
 </div>
  </div>
<!-- END TITLE OF THE PAGE-->
<!--CONTENT OF THE PAGE-->
  <div class="panel panel-default" style="background-color: #f5f9fc;">
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
                                 <span>Propriétés</span>
                              <!---->
                           </div>
                           <div class="nav-total">
                              <div>
                                 <total> <span> {{ $nb_log }}</span> <span style="text-transform:none" > logement(s) au total</span> </total>
                              </div>
                           </div>

                        </div>
                     </header-list>
                  </property-nav>
               </nav-list>
            </div>
            <div class="sidebar-filter">
               <!----> <!----> <!---->
               <a class="filter-item m-btn btn-primary" title="Ajouter un logement" onclick="openForm(); return false;">
                  <div class="icon-svg">
                     <e-svg-icon set-class="i-svg--fill i-svg--12 i-svg-fill--white" xlink="#icon-line-plus" class="e-svg-icon">
                        <svg class="i-svg--fill i-svg--12 i-svg-fill--white" id="svgElement" viewBox="0 0 12 12">
                           <path d="M6.75 6.75v3.578c0 .371-.333.672-.75.672-.414 0-.75-.29-.75-.672V6.75H1.672C1.29 6.75 1 6.414 1 6c0-.417.3-.75.672-.75H5.25V1.672C5.25 1.29 5.586 1 6 1c.417 0 .75.3.75.672V5.25h3.578c.371 0 .672.333.672.75 0 .414-.29.75-.672.75H6.75z" fill-rule="evenodd"></path>
                        </svg>
                     </e-svg-icon>
                     <span style="text-transform:none">Ajouter un logement</span>
                  </div>
               </a>

            </div>
         </div>
      </header-sidebar>
      </div>

  <!--<h4>FIN HEADER  </h4> -->
      <!--<h4>logements  </h4> -->
      <div class="panel-wrapper column">
        <div class="wrapper-list">
          <div class="row propRow">
              <!---DEBUT  CARTE LOGEMENT 1 -->
            @foreach($infos_log as $vl)
            <div class="col-xs-12 col-sm-10 col-md-8">
              <div class="m-panel panel-property--list" >
                <div class="markup"></div>
                <!-- DEBUT BODY DETAIL -->
                <div class="m-panel__body">

                  <div class="body-detail">
                   <div class="detail-img"> <a title="icone logement" href="">
                     <img imageonload="" class="img-responsive s-image--loading_success" alt="avatar" src="{{url('images/icon-undraw-house.png')}}">
                    </a>
                  </div>
                   <div class="detail-info">
                      <div class="info-name">
                         <div class="name-address">
                            <a href="">
                               <fieldset-property-info property="property" address1="26 Route des Maristes" city-address="Chelles, Dakar, 77500, SN">
                                  <div class="m-property-info ">
                                     <div class="info-name-property">
                                        <span>
                                          <span>{{ $vl->title }}</span>
                                        </span>
                                     </div>
                                     <!----> <!---->
                                     <div class="info-location">
                                        <div class="icon-svg"> <i class="fas fa-map-marker-alt"></i></div>
                                        <div class="location-address">
                                        <span>{{ $vl->address }}</span><br><span> {{ $vl->city }}, Sénégal</span><!---->
                                        </div>
                                     </div>
                                     <!---->
                                  </div>
                               </fieldset-property-info>
                            </a>
                         </div>
                         <div class="name-view">
                            <div class="u-flex--items-center">
                               <!----> <!---->
                               <div class="units"> <span class="unit-count"> {{ $vl->nb_rooms }} {{ ($vl->nb_rooms != "maison" and $vl->nb_rooms != "Studio") ? 'chambres' : ''}} </span> </div>
                               <!----> <!---->
                            </div>
                            <div class="view-units">
                              @if($vl->status == "N")
                               <div class="units-progress">
                                  <div style="width: 100%;"></div>
                               </div>
                               @endif
                               @if($vl->status == "Y")
                               <div class="units-progress">
                                 <div style="width: 100%;background-image: linear-gradient(90deg,#1ab92d,#f2ffd9 60%,#f2f6ff);"></div>
                               </div>
                               @endif
                               <div class="units-type">
                                 @if($vl->status == "N")
                                  <div class="occupied">
                                     <!----> <span>Occupé par {{ $vl->current_occupant_name }}</span>
                                  </div>
                                  @endif
                                  @if($vl->status == "Y")
                                  <div class="vacant">
                                     <!----> <span>Libre</span>
                                  </div>
                                  @endif
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                 </div>

                </div>
                <!---FIN BODY DETAIL-->
                  <!---DEBUT MENU AVEC ICONES-->
                <div class="m-action-btn-icon">
                   <a class="col-xs-12 col-sm-12 tooltip-link" title="Locataire" href="mes-locataires/{{ $vl->occupant_id }}">
                      <div class="icon-svg">
                         <i class="fas fa-house-user"></i>
                      </div>
                      <div class="m-title-tooltip">
                         <div class="tooltip-label">Locataire</div>
                      </div>
                      <p>Locataire</p>
                   </a>
                   <a class="col-xs-12 col-sm-12 tooltip-link"  title="Factures" href="transactions-proprietaire/{{ $vl->occupant_id }}">
                      <div class="icon-svg">
                         <i class="fas fa-file-invoice-dollar"></i>
                      </div>
                      <div class="m-title-tooltip">
                         <div class="tooltip-label">Factures</div>
                      </div>
                      <p>Factures</p>
                   </a>

                </div>
                <!---FIN MENU AVEC ICONES-->
                <!---DEBUT FOOTER-->
                <div class="m-panel__footer between-xs">
                  @if($vl->status == "Y")
                   <div>
                      <!-- SI LOGEMENT LIBRE ALORS AJOUTER LE CODE  SUIVANT--> <!---->

                    <a class="m-btn-link--view add_occ housing_{{ $vl->id }}" title="détails" href="" style="text-transform: none;" onclick="openFormLocataire(); return false;"> Ajouter un locataire <i class="fas fa-house-user"></i></a>

                   </div>
                   @endif
                   <div class="property-view"> <a class="m-btn-link--view modify_housing housing_{{ $vl->id }}" title="détails" href="" style="text-transform: none;"  onclick="openDesc(); return false;"> Modifier <i class="far fa-edit"></i></a> </div>
                </div>
                <!---FIN FOOTER-->
              </div>
            </div>
            <input type="hidden" class="modify_title_{{ $vl->id }}" value="{{ $vl->title }}" />
            <input type="hidden" class="modify_address_{{ $vl->id }}" value="{{ $vl->address }}" />
            <input type="hidden" class="modify_city_{{ $vl->id }}" value="{{ $vl->city }}" />
            <input type="hidden" class="modify_status_{{ $vl->id }}" value="{{ $vl->status }}" />
            <input type="hidden" class="modify_nb_rooms_{{ $vl->id }}" value="{{ $vl->nb_rooms }}" />
            <input type="hidden" class="modify_housing_type_{{ $vl->id }}" value="{{ $vl->housing_type }}" />
            @endforeach

  <!---FIN CARTE LOGEMENT 1 -->
    <!---DEBUT CARTE LOGEMENT 2-->

  <!---FIN CARTE LOGEMENT 2-->
          </div>
        </div>
      </div>

    </div>

    <!---FORMULAIRE AJOUT LOGEMENT-->
    <form method="post" action="{{ route('mes-logements.add') }}">
      {{csrf_field()}}
      <div class="container-contact100 form-popup" id="propForm">
        <div class="wrap-contact100">
          <form class="contact100-form validate-form" >
            <span class="contact100-form-title">
              Ajoutez un logement
            </span>

            <div class="wrap-input100 validate-input bg1" data-validate="Entrez svp un nom pour le logement">
              <span class="label-input100">Nom du logement *</span>
              <input class="input100" type="text" name="tl_housing" placeholder="Entrez un nom pour le logement" required>
            </div>
            <div class="wrap-input100 validate-input bg1 rs1-wrap-input100" data-validate = "Entrez l'adresse ou le quartier">
              <span class="label-input100">Adresse du logement *</span>
              <input class="input100" type="text" name="address_housing" placeholder="Entrez l'adresse ou le quartier " required>
            </div>

            <div class="wrap-input100 bg1 rs1-wrap-input100">
              <span class="label-input100">Ville du logement</span>
              <input class="input100" type="text" name="city_housing" placeholder="Entrez la ville du  logement" required>
            </div>
            <div class="wrap-input100 input100-select bg1">
              <span class="label-input100">Nombre de chambres *</span>
              <div>
                <select class="js-select-bed" name="nb_rooms" required>
                  <option>Studio</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>maison</option>
                </select>
                <div class="dropDownSelect2"></div>
              </div>
            </div>

            <div class="wrap-input100 input100-select bg1">
              <span class="label-input100">Libre ou occupé *</span>
              <div>
                <select class="js-select2" name="status_housing" required>
                  <option disabled>Choisir svp</option>
                  <option value="Y">Logement libre</option>
                  <option value="N">Logement occupé</option>
                </select>
                <div class="dropDownSelect2"></div>
              </div>
            </div>

            <div class="w-full dis-none js-show-service">
              <div class="wrap-contact100-form-radio">
                <span class="label-input100">Le logement est-il meublé?</span>

                <div class="contact100-form-radio m-t-15">
                  <input class="input-radio100" id="radio1" type="radio" name="housing_type" value="nonmeuble" checked="checked">
                  <label class="label-radio100" for="radio1">
                    Logement non meublé
                  </label>
                </div>

                <div class="contact100-form-radio">
                  <input class="input-radio100" id="radio2" type="radio" name="type_housing" value="meuble">
                  <label class="label-radio100" for="radio2">
                    Logement meublé
                  </label>
                </div>
              </div>

            </div>


            <div class="container-contact100-form-btn">
              <button type="submit" class="contact100-form-btn">
                <span>
                  Ajoutez
                  <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                </span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </form>

    <!--- FIN FORMULAIRE AJOUT LOGEMENT-->

    <!---DESCRIPTION LOGEMENT-->
    <form method="post" action="{{ route('mes-logements.update') }}">
      {{csrf_field()}}
      <div class="container-contact100 desc-popup" id="propDesc">
        <div class="wrap-contact100">
          <form class="contact100-form validate-form" >
            <span class="contact100-form-title">
              Modifier votre logement
            </span>

            <div class="wrap-input100 validate-input bg1" data-validate="Entrez svp un nom pour le logement">
              <span class="label-input100">Nom du logement *</span>
              <input class="input100 update_title_log" type="text" name="tl_housing_m" placeholder="Entrez un nom pour le logement" value="Keur Serigne Saliou" required>
            </div>
            <div class="wrap-input100 validate-input bg1 rs1-wrap-input100" data-validate = "Entrez l'adresse ou le quartier">
              <span class="label-input100">Adresse du logement *</span>
              <input class="input100 update_address_log" type="text" name="address_housing_m" placeholder="Entrez l'adresse ou le quartier" value="Hann Mariste 2 villa Y46" required>
            </div>

            <div class="wrap-input100 bg1 rs1-wrap-input100">
              <span class="label-input100">Ville du logement</span>
              <input class="input100 update_city_log" type="text" name="city_housing_m" placeholder="Entrez la ville du  logement" value="Dakar" required>
            </div>
            <div class="wrap-input100 input100-select bg1">
              <span class="label-input100">Nombre de chambres *</span>
              <div class="update_nb_rooms_log">
                <select class="js-select-bed" name="nb_rooms_housing_m" required>
                  <option class="disp_studio" value="Studio">Studio</option>
                  <option class="disp_1" value="1">1</option>
                  <option class="disp_2" value="2">2</option>
                  <option class="disp_3" value="3">3</option>
                  <option class="disp_4" value="4">4</option>
                  <option class="disp_5" value="5">5</option>
                  <option class="disp_6" value="6">6</option>
                  <option class="disp_maison" value="maison">maison</option>
                </select>
                <div class="dropDownSelect2"></div>
              </div>
            </div>

            <div class="wrap-input100 input100-select bg1">
              <span class="label-input100">Libre ou occupé *</span>
              <div class="update_status_log">
                <select class="js-select2" name="status_housing_m" required>
                  <option disabled>Choisir svp</option>
                  <option class="status_Y" value="Y">Logement libre</option>
                  <option class="status_N" value="N">Logement occupé</option>
                </select>
                <div class="dropDownSelect2"></div>
              </div>
            </div>
            <div class="w-full dis-none js-show-service">
              <div class="wrap-contact100-form-radio">
                <span class="label-input100">Le logement est-il meublé?</span>

                <div class="contact100-form-radio m-t-15">
                  <input class="input-radio100 update_housing_type_log" id="radio1" type="radio" name="type_housing_m" value="nonmeuble" checked="checked">
                  <label class="label-radio100" for="radio1">
                    Logement non meublé
                  </label>
                </div>

                <div class="contact100-form-radio">
                  <input class="input-radio100 update_housing_type_log" id="radio2" type="radio" name="type_housing_m" value="meuble">
                  <label class="label-radio100" for="radio2">
                    Logement meublé
                  </label>
                </div>
              </div>

            </div>

            <div class="container-contact100-form-btn">
              <button type="submit" class="contact100-form-btn">
                <span>
                  Modifier
                  <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                </span>
              </button>
            </div>
            <input type="hidden" name="housing_id_m" class="update_housing_id" value=""/>
          </form>
        </div>
      </div>
    </form>
    <!---FIN  DESCRIPTION LOGEMENT-->

    <!---FORMULAIRE AJOUT LOCATAIRE-->

      <div class="container-contact100 loc-popup" id="locForm">
        <div class="wrap-contact100">
          <form class="contact100-form validate-form" method="post" action="{{ route('occupant.add') }}">
            {{csrf_field()}}
            <span class="contact100-form-title">
              Ajoutez un locataire
            </span>
              <div class="wrap-input100 input100-select bg1 rs1-wrap-input100">
                <span class="label-input100">Civilité *</span>
                <div>
                  <select class="js-select-civ" name="civilite">
                    <option disabled>Votre civilité</option>
                    <option value="Mr">Monsieur</option>
                    <option value="Mme">Madame</option>
                  </select>
                  <div class="dropDownSelect2"></div>
                </div>
              </div>
              <div class="rs1-wrap-input100">
              </div>
            <div class="wrap-input100 validate-input bg1 rs1-wrap-input100" data-validate = "Entrez le prénom">
              <span class="label-input100">Prénom *</span>
              <input class="input100" type="text" name="prenom" required placeholder="Entrez le prénom du locataire">
            </div>

            <div class="wrap-input100 bg1 rs1-wrap-input100">
              <span class="label-input100">Nom *</span>
              <input class="input100" type="text" name="nom" required  placeholder="Entrez le nom du locataire">
            </div>
            <div class="wrap-input100 input100-select bg1 rs1-wrap-input100">
              <span class="label-input100">Date de naissance </span>
              <input class="input100" type="text" name="dateOB" required  placeholder="Entrez la date">
            </div>
            <div class=" wrap-input100 bg1 rs1-wrap-input100">
              <span class="label-input100">Lieu de naissance </span>
              <input class="input100" type="text" name="placeOB" placeholder="Entrez le lieu de naissance du locataire">
            </div>
            <div class="wrap-input100 validate-input bg1 rs1-wrap-input100" data-validate = "Entrez l'adresse mail">
              <span class="label-input100">Email </span>
              <input class="input100" type="email" name="mail" placeholder="Entrez l'adresse mail du locataire" required>
            </div>

            <div class="wrap-input100 bg1 rs1-wrap-input100">
              <span class="label-input100">Téléphone * </span>
              <input class="input100" type="tel" pattern="[0-9]{*}" name="phone" required placeholder="Entrez le téléphone du locataire">
            </div>
            <div class="wrap-input100 validate-input bg1" data-validate="Entrez svp un nom pour le logement">
              <span class="label-input100">Numéro CNI *</span>
              <input class="input100" type="text" pattern="[0-9,A-Z,a-z]{13}" required name="cni" placeholder="Entrez le numéro de Carte d'identité nationale du locataire">
            </div>
            <div class="wrap-input100 bg1 rs1-wrap-input100">
              <span class="label-input100">Caution *</span>
              <input class="input100" type="number" pattern="[0-9]{0,10}" name="caution" required  placeholder="Entrez le montant de la caution">
            </div>
            <div class="wrap-input100 bg1 rs1-wrap-input100">
              <span class="label-input100">Loyer *</span>
              <input class="input100" type="number" pattern="[0-9]{0,10}" name="loyer" required  placeholder="Entrez le montant du loyer">
            </div>
            <div class="wrap-input100 bg1 rs1-wrap-input100">
              <span class="label-input100">Date de début *</span>
              <input class="input100" type="date" pattern="[0-9]{0,10}" name="start_date" required>
            </div>
            <div class="wrap-input100 bg1 rs1-wrap-input100">
              <span class="label-input100">Date de fin </span>
              <input class="input100" type="date" name="end_date">
            </div>
            <div class="wrap-input100 input100-select bg1 rs1-wrap-input100">
              <span class="label-input100">Fréquence de paiement *</span>
              <div>
                <select class="js-select-civ" name="frequency" required>
                  <option disabled>Fréquence</option>
                  <option value="mensuel">mensuel</option>
                  <option value="bimestriel">bimestriel</option>
                </select>
                <div class="dropDownSelect2"></div>
              </div>
            </div>
            <div class="wrap-input100 bg1 rs1-wrap-input100">
              <span class="label-input100">Délai de paiement *</span>
              <input class="input100" type="number" pattern="[0-9]{0,5}" name="delay" required  value="0">
            </div>



            <div class="container-contact100-form-btn">
              <button type="submit" class="contact100-form-btn">
                <span>
                  Ajoutez
                  <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                </span>
              </button>
            </div>
            <input type="hidden" name="housing_id" class="add_occ_housing_id" value=""/>
            <input type="hidden" name="housing_address" class="add_occ_housing_address" value=""/>
          </form>
        </div>
      </div>

    <!--- FIN FORMULAIRE AJOUT LOCATAIRE-->
  </div>
    <div class="row">
      <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
      <lottie-player src="{{url('images/lottie/logement.json')}}"  background="transparent"  speed="1"  style="width: 100%; height: 400px;display: inline-block;"  loop  autoplay></lottie-player>
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
  $(".js-select2").each(function(){
    $(this).select2({
      minimumResultsForSearch: 20,
      dropdownParent: $(this).next('.dropDownSelect2')
    });

  })
  $(".js-select-bed").each(function(){
    $(this).select2({
      minimumResultsForSearch: 20,
      dropdownParent: $(this).next('.dropDownSelect2')
    });

  })
  $(".js-select-civ").each(function(){
    $(this).select2({
      minimumResultsForSearch: 20,
      dropdownParent: $(this).next('.dropDownSelect2')
    });

  })
  } );
</script>
<!--===============================================================================================-->
<script>
  function openForm() {
    if (document.getElementById("propDesc").style.display != "none"){
      closeDesc();
    }
   if (document.getElementById("locForm").style.display != "none"){
      closeFormLocataire();
    }
    document.getElementById("propForm").style.display = "flex";
  }

  function closeForm() {
    document.getElementById("propForm").style.display = "none";
  }

</script>
<script>
  function openDesc() {
    if (document.getElementById("propForm").style.display != "none"){
      closeForm();
    }
   if (document.getElementById("locForm").style.display != "none"){
      closeFormLocataire();
    }
    document.getElementById("propDesc").style.display = "flex";
  }

  function closeDesc() {
    document.getElementById("propDesc").style.display = "none";
  }

</script>
<script>
  function openFormLocataire() {
    if (document.getElementById("propDesc").style.display != "none"){
      closeDesc();
    }
   if (document.getElementById("propForm").style.display != "none"){
      closeForm();
    }
    document.getElementById("locForm").style.display = "flex";
  }

  function closeFormLocataire() {
    document.getElementById("locForm").style.display = "none";
  }

</script>
<!--===============================================================================================-->
<script src="{{url('vendor/daterangepicker/moment.min.js')}}"></script>
<script src="{{url('vendor/daterangepicker/daterangepicker.js')}}"></script>
<script>
$(function() {
  $('input[name="dateOB"]').daterangepicker({
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
  $('.modify_housing').click(function(){
    $('option').removeAttr('selected');
    var nameClass = this.className.split(' ');
    var housing_id = nameClass[2].split('_');
    var status_housing = $('.modify_status_'+housing_id[1]).val();
    var title_housing = $('.modify_title_'+housing_id[1]).val();
    var address_housing = $('.modify_address_'+housing_id[1]).val();
    var city_housing = $('.modify_city_'+housing_id[1]).val();
    var housing_type = $('.modify_housing_type_'+housing_id[1]).val();
    var nb_rooms_housing = $('.modify_nb_rooms_'+housing_id[1]).val();
    $('.update_title_log').val(title_housing);
    $('.update_address_log').val(address_housing);
    $('.update_city_log').val(city_housing);
    $("select option[value="+nb_rooms_housing+"]").attr('selected','selected');
    $('.js-select-bed').val(nb_rooms_housing).change();
    $("select option[value="+status_housing+"]").attr('selected','selected');
    $('.js-select2').val(status_housing).change();
    $('.update_housing_type_log').val(housing_type);
    $('.update_housing_id').val(housing_id[1]);
  });

  $('.add_occ').click(function(){
    var nameClass_2 = this.className.split(' ');
    var housing_id_2 = nameClass_2[2].split('_');
    $('.add_occ_housing_id').val(housing_id_2[1]);
    var address_housing_2 = $('.modify_address_'+housing_id_2[1]).val();
    $('.add_occ_housing_address').val(address_housing_2);
  });

});
</script>


@endsection
