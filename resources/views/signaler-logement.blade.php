<?php
session_start();
$notification = (isset($_SESSION["numberOfBillsNonPaid"])) ? $_SESSION["numberOfBillsNonPaid"] : '';

?>
@extends('layouts.app', ['notification' => $notification, 'service' => $_SESSION['current_service'], 'services' => $actived_services, 'profilNotif' => $_SESSION['profilNotif']])

@section('content')

<div class="container">
<link rel="stylesheet" type="text/css" href="{{url('vendor/select2/select2.min.css')}}">
 <link rel="stylesheet" type="text/css" href="{{url('css/utilForm.css')}}">
 <link rel="stylesheet" type="text/css" href="{{url('css/mainForm.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('vendor/animate/animate.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{url('vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{url('vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{url('vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->


<script src="{{ url('js/notify.js') }}"></script>
<script src="{{ url('js/sweetalert.min.js') }}"></script>

@if(session('message'))
<input  type='hidden' class="mess" value="{{ session('message') }}">
@endif


  <!--TITLE OF THE PAGE-->
  <div class="row rowloc rowmobile" style="margin-top:14%;z-index: 1100;">
  <div class="col-md-12" style="margin-top:10px;margin-bottom:20px;text-align:center;flex-basis:100%;max-width:100%;z-index: 1100;">
   <br /><br />
 </div>

  </div>
<!-- END TITLE OF THE PAGE-->
<!--CONTENT OF THE PAGE-->

<script type="text/javascript"  src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBK1lhFLXgX3IbSZegrgp4i2zjj0kyYkt4"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var places = new google.maps.places.Autocomplete(document.getElementById('address_log'));
        google.maps.event.addListener(places, 'place_changed', function () {
        });
    });
</script>

<ul class="pager">
  <li class="previous"><a href="/rechercher-logement"><span aria-hidden="true">&laquo;</span> Retour aux logements </a></li>
</ul>

@if(empty(session('message')))
         <!---FORMULAIRE AJOUT LOGEMENT-->
         <form enctype="multipart/form-data" method="post" action="{{ route('signaler-logement-save') }}">

           {{csrf_field()}}
           <div class="container-contact100">
             <div class="wrap-contact100">
               <form class="contact100-form validate-form" >
                 <span class="contact100-form-title">
                   Signaler un logement
                 </span>

                 <div class="wrap-input100 bg1 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                   <span class="label-input100 control-label">Nom Complet de la personne ou agence *</span>
                   <input class="input100" type="text" name="name" placeholder="Entrez le nom complet de la personne ou de l'agence" required>
                   @if ($errors->has('name'))
                       <span class="help-block">
                           <strong>{{ $errors->first('name') }}</strong>
                       </span>
                   @endif
                 </div>

                 <div class="wrap-input100 bg1 form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                   <span class="label-input100 control-label">Téléphone du propriétaire * </span>
                   <input class="input100" type="tel" name="phone" required placeholder="Entrez le numéro de téléphone du propriétaire">
                   @if ($errors->has('phone'))
                       <span class="help-block">
                           <strong>{{ $errors->first('phone') }}</strong>
                       </span>
                   @endif
                 </div>

                 <div class="wrap-input100 validate-input bg1  form-group{{ $errors->has('address') ? ' has-error' : '' }}" data-validate = "Entrez l'adresse ou le quartier">
                   <span class="label-input100 control-label">Adresse du logement *</span>
                   <input id="address_log" class="input100" type="text" name="address" placeholder="Entrez l'adresse ou le quartier " autocomplete="on" required>
                   @if ($errors->has('address'))
                       <span class="help-block">
                           <strong>{{ $errors->first('address') }}</strong>
                       </span>
                   @endif
                 </div>

                 <div class="wrap-input100 bg1 form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                   <span class="label-input100 control-label">Ville du logement *</span>
                   <input class="input100" type="text" name="city" placeholder="Entrez la ville du  logement" required>
                   @if ($errors->has('city'))
                       <span class="help-block">
                           <strong>{{ $errors->first('city') }}</strong>
                       </span>
                   @endif
                 </div>

                 <div class="wrap-input100 input100-select bg1">
                   <span class="label-input100">Nombre de chambres *</span>
                   <div>
                     <select class="js-select-bed" name="nb_rooms" required>
                       <option value="Studio">Studio</option>
                       <option value="1">1</option>
                       <option value="2">2</option>
                       <option value="3">3</option>
                       <option value="4">4</option>
                       <option value="5">5</option>
                       <option value="6">6</option>
                       <option value="maison">maison</option>
                     </select>
                     <div class="dropDownSelect2"></div>
                   </div>
                 </div>

                 <div class="wrap-input100 bg1 form-group{{ $errors->has('surface') ? ' has-error' : '' }}">
                   <span class="label-input100 control-label">Superficie *</span>
                   <input class="input100" type="number" pattern="[0-9]{0,10}" name="surface" required  placeholder="Renseignez la superficie en mètre carré">
                   @if ($errors->has('surface'))
                       <span class="help-block">
                           <strong>{{ $errors->first('surface') }}</strong>
                       </span>
                   @endif
                 </div>

                 <div class="wrap-input100 bg1 form-group{{ $errors->has('caution') ? ' has-error' : '' }}">
                   <span class="label-input100 control-label">Caution *</span>
                   <input class="input100" type="number" pattern="[0-9]{0,10}" name="caution" required  placeholder="Renseignez le montant de la caution">
                   @if ($errors->has('caution'))
                       <span class="help-block">
                           <strong>{{ $errors->first('caution') }}</strong>
                       </span>
                   @endif
                 </div>

                 <div class="wrap-input100 bg1 form-group{{ $errors->has('monthly_pm') ? ' has-error' : '' }}">
                   <span class="label-input100 control-label">Loyer *</span>
                   <input class="input100" type="number" pattern="[0-9]{0,10}" name="monthly_pm" required  placeholder="Entrez le montant du loyer">
                   @if ($errors->has('monthly_pm'))
                       <span class="help-block">
                           <strong>{{ $errors->first('monthly_pm') }}</strong>
                       </span>
                   @endif
                 </div>
                
               
               <!--  <div class="wrap-input100 input100-select bg1">
                   <span class="label-input100">Libre ou occupÃ© *</span>
                   <div>
                     <select class="js-select2" name="status_housing" required>
                       <option disabled>Choisir svp</option>
                       <option value="Y">Logement libre</option>
                       <option value="N">Logement occupÃ©</option>
                     </select>
                     <div class="dropDownSelect2"></div>
                   </div>
                 </div> -->
                 <div class="wrap-input100 input100-select bg1">
                   <span class="label-input100">Le logement est-il meublé? *</span>
                   <div>
                     <select class="js-select2 js-select-meuble" name="housing_type" required>
                       <option value="nonmeuble" selected>NON</option>
                       <option value="meuble">OUI</option>
                     </select>
                     <div class="dropDownSelect2"></div>
                   </div>
                 <input type="hidden" name="status_housing" value='Y' />
                </div>
                 <div class="container-contact100-form-btn">
                   <button class="contact100-form-btn" id="submit_form">
                     <span>
                       Envoyez
                       <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                     </span>
                   </button>
                 </div>
               </form>
             </div>
           </div>
         </form>
@endif

         <!--- FIN FORMULAIRE AJOUT LOGEMENT-->

@if(session('message'))

<div class="alert alert-success col-md-8" role="alert">
  {{ session('message')}}
</div>

@endif

</div>
</div>
 @endsection

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
       $(".js-select-fees").each(function(){
         $(this).select2({
           minimumResultsForSearch: 20,
           dropdownParent: $(this).next('.dropDownSelect2')
         });

       })
       } );
     </script>
     <!--===============================================================================================-->
     <script>

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

        var selectedOption = 'Studio';
        $("<input class='strong_option_selected' type='hidden' name='strong_option_selected' value='"+selectedOption+"' />").insertAfter('.select2-selection__rendered');
        $(".js-select-bed").on("change", function() {
          selectedOption = $(this).val();
          $('.strong_option_selected').val(selectedOption);
        });

        var selectedOptionMeuble = 'nonmeuble';
        $("<input class='strong_option_meuble_selected' type='hidden' name='strong_option_meuble_selected' value='"+selectedOptionMeuble+"' />").insertAfter('.select2-selection__rendered');
        $(".js-select-meuble").on("change", function() {
          selectedOptionMeuble = $(this).val();
          $('.strong_option_meuble_selected').val(selectedOptionMeuble);
        });

        var selectedOptionFees = '0.01';
        $("<input class='strong_option_fees_selected' type='hidden' name='strong_option_fees_selected' value='"+selectedOptionFees+"' />").insertAfter('.select2-selection__rendered');
        $(".js-select-fees").on("change", function() {
          selectedOptionFees = $(this).val();
          $('.strong_option_fees_selected').val(selectedOptionFees);
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

@endsection