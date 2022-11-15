<?php
session_start();
$notification = (isset($_SESSION["numberOfBillsNonPaid"])) ? $_SESSION["numberOfBillsNonPaid"] : '';
$service =explode('/',$_SERVER['REQUEST_URI']);
$_SESSION['current_service'] = $service[2];
if(strpos($service[2],'?') !== false){
  $clean_service = explode('?',$service[2]);
  $_SESSION['current_service'] = $clean_service[0];
}
?>
@extends('layouts.realEstate', ['notification' => $notification, 'service' => $_SESSION['current_service'], 'services' => $actived_services, 'profilNotif' => $_SESSION['profilNotif']])

@section('content')

<div class="container">

  <!--TITLE OF THE PAGE-->
  <div class="row rowloc rowmobile" style="margin-top:14%;z-index: 1100;">
  <div class="col-md-12" style="margin-top:10px;margin-bottom:20px;text-align:center;flex-basis:100%;max-width:100%;z-index: 1100;">
   <h3><strong>Mes Demandes</strong></h3>
 </div>

  </div>
<!-- END TITLE OF THE PAGE-->
<!--CONTENT OF THE PAGE-->
@if(session('message'))
<input  type='hidden' class="mess" value="{{ session('message') }}">
<script>
 $(document).ready(function() {
  var  mess= $('.mess').val();
  showAddPropertyNotif(mess);
  });
 </script>
@endif

<script type="text/javascript"  src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBK1lhFLXgX3IbSZegrgp4i2zjj0kyYkt4"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var places = new google.maps.places.Autocomplete(document.getElementById('address_log'));
        google.maps.event.addListener(places, 'place_changed', function () {
        });
        var places_update = new google.maps.places.Autocomplete(document.getElementById('address_log_update'));
        google.maps.event.addListener(places_update, 'place_changed', function () {
        });
    });
</script>

 

  <div class="panel panel-default" style="background-color: #f5f9fc;z-index: 1100;">
    <div class="panel-body propPanelBody">


         <!---FORMULAIRE AJOUT LOGEMENT-->
         <form id="add_logement">

           {{csrf_field()}}
           <div class="container-contact100 form-popup" id="propForm">
             <div class="wrap-contact100">
                 <span class="contact100-form-title">
                   Soumettre une demande
                 </span>

                  <!-- Type  de service-->

                 <div class="wrap-input100 input100-select bg1">
                   <span class="label-input100">Type de service *</span>
                   <div>
                     <select class="js-select-sv-type" onchange="openSelectionServicenameForm(this.value); return false;" name="service_type" required>
                       <option value="Mairie" >Mairie</option>
                       <option value="Police">Police</option>
                       <option value="Impots">Impôts et domaines</option>
                       <option value="Douanes">Douanes</option>
                       <option value="AfricatelAvs">Africatel AVS</option>
                     </select>
                     <div class="dropDownSelect2"></div>
                   </div>
                 </div>

                 <!-- Service -->
                 <div class="wrap-input100 input100-select bg1" id='requestServicename-popup'>
                  <div class="wrap-input100 input100-select bg1">
                    <span class="label-input100">Service *</span>
                    <div>
                      <select class="js-select-sv-name" onchange="openSelectionRequestypeForm(this.value); return false;" name="service_name" required>
                        <option value="Mairie1">Mairie de Dakar</option>
                        <option value="Mairie2">Mairie de Yoff</option>
                        <option value="Mairie3">Mairie des parcelles assainies</option>
                        <option value="Impots1">Impôts et domaines</option>
                      </select>
                      <div class="dropDownSelect2"></div>
                    </div>
                  </div>
                </div>

                  <!-- Type de demande -->
                  <div class="wrap-input100 input100-select bg1" id='requestType-popup'>
                    <div class="wrap-input100 input100-select bg1">
                      <span class="label-input100">Type de demande *</span>
                      <div>
                        <select class="js-select-rq-type" name="request_type" onchange="openInfoForm(); return false;" required>
                          <option value="Mairie_extrait" >Demande extrait de naissance</option>
                          <option value="Mairie_cert_mariage">Demande certificat de mariage</option>
                          <option value="avs1">Demande quittance passeport</option>
                        </select>
                        <div class="dropDownSelect2"></div>
                      </div>
                    </div>
                </div>

              
                 <div class="container-contact100 form-popup" id='requesterDetails-popup'>

                  <!-- Nom du demandeur-->
                 <div class="wrap-input100 validate-input bg1 form-group{{ $errors->has('last_name') ? ' has-error' : '' }}" data-validate="Entrez svp le nom de la personne demandeur">
                   <span class="label-input100">Nom *</span>
                   <input class="input100 control-label" type="text" name="last_name" placeholder="Entrez le nom de la personne demandeur" required>
                   @if ($errors->has('last_name'))
                       <span class="help-block">
                           <strong>{{ $errors->first('last_name') }}</strong>
                       </span>
                   @endif
                 </div>

                 <!-- Prénom du demandeur-->
                 <div class="wrap-input100 validate-input bg1 form-group{{ $errors->has('first_name') ? ' has-error' : '' }}" data-validate="Entrez svp le prénom de la personne demandeur">
                   <span class="label-input100">Prénom *</span>
                   <input class="input100 control-label" type="text" name="first_name" placeholder="Entrez le prénom de la personne demandeur" required>
                   @if ($errors->has('first_name'))
                       <span class="help-block">
                           <strong>{{ $errors->first('first_name') }}</strong>
                       </span>
                   @endif
                 </div>

                 <!-- Date de naissance du demandeur-->
                 <div class="wrap-input100 validate-input bg1 form-group{{ $errors->has('dob') ? ' has-error' : '' }}" data-validate="Entrez svp la date de naissance de la personne demandeur">
                   <span class="label-input100">Date de naissance *</span>
                   <input class="input100 control-label" type="text" name="dob" placeholder="Entrez la date de naissance de la personne demandeur" required>
                   @if ($errors->has('dob'))
                       <span class="help-block">
                           <strong>{{ $errors->first('dob') }}</strong>
                       </span>
                   @endif
                 </div>

                  <!-- Lieu de naissance du demandeur-->
                  <div class="wrap-input100 validate-input bg1 form-group{{ $errors->has('pob') ? ' has-error' : '' }}" data-validate="Entrez svp le lieu de naissance de la personne demandeur">
                   <span class="label-input100">Lieu de naissance *</span>
                   <input class="input100 control-label" type="text" name="pob" placeholder="Entrez le lieu de naissance de la personne demandeur" required>
                   @if ($errors->has('pob'))
                       <span class="help-block">
                           <strong>{{ $errors->first('pob') }}</strong>
                       </span>
                   @endif
                 </div>

                 <!-- Email du demandeur-->
                 <div class="wrap-input100 validate-input bg1 form-group{{ $errors->has('email') ? ' has-error' : '' }}" data-validate="Entrez svp l'adresse mail de la personne demandeur">
                   <span class="label-input100">Adresse mail *</span>
                   <input class="input100 control-label" type="text" name="email" placeholder="Entrez l'adresse mail de la personne demandeur" required>
                   @if ($errors->has('email'))
                       <span class="help-block">
                           <strong>{{ $errors->first('email') }}</strong>
                       </span>
                   @endif
                 </div>

                 <!-- Téléphone du demandeur-->
                 <div class="wrap-input100 validate-input bg1 form-group{{ $errors->has('phone') ? ' has-error' : '' }}" data-validate="Entrez svp le numéro de téléphone de la personne demandeur">
                   <span class="label-input100">Numéro de téléphone *</span>
                   <input class="input100 control-label" type="text" name="phone" placeholder="Entrez le numéro de téléphone de la personne demandeur" required>
                   @if ($errors->has('phone'))
                       <span class="help-block">
                           <strong>{{ $errors->first('phone') }}</strong>
                       </span>
                   @endif
                 </div>

                 <div class="wrap-input100 validate-input bg1 rs1-wrap-input100 form-group{{ $errors->has('physical_address') ? ' has-error' : '' }}" data-validate = "Entrez l'adresse ou le quartier">
                   <span class="label-input100 control-label">Adresse du logement *</span>
                   <input id="address_log" class="input100" type="text" name="physical_address" placeholder="Entrez l'adresse ou le quartier " autocomplete="on" required>
                   @if ($errors->has('physical_address'))
                       <span class="help-block">
                           <strong>{{ $errors->first('physical_address') }}</strong>
                       </span>
                   @endif
                 </div>

                 <!-- Nom père-->
                 <div class="wrap-input100 validate-input bg1 form-group{{ $errors->has('father_last_name') ? ' has-error' : '' }}" data-validate="Entrez svp le nom du père">
                   <span class="label-input100">Nom du père*</span>
                   <input class="input100 control-label" type="text" name="father_last_name" placeholder="Entrez le nom du père" required>
                   @if ($errors->has('father_last_name'))
                       <span class="help-block">
                           <strong>{{ $errors->first('father_last_name') }}</strong>
                       </span>
                   @endif
                 </div>

                 <!-- Prénom père-->
                 <div class="wrap-input100 validate-input bg1 form-group{{ $errors->has('father_first_name') ? ' has-error' : '' }}" data-validate="Entrez svp le prénom du père">
                   <span class="label-input100">Prénom du père *</span>
                   <input class="input100 control-label" type="text" name="father_first_name" placeholder="Entrez le prénom du père" required>
                   @if ($errors->has('father_first_name'))
                       <span class="help-block">
                           <strong>{{ $errors->first('father_first_name') }}</strong>
                       </span>
                   @endif
                 </div>


                 <!-- Nom de la mère-->
                 <div class="wrap-input100 validate-input bg1 form-group{{ $errors->has('mother_last_name') ? ' has-error' : '' }}" data-validate="Entrez svp le nom de la mère">
                   <span class="label-input100">Nom de la mère*</span>
                   <input class="input100 control-label" type="text" name="mother_last_name" placeholder="Entrez le nom du mère" required>
                   @if ($errors->has('mother_last_name'))
                       <span class="help-block">
                           <strong>{{ $errors->first('mother_last_name') }}</strong>
                       </span>
                   @endif
                 </div>

                 <!-- Prénom de la mère-->
                 <div class="wrap-input100 validate-input bg1 form-group{{ $errors->has('mother_first_name') ? ' has-error' : '' }}" data-validate="Entrez svp le prénom de la mère">
                   <span class="label-input100">Prénom de la mère *</span>
                   <input class="input100 control-label" type="text" name="mother_first_name" placeholder="Entrez le prénom de la mère" required>
                   @if ($errors->has('mother_first_name'))
                       <span class="help-block">
                           <strong>{{ $errors->first('mother_first_name') }}</strong>
                       </span>
                   @endif
                 </div>


                  <!-- Pièces justificatives-->
                 <div class="wrap-input100 input100-select bg1">
                 <div class="row">
                  <div class="col-md-">
                  <span class="label-input100">Pièces jointes * </span>
                  <p>La taille maximale des fichiers doit être inférieure à 16 Mo</p>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-md-12">
                  <span style="color: #7790b3; text-align:center;" id="counter"></span>
                  </div>
                 </div>
                   <div>
                      <div id="dZUpload" class="dropzone" style="margin-left:6px;">
                        <div class="dz-default dz-message">
                          <p>Déposez les images/photos ici ou cliquez pour télécharger</p>
                        </div>
                      </div>
                   </div>
                 </div>
                
               

                 <div class="container-contact100-form-btn">
                   <button class="contact100-form-btn" id="submit_form">
                     <span>
                       Ajoutez
                       <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                     </span>
                   </button>
                 </div>
              </div>
            </div>
           </div>
           <input type="hidden" name="status" value="A" />
  </form>
       

         <!--- FIN FORMULAIRE AJOUT LOGEMENT-->

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
                                 <span>Demande(s)</span>
                              <!---->
                           </div>
                           <div class="nav-total">
                              <div>
                                 <total> <span> {{ $nb_dem }} </span> <span style="text-transform:none" > requête(s) au total</span> </total>
                              </div>
                           </div>

                        </div>
                     </header-list>
                  </property-nav>
               </nav-list>
            </div>
            <div class="sidebar-filter">
               <!----> <!----> <!---->
               <a class="filter-item m-btn btn-primary addProperty" title="Soumettre une demande" onclick="openForm(); return false;">
                  <div class="icon-svg">
                  
                     <e-svg-icon set-class="i-svg--fill i-svg--12 i-svg-fill--white" xlink="#icon-line-plus" class="e-svg-icon">
                        <svg class="i-svg--fill i-svg--12 i-svg-fill--white" id="svgElement" viewBox="0 0 12 12">
                           <path d="M6.75 6.75v3.578c0 .371-.333.672-.75.672-.414 0-.75-.29-.75-.672V6.75H1.672C1.29 6.75 1 6.414 1 6c0-.417.3-.75.672-.75H5.25V1.672C5.25 1.29 5.586 1 6 1c.417 0 .75.3.75.672V5.25h3.578c.371 0 .672.333.672.75 0 .414-.29.75-.672.75H6.75z" fill-rule="evenodd"></path>
                        </svg>
                     </e-svg-icon>
                     <span style="text-transform:none">Soumettre une demande</span>
                  </div>
               </a>

            </div>
         </div>
      </header-sidebar>
      </div>

      <div class="panel-wrapper column">

<div class="wrapper-list">
  <div class="row propRow">
      <!---DEBUT  CARTE LOGEMENT 1 -->

    @foreach($infos_demand as $vl)
    <div class="col-xs-24 col-sm-10 col-md-8">
      <div class="m-panel panel-property--list" >
        <div class="markup"></div>
        <!-- DEBUT BODY DETAIL -->
        <div class="m-panel__body">
          <div class="body-detail">

          <div class="detail-img">
          <a title="icone demande" href="">
              <img class="img-responsive s-image--loading_success" alt="avatar" src="{{url('images/37005.jpg')}}" />
          </a>
          </div>
           <div class="detail-info">
              <div class="info-name">
                 <div class="name-address">
                    <a href="">

                    </a>
                 </div>
                 <div class="name-view">
                    <div class="u-flex--items-center">
                       <!----> <!---->
                       <div class="units"> <span class="unit-count">  {{ $vl->sp_label }} </span> </div>
                       <!----> <!---->
                    </div>
                    <div class="view-units">
                      @if($vl->status == "N")
                       <div class="units-progress">
                          <div style="width: 100%;"></div>
                       </div>
                       @endif
                       @if($vl->status == "A")
                       <div class="units-progress">
                         <div style="width: 33%;background-image: linear-gradient(90deg,#1ab92d,#f2ffd9 60%,#f2f6ff);"></div>
                       </div>
                       @endif
                       @if($vl->status == "P")
                       <div class="units-progress">
                         <div style="width: 66%;background-image: linear-gradient(90deg,#1ab92d,#f2ffd9 60%,#f2f6ff);"></div>
                       </div>
                       @endif
                       <div class="units-type">
                         @if($vl->status == "N")
                          <div class="occupied">
                             <!----> <span> </span>
                          </div>
                          @endif
                          @if($vl->status == "A")
                          <div class="vacant">
                             <!----> <span>En attente de validation</span>
                          </div>
                          @endif
                          @if($vl->status == "P")
                          <div class="vacant">
                             <!----> <span>En attente de paiement</span>
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
           <a class="col-xs-12 col-sm-12 tooltip-link" title="Détails" href="../demande/{{$_SESSION['current_service']}}/{{ $vl->id }}">
              <div class="icon-svg">
                 <i class="fas fa-house-user"></i>
              </div>
              <div class="m-title-tooltip">
                 <div class="tooltip-label">Détails</div>
              </div>
              <p>Détails</p>
           </a>
           <a class="col-xs-12 col-sm-12 tooltip-link"  title="Factures" href="transactions-proprietaire/{{ $vl->customer_id }}">
              <div class="icon-svg">
                 <i class="fas fa-file-invoice-dollar"></i>
              </div>
              <div class="m-title-tooltip">
                 <div class="tooltip-label">Paiements</div>
              </div>
              <p>Paiements</p>
           </a>

        </div>
        <!---FIN MENU AVEC ICONES-->
        <!---DEBUT FOOTER-->
        <div class="m-panel__footer between-xs">
           <div class="property-view"> <a class="m-btn-link--view modify_housing housing_{{ $vl->id }}" title="détails" href="" style="text-transform: none;"  onclick="openDesc(); return false;"> Modifier <i class="far fa-edit"></i></a> </div>
           <div class="property-view"> <a class="m-btn-link--view delete_housing housing_{{ $vl->id }}" title="supprimer" href="" style="text-transform: none; color:red;" onclick="confirmation(event,{{ $vl->id }})">  <i class="fa fa-trash" aria-hidden="true"></i></a> </div>
        </div>

        <!---FIN FOOTER-->
      </div>

    </div>

    @endforeach




<!---FIN CARTE LOGEMENT 1 -->

      <!--<h4>FIN HEADER  </h4> -->

           <div class="panel-wrapper column">

             <div class="wrapper-list">
               <div class="row propRow">

               </div>

             </div>

           </div>

         </div>




       </div>
         <div class="row">
           <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
           <lottie-player src="{{url('images/lottie/8558-floating-document.json')}}"  background="transparent"  speed="1"  style="width: 100%; height: 400px;display: inline-block;"  loop  autoplay></lottie-player>
         </div>
     </div>
     @endsection

     @section('scripts')
      <!--=============DROPZONE SCRIPT============-->
    <script src="{{ url('/js/dropzone/jquery.js') }}"></script>
    <script src="{{ url('/js/dropzone/dropzone.js') }}"></script>
    <!-- <script src="{{ url('/js/dropzone/dropzone-config.js') }}"></script> -->

    @section('scripts')
      <!--=============DROPZONE SCRIPT============-->
    <script src="{{ url('/js/dropzone/jquery.js') }}"></script>
    <script src="{{ url('/js/dropzone/dropzone.js') }}"></script>
    <!-- <script src="{{ url('/js/dropzone/dropzone-config.js') }}"></script> -->

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
       $(".js-select-sv-type").each(function(){
         $(this).select2({
           minimumResultsForSearch: 20,
           dropdownParent: $(this).next('.dropDownSelect2')
         });

       })
       $(".js-select-sv-name").each(function(){
         $(this).select2({
           minimumResultsForSearch: 20,
           dropdownParent: $(this).next('.dropDownSelect2')
         });

       })
       $(".js-select-rq-type").each(function(){
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
         /*if (document.getElementById("propDesc").style.display != "none"){
           closeDesc();
         }*/
         document.getElementById("propForm").style.display = "flex";
         document.getElementById('requesterDetails-popup').style.display = "none";
         document.getElementById('requestServicename-popup').style.display = "none";
         document.getElementById('requestType-popup').style.display = "none";

       }

       function closeForm() {
         document.getElementById("propForm").style.display = "none";
       }

       function openInfoForm(){
         document.getElementById('requesterDetails-popup').style.display = "flex";
       }

       function openSelectionServicenameForm(selectedOption){
         if(selectedOption == 'Mairie')
          document.getElementById('requestServicename-popup').style.display = "flex";
       }

       function openSelectionRequestypeForm(selectedOption){
         if(selectedOption.includes('Mairie'))
          document.getElementById('requestType-popup').style.display = "flex";
       }

       

       function showAddPropertyNotif(message) {
         $('.panel-heading').notify(message, {
           // whether to hide the notification on click
          clickToHide: true,
          // whether to auto-hide the notification
          autoHide: true,
          // if autoHide, hide after milliseconds
          autoHideDelay: 10000,
          // show the arrow pointing at the element
          arrowShow: true,
          // arrow size in pixels
          arrowSize: 5,
          // position defines the notification position though uses the defaults below
          position: 'top',
          // default positions
          elementPosition: 'top left',
          globalPosition: 'top left',
          // default style
          style: 'bootstrap',
          // default class (string or [string])
          className: 'success',
          // show animation
          showAnimation: 'slideDown',
          // show animation duration
          showDuration: 400,
          // hide animation
          hideAnimation: 'slideUp',
          // hide animation duration
          hideDuration: 200,
          // padding between element and notification
          gap: -2,
          });
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

        var selectedSvType = 'Mairie';
        $("<input class='service_type' type='hidden' name='service_type' value='"+selectedSvType+"' />").insertAfter('.select2-selection__rendered');
        $(".js-select-sv-type").on("change", function() {
          selectedSvType = $(this).val();
          $('.service_type').val(selectedSvType);
        });

        var selectedSvName = 'Mairie1';
        $("<input class='service_name' type='hidden' name='service_name' value='"+selectedSvName+"' />").insertAfter('.select2-selection__rendered');
        $(".js-select-sv-name").on("change", function() {
          selectedSvName = $(this).val();
          $('.service_name').val(selectedSvName);
        });

        var selectedRqType = 'Mairie_extrait';
        $("<input class='request_type' type='hidden' name='request_type' value='"+selectedRqType+"' />").insertAfter('.select2-selection__rendered');
        $(".js-select-rq-type").on("change", function() {
          selectedRqType = $(this).val();
          $('.request_type').val(selectedRqType);
        });

        

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
         var strong_nb_rooms_housing = $('.js-select2').val(status_housing);
         var strong_option_fees_selected = $('.strong_option_fees_selected_'+housing_id[1]).val();
         $("<input class='strong_option_fees_selected' type='hidden' name='strong_option_fees_selected' value='"+strong_option_fees_selected+"' />").insertAfter('.update_housing_id');
         var img_housing_id_m = {};
         var img_id_m ={};
          $(".modify_image_"+housing_id[1]).each(function(index) {
            img_housing_id_m[index] = $(this).val();
            img_id_m[index] = $(".image_id_"+housing_id[1]).val();
            $("<input class='new_img_modif' type='hidden' name='new_img_modif' value='"+img_housing_id_m[index]+"' />").insertAfter('.modify_title_'+housing_id[1]);
            //console.log(img_housing_id_m[index]);
          });
          $(".image_id_"+housing_id[1]).each(function(index) {
            img_id_m[index] = $(this).val();
            $("<input class='img_id_modif' type='hidden' name='img_id_modif' value='"+img_id_m[index]+"' />").insertAfter('.modify_title_'+housing_id[1]);
            //console.log(img_housing_id_m[index]);
          });

  
         $('.update_title_log').val(title_housing);
         $('.update_address_log').val(address_housing);
         $('.update_city_log').val(city_housing);
         $("select option[value="+status_housing+"]").attr('selected','selected');
         $('.js-select2').val(status_housing).change();
         $("select option[value="+nb_rooms_housing+"]").attr('selected','selected');
         $('.js-select-bed').val(nb_rooms_housing).change();
         $('select option[value="'+strong_option_fees_selected+'"]').attr('selected','selected');
         $('.js-select-fees').val(strong_option_fees_selected).change();
         $('.update_housing_type_log').val(housing_type);
         $('.update_housing_id').val(housing_id[1]);

       });
       $(".js-select-bed-m").on("change", function() {
          $( ".strong_nb_rooms_housing" ).remove();
          nb_rooms_housing = $(this).val();
          $("<input class='strong_nb_rooms_housing' type='hidden' name='strong_nb_rooms_housing' value='"+nb_rooms_housing+"' />").insertAfter('.update_housing_id');
          //console.log(nb_rooms_housing);
        });
        $(".js-select2-m").on("change", function() {
          $( ".strong_status_housing" ).remove();
          status_housing = $(this).val();
          $("<input class='strong_status_housing' type='hidden' name='strong_status_housing' value='"+status_housing+"' />").insertAfter('.update_housing_id');

        });


        $(".js-select-fees-m").on("change", function() {
          $( ".strong_option_fees_selected" ).remove();
          fees = $(this).val();
          $("<input class='strong_option_fees_selected' type='hidden' name='strong_option_fees_selected' value='"+fees+"' />").insertAfter('.update_housing_id');
          //console.log(nb_rooms_housing);
        });

       $('.add_occ').click(function(){
         var nameClass_2 = this.className.split(' ');
         var housing_id_2 = nameClass_2[2].split('_');
         $('.add_occ_housing_id').val(housing_id_2[1]);
         var address_housing_2 = $('.modify_address_'+housing_id_2[1]).val();
         $('.add_occ_housing_address').val(address_housing_2);
       });

     });

     function confirmation(ev,id) {
       ev.preventDefault();
       swal({
         title: "Etes vous sûr de vouloir supprimer ce logement ?",   text: "Le locataire associé à ce logement sera également supprimé ! Cette action est irréversible.",
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Annuler",
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Oui, supprimez!",
          closeOnConfirm: false
        }, function(){
           swal({
               title: "Supprimé!",
               text: "Ce logement a été supprimé avec succès.",
               type: "success",
               //timer: 3000
           },
           function(){
             window.location.href = "../mes-logements/delete/"+ id;
           })
     });
      }

     </script>
 <!--=============DROPZONE SCRIPT============-->
     <script>
     Dropzone.autoDiscover = false;
     $(document).ready(function () {
      var total_photos_counter = 0;
      var name = "";
    $("#dZUpload").dropzone({
      headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
        method: "POST",
        url: "mes-demandes",
        uploadMultiple: false,
        autoProcessQueue: true,
        parallelUploads: 4,
        maxFilesize: 16,
        addRemoveLinks: true,
        dictRemoveFile: "Enlever l'image",
        dictFileTooBig: "L'image est supérieure à 16 Mo",
        timeout: 10000,
        renameFile: function (file) {
        name = new Date().getTime() + Math.floor((Math.random() * 100) + 1) + '_' + file.name;
        return name;
    },
    init: function () {
        var myDropzone = this;

        this.on("sending", function(file, xhr, formData){
            $('#add_logement').find('input').each(function() {
                formData.append( $(this).attr('name'), $(this).val() );
                console.log($(this).attr('name')+'__'+$(this).val());
            });
            formData.append('file','test_2');
        });
        this.on("success", function(file, response) {
          var imgName = response;
            file.previewElement.classList.add("dz-success");
            console.log("Successfully uploaded :" + imgName);
            total_photos_counter++;
            $("#counter").text("# " + total_photos_counter + "  pièce(s) jointe(s) au total" );
            file["customName"] = name;
            console.log(response);
        });
        this.on("error", function(file, response) {
          var errorDisplay = document.querySelectorAll('[data-dz-errormessage]');
          console.log(response);
          console.log(errorDisplay);
          file.previewElement.classList.add("dz-error");
        });
      
    },
      
    });
});

$(document).ready(function () {
      var total_photos_counter = 0;
      var name = "";
  
  $('.modify_housing').click(function(){
  var new_img_modif = {};
  var img_id_m = {};
  var index = 0;
  var idx = 0;
    
    $(".new_img_modif").each(function(index) {
      new_img_modif[index] = $(this).val();

      //console.log(new_img_modif[index]);
    });

    $(".img_id_modif").each(function(idx) {
      img_id_m[idx] = $(this).val();
    });


    $("#dZUploadMd").dropzone({
      headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
        method: "POST",
        url: "{{ route('mes-logements.update') }}",
        uploadMultiple: false,
        autoProcessQueue: true,
        parallelUploads: 4,
        maxFilesize: 16,
        addRemoveLinks: true,
        removedfile: function(file) {
          var fileName = file.name;
          var image_id = fileName.split(' ');
          console.log(image_id[1]);
          $.ajax({
            type: 'POST',
            headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
            url: "{{ route('mes-images.delete') }}",
            data: {name: fileName,request: 'delete',image_id: image_id[1]},
            sucess: function(data){
                console.log('success: ' + data);
            }
          });
          var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        },
        dictRemoveFile: "Enlever l'image",
        dictFileTooBig: "L'image est supérieure à 16 Mo",
        timeout: 10000,
        renameFile: function (file) {
        name = new Date().getTime() + Math.floor((Math.random() * 100) + 1) + '_' + file.name;
        return name;
      },
        
    init: function () {
        var myDropzone = this;
        // Create the mock file:
        for (pic in new_img_modif){
          var img = new Image();
          img.size = 12345;
          img.src = new_img_modif[pic];
          img.name = 'Photo '+img_id_m[pic];
          img.height = 944;
          img.width = 698;

          // Call the default addedfile event handler
          myDropzone.emit("addedfile", img);

          // And optionally show the thumbnail of the file:
          myDropzone.emit("thumbnail", img, img.src);

          myDropzone.emit("complete", img);
          $('img').css({"max-width": "100%", "max-height": "100%"});
          $('.dz-image').css({"width": "120", "height": "120"});

        }



        this.on("sending", function(file, xhr, formData){
            $('#update_logement').find('input').each(function() {
                formData.append( $(this).attr('name'), $(this).val() );
            });
        });
        this.on("success", function(file, response) {
          $('.dz-image').css({"width":"100%", "height":"auto"});
          var imgName = response;
            file.previewElement.classList.add("dz-success");
            console.log("Successfully uploaded :" + imgName);
            total_photos_counter++;
            $("#counter").text("# " + total_photos_counter + "  images(s) au total" );
            file["customName"] = name;
            console.log(response);
        });
        this.on("error", function(file, response) {
          console.log(response);
          file.previewElement.classList.add("dz-error");
        });
      
    },
      
    });
  });
});
</script>
@endsection