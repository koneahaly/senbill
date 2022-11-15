<?php
session_start();
$notification = (isset($_SESSION["numberOfBillsNonPaid"])) ? $_SESSION["numberOfBillsNonPaid"] : '';

?>
@extends('layouts.realEstate', ['notification' => $notification, 'services' => $actived_services, 'profilNotif' => $_SESSION['profilNotif']])

@section('content')

<div class="container">
  <!--TITLE OF THE PAGE-->
  <div class="row rowloc rowmobile" style="margin-top:14%;z-index: 1100;">
  <div class="col-md-12" style="margin-top:10px;margin-bottom:20px;text-align:center;flex-basis:100%;max-width:100%;z-index: 1100;">
   <h3><strong>Mes logements</strong></h3>
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


         <!---FORMULAIRE AJOUT LOGEMENT-->
         <form enctype="multipart/form-data" method="post" action="{{ route('ownerProperties') }}" id="add_logement">

           {{csrf_field()}}
           <div class="container-contact100 form-popup" id="propForm">
             <div class="wrap-contact100">
               <form class="contact100-form validate-form" >
                 <span class="contact100-form-title">
                   Ajoutez un logement
                 </span>

                 <div class="wrap-input100 validate-input bg1 form-group{{ $errors->has('title') ? ' has-error' : '' }}" data-validate="Entrez svp un nom pour le logement">
                   <span class="label-input100">Nom du logement *</span>
                   <input class="input100 control-label" type="text" name="title" placeholder="Entrez un nom pour le logement" required>
                   @if ($errors->has('title'))
                       <span class="help-block">
                           <strong>{{ $errors->first('title') }}</strong>
                       </span>
                   @endif
                 </div>
                 <div class="wrap-input100 validate-input bg1 rs1-wrap-input100 form-group{{ $errors->has('address') ? ' has-error' : '' }}" data-validate = "Entrez l'adresse ou le quartier">
                   <span class="label-input100 control-label">Adresse du logement *</span>
                   <input id="address_log" class="input100" type="text" name="address" placeholder="Entrez l'adresse ou le quartier " autocomplete="on" required>
                   @if ($errors->has('address'))
                       <span class="help-block">
                           <strong>{{ $errors->first('address') }}</strong>
                       </span>
                   @endif
                 </div>
                 <div class="row" style="padding-left:1%">
                 <div class="wrap-input100 rs1-wrap-input100 input100-select bg1 col-md-8">
                   <span class="label-input100">Région du logement *</span>
                   <div>
                     <select class="js-select-city" name="city_choice" required>
                       <option value="Dakar">Dakar</option>
                       <option value="Diourbel">Diourbel</option>
                       <option value="Fatick">Fatick</option>
                       <option value="Kaolack">Kaolack</option>
                       <option value="Kolda">Kolda</option>
                       <option value="Louga">Louga</option>
                       <option value="Matam">Matam</option>
                       <option value="Stlouis">Stlouis</option>
                       <option value="Tamba">Tamba</option>
                       <option value="Thies">Thies</option>
                       <option value="Ziguinchor">ZIG</option>
                     </select>
                     <div class="dropDownSelect2"></div>
                   </div>
                 </div>
                 <div class="col-md-1"></div>
                 <div class="wrap-input100 rs1-wrap-input100 input100-select bg1 col-md-8">
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
                 <div class="col-md-1"></div>
                 <div class="wrap-input100 rs1-wrap-input100 input100-select bg1{{ $errors->has('surface') ? ' has-error' : '' }} col-md-6">
                   <span class="label-input100 ">Superficie *</span>
                   <input class="input100 surface" type="number" pattern="[0-9]{0,10}" name="surface" required  placeholder="en m">
                   @if ($errors->has('surface'))
                       <span class="help-block">
                           <strong>{{ $errors->first('surface') }}</strong>
                       </span>
                   @endif
                 </div>
              </div>
                 <!-- catégorisation du logement -->
                 <div class="wrap-input100 input100-select bg1">
                 <span class="label-input100 control-label">Catégorie du logement *
                 <br />
                 </span>
                 <br />
                 <div class="row">
                  <div class="form-check-inline col-md-3 offset-md-3">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" value="A" name="category"> A
                        <sup><a data-toggle="tooltip" data-placement="bottom" title="<?php echo File::get(storage_path('title-toggle/category-a.txt')); ?>"> <i class="fas fa-info-circle"></i></a></sup>
                      </label>
                    </div>
                    <div class="form-check-inline col-md-3 offset-md-3">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" value="B" name="category"> B
                        <sup><a data-toggle="tooltip" data-placement="bottom" title="<?php echo File::get(storage_path('title-toggle/category-b.txt')); ?>"> <i class="fas fa-info-circle"></i></a></sup>
                      </label>
                    </div>
                    <div class="form-check-inline col-md-3 offset-md-3">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" value="C" name="category" > C
                        <sup><a data-toggle="tooltip" data-placement="bottom" title="<?php echo File::get(storage_path('title-toggle/category-c.txt')); ?>"> <i class="fas fa-info-circle"></i></a></sup>
                      </label>
                    </div>
                    <div class="form-check-inline col-md-3 offset-md-3">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" value="D" name="category" > D
                        <sup><a data-toggle="tooltip" data-placement="bottom" title="<?php echo File::get(storage_path('title-toggle/category-d.txt')); ?>"> <i class="fas fa-info-circle"></i></a></sup>
                      </label>
                    </div>
                    <div class="form-check-inline col-md-3 offset-md-3">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" value="E" name="category"> E
                        <sup><a data-toggle="tooltip" data-placement="bottom" title="<?php echo File::get(storage_path('title-toggle/category-e.txt')); ?>"> <i class="fas fa-info-circle"></i></a></sup>
                      </label>
                    </div>
                    <div class="form-check-inline col-md-3 offset-md-3">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" value="F" name="category"> F
                        <sup><a data-toggle="tooltip" data-placement="bottom" title="<?php echo File::get(storage_path('title-toggle/category-f.txt')); ?>"> <i class="fas fa-info-circle"></i></a></sup>
                      </label>
                    </div>
                    <div class="form-check-inline col-md-3 offset-md-3">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" value="G" name="category" > G
                        <sup><a data-toggle="tooltip" data-placement="bottom" title="<?php echo File::get(storage_path('title-toggle/category-g.txt')); ?>"> <i class="fas fa-info-circle"></i></a></sup>
                      </label>
                    </div>
                    <div class="form-check-inline col-md-3 offset-md-3">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" value="H" name="category" > H
                        <sup><a data-toggle="tooltip" data-placement="bottom" title="<?php echo File::get(storage_path('title-toggle/category-h.txt')); ?>"> <i class="fas fa-info-circle"></i></a></sup>
                      </label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-check-inline col-md-3 offset-md-3">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" value="I" name="category"> I
                        <sup><a data-toggle="tooltip" data-placement="bottom" title="<?php echo File::get(storage_path('title-toggle/category-i.txt')); ?>"> <i class="fas fa-info-circle"></i></a></sup>
                      </label>
                    </div>
                    <div class="form-check-inline col-md-3 offset-md-3">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" value="J" name="category"> J
                        <sup><a data-toggle="tooltip" data-placement="bottom" title="<?php echo File::get(storage_path('title-toggle/category-j.txt')); ?>"> <i class="fas fa-info-circle"></i></a></sup>
                      </label>
                    </div>
                    <div class="form-check-inline col-md-3 offset-md-3">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" value="K" name="category"> K
                        <sup><a data-toggle="tooltip" data-placement="bottom" title="<?php echo File::get(storage_path('title-toggle/category-k.txt')); ?>"> <i class="fas fa-info-circle"></i></a></sup>
                      </label>
                    </div>
                    <div class="form-check-inline col-md-3 offset-md-3">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" value="L" name="category"> L
                        <sup><a data-toggle="tooltip" data-placement="bottom" title="<?php echo File::get(storage_path('title-toggle/category-l.txt')); ?>"> <i class="fas fa-info-circle"></i></a></sup>
                      </label>
                    </div>
                    <div class="form-check-inline col-md-3 offset-md-3">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" value="M" name="category"> M
                        <sup><a data-toggle="tooltip" data-placement="bottom" title="<?php echo File::get(storage_path('title-toggle/category-m.txt')); ?>"> <i class="fas fa-info-circle"></i></a></sup>
                      </label>
                    </div>
                  </div>
                  </div>
                  <!-- Fin de catégorisation du logement -->
                <div class="row" style="padding-left:1%">
                <div class="wrap-input100 bg1 rs1-wrap-input100 input100-select col-md-8 {{ $errors->has('monthly_pm_rec') ? ' has-error' : '' }}">
                    <span class="label-input100 control-label">Loyer recommandé </span>
                    <input class="input100 monthly_pm_rec" type="number" pattern="[0-9]{0,10}" name="monthly_pm_rec" disabled placeholder="loyer recommandé">
                    @if ($errors->has('monthly_pm_rec'))
                        <span class="help-block">
                            <strong>{{ $errors->first('monthly_pm_rec') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="col-md-1"></div>
                  <div class="wrap-input100 bg1 monthly_pm_div rs1-wrap-input100 input100-select col-md-10 {{ $errors->has('monthly_pm') ? ' has-error' : '' }}">
                    <span class="label-input100 control-label">Loyer *</span>
                    <input class="input100 monthly_pm" type="number" pattern="[0-9]{0,10}" name="monthly_pm" name="monthly_pm" required  placeholder="Entrez le montant du loyer">
                    @if ($errors->has('monthly_pm'))
                        <span class="help-block help-monthly-pm">
                            <strong>{{ $errors->first('monthly_pm') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>

                 <div class="wrap-input100 input100-select bg1">
                   <span class="label-input100">Frais à la charge du *</span>
                   <div>
                     <select class="js-select-fees js-select-fees" name="fees" required>
                       <option value="0.01">locataire</option>
                       <option value="-0.01">propriétaire</option>
                     </select>
                     <div class="dropDownSelect2"></div>
                   </div>
                 </div>


                 <div class="wrap-input100 input100-select bg1">
                 <div class="row">
                  <div class="col-md-">
                  <span class="label-input100">Image/Photo du logement * </span>
                  <p>La dernière Image/Photo sera par défaut</p>
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
                       Ajoutez
                       <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                     </span>
                   </button>
                 </div>
                 <?php
                  $i = 0;
                  $category = ['A','B','C','D','E','F','G','H','I','J','K','L','M'];
                  ?>
                 @foreach($scales_housing as $scale_housing)
                  <input type="hidden" name="Dakar_{{ $category[$i] }}" value='{{ $scale_housing->Dakar}}' />
                  <input type="hidden" name="Diourbel_{{ $category[$i] }}" value='{{ $scale_housing->Diourbel}}' />
                  <input type="hidden" name="Fatick_{{ $category[$i] }}" value='{{ $scale_housing->Fatick}}' />
                  <input type="hidden" name="Kaolack_{{ $category[$i] }}" value='{{ $scale_housing->Kaolack}}' />
                  <input type="hidden" name="Kolda_{{ $category[$i] }}" value='{{ $scale_housing->Kolda}}' />
                  <input type="hidden" name="Louga_{{ $category[$i] }}" value='{{ $scale_housing->Louga}}' />
                  <input type="hidden" name="Matam_{{ $category[$i] }}" value='{{ $scale_housing->Matam}}' />
                  <input type="hidden" name="Stlouis_{{ $category[$i] }}" value='{{ $scale_housing->Stlouis}}' />
                  <input type="hidden" name="Tamba_{{ $category[$i] }}" value='{{ $scale_housing->Tamba}}' />
                  <input type="hidden" name="Thies_{{ $category[$i] }}" value='{{ $scale_housing->Thies}}' />
                  <input type="hidden" name="ZIG_{{ $category[$i] }}" value='{{ $scale_housing->ZIG}}' />
                  <?php $i++; ?>
                @endforeach
               </form>
             </div>
           </div>
         </form>
       

         <!--- FIN FORMULAIRE AJOUT LOGEMENT-->

                  <!---DESCRIPTION LOGEMENT-->
                  <form method="post" action="{{ route('ownerProperties') }}" id="update_logement">
           {{csrf_field()}}
           <div class="container-contact100 desc-popup" id="propDesc">
             <div class="wrap-contact100">
               <form class="contact100-form validate-form" >
                 <span class="contact100-form-title">
                   Modifier votre logement
                 </span>

                 <div class="wrap-input100 validate-input bg1 form-group{{ $errors->has('title') ? ' has-error' : '' }}" data-validate="Entrez svp un nom pour le logement">
                   <span class="label-input100 control-label">Nom du logement *</span>
                   <input class="input100 update_title_log" type="text" name="title" placeholder="Entrez un nom pour le logement" value="Keur Serigne Saliou" required>
                   @if ($errors->has('title'))
                       <span class="help-block">
                           <strong>{{ $errors->first('title') }}</strong>
                       </span>
                   @endif
                 </div>
                 <div class="wrap-input100 validate-input bg1 rs1-wrap-input100 form-group{{ $errors->has('address') ? ' has-error' : '' }}" data-validate = "Entrez l'adresse ou le quartier">
                   <span class="label-input100 control-label">Adresse du logement *</span>
                   <input id="address_log_update" class="input100 update_address_log" type="text" name="address" placeholder="Entrez l'adresse ou le quartier" value="Hann Mariste 2 villa Y46" required>
                   @if ($errors->has('address'))
                       <span class="help-block">
                           <strong>{{ $errors->first('address') }}</strong>
                       </span>
                   @endif
                 </div>

                 <div class="wrap-input100 bg1 rs1-wrap-input100">
                   <span class="label-input100 control-label form-group{{ $errors->has('city') ? ' has-error' : '' }}">Ville du logement</span>
                   <input class="input100 update_city_log" type="text" name="city" placeholder="Entrez la ville du  logement" value="Dakar" required>
                   @if ($errors->has('city'))
                       <span class="help-block">
                           <strong>{{ $errors->first('city') }}</strong>
                       </span>
                   @endif
                 </div>
                 <div class="wrap-input100 input100-select bg1">
                   <span class="label-input100">Nombre de chambres *</span>
                   <div class="update_nb_rooms_log">
                     <select class="js-select-bed js-select-bed-m" name="nb_rooms_housing_m" required>
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
                   <span class="label-input100">Frais à la charge du *</span>
                   <div class="update_fees_log">
                     <select class="js-select-fees js-select-fees-m" name="fees_m" required>
                       <option class="disp_loc" value="0.01">locataire</option>
                       <option class="disp_prop" value="-0.01">propriétaire</option>
                     </select>
                     <div class="dropDownSelect2"></div>
                   </div>
                 </div>

                 <div class="wrap-input100 input100-select bg1">
                 <div class="row">
                  <div class="col-md-">
                  <span class="label-input100">Image/Photo du logement * </span>
                  <p>La dernière Image/Photo sera par défaut</p>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-md-12">
                  <span style="color: #7790b3; text-align:center;" id="counter"></span>
                  </div>
                 </div>
                   <div>
                      <div id="dZUploadMd" class="dropzone" style="margin-left:6px;">
                        <div class="dz-default dz-message dz-image">
                          <p>Déposez les images/photos ici ou cliquez pour télécharger</p>
                        </div>
                      </div>
                   </div>
                 </div>

                 <div class="wrap-input100 input100-select bg1">
                   <span class="label-input100">Libre ou occupé *</span>
                   <div class="update_status_log">
                     <select class="js-select2 js-select2-m" name="status_housing_m" required>
                       <option disabled>Choisir svp</option>
                       <option class="status_Y" value="Y">Logement libre</option>
                       <option class="status_N" value="N">Logement occupé</option>
                     </select>
                     <div class="dropDownSelect2"></div>
                   </div>
                 </div>

                 <div class="w-full js-show-service">
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
                   <button class="contact100-form-btn" id="submit_form_m">
                     <span>
                       Modifier
                       <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                     </span>
                   </button>
                 </div>
                 <input type="hidden" name="housing_id_m" class="update_housing_id" value="true"/>
               </form>
             </div>
           </div>
         </form>
         <!---FIN  DESCRIPTION LOGEMENT-->

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
               <a class="filter-item m-btn btn-primary addProperty" title="Ajouter un logement" onclick="openForm(); return false;">
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
                 <div class="col-xs-24 col-sm-10 col-md-8">
                   <div class="m-panel panel-property--list" >
                     <div class="markup"></div>
                     <!-- DEBUT BODY DETAIL -->
                     <div class="m-panel__body">
                       <div class="body-detail">

                       <div class="detail-img">
                        @foreach($images as $image)
                          @if($image['housing_id'] == $vl->id)
                              <a title="icone logement" href="">
                              <img class="img-responsive s-image--loading_success" alt="avatar" src="{{$image['src'] }}" />
                            </a>
                          @endif
                        @endforeach
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
                        <div class="property-view"> <a class="m-btn-link--view delete_housing housing_{{ $vl->id }}" title="supprimer" href="" style="text-transform: none; color:red;" onclick="confirmation(event,{{ $vl->id }})">  <i class="fa fa-trash" aria-hidden="true"></i></a> </div>
                     </div>

                     <!---FIN FOOTER-->
                   </div>

                 </div>

                 <input type="hidden" class="modify_title_{{ $vl->id }}" value="{{ $vl->title }}" />
                 <input type="hidden" class="modify_address_{{ $vl->id }}" value="{{ $vl->address }}" />
                 <input type="hidden" class="modify_city_{{ $vl->id }}" value="{{ $vl->city }}" />
                 <input type="hidden" class="modify_status_{{ $vl->id }}" value="{{ $vl->status }}" />
                 <input type="hidden" class="modify_nb_rooms_{{ $vl->id }}" value="{{ $vl->nb_rooms }}" />
                 <input type="hidden" class="strong_option_fees_selected_{{ $vl->id }}" value='{{ $vl->fees }}' />
                 <input type="hidden" class="modify_housing_type_{{ $vl->id }}" value="{{ $vl->housing_type }}" />

                 @foreach($img_s as $img_)
                        @if($img_['housing_id'] == $vl->id)
                        <input type="hidden" class="modify_image_{{ $vl->id }}" value="{{ $img_['src'] }}" />
                        <input type="hidden" class="image_id_{{ $vl->id }}" value="{{ $img_['id'] }}" />
                        @endif
                 @endforeach

                 @endforeach

       
       
       
       <!---FIN CARTE LOGEMENT 1 -->
    

         <!---DEBUT CARTE LOGEMENT 2-->

       <!---FIN CARTE LOGEMENT 2-->
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
                         <option value="Mr" selected="selected">Monsieur</option>
                         <option value="Mme">Madame</option>
                       </select>
                       <div class="dropDownSelect2"></div>
                     </div>
                   </div>
                   <div class="rs1-wrap-input100">
                   </div>
                 <div class="wrap-input100 validate-input bg1 rs1-wrap-input100 form-group{{ $errors->has('first_name') ? ' has-error' : '' }}" data-validate = "Entrez le prÃ©nom">
                   <span class="label-input100 control-label">Prénom *</span>
                   <input class="input100" type="text" name="first_name" required placeholder="Entrez le prÃ©nom du locataire">
                   @if ($errors->has('first_name'))
                       <span class="help-block">
                           <strong>{{ $errors->first('first_name') }}</strong>
                       </span>
                   @endif
                 </div>

                 <div class="wrap-input100 bg1 rs1-wrap-input100 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                   <span class="label-input100 control-label">Nom *</span>
                   <input class="input100" type="text" name="name" required  placeholder="Entrez le nom du locataire">
                   @if ($errors->has('name'))
                       <span class="help-block">
                           <strong>{{ $errors->first('name') }}</strong>
                       </span>
                   @endif
                 </div>
                 <div class="wrap-input100 input100-select bg1 rs1-wrap-input100">
                   <span class="label-input100">Date de naissance </span>
                   <input class="input100" type="text" name="dateOB" >
                 </div>
                 <div class=" wrap-input100 bg1 rs1-wrap-input100">
                   <span class="label-input100">Lieu de naissance </span>
                   <input class="input100" type="text" name="placeOB" placeholder="Entrez le lieu de naissance du locataire">
                 </div>
                 <div class="wrap-input100 validate-input bg1 rs1-wrap-input100 form-group{{ $errors->has('email') ? ' has-error' : '' }}" data-validate = "Entrez l'adresse mail">
                   <span class="label-input100 control-label">Email *</span>
                   <input class="input100" type="email" name="email" placeholder="Entrez l'adresse mail du locataire" required>
                   @if ($errors->has('email'))
                       <span class="help-block">
                           <strong>{{ $errors->first('email') }}</strong>
                       </span>
                   @endif
                 </div>

                 <div class="wrap-input100 bg1 rs1-wrap-input100 form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                   <span class="label-input100 control-label">Téléphone * </span>
                   <input class="input100" type="tel" name="phone" required placeholder="Entrez le tÃ©lÃ©phone du locataire">
                   @if ($errors->has('phone'))
                       <span class="help-block">
                           <strong>{{ $errors->first('phone') }}</strong>
                       </span>
                   @endif
                 </div>
                 <div class="wrap-input100 validate-input bg1 form-group{{ $errors->has('customerId') ? ' has-error' : '' }}" data-validate="Entrez svp un nom pour le logement">
                   <span class="label-input100 control-label">Numéro CNI *</span>
                   <input class="input100" type="text" pattern="[0-9,A-Z,a-z]{13,19}" required name="customerId" placeholder="Entrez le numÃ©ro de Carte d'identitÃ© nationale du locataire">
                   @if ($errors->has('customerId'))
                       <span class="help-block">
                           <strong>{{ $errors->first('customerId') }}</strong>
                       </span>
                   @endif
                 </div>
                 <div class="wrap-input100 bg1 rs1-wrap-input100 form-group{{ $errors->has('bail') ? ' has-error' : '' }}">
                   <span class="label-input100 control-label">Caution *</span>
                   <input class="input100" type="number" pattern="[0-9]{0,10}" name="bail" required  placeholder="Entrez le montant de la caution">
                   @if ($errors->has('bail'))
                       <span class="help-block">
                           <strong>{{ $errors->first('bail') }}</strong>
                       </span>
                   @endif
                 </div>
                 <div class="wrap-input100 bg1 rs1-wrap-input100 form-group{{ $errors->has('monthly_pm') ? ' has-error' : '' }}">
                   <span class="label-input100 control-label">Loyer *</span>
                   <input class="input100" type="number" pattern="[0-9]{0,10}" name="monthly_pm" required  placeholder="Entrez le montant du loyer">
                   @if ($errors->has('monthly_pm'))
                       <span class="help-block">
                           <strong>{{ $errors->first('monthly_pm') }}</strong>
                       </span>
                   @endif
                 </div>
                 <div class="wrap-input100 bg1 rs1-wrap-input100 form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                   <span class="label-input100 control-label">Date de début *</span>
                   <input class="input100" type="text"  name="start_date" required>
                   @if ($errors->has('start_date'))
                       <span class="help-block">
                           <strong>{{ $errors->first('start_date') }}</strong>
                       </span>
                   @endif
                 </div>
                 <?php
                 $date_plus_one_year_en = date('Y-m-d',strtotime(date("Y-m-d", time()) . " + 365 day"));
                 $date_plus_one_year_fr = substr($date_plus_one_year_en,-2,2).'/'.substr($date_plus_one_year_en,5,2).'/'.substr($date_plus_one_year_en,0,4);
                  ?>
                 <div class="wrap-input100 bg1 rs1-wrap-input100">
                   <span class="label-input100">Date de fin </span>
                   <input class="input100" type="text" name="end_date" value="{{ $date_plus_one_year_fr }}">
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
                   <span class="label-input100">Jour d'échéance *</span>
                   <input class="input100" type="number" pattern="[0-9]{0,5}" name="delay" required  value="5">
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
       $(".js-select-city").each(function(){
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

        var selectedOptionCategory = 'A';
        $("<input class='strong_option_category_selected' type='hidden' name='strong_option_category_selected' value='"+selectedOptionCategory+"' />").insertAfter('.select2-selection__rendered');
        $(".form-check-input").on("change", function() {
          selectedOptionCategory = $(this).val();
          $('.strong_option_category_selected').val(selectedOptionCategory);
        });

        var selectedOptionCity = 'Dakar';
        $("<input class='strong_option_city_selected' type='hidden' name='city' value='"+selectedOptionCity+"' />").insertAfter('.select2-selection__rendered');
        $(".js-select-city").on("change", function() {
          selectedOptionCity = $(this).val();
          $('.strong_option_city_selected').val(selectedOptionCity);
        });

        $('.js-select-city, .form-check-input, .surface').on('change', function() {
          var surface = $('.surface').val();
          if(surface != ''){
            var dynamic_city = $('.strong_option_city_selected').val();
            var dynamic_category = $('.strong_option_category_selected').val();
            var class_to_use = '[name="'+dynamic_city+'_'+dynamic_category+'"]';
            var recommended_value = $(class_to_use).val();
            //console.log(dynamic_city+''+dynamic_category+''+recommended_value);
            $('.monthly_pm_rec').val(parseInt(recommended_value * surface));
            $('.monthly_pm_rec').attr('style', 'color:green');

          }
        });
        $('.monthly_pm').on('change', function() {
          var monthly_pm_rec = $('.monthly_pm_rec').val();
          var monthly_pm =  $('.monthly_pm').val();
          if(monthly_pm_rec != ''){
            if(monthly_pm_rec < monthly_pm){
              $('<span style="color:#FFA500;font-size:10px" class="help-block"><strong> Attention le loyer renseigné est supérieur à celui préconisé.</strong></span>').insertAfter('.monthly_pm');
            }
            if(monthly_pm_rec > monthly_pm){
              $( ".help-block" ).remove();            }
          }
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
        url: "mes-logements/add",
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
            $("#counter").text("# " + total_photos_counter + "  images(s) au total" );
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