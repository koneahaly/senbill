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
   <h3><strong>Mes locataires</strong></h3></div>
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
                                 <span>Locataires</span>
                              <!---->
                           </div>
                           <div class="nav-total">
                              <div>
                                 <total> <span>1</span> <span style="text-transform:none" > locataire(s) au total</span> </total>
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
                                        <!-- <img imageonload="" class="img-responsive s-image--loading_success" alt="avatar" src="{{url('images/icon-homme.png')}}"> -->
                                        <img imageonload="" class="img-responsive s-image--loading_success" alt="avatar" src="{{url('images/icon-femme.png')}}">
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
                                           <h2>Yacine Ndiaye</h2>
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
                                     <div class="loc-phone"> <p>773228879</p> </div>
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                      <!----> <!---->
                      <div class="detail-roommates">
                         <!----> <!-- SI ANCIEN LOCATAIRE ALORS REMPLACER  CLASSE occupied par old-->
                         <div class="rent-property occupied">
                            <p>Keur Serigne Saliou</p>
                         </div>
                         <!---->
                      </div>
                      <!----> <!---->
                   </div>
                   <div class="move-out">
                      <div class="m-action-btn-icon">
                         <a class="col-xs-12"  title="Loyer"  href="">
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
                         <a class="col-xs-12" title="Contrat" href="">
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
                   <div class="property-view"> <a class="m-btn-link--view" title="détails" style="text-transform: none;" onclick="openFormEditLocataire()"> Modifier <i class="far fa-edit"></i></a> </div>
                </div>
             </div>
          </div>
       </div>
        <!-- FIN CARTE LOCATAIRE 1-->
       <!---->
    </div>
 </div>
</div>

  </div>


      <!---FORMULAIRE MODIF LOCATAIRE-->
      <div class="container-contact100 loc-edit-popup" id="locEditForm">
        <div class="wrap-contact100">
          <form class="contact100-form validate-form" >
            <span class="contact100-form-title">
              Modifier un locataire
            </span>
              <div class="wrap-input100 input100-select bg1 rs1-wrap-input100">
                <span class="label-input100">Civilité *</span>
                <div>
                  <select class="js-select-civ" name="civilite">
                    <option>Monsieur</option>
                    <option selected>Madame</option>
                    <option>Mademoiselle</option>
                  </select>
                  <div class="dropDownSelect2"></div>
                </div>
              </div>
              <div class="rs1-wrap-input100">
              </div>
            <div class="wrap-input100 validate-input bg1 rs1-wrap-input100" data-validate = "Entrez le prénom">
              <span class="label-input100">Prénom *</span>
              <input class="input100" type="text" name="prenom" required placeholder="Entrez le prénom du locataire" value="Yacine">
            </div>

            <div class="wrap-input100 bg1 rs1-wrap-input100">
              <span class="label-input100">Nom *</span>
              <input class="input100" type="text" name="nom" required  placeholder="Entrez le nom du locataire" value="Ndiaye">
            </div>
            <div class="wrap-input100 input100-select bg1 rs1-wrap-input100">
              <span class="label-input100">Date de naissance </span>
              <input class="input100" type="text" name="dateOB" required  placeholder="Entrez la date" value="03/05/1993">
            </div>
            <div class=" wrap-input100 bg1 rs1-wrap-input100">
              <span class="label-input100">Lieu de naissance </span>
              <input class="input100" type="text" name="placeOB" placeholder="Entrez le lieu de naissance du locataire" value="Dakar">
            </div>
            <div class="wrap-input100 validate-input bg1 rs1-wrap-input100" data-validate = "Entrez l'adresse mail" >
              <span class="label-input100">Email </span>
              <input class="input100" type="email" name="mail" placeholder="Entrez l'adresse mail du locataire" value="yacinenana@gmail.com">
            </div>

            <div class="wrap-input100 bg1 rs1-wrap-input100">
              <span class="label-input100">Téléphone * </span>
              <input class="input100" type="tel" pattern="[0-9]{*}" name="phone" required placeholder="Entrez le téléphone du locataire" value="773228879">
            </div>
            <div class="wrap-input100 validate-input bg1" data-validate="Entrez svp un nom pour le logement">
              <span class="label-input100">Numéro CNI *</span>
              <input class="input100" type="text" pattern="[0-9,A-Z,a-z]{13}" required name="cni" placeholder="Entrez le numéro de Carte d'identité nationale du locataire" value="A000305199377">
            </div>



            <div class="container-contact100-form-btn">
              <button class="contact100-form-btn" onclick="closeFormEditLocataire(); return false;">
                <span>
                  Sauvegarder
                  <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                </span>
              </button>
            </div>
          </form>
        </div>
      </div>

      <!--- FIN FORMULAIRE MODIF LOCATAIRE-->
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
  function openFormEditLocataire() {
    document.getElementById("locEditForm").style.display = "flex";
  }

  function closeFormEditLocataire() {
    document.getElementById("locEditForm").style.display = "none";
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
