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

  <div class="container">
          <div>
              <div class="media-container">
                  <svg><rect height="100%"></rect></svg>
                  <div class="col-md-12 align-center">
                    <h1 class="mbr-section-title pb-3 mbr-white mbr-bold mbr-fonts-style display-1">
                        CHOIX DU PARTENAIRE
                    </h1>
                    <p class="mbr-text pb-3 mbr-white mbr-fonts-style display-5">
                        Cliquez sur un partenaire pour accéder à son espace
                    </p>
                  </div>
              </div>

                  <div class="icons-media-container mbr-white" style="text-align:center">
                    @foreach($infos_global_partenaires as $igp)
                      <div class="card col-12 col-md-6 col-lg-3" style="color: white;">
                          <div class="icon-block">
                          <a href="../dashboard/accueil/{{ $igp->social_name }}">

                              <i class="fas fa-handshake fa-7x" style="color: white;"></i>
                          </a>
                          </div>
                          <h5 class="mbr-fonts-style display-5">
                              {{ $igp->social_name }}
                          </h5>
                      </div>
                      @endforeach


                      </div>

              </div>
          </div>
  </div>

</section>
    </body>
</html>
