<?php
session_start();
$notification = (isset($_SESSION["numberOfBillsNonPaid"])) ? $_SESSION["numberOfBillsNonPaid"] : '';
?>

@extends('layouts.app', ['notification' => $notification, 'service' => $_SESSION['current_service'], 'services' => $actived_services, 'profilNotif' => $_SESSION['profilNotif']])
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
<link rel="stylesheet" type="text/css" href="{{url('vendor/noui/nouislider.min.css')}}">
 <link rel="stylesheet" type="text/css" href="{{url('css/locationApp.css')}}">
@section('content')
<div class="container">
<div class="row rowloc rowmobile" style="margin-top:14%;z-index: 1100;">
  <div class="col-md-12" style="margin-top:10px;margin-bottom:20px;text-align:center;flex-basis:100%;max-width:100%;z-index: 1100;">
   <h3><strong>Rechercher votre logement</strong></h3>
  </div>
  </div>
  @if(session('message'))
<input  type='hidden' class="mess" value="{{ session('message') }}">
<script>
 $(document).ready(function() {
  var  mess= $('.mess').val();
  showAddPropertyNotif(mess);
  });
 </script>
@endif
  <div class="panel panel-default" style="background-color: #f5f9fc;z-index: 1100;">
    <div class="panel-body propPanelBody">
      <div style="margin-top:35px; margin-bottom:35px; text-align:center;">
      <form class="form-inline my-2 my-lg-0" action="{{ route('search') }}" method="GET">
     
        <!-- <div class="form-group input-group mb-3"> -->
          
   <!-- <input style="width:600px;padding: 25px 15px; line-height: 32px;" class="form-control mr-lg-4" type="search" aria-label="Search" name="search" required id="search" placeholder="Rechercher un logement"> -->
  <!-- </div> -->
  <select style="width:300px;padding: 25px 15px; line-height: 22px;" class="js-select-bed" name="Category" required>
                        <option disabled>---- Choisissez une catégorie ----</option>
                       <option value="Locations">Locations</option>
                       <option value="Ventes">Ventes</option>
                     </select>
                     
 
    <button style="padding: 15px 5px; line-height: 20px;" class="btn btn-success my-2 my-sm-0" type="submit">Rechercher</button>

      </form>
      </div>
    @isset($housings_all)
    @if($housings_all->isNotEmpty())
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
                              <span class="form-text text-muted">Résultat de votre recherche : {{ count($housings_all) }} logement(s) au total</span>
                              <!---->
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
           <!--<h4>logements  </h4> -->
           <div class="panel-wrapper column">
             <div class="wrapper-list">
               <div class="row propRow">
                   <!---DEBUT  CARTE LOGEMENT 1 -->
                   @foreach ($housings_all as $housing_all)
                 <div class="col-xs-24 col-sm-10 col-md-8">
                   <div class="m-panel panel-property--list" >
                     <div class="markup"></div>
                     <!-- DEBUT BODY DETAIL -->
                     <div class="m-panel__body">
                       <div class="body-detail" data-toggle="modal" data-target="#exampleModalCenter{{$housing_all->id}}">
                       <div class="detail-img">
                       @foreach($images as $image)
                        @if($image['housing_id'] == $housing_all->id)
                            <a title="icone logement" href="#exampleModalCenter{{$housing_all->id}}" data-toggle="modal">
                            <img imageonload="" class="img-responsive s-image--loading_success" alt="avatar" src="{{$image['src']}}">
                          </a>
                          @endif
                         @endforeach
                       </div>
                        <div class="detail-info">
                           <div class="info-name">
                              <div class="name-address">
                                 <a href="">
                                    <fieldset-property-info property="property" address1="26 Route des Maristes" city-address="Chelles, Dakar, 77500, SN">
                                       <div class="m-property-info ">
                                          <div class="info-name-property">
                                             <span>
                                               <span><a href="#exampleModalCenter{{$housing_all->id}}" data-toggle="modal">{{ $housing_all->title }}</a></span>
                                             </span>
                                          </div>
                                          <!----> <!---->
                                          <div class="info-location">
                                             <div class="icon-svg"> <i class="fas fa-map-marker-alt"></i></div>
                                             <div class="location-address">
                                             <span>{{ $housing_all->address }}</span><br><span> {{ $housing_all->city }}, Sénégal</span><!---->
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
                                    <div class="units"> <span class="unit-count"> {{ $housing_all->nb_rooms }} {{ ($housing_all->nb_rooms != "maison" and $housing_all->nb_rooms != "Studio") ? 'chambres' : ''}} </span> </div>
                                    <!----> <!---->
                                 </div>
                                 <div class="view-units">
                                   @if($housing_all->status == "N")
                                    <div class="units-progress">
                                       <div style="width: 100%;"></div>
                                    </div>
                                    @endif
                                    @if($housing_all->status == "Y")
                                    <div class="units-progress">
                                      <div style="width: 100%;background-image: linear-gradient(90deg,#1ab92d,#f2ffd9 60%,#f2f6ff);"></div>
                                    </div>
                                    @endif
                                    <div class="units-type">
                                      @if($housing_all->status == "N")
                                       <div class="occupied">
                                          <!----> <span>Occupé par {{ $housing_all->current_occupant_name }}</span>
                                       </div>
                                       @endif
                                       @if($housing_all->status == "Y")
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
                    
                     <!---FIN MENU AVEC ICONES-->
                     <!---DEBUT FOOTER-->
                   
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
       </div>
         <!-- Modal -->
         <div class="modal fade" id="exampleModalCenter{{$housing_all->id}}"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content ">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Détails de la procédure</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                <div class="table-responsive">
                                    test
                                    </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                            </div>
                        </div>
    @else 
          <div class="col-md-12" style="text-align:center">
              <div class="alert alert-info alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Info! </strong>Logement non trouvé ! 
              </div>
          </div>
    @endif
    @endisset
   
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.3/d3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/nvd3/1.8.6/nv.d3.js"></script>
<script src="http://nvd3.org/assets/js/data/stream_layers.js"></script>
<script>

$(document).ready(function() {
    $(".js-select-bed").each(function(){
         $(this).select2({
           minimumResultsForSearch: 20,
           dropdownParent: $(this).next('.dropDownSelect2')
         });

});



</script>
@endsection
