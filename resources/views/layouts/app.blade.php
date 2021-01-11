<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Senbill') }}</title>

    <!-- Scripts -->
  <script type="text/javascript">
       // Notice how this gets configured before we load Font Awesome
       window.FontAwesomeConfig = { autoReplaceSvg: false }
  </script>
  <script src=https://touchpay.gutouch.com/touchpay/script/prod_touchpay-0.0.1.js  type="text/javascript"></script>
<script type="text/javascript">
function calltouchpay(){
             sendPaymentInfos(
                                new Date().getTime(),
                                'SNBIL11162',
                                'NTrmzaD4WyiAKaTa9-8Vjc^$ijuP-ut0oY2J^drhn$v9qTWJC@',
                                'senbill.sn',
				'url_redirection_success',
                                'url_redirection_fail', 5,
                                'dakar', '','', '',  '');
}
</script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script src="{!! mix('js/app.js') !!}"></script>
  @yield('scripts')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/graphicalChart.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('css/common.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="https://elektra.s3.amazonaws.com/images/icons/logo-senbill-halo.png"/>
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
<link rel="stylesheet" type="text/css" href="{{ url('css/sweetalert.min.css') }}">
<script src="{{ url('js/notify.js') }}"></script>
<script src="{{ url('js/sweetalert.min.js') }}"></script>

<!--===============================================================================================-->

<!--====================================PAY DUNYA===================================================-->
<!--
<link rel="stylesheet" type="text/css" href="https://paydunya.com/assets/psr/css/psr.paydunya.min.css">
-->
<!--===============================================================================================-->
@php
$active_1 ='none';
$active_2 ='none';
$active_3 ='none';
$active_4 ='none';

$suivi_none='none';

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

if(strpos($_SERVER['REQUEST_URI'],"locataire") == true)
      $suivi_none = 'active';

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
          <img src="{{url('images/logo-senbill-halo.png')}}" alt=" logo-senbill" width="80" height="auto" class="s2sn-img-normal">
          <img src="{{url('images/logo-senbill-halo.png')}}" alt=" logo-senbill" width="80" height="auto" class="s2sn-img-retina">
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
              <img src="{{url('images/logo-senbill-halo.png')}}" alt=" logo-senbill" width="80" height="auto" class="s2sn-img-normal">
              <img src="{{url('images/logo-senbill-halo.png')}}" alt=" logo-senbill" width="80" height="auto" class="s2sn-img-retina">
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
   @if( $service == "scolarite")
     <p class="custom-space">Espace Scolarité</p>
     <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_JYe5t7/data2.json"  background="transparent"  speed="1" class="space-logo-locataire"  loop  autoplay></lottie-player>
   @endif
  @if( $service == "sport")
    <p class="custom-space">Espace Sport</p>
    <lottie-player src="{{url('images/lottie/7206-run-for-loading.json')}}"  background="transparent"  speed="1" class="space-logo-locataire"  loop  autoplay></lottie-player>
  @endif
          <div class="s2sn-login-header-nav  navbarElektra">
         <ul class="s2sn-navbar-elektra">
             @if($notification >=0)
             <li class="nav-item item-connected {{ $suivi_none == 'active' ? 'disabled' : '' }}">
               <a class="nav-link {{ $active_4 }}"  href="../suivi-conso/{{ $service }}" onclick="{{ $suivi_none == 'active' ? 'return false' : '' }}">
                 <i  class="fa fa-chart-bar fa-2x ">
                 </i> <p>Suivi conso</p>
                </a>
             </li>
               <li class="nav-item item-connected">
                 <a class="nav-link {{ $active_3 }}"  href="../mes-factures/{{ $service }}">
                   <i  class="fa fa-envelope-open-text fa-2x ">
                      <?php if($notification > 0) echo '<span class="badge badge_2">'.$notification.'</span>'; ?>
                   </i> <p>Factures et paiements</p>
                  </a>
               </li>
               <li class="nav-item item-connected">
                 <a class="nav-link {{ $active_2 }}"  href="../mon-contrat/{{ $service }}">
                   <i class="fa fa-file-contract fa-2x"></i> <p>Contrat</p>
                     <span class="sr-only">(current)</span>
                 </a>
               </li>

               <li class="dropdown nav-item item-connected">
                   <a href="#" class="nav-link {{ $active_1 }} dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                     <i class="fa fa-user fa-2x">
                       <?php if($profilNotif > 0) echo '<span class="badge badge_2">'.$profilNotif.'</span>'; ?>
                     </i> <p>Profil</p>
                     <span class="caret"></span>
                   </a>

                   <ul class="dropdown-menu">
                       <li class="dropdown-item" style="text-transform:capitalize">
                         <a href="../infos-personnelles/{{ $service }}">
                           mes infos personnelles <?php if($profilNotif > 0){ echo ' '; echo '<span class="badge" style="background-color:red">'.$profilNotif.'</span>';} ?>
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
              <!--
        Some spans to act as a hamburger.
        -->
        <span></span>
        <span></span>
        <span></span>
              @guest
              @else
              <a class="s2sn-logo-elektra-connected" href="{{ $home_directory }}">
                  <img src="{{url('images/logo-senbill-halo.png')}}" alt="logo-senbill" width="80" height="auto" class="s2sn-img-normal">
                  <img src="{{url('images/logo-senbill-halo.png')}}" alt="logo-senbill" width="80" height="auto" class="s2sn-img-retina">
              </a>

              <!--  POUR ELECTRICITE -->
              @if( $service == "electricite")
                <p class="custom-space">Espace electricité</p>
                <lottie-player src="{{url('images/lottie/light.json')}}"  background="transparent"  speed="1" class="space-logo logoEspaceMobile"   loop  autoplay></lottie-player>
              @endif

             <!--  POUR EAU -->
              @if( $service == "eau")
                <p class="custom-space">Espace eau</p>
                <lottie-player src="{{url('images/lottie/water.json')}}"  background="transparent"  speed="1" class="space-logo logoEspaceMobile"  loop  autoplay></lottie-player>
             @endif
            <!--  POUR TV -->
            @if( $service == "tv")
              <p class="custom-space">Espace Télévision </p>
              <lottie-player src="{{url('images/lottie/tv.json')}}"  background="transparent"  speed="1" class="space-logo-tv logoEspaceMobile" loop  autoplay></lottie-player>
            @endif

           <!--  POUR MOBILE & Internet -->
           @if( $service == "mobile")
            <p class="custom-space">Espace Mobile & Internet</p>
            <lottie-player src="{{url('images/lottie/wifi.json')}}"  background="transparent"  speed="1" class="space-logo-internet logoEspaceMobile"  loop  autoplay></lottie-player>
           @endif
          <!--  POUR Locataire -->
          @if( $service == "locataire")
            <p class="custom-space">Espace Locataire</p>
            <lottie-player src="{{url('images/lottie/key.json')}}"  background="transparent"  speed="1" class="space-logo-locataire logoEspaceMobile"  loop  autoplay></lottie-player>
         @endif
         @if( $service == "scolarite")
           <p class="custom-space">Espace Scolarité</p>
           <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_JYe5t7/data2.json"  background="transparent"  speed="1" class="space-logo-locataire logoEspaceMobile"  loop  autoplay></lottie-player>
         @endif
         @if( $service == "sport")
           <p class="custom-space">Espace Sport</p>
           <lottie-player src="{{url('images/lottie/7206-run-for-loading.json')}}"  background="transparent"  speed="1" class="space-logo-locataire logoEspaceMobile"  loop  autoplay></lottie-player>
         @endif
              @endguest

    </nav>
  <!--  POUR CHANGER D'ESPACE -->
  @if($_SERVER['REQUEST_URI'] != '/register' && strpos($_SERVER['REQUEST_URI'],"admin") == false)
    <div class="circleEspace ">
      <div class="ringEspace ">
        <a href="../mes-factures/eau" class="menuItemEspace fa fa-faucet fa-2x {{ (!empty($services->service_1) && $actived_services->service_1 != 'NULL') ? '' : 'disabled' }}" title="Espace Eau"></a>
        <a href="../mes-factures/electricite" class="menuItemEspace fa fa-plug fa-2x {{ (!empty($services->service_2) && $actived_services->service_2 != 'NULL') ? '' : 'disabled' }}" title="Espace Electricité"></a>
        <a href="../mes-factures/tv" class="menuItemEspace fa fa-tv fa-2x {{ (!empty($services->service_3) && $actived_services->service_3 != 'NULL') ? '' : 'disabled' }}" title="Espace Télévision"></a>
        <a href="../mes-factures/mobile" class="menuItemEspace fa fa-wifi fa-2x {{ (!empty($services->service_4) && $actived_services->service_4 != 'NULL') ? '' : 'disabled' }}" title="Espace Mobile &  Internet"></a>
        <a href="../transactions-proprietaire" class="menuItemEspace fa fa-building fa-2x {{ (!empty($services->service_6) && $actived_services->service_6 != 'NULL') ? '' : 'disabled' }}" title="Espace Propriétaire"></a>
        <a href="../mes-factures/locataire" class="menuItemEspace fa fa-key fa-2x {{ (!empty($services->service_5) && $actived_services->service_5 != 'NULL') ? '' : 'disabled' }}" title="Espace Locataire"></a>
        <a href="../mes-factures/scolarite" class="menuItemEspace fa fa-university fa-2x {{ (!empty($services->service_7) && $actived_services->service_7 != 'NULL') ? '' : 'disabled' }}" title="Espace Scolarité"></a>
        <a href="../mes-factures/sport" class="menuItemEspace fa fa-running fa-2x {{ (!empty($services->service_8) && $actived_services->service_8 != 'NULL') ? '' : 'disabled' }}" title="Espace Sport"></a>
      </div>
      <a href="#" class="center fa fa-th fa-2x"  title="Changer d'espace"></a>
    </div>
  @endif
  <!--  FIN POUR CHANGER D'ESPACE -->
    @yield('content')

    <!--  MENU MOBILE DU BAS -->
  <nav class="navbar navbarMobileElek navbar-expand-md navbar-dark bg-dark fixed-bottom">
    <ul id="nav-list" class="mobile-nav_list-elektra">
      @guest
      <li class="mobile-nav-elektra-item">
          <a href="." class="mobile-nav-elektra-link mobile-nav-elektra-link--active">
              <i class="fas fa-user-circle mobile-nav-elektra-icon"></i>
              SE CONNECTER
          </a>
      </li>
      <li class="mobile-nav-elektra-item">
          <a href="{{ route('register') }}" class="mobile-nav-elektra-link ">
              <i class="fas fa-sign-in-alt mobile-nav-elektra-icon"></i>
              S'INSCRIRE
          </a>
      </li>
      @else
      <li class="mobile-nav-elektra-item {{ $suivi_none == 'active' ? 'disabled' : '' }}">
          <a href="../suivi-conso/{{ $service }}" onclick="{{ $suivi_none == 'active' ? 'return false' : '' }}" class="mobile-nav-elektra-link mobile-nav-elektra-link--active">
              <i class="fa fa-envelope-open-text mobile-nav-elektra-icon"></i>
              Suivi conso
          </a>
      </li>
      <li class="mobile-nav-elektra-item">
          <a href="../mes-factures/{{ $service }}" class="mobile-nav-elektra-link ">
              <i class="fa fa-house-user mobile-nav-elektra-icon"></i>
              Paiements
          </a>
      </li>

      <li class="mobile-nav-elektra-item">
          <a href="../mon-contrat/{{ $service }}" class="mobile-nav-elektra-link ">
              <i class="fa fa-building mobile-nav-elektra-icon"></i>
              Contrat
          </a>
      </li>
      <li class="mobile-nav-elektra-item">
          <a href="../infos-personnelles/{{ $service }}" class="mobile-nav-elektra-link ">
              <i class="fa fa-user mobile-nav-elektra-icon"></i>
              Profil
          </a>
      </li>
      <li class="mobile-nav-elektra-item">
          <button id="menu-btn" onclick="toggleMenuMobile()" class="mobile-nav-elektra-link js-mobile-nav-elektra-more-btn button--link" style="color: rgb(255, 255, 255);">
              <i class="fa fa-ellipsis-h mobile-nav-elektra-icon"></i>
              Plus
          </button>
      </li>
    @endif
  </ul>

  <div id="mobile-nav-overlay" class="mobile-nav-elektra-overlay" >
        <!--mobile dropdown-->
        <ul class="mobile-nav-elektra-menu-popup">
            <li class="mobile-nav-elektra-item mobile-nav-elektra-item--popup">
                <a class="mobile-nav-elektra-inherit-color" href="../infos-services/{{ $service }}">Mes services</a>
            </li>
            <li class="mobile-nav-elektra-item mobile-nav-elektra-item--popup  js-mobile-nav-elektra-menu-my-account">
                <a class="mobile-nav-elektra-inherit-color" href="../mes-services/">Changer de plateforme</a>
            </li>
            <li class="mobile-nav-elektra-item mobile-nav-elektra-item--popup mobile-nav-elektra-login-social-wrap">
                <button id="mobile-nav-sign-up" class="mobile-nav-elektra-popup-btn" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Se Déconnecter</button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
        <!--mobile dropdown end-->
    </div>
</nav>
  <!--  FIN MENU MOBILE DU BAS -->
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
function toggleMenuMobile() {
  var moreDiv = document.getElementById("mobile-nav-overlay");
  var layout=document.getElementsByClassName("mobile-nav-elektra-menu-popup");
  if (moreDiv.style.display === "none") {
    moreDiv.style.display = "block";
    layout[0].style.display = "block";
  } else {
    moreDiv.style.display = "none";
}
}
</script>
</body>
</html>
