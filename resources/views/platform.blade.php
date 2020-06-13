<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>
        <link rel="icon" type="image/png" href="https://elektra.s3.amazonaws.com/images/icons/logo-elektra-halo.png"/>
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
      if ($service =='eau' || $service =='tv' || $service =='electricite' || $service =='mobile' || $service == 'locataire' || $service == 'proprietaire')
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

                  <div class="icons-media-container mbr-white">
                      <div class="card col-12 col-md-6 col-lg-3" style="color: <?=getServiceColor($infos_perso->service_1)?>;">
                          <div class="icon-block">
                            <?php
                            if($infos_perso->service_1 != "eau")
                            {
                                echo '<a href="javascript:void(0);" style="cursor:not-allowed;">';
                            }
                            else {
                              echo '<a href="mes-factures/eau">';
                            }
                            ?>
                              <i class="fas fa-faucet fa-7x" style="color: <?=getServiceColor($infos_perso->service_1)?>;"></i>
                          </a>
                          </div>
                          <h5 class="mbr-fonts-style display-5">
                              Eau
                          </h5>
                      </div>

                      <div class="card col-12 col-md-6 col-lg-3" style="color: <?=getServiceColor($infos_perso->service_2)?>;">
                          <div class="icon-block">
                            <?php
                            if($infos_perso->service_2 != "electricite")
                            {
                                echo '<a href="javascript:void(0);" style="cursor:not-allowed;">';
                            }
                            else {
                              echo '<a href="mes-factures/electricite">';
                            }
                            ?>
                                    <i class="fas fa-plug fa-7x" style="color: <?=getServiceColor($infos_perso->service_2)?>;"></i>
                              </a>
                          </div>
                          <h5 class="mbr-fonts-style display-5">
                              Electricité
                          </h5>
                      </div>

                      <div class="card col-12 col-md-6 col-lg-3" style="color: <?=getServiceColor($infos_perso->service_3)?>;">
                          <div class="icon-block">
                            <?php
                            if($infos_perso->service_3 != "tv")
                            {
                                echo '<a href="javascript:void(0);" style="cursor:not-allowed;">';
                            }
                            else {
                              echo '<a href="mes-factures/tv">';
                            }
                            ?>
                                  <i class="fas fa-tv fa-7x" style="color: <?=getServiceColor($infos_perso->service_3)?>;"></i>
                              </a>
                          </div>
                          <h5 class="mbr-fonts-style display-5">
                              Télévision
                          </h5>
                      </div>

                      <div class="card col-12 col-md-6 col-lg-3" style="color: <?=getServiceColor($infos_perso->service_4)?>;">
                          <div class="icon-block">
                            <?php
                            if($infos_perso->service_4 != "mobile")
                            {
                                echo '<a href="javascript:void(0);" style="cursor:not-allowed;">';
                            }
                            else {
                              echo '<a href="mes-factures/mobile">';
                            }
                            ?>
                                  <i class="fas fa-wifi fa-7x" style="color: <?=getServiceColor($infos_perso->service_4)?>;"></i>
                              </a>
                          </div>
                          <h5 class="mbr-fonts-style display-5">
                              Mobile & Internet
                          </h5>
                      </div>

                      <div class="card col-12 col-md-6 col-lg-3" style="color: <?=getServiceColor($infos_perso->service_5)?>;">
                          <div class="icon-block">
                            <?php
                            if($infos_perso->service_5 != "locataire")
                            {
                                echo '<a href="javascript:void(0);" style="cursor:not-allowed;">';
                            }
                            else {
                              echo '<a href="mes-factures/locataire">';
                            }
                            ?>
                                  <i class="fas fa-building fa-7x" style="color: <?=getServiceColor($infos_perso->service_5)?>;"></i>
                              </a>
                          </div>
                          <h5 class="mbr-fonts-style display-5">
                              Locataire
                          </h5>
                      </div>

                      <div class="card col-12 col-md-6 col-lg-3" style="color: <?=getServiceColor($infos_perso->service_6)?>;">
                          <div class="icon-block">
                            <?php
                            if($infos_perso->service_6 != "proprietaire")
                            {
                                echo '<a href="javascript:void(0);" style="cursor:not-allowed;">';
                            }
                            else {
                              echo '<a href="transactions-proprietaire">';
                            }
                            ?>
                                  <i class="fas fa-building fa-7x" style="color: <?=getServiceColor($infos_perso->service_6)?>;"></i>
                              </a>
                          </div>
                          <h5 class="mbr-fonts-style display-5">
                              Propriétaire
                          </h5>
                      </div>

                      </div>

              </div>
          </div>
  </div>

</section>
    </body>
</html>
