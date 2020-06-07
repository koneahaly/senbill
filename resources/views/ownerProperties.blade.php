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
   <h3><strong>Mes logements</strong></h3></div>
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
                               <div class="units"> <span class="unit-count"> {{ $vl->nb_rooms }} chambres </span> </div>
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
                                     <!----> <span>Occupé par Yacine Ndiaye</span>
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
                   <a class="col-xs-12 col-sm-12 tooltip-link" title="Locataire" href="">
                      <div class="icon-svg">
                         <i class="fas fa-house-user"></i>
                      </div>
                      <div class="m-title-tooltip">
                         <div class="tooltip-label">Locataire</div>
                      </div>
                      <p>Locataire</p>
                   </a>
                   <a class="col-xs-12 col-sm-12 tooltip-link"  title="Factures" href="">
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

                    <a class="m-btn-link--view" title="détails" href="" style="text-transform: none;"> Ajouter un locataire <i class="fas fa-house-user"></i></a>

                   </div>
                   @endif
                   <div class="property-view"> <a class="m-btn-link--view" title="détails" href="" style="text-transform: none;"  onclick="openDesc(); return false;"> Modifier <i class="far fa-edit"></i></a> </div>
                </div>
                <!---FIN FOOTER-->
              </div>
            </div>
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
              <input class="input100" type="text" name="tl_housing" placeholder="Entrez un nom pour le logement">
            </div>
            <div class="wrap-input100 validate-input bg1 rs1-wrap-input100" data-validate = "Entrez l'adresse ou le quartier">
              <span class="label-input100">Adresse du logement *</span>
              <input class="input100" type="text" name="address_housing" placeholder="Entrez l'adresse ou le quartier ">
            </div>

            <div class="wrap-input100 bg1 rs1-wrap-input100">
              <span class="label-input100">Ville du logement</span>
              <input class="input100" type="text" name="city_housing" placeholder="Entrez la ville du  logement">
            </div>
            <div class="wrap-input100 input100-select bg1">
              <span class="label-input100">Nombre de chambres *</span>
              <div>
                <select class="js-select-bed" name="nb_rooms">
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
                <select class="js-select2" name="status_housing">
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
    <div class="container-contact100 desc-popup" id="propDesc">
      <div class="wrap-contact100">
        <form class="contact100-form validate-form" >
          <span class="contact100-form-title">
            Modifier votre logement
          </span>

          <div class="wrap-input100 validate-input bg1" data-validate="Entrez svp un nom pour le logement">
            <span class="label-input100">Nom du logement *</span>
            <input class="input100" type="text" name="name" placeholder="Entrez un nom pour le logement" value="Keur Serigne Saliou">
          </div>
          <div class="wrap-input100 validate-input bg1 rs1-wrap-input100" data-validate = "Entrez l'adresse ou le quartier">
            <span class="label-input100">Adresse du logement *</span>
            <input class="input100" type="text" name="adresse" placeholder="Entrez l'adresse ou le quartier" value="Hann Mariste 2 villa Y46">
          </div>

          <div class="wrap-input100 bg1 rs1-wrap-input100">
            <span class="label-input100">Ville du logement</span>
            <input class="input100" type="text" name="ville" placeholder="Entrez la ville du  logement" value="Dakar">
          </div>
          <div class="wrap-input100 input100-select bg1">
            <span class="label-input100">Nombre de chambres *</span>
            <div>
              <select class="js-select-bed" name="nbchambres">
                <option>Studio</option>
                <option>1</option>
                <option selected >2</option>
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
              <select class="js-select2" name="service">
                <option>Choisir svp</option>
                <option>Logement libre</option>
                <option selected>Logement occupé</option>
              </select>
              <div class="dropDownSelect2"></div>
            </div>
          </div>
          <div class="w-full dis-none js-show-service">
            <div class="wrap-contact100-form-radio">
              <span class="label-input100">Le logement est-il meublé?</span>

              <div class="contact100-form-radio m-t-15">
                <input class="input-radio100" id="radio1" type="radio" name="type-product" value="nonmeuble" checked="checked">
                <label class="label-radio100" for="radio1">
                  Logement non meublé
                </label>
              </div>

              <div class="contact100-form-radio">
                <input class="input-radio100" id="radio2" type="radio" name="type-product" value="meuble">
                <label class="label-radio100" for="radio2">
                  Logement meublé
                </label>
              </div>
            </div>

          </div>

          <div class="container-contact100-form-btn">
            <button class="contact100-form-btn" onclick="closeForm(); return false;">
              <span>
                Sauvegarder
                <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
              </span>
            </button>
          </div>
        </form>
      </div>
    </div>
    <!---FIN  DESCRIPTION LOGEMENT-->

    <!---FORMULAIRE AJOUT LOCATAIRE-->
    <div class="container-contact100 loc-popup" id="locForm">
      <div class="wrap-contact100">
        <form class="contact100-form validate-form" >
          <span class="contact100-form-title">
            Ajoutez un locataire
          </span>
            <div class="wrap-input100 input100-select bg1 rs1-wrap-input100">
              <span class="label-input100">Civilité *</span>
              <div>
                <select class="js-select-civ" name="civilite">
                  <option>Monsieur</option>
                  <option>Madame</option>
                  <option>Mademoiselle</option>
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
            <input class="input100" type="email" name="mail" placeholder="Entrez l'adresse mail du locataire">
          </div>

          <div class="wrap-input100 bg1 rs1-wrap-input100">
            <span class="label-input100">Téléphone * </span>
            <input class="input100" type="tel" pattern="[0-9]{*}" name="phone" required placeholder="Entrez le téléphone du locataire">
          </div>
          <div class="wrap-input100 validate-input bg1" data-validate="Entrez svp un nom pour le logement">
            <span class="label-input100">Numéro CNI *</span>
            <input class="input100" type="text" pattern="[0-9,A-Z,a-z]{13}" required name="cni" placeholder="Entrez le numéro de Carte d'identité nationale du locataire">
          </div>



          <div class="container-contact100-form-btn">
            <button class="contact100-form-btn" onclick="closeFormLocataire(); return false;">
              <span>
                Ajoutez
                <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
              </span>
            </button>
          </div>
        </form>
      </div>
    </div>

    <!--- FIN FORMULAIRE AJOUT LOCATAIRE-->
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
</script>


@endsection
