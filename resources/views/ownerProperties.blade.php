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

  <!--<h4>logements  </h4> -->
  <div class="panel-wrapper column">
    <div class="wrapper-list">
      <div class="row propRow">
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
                                      <span>Keur Serigne Saliou</span>
                                    </span>
                                 </div>
                                 <!----> <!---->
                                 <div class="info-location">
                                    <div class="icon-svg"> <i class="fas fa-map-marker-alt"></i></div>
                                    <div class="location-address">
                                    <span>Hann Mariste 2 villa Y46</span><br><span> Dakar, Sénégal</span><!---->
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
                           <div class="units"> <span class="unit-count"> 2 chambres </span> </div>
                           <!----> <!---->
                        </div>
                        <div class="view-units">
                           <div class="units-progress">
                              <div ng-style="{ width: $ctrl.calcPercent(property) + '%' }" style="width: 100%;"></div>
                           </div>
                           <div class="units-type">
                              <div class="occupied">
                                 <!----> <span>Occupé</span>
                              </div>
                              <div class="vacant ng-hide" style="display:none;">
                                 <!----> <span>Libre</span>
                              </div>
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
               <div>
                  <!----> <!---->
               </div>
               <div class="property-view"> <a class="m-btn-link--view" title="détails" href="" style="text-transform: none;"> Voir <i class="far fa-eye"></i> </a> </div>
            </div>
            <!---FIN FOOTER-->
          </div>
        </div>
      </div>
    </div>
  </div>



</div>
@endsection
