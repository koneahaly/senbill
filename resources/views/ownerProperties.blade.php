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
                                 <total> <span>2</span> <span style="text-transform:none" > logement(s) au total</span> </total>
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
                                  <div style="width: 100%;"></div>
                               </div>
                               <div class="units-type">
                                  <div class="occupied">
                                     <!----> <span>Occupé par Yacine Ndiaye</span>
                                  </div>
                                  <div class="vacant" style="display:none;">
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

  <!---FIN CARTE LOGEMENT 1 -->
    <!---DEBUT CARTE LOGEMENT 2-->
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
                                  <span>Keur Serigne Aly</span>
                                </span>
                             </div>
                             <!----> <!---->
                             <div class="info-location">
                                <div class="icon-svg"> <i class="fas fa-map-marker-alt"></i></div>
                                <div class="location-address">
                                <span>Almadies  villa Aldiana</span><br><span> Dakar, Sénégal</span><!---->
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
                       <div class="units"> <span class="unit-count"> 5 chambres </span> </div>
                       <!----> <!---->
                    </div>
                    <div class="view-units">
                       <div class="units-progress">
                         <!-- AJOUTER ICI LE BACKGROUND IMAGE QUE SI LE LOGEMENT EST LIBRE-->
                          <div style="width: 100%;background-image: linear-gradient(90deg,#1ab92d,#f2ffd9 60%,#f2f6ff);"></div>
                       </div>
                       <div class="units-type">
                          <div class="occupied" style="display:none;">
                             <!----> <span>Occupé</span>
                          </div>
                          <div class="vacant">
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
  <!---FIN CARTE LOGEMENT 2-->
          </div>
        </div>
      </div>

    </div>
  </div>
  <!---FORMULAIRE AJOUT LOGEMENT-->
<div class="form-popup" id="propForm">
<div class="row">

</div>
</div>
  <!--- FIN FORMULAIRE AJOUT LOGEMENT-->
</div>


@endsection

@section('scripts')

<script>
  function openForm() {
    document.getElementById("propForm").style.display = "block";
  }

  function closeForm() {
    document.getElementById("propForm").style.display = "none";
  }

</script>

@endsection
