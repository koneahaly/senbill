<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>
        <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
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

  <div class="container  ">
          <div class="media-container">
              <div class="col-md-12 align-center">
                  <h1 class="mbr-section-title pb-3 mbr-white mbr-bold mbr-fonts-style display-1">
                      PLATEFORMES DE PAIEMENT
                  </h1>
                  <p class="mbr-text pb-3 mbr-white mbr-fonts-style display-5">
                      Cliquez pour accéder à une de nos plateformes
                  </p>


                  <div class="icons-media-container mbr-white">
                      <div class="card col-12 col-md-6 col-lg-3">
                          <div class="icon-block">
                          <a href="mes-factures">
                              <i class="fas fa-faucet fa-7x"></i>
                          </a>
                          </div>
                          <h5 class="mbr-fonts-style display-5">
                              Eau
                          </h5>
                      </div>

                      <div class="card col-12 col-md-6 col-lg-3">
                          <div class="icon-block">
                              <a href="mes-factures">
                                    <i class="fas fa-plug fa-7x"></i>
                              </a>
                          </div>
                          <h5 class="mbr-fonts-style display-5">
                              Electricité
                          </h5>
                      </div>

                      <div class="card col-12 col-md-6 col-lg-3">
                          <div class="icon-block">
                              <a href="mes-factures">
                                  <i class="fas fa-tv fa-7x"></i>
                              </a>
                          </div>
                          <h5 class="mbr-fonts-style display-5">
                              Télévision
                          </h5>
                      </div>

                      <div class="card col-12 col-md-6 col-lg-3">
                          <div class="icon-block">
                              <a href="mes-factures">
                                  <i class="fas fa-wifi fa-7x"></i>
                              </a>
                          </div>
                          <h5 class="mbr-fonts-style display-5">
                              Mobile & Internet
                          </h5>
                      </div>
                  </div>
              </div>
          </div>
  </div>

</section>
    </body>
</html>
