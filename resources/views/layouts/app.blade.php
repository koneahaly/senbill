<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'eLECTRA') }}</title>

    <!-- Scripts -->
  <script type="text/javascript">
       // Notice how this gets configured before we load Font Awesome
       window.FontAwesomeConfig = { autoReplaceSvg: false }
  </script>
  <script src="{!! mix('js/app.js') !!}"></script>
  @yield('scripts')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/graphicalChart.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('css/common.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="https://elektra.s3.amazonaws.com/images/icons/logo-elektra-halo.png"/>
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.material.min.css">
<link rel="stylesheet" type="text/css" href=" https://cdnjs.cloudflare.com/ajax/libs/material-components-web/4.0.0/material-components-web.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="css/util.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="{{url('css/elektra.css')}}">
<link href='https://fonts.googleapis.com/css?family=Alegreya+Sans:400,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="{{url('css/jquery.range.css')}}">
<link rel="stylesheet" href="{{url('css/payment_modal.css')}}">
<script src="{{ url('js/jquery.range.js') }}"></script>
<script src="{{ url('js/lottie-player.js') }}"></script>

<!--===============================================================================================-->

@php
$active_1 ='none';
$active_2 ='none';
$active_3 ='none';
$active_4 ='none';

if($_SERVER['REQUEST_URI'] == '/register' || strpos($_SERVER['REQUEST_URI'],"admin") == true){
  $home_directory = '.';
  $service="";
}
else{
$home_directory = "../mes-factures/".$service."";
}
if(strpos($_SERVER['REQUEST_URI'],"infos-personnelles") == true)
  $active_1 = 'active';
if(strpos($_SERVER['REQUEST_URI'],"mon-contrat") == true)
  $active_2 = 'active';
if(strpos($_SERVER['REQUEST_URI'],"mes-factures") == true)
  $active_3 = 'active';
if(strpos($_SERVER['REQUEST_URI'],"suivi-conso") == true)
    $active_4 = 'active';
if(strpos($_SERVER['REQUEST_URI'],"infos-services") == true)
      $active_1 = 'active';

@endphp

<style>
html, body {
    max-width: 100%;
    overflow-x: hidden;
}

.disabled {
  color: currentColor;
  cursor: not-allowed;
  opacity: 0.5;
  text-decoration: none;
}

</style>
</head>

<body style="height:100%">
<div id="app" class="s2sn-wrapper-login-container s2sn-js-login" style="background-image: url({{url('images/white-background/19366_Fotor1.jpg')}});">
  <!-- HEADER START -->
   @guest
   <!--  Header  invité -->
  <div class="s2sn-login-header-desktop-elektra">
      <a class="s2sn-logo-elektra-register" href="{{ $home_directory }}">
          <img src="{{url('images/logo-elektra-halo.png')}}" alt="logo-elektra" width="80" height="auto" class="s2sn-img-normal">
          <img src="{{url('images/logo-elektra-halo.png')}}" alt="logo-elektra" width="80" height="auto" class="s2sn-img-retina">
      </a>
      <div class="s2sn-login-header-nav">
       <ul class="s2sn-navbar"  style="margin-left: 300px;">
         <!-- Authentication Links -->

           <li><a class="s2sn-header-link-elektra" href=".">Se connecter &nbsp </a></li>
           <li><a class="s2sn-header-link-elektra elektra-register-button" href="{{ route('register') }}" >S'inscrire</a></li>
        </ul>
      </div>
  </div>

  <!--  Fin Header  invité -->
  @else
      <!--  Début Header  user connecté -->
      <div class="s2sn-login-header-desktop-elektra">
          <a class="s2sn-logo-elektra-connected" href="{{ $home_directory }}">
              <img src="{{url('images/logo-elektra-halo.png')}}" alt="logo-elektra" width="80" height="auto" class="s2sn-img-normal">
              <img src="{{url('images/logo-elektra-halo.png')}}" alt="logo-elektra" width="80" height="auto" class="s2sn-img-retina">
          </a>


        <!--  POUR ELECTRICITE -->
        @if( $service == "electricite")
          <p class="custom-space">Espace electricité</p>
          <lottie-player src="{{url('images/lottie/light.json')}}"  background="transparent"  speed="1" class="space-logo"   loop  autoplay></lottie-player>
        @endif

       <!--  POUR EAU -->
        @if( $service == "eau")
          <p class="custom-space">Espace eau</p>
          <lottie-player src="{{url('images/lottie/water.json')}}"  background="transparent"  speed="1" class="space-logo"  loop  autoplay></lottie-player>
       @endif
      <!--  POUR TV -->
      @if( $service == "tv")
        <p class="custom-space">Espace Télévision </p>
        <lottie-player src="{{url('images/lottie/tv.json')}}"  background="transparent"  speed="1" class="space-logo-tv" loop  autoplay></lottie-player>
      @endif

     <!--  POUR MOBILE & Internet -->
     @if( $service == "mobile")
      <p class="custom-space">Espace Mobile & Internet</p>
      <lottie-player src="{{url('images/lottie/wifi.json')}}"  background="transparent"  speed="1" class="space-logo-internet"  loop  autoplay></lottie-player>
     @endif
    <!--  POUR Locataire -->
    @if( $service == "locataire")
      <p class="custom-space">Espace Locataire</p>
      <lottie-player src="{{url('images/lottie/key.json')}}"  background="transparent"  speed="1" class="space-logo-locataire"  loop  autoplay></lottie-player>
   @endif
          <div class="s2sn-login-header-nav  navbarElektra">
         <ul class="s2sn-navbar-elektra">
             @if($notification >=0)
             <li class="nav-item item-connected">
               <a class="nav-link {{ $active_4 }}"  href="../suivi-conso/{{ $service }}">
                 <i  class="fa fa-chart-bar fa-2x ">
                 </i> <p>Suivi conso</p>
                </a>
             </li>
               <li class="nav-item item-connected">
                 <a class="nav-link {{ $active_3 }}"  href="../mes-factures/{{ $service }}">
                   <i  class="fa fa-envelope-open-text fa-2x ">
                      <?php if($notification > 0) echo '<span class="badge">'.$notification.'</span>'; ?>
                   </i> <p>Factures et paiements</p>
                  </a>
               </li>
               <li class="nav-item item-connected">
                 <a class="nav-link {{ $active_2 }}"  href="../mon-contrat/{{ $service }}">
                   <i class="fa fa-file-contract fa-2x"></i> <p>Mon contrat</p>
                     <span class="sr-only">(current)</span>
                 </a>
               </li>

               <li class="dropdown nav-item item-connected">
                   <a href="#" class="nav-link {{ $active_1 }} dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                     <i class="fa fa-user fa-2x"></i> <p>Mon profil</p>
                     <span class="caret"></span>
                   </a>

                   <ul class="dropdown-menu">
                       <li class="dropdown-item" style="text-transform:capitalize">
                         <a href="../infos-personnelles/{{ $service }}">
                           mes infos personnelles
                         </a>
                       </li>
                       <li style="padding:0px;text-transform:capitalize" class="dropdown-item">
                         <a  href="../infos-services/{{ $service }}">
                           mes services
                         </a>
                       </li>
                      @endif
                      <hr />
                       <li style="padding:0px;text-transform:capitalize" class="dropdown-item">
                           <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                               Se déconnecter
                           </a>

                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                               {{ csrf_field() }}
                           </form>
                       </li>
                   </ul>
               </li>

     </ul>
   </div>
  </div>
  @endguest
    <!--  Fin Header user connecté -->


  <nav class="navbar navbar-dark s2sn-login-header-mobile-elektra" role="navigation">
      <div id="menuToggle">
      <input type="checkbox" />
            <!--
      Some spans to act as a hamburger.
      -->
      <span></span>
      <span></span>
      <span></span>
      <ul id="menuElek">
            @guest
              <li><a class="nav-link" href=".">SE CONNECTER</a></li>
              <li><a class="nav-link" href="{{ route('register') }}" >S'INSCRIRE</a></li>
            @else
              @if($notification >=0)
              <li class="nav-item">
                <a class="nav-link {{ $active_4 }}"  href="../suivi-conso/{{ $service }}">
                Suivi conso
                 </a>
              </li>
                <li class="nav-item">
                  <a class="nav-link {{ $active_3 }}"  href="../mes-factures/{{ $service }}">
                  Factures et paiements
                   </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ $active_2 }}"  href="../mon-contrat/{{ $service }}">
                  Mon contrat
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ $active_1 }}"  href="../infos-personnelles/{{ $service }}">
                  Mes informations
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ $active_1 }}"  href="../infos-services/{{ $service }}">
                  Mes services
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ $active_1 }}"  href="../mes-services/">
                   Changer d'espace
                  </a>
                </li>

            @endif
            <li class="nav-item">
              <a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                  Se déconnecter
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
              </li>

            @endguest
          </ul>
      </div>

  </nav>
  <!--  POUR CHANGER D'ESPACE -->
  @if($_SERVER['REQUEST_URI'] != '/register' && strpos($_SERVER['REQUEST_URI'],"admin") == false)
    <div class="circleEspace ">
      <div class="ringEspace ">
        <a href="../mes-factures/eau" class="menuItemEspace fa fa-faucet fa-2x {{ (!empty($services->service_1)) ? '' : 'disabled' }}" title="Espace Eau"></a>
        <a href="../mes-factures/electricite" class="menuItemEspace fa fa-plug fa-2x {{ (!empty($services->service_2)) ? '' : 'disabled' }}" title="Espace Electricité"></a>
        <a href="../mes-factures/tv" class="menuItemEspace fa fa-tv fa-2x {{ (!empty($services->service_3)) ? '' : 'disabled' }}" title="Espace Télévision"></a>
        <a href="../mes-factures/mobile" class="menuItemEspace fa fa-wifi fa-2x {{ (!empty($services->service_4)) ? '' : 'disabled' }}" title="Espace Mobile &  Internet"></a>
        <a href="../transactions-proprietaire" class="menuItemEspace fa fa-building fa-2x {{ (!empty($services->service_6)) ? '' : 'disabled' }}" title="Espace Propriétaire"></a>
        <a href="../mes-factures/locataire" class="menuItemEspace fa fa-key fa-2x {{ (!empty($services->service_5)) ? '' : 'disabled' }}" title="Espace Locataire"></a>
      </div>
      <a href="#" class="center fa fa-th fa-2x"  title="Changer d'espace"></a>
    </div>
  @endif
  <!--  FIN POUR CHANGER D'ESPACE -->
    @yield('content')
</div>
  <!-- HEADER END -->
<script>
$(document).ready(function() {
  var items = document.querySelectorAll('.menuItemEspace');

  for(var i = 0, l = items.length; i < l; i++) {
    items[i].style.left = (50 - 35*Math.cos(-0.5 * Math.PI - 2*(1/l)*i*Math.PI)).toFixed(4) + "%";

    items[i].style.top = (50 + 35*Math.sin(-0.5 * Math.PI - 2*(1/l)*i*Math.PI)).toFixed(4) + "%";
  }

  document.querySelector('.center').onclick = function(e) {
     e.preventDefault(); document.querySelector('.circleEspace').classList.toggle('open');
     $(".circleEspace").toggleZindex();
  }
  $.fn.toggleZindex= function() {
  var $this  = $(this);
    if($this.css("z-index")=="1000"){
        $this.css("z-index","1300")
    }else{
        $this.css("z-index","1000")
    }


  return this;
};

});
</script>
</body>
</html>
