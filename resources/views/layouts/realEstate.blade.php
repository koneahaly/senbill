<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Senbill') }}</title>
    <!-- <link rel="stylesheet" href="{{ asset('/css/dropzone/bootstrap.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('css/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropzone/custom.css') }}">
    
@yield('head')

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
<link rel="icon" type="image/png" href="{{ env('S3_URL')}}/{{ env('AWS_BUCKET')}}/logo-senbill-halo.png"/>
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.material.min.css">
<link rel="stylesheet" type="text/css" href=" https://cdnjs.cloudflare.com/ajax/libs/material-components-web/4.0.0/material-components-web.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">


<!--===============================================================================================-->

<!--===============================================================================================-->

@if ($_SERVER['REQUEST_URI'] == '/mes-logements' ||strpos($_SERVER['REQUEST_URI'],"mes-locataires") == true ||strpos($_SERVER['REQUEST_URI'],"servicepublic") == true)
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
@endif

<!--CHARGER MAIN.CSS PARTOUT SAUF POUR LA PAGE MES LOGEMENTS-->
@if ($_SERVER['REQUEST_URI'] != '/mes-logements' && strpos($_SERVER['REQUEST_URI'],"mes-locataires") == false && strpos($_SERVER['REQUEST_URI'],"mes-locataires") == false && strpos($_SERVER['REQUEST_URI'],"mes-demandes") == false)
<link rel="stylesheet" type="text/css" href="css/main.css">
@endif

<link rel="stylesheet" type="text/css" href="{{url('fonts/iconic/css/material-design-iconic-font.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('css/util.css')}}">


<link rel="stylesheet" type="text/css" href="{{url('css/elektra.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('css/realEstate.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('css/locationModule.css')}}">
<link rel="stylesheet" type="text/css" href="{{ url('css/sweetalert.min.css') }}">
<script src="{{ url('js/notify.js') }}"></script>
<script src="{{ url('js/sweetalert.min.js') }}"></script>

<script type="text/javascript"  src="https://github.com/lewagon/google-place-autocomplete/blob/gh-pages/autocomplete.js"></script>

<!-- Custom JS code to bind to Autocomplete API -->
<!-- find it here: https://github.com/lewagon/google-place-autocomplete/blob/gh-pages/autocomplete.js -->

<!--===============================================================================================-->

@php
$active_1 ='none';
$active_2 ='none';
$active_3 ='none';
$active_4 ='none';
$home_directory = "transactions-proprietaire";
if(strpos($_SERVER['REQUEST_URI'],"infos-proprietaire") == true)
  $active_1 = 'active';
if(strpos($_SERVER['REQUEST_URI'],"infos-services-pro") == true)
    $active_1 = 'active';
if(strpos($_SERVER['REQUEST_URI'],"mes-locataires") == true || strpos($_SERVER['REQUEST_URI'],"demande") == true)
  $active_2 = 'active';
if(strpos($_SERVER['REQUEST_URI'],"transactions-proprietaire") == true || strpos($_SERVER['REQUEST_URI'],"suivi-conso") == true){
  $active_3 = 'active';
  }
if(strpos($_SERVER['REQUEST_URI'],"mes-logements" ) == true || strpos($_SERVER['REQUEST_URI'],"mes-factures"))
    $active_4 = 'active';

if($_SERVER['REQUEST_URI'] == '/register')
  $home_directory = '.';
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
      <!--  Début Header  user connecté -->
      <div class="s2sn-login-header-desktop-elektra">
          <a class="s2sn-logo-elektra-connected" href="{{ $home_directory }}">
              <img src="{{url('images/logo-senbill-halo.png')}}" alt="logo-senbill" width="80" height="auto" class="s2sn-img-normal">
              <img src="{{url('images/logo-senbill-halo.png')}}" alt="logo-senbill" width="80" height="auto" class="s2sn-img-retina">
          </a>
          <p class="custom-space">{{ (strpos($_SERVER['REQUEST_URI'],"servicepublic") != true) ? 'Espace Propriétaire' : 'Espace Service public'}} </p>

          <lottie-player src="{{url('images/lottie/properties.json')}}"  background="transparent"  speed="1"  class="propLogo"  loop  autoplay></lottie-player>
          <div class="s2sn-login-header-nav  navbarElektra">
         <ul class="s2sn-navbar-elektra">
             @if($notification >=0)
              @if(strpos($_SERVER['REQUEST_URI'],"servicepublic") != true)
               <li class="nav-item item-connected">
                 <a class="nav-link {{ $active_3 }}"  href="{{ route('ownerTransactions') }}">
                   <i  class="fa fa-envelope-open-text fa-2x ">
                      <?php if($notification > 0) echo '<span class="badge">'.$notification.'</span>'; ?>
                   </i> <p>Transactions</p>
                  </a>
               </li>
               @endif
               @if(strpos($_SERVER['REQUEST_URI'],"servicepublic") == true)
               <li class="nav-item item-connected">
                 <a class="nav-link {{ $active_4 }}"  href="{{ route('mes-factures') }}/{{ $service }}">
                   <i  class="fa fa-envelope-open-text fa-2x ">
                      <?php if($notification > 0) echo '<span class="badge">'.$notification.'</span>'; ?>
                   </i> <p>Paiements</p>
                   <span class="sr-only">(current)</span>
                  </a>
               </li>
               @endif

               @if(strpos($_SERVER['REQUEST_URI'],"servicepublic") != true)
               <li class="nav-item item-connected">
                 <a class="nav-link {{ $active_2 }}"  href="{{ route('mes-locataires') }}">
                   <i class="fa fa-house-user fa-2x"></i> <p>Locataires</p>
                     <span class="sr-only">(current)</span>
                 </a>
               </li>
               @endif

               @if(strpos($_SERVER['REQUEST_URI'],"servicepublic") == true)
               <li class="nav-item item-connected">
                 <a class="nav-link {{ $active_2 }}"  href="{{ route('mes-demandes') }}/{{ $service }}">
                   <i class="fa fa-house-user fa-2x"></i> <p>Demandes</p>
                     <span class="sr-only">(current)</span>
                 </a>
               </li>
               @endif
               @if(strpos($_SERVER['REQUEST_URI'],"servicepublic") != true)
               <li class="nav-item item-connected">
                 <a class="nav-link {{ $active_4 }}"  href="{{ route('ownerProperties') }}">
                   <i class="fa fa-building fa-2x"></i><p>Locataires</p>
                   <span class="sr-only">(current)</span>
                 </a>
               </li>
               @endif
               @if(strpos($_SERVER['REQUEST_URI'],"servicepublic") == true)
               <li class="nav-item item-connected">
                 <a class="nav-link {{ $active_4 }}"  href="{{ route('mon-contrat') }}/{{ $service }}">
                   <i class="fa fa-building fa-2x"></i><p>Contrat</p>
                   <span class="sr-only">(current)</span>
                 </a>
               </li>
               @endif
               <li class="dropdown nav-item item-connected">
                   <a href="#" class="nav-link {{ $active_1 }} dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                     <i class="fa fa-user fa-2x">
                       <?php if($profilNotif > 0) echo '<span class="badge badge_2">'.$profilNotif.'</span>'; ?>
                     </i> <p>Profil</p>
                     <span class="caret"></span>
                   </a>

                   <ul class="dropdown-menu">
                       <li class="dropdown-item" style="text-transform:capitalize">
                         <a href="../infos-proprietaire">
                           mes infos personnelles <?php if($profilNotif > 0){ echo ' '; echo '<span class="badge" style="background-color:red">'.$profilNotif.'</span>';} ?>
                         </a>
                       </li>
                       <li style="padding:0px;text-transform:capitalize" class="dropdown-item">
                         <a  href="../infos-services-pro">
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
                  <img src="{{url('images/logo-elektra-halo.png')}}" alt="logo-elektra" width="80" height="auto" class="s2sn-img-normal">
                  <img src="{{url('images/logo-elektra-halo.png')}}" alt="logo-elektra" width="80" height="auto" class="s2sn-img-retina">
              </a>
              <p class="custom-space">{{ (strpos($_SERVER['REQUEST_URI'],"servicepublic") != true) ? 'Espace Propriétaire' : 'Espace Service public'}}</p>
              <lottie-player src="{{url('images/lottie/servicepublic.json')}}"  background="transparent"  speed="1"  class="propLogoMobile"  loop  autoplay></lottie-player>
              @endguest

    </nav>
  <!--  POUR CHANGER D'ESPACE -->
@if($_SERVER['REQUEST_URI'] != '/register' && strpos($_SERVER['REQUEST_URI'],"admin") == false)
  <div class="circleEspace ">
    <div class="ringEspace ">
      <a href="../mes-factures/distribution" class="menuItemEspace fas fa-network-wired fa-2x {{ (!empty($services->service_1) && $actived_services->service_1 != 'NULL') ? '' : 'disabled' }}" title="Espace Distribution"></a>
      <a href="../mes-demandes/servicepublic" class="menuItemEspace fab fa-galactic-republic fa-2x {{ (!empty($services->service_2) && $actived_services->service_2 != 'NULL') ? '' : 'disabled' }}" title="Espace Service public"></a>
      <a href="../mes-factures/telecom" class="menuItemEspace fa fa-tv fa-2x {{ (!empty($services->service_3) && $actived_services->service_3 != 'NULL') ? '' : 'disabled' }}" title="Espace Télécom"></a>
      <a href="../mes-factures/sante" class="menuItemEspace fa fa-wifi fa-2x {{ (!empty($services->service_4) && $actived_services->service_4 != 'NULL') ? '' : 'disabled' }}" title="Espace Santé"></a>
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
      <li class="mobile-nav-elektra-item">
          <a href="{{ route('ownerTransactions') }}" class="mobile-nav-elektra-link mobile-nav-elektra-link--active">
              <i class="fa fa-envelope-open-text mobile-nav-elektra-icon"></i>
              Transactions
          </a>
      </li>
      <li class="mobile-nav-elektra-item">
          <a href="{{ route('mes-locataires') }}" class="mobile-nav-elektra-link ">
              <i class="fa fa-house-user mobile-nav-elektra-icon"></i>
              Locataires
          </a>
      </li>

      <li class="mobile-nav-elektra-item">
          <a href="{{ route('ownerProperties') }}" class="mobile-nav-elektra-link ">
              <i class="fa fa-building mobile-nav-elektra-icon"></i>
              Logements
          </a>
      </li>
      <li class="mobile-nav-elektra-item">
          <a href="{{ route('infos-proprietaire') }}" class="mobile-nav-elektra-link ">
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
                <a class="mobile-nav-elektra-inherit-color" href="{{ route('infos-services-pro') }}">Mes services</a>
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
