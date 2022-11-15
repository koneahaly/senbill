<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
                <!-- Event snippet for Inscription conversion page -->
        <script>
        gtag('event', 'conversion', {'send_to': 'AW-434612469/9slwCO72y_QBEPXRns8B'});
        </script>


        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>
        <link rel="icon" type="image/png" href="{{ env('S3_URL')}}/{{ env('AWS_BUCKET')}}/logo-senbill-halo.png"/>
        <!-- Fonts -->

        <link rel="stylesheet" type="text/css" href="{{url('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{url('css/style_mobirise.css')}}">
        <link rel="preload" as="style" href="{{url('css/mbr-additional.css')}}">
        <link rel="stylesheet" href="{{url('css/mbr-additional.css')}}" type="text/css">


        <script src="{!! mix('js/app.js') !!}"></script>

    </head>

    <body class="welcome_elektra">
      <section class="header12 cid-s020q4nzkT mbr-fullscreen mbr-parallax-background" id="header12-g">



  <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(35, 35, 35);">
  </div>
<?php
  function getServiceColor($service)
  {
      if ($service =='distribution_stop' || $service =='mobiletv_stop' || $service =='servicepublic' ||
      $service =='sante' || $service == 'locataire' || $service == 'proprietaire' || $service == 'scolarité' || $service == 'sport_stop')
          return '#ffffff';
      else
          return '#888484';
  }
  ?>
  <div class="container">
          <div>
              <div class="media-container">
                  <svg><rect height="100%"></rect></svg>
                  <div class="col-md-12 align-center">
                    <h1 class="mbr-section-title pb-3 mbr-white mbr-bold mbr-fonts-style display-1">
                        PLATEFORMES DE PAIEMENT
                    </h1>
                    <p class="mbr-text pb-3 mbr-white mbr-fonts-style display-5">
                        Cliquez pour accéder à une de nos plateformes
                    </p>
                  </div>
              </div>

                  <div class="icons-media-container mbr-white" style="text-align:center">
                      <div class="card col-12 col-md-6 col-lg-3" style="color: <?=getServiceColor($actived_services->service_1)?>;">
                          <div class="icon-block">
                            <?php
                            if($actived_services->service_1 != "distribution_stop")
                            {
                                echo '<a href="javascript:void(0);" style="cursor:not-allowed;">';
                            }
                            else {
                              echo '<a href="../mes-factures/distribution">';
                            }
                            ?>
                              <i class="fas fa-network-wired fa-7x" style="color: <?=getServiceColor($actived_services->service_1)?>;"></i>
                          </a>
                          </div>
                          <h5 class="mbr-fonts-style display-5">
                              Distribution
                          </h5>
                      </div>

                      <div class="card col-12 col-md-6 col-lg-3" style="color: <?=getServiceColor($actived_services->service_2)?>;">
                          <div class="icon-block">
                            <?php
                            if($actived_services->service_2 != "servicepublic")
                            {
                                echo '<a href="javascript:void(0);" style="cursor:not-allowed;">';
                            }
                            else {
                              echo '<a href="../mes-factures/servicepublic">';
                            }
                            ?>
                                    <i class="fab fa-galactic-republic fa-7x" style="color: <?=getServiceColor($actived_services->service_2)?>;"></i>
                              </a>
                          </div>
                          <h5 class="mbr-fonts-style display-5">
                              Service public
                          </h5>
                      </div>

                      <div class="card col-12 col-md-6 col-lg-3" style="color: <?=getServiceColor($actived_services->service_3)?>;">
                          <div class="icon-block">
                            <?php
                            if($actived_services->service_3 != "telecom_stop")
                            {
                                echo '<a href="javascript:void(0);" style="cursor:not-allowed;">';
                            }
                            else {
                              echo '<a href="../mes-factures/telecom">';
                            }
                            ?>
                                  <i class="fas fa-tv fa-7x" style="color: <?=getServiceColor($actived_services->service_3)?>;"></i>
                              </a>
                          </div>
                          <h5 class="mbr-fonts-style display-5">
                              Télécom
                          </h5>
                      </div>

                      <div class="card col-12 col-md-6 col-lg-3" style="color: <?=getServiceColor($actived_services->service_4)?>;">
                          <div class="icon-block">
                            <?php
                            if($actived_services->service_4 != "sante")
                            {
                                echo '<a href="javascript:void(0);" style="cursor:not-allowed;">';
                            }
                            else {
                              echo '<a href="../mes-factures/sante">';
                            }
                            ?>
                                  <i class="fas fa-hospital fa-7x" style="color: <?=getServiceColor($actived_services->service_4)?>;"></i>
                              </a>
                          </div>
                          <h5 class="mbr-fonts-style display-5">
                              Santé
                          </h5>
                      </div>

                      <div class="card col-12 col-md-6 col-lg-3" style="color: <?=getServiceColor($actived_services->service_5)?>;">
                          <div class="icon-block">
                            <?php
                            if($actived_services->service_5 != "locataire")
                            {
                                echo '<a href="javascript:void(0);" style="cursor:not-allowed;">';
                            }
                            else {
                              echo '<a href="../mes-factures/locataire">';
                            }
                            ?>
                                  <i class="fas fa-house-user  fa-7x" style="color: <?=getServiceColor($actived_services->service_5)?>;"></i>
                              </a>
                          </div>
                          <h5 class="mbr-fonts-style display-5">
                              Locataire
                          </h5>
                      </div>

                      <div class="card col-12 col-md-6 col-lg-3" style="color: <?=getServiceColor($actived_services->service_6)?>;">
                          <div class="icon-block">
                            <?php
                            if($actived_services->service_6 != "proprietaire")
                            {
                                echo '<a href="javascript:void(0);" style="cursor:not-allowed;">';
                            }
                            else {
                              echo '<a href="../transactions-proprietaire">';
                            }
                            ?>
                                  <i class="fas fa-building fa-7x" style="color: <?=getServiceColor($actived_services->service_6)?>;"></i>
                              </a>
                          </div>
                          <h5 class="mbr-fonts-style display-5">
                              Propriétaire
                          </h5>
                      </div>

                      <div class="card col-12 col-md-6 col-lg-3" style="color: <?=getServiceColor($actived_services->service_7)?>;">
                          <div class="icon-block">
                            <?php
                            if($actived_services->service_7 != "scolarité")
                            {
                                echo '<a href="javascript:void(0);" style="cursor:not-allowed;">';
                            }
                            else {
                              echo '<a href="../mes-factures/scolarite">';
                            }
                            ?>
                                  <i class="fas fa-university fa-7x" style="color: <?=getServiceColor($actived_services->service_7)?>;"></i>
                              </a>
                          </div>
                          <h5 class="mbr-fonts-style display-5">
                              Scolarité
                          </h5>
                      </div>

                      <div class="card col-12 col-md-6 col-lg-3" style="color: <?=getServiceColor($actived_services->service_8)?>;">
                          <div class="icon-block">
                            <?php
                            if($actived_services->service_8 != "sport_stop")
                            {
                                echo '<a href="javascript:void(0);" style="cursor:not-allowed;">';
                            }
                            else {
                              echo '<a href="../mes-factures/sport">';
                            }
                            ?>
                                  <i class="fas fa-running fa-7x" style="color: <?=getServiceColor($actived_services->service_8)?>;"></i>
                              </a>
                          </div>
                          <h5 class="mbr-fonts-style display-5">
                              Sport
                          </h5>
                      </div>

                      </div>

              </div>
          </div>
  </div>

</section>
    </body>
</html>
