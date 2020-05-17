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
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/graphicalChart.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('css/common.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<!--===============================================================================================-->
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

<!--===============================================================================================-->


@php
$active_1 ='none';
$active_2 ='none';
$active_3 ='none';
if($_SERVER['REQUEST_URI'] == '/infos-personnelles')
  $active_1 = 'active';
if($_SERVER['REQUEST_URI'] == '/mon-contrat')
  $active_2 = 'active';
if($_SERVER['REQUEST_URI'] == '/mes-factures')
  $active_3 = 'active';
@endphp

</head>
<script src="{{ url('js/form.js') }}"></script>

<body>
<div id="app" class="s2sn-wrapper-login-container s2sn-js-login" style="background-image: url({{url('images/white-background/19366_Fotor1.jpg')}});">
  <!-- HEADER START -->
   @guest
   <!--  Header  invité -->
  <div class="s2sn-login-header-desktop-elektra">
      <a class="s2sn-logo-elektra-register" href=".">
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
          <a class="s2sn-logo-elektra-connected" href=".">
              <img src="{{url('images/logo-elektra-halo.png')}}" alt="logo-elektra" width="80" height="auto" class="s2sn-img-normal">
              <img src="{{url('images/logo-elektra-halo.png')}}" alt="logo-elektra" width="80" height="auto" class="s2sn-img-retina">
          </a>
          <div class="s2sn-login-header-nav">
         <ul class="s2sn-navbar-elektra"  style="margin-left: 300px;">
             @if($notification >=0)
               <li class="nav-item item-connected">
                 <a class="nav-link {{ $active_3 }}"  href="{{ route('mes-factures') }}">
                   <i  class="fa fa-envelope-open-text fa-2x ">
                     <span class="badge"> <?php if($notification > 0) echo $notification; ?></span>
                   </i> Factures et paiements
                  </a>
               </li>
               <li class="nav-item item-connected">
                 <a class="nav-link {{ $active_2 }}"  href="{{ route('mon-contrat') }}">
                   <i class="fa fa-file-contract"></i>Mon contrat
                     <span class="sr-only">(current)</span>
                 </a>
               </li>
               <li class="nav-item item-connected">
                 <a class="nav-link {{ $active_1 }}"  href="{{ route('infos-personnelles') }}">
                   <i class="fa fa-address-card"></i>Mes informations personnelles
                   <span class="sr-only">(current)</span>
                 </a>
               </li>
           @endif
             <li class="dropdown">
                 <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                   <i class="fa fa-user-alt-slash"></i>{{ Auth::user()->name }}
                   <span class="caret"></span>
                 </a>

                 <ul class="dropdown-menu">
                     <li>
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


  <nav class="navbar navbar-dark s2sn-login-header-mobile">
      <a class="s2sn-logo-elektra" href="https://www.elektra.com/" target="_blank">
          <img src="{{url('images/logo-elektra-halo.png')}}" alt="logo-elektra" width="70" height="auto" class="s2sn-img-normal">
          <img src="{{url('images/logo-elektra-halo.png')}}" alt="logo-elektra" width="70" height="auto" class="s2sn-img-retina">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-contrs2sn="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            @guest
              <li class="nav-item"><a class="nav-link" href=".">SE CONNECTER</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ route('register') }}" >S'INSCRIRE</a></li>
            @else
              @if($notification >=0)
                <li class="nav-item">
                  <a class="nav-link {{ $active_3 }}"  href="{{ route('mes-factures') }}">
                    <i class="fa fa-envelope-open-text">
                      <span class="badge"> 1</span>
                    </i> Factures et paiements
                   </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ $active_2 }}"  href="{{ route('mon-contrat') }}">
                    <i class="fa fa-file-contract"></i>Mon contrat
                      <span class="sr-only">(current)</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ $active_1 }}"  href="{{ route('infos-personnelles') }}">
                    <i class="fa fa-address-card"></i>Mes informations personnelles
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
            @endif
            <li class="dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                  <i class="fa fa-user-alt-slash"></i>{{ Auth::user()->name }}
                  <span class="caret"></span>
                </a>

                <ul class="dropdown-menu">
                    <li>
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
            @endguest
          </ul>
      </div>

  </nav>
    @yield('content')
</div>
  <!-- HEADER END -->
</body>
</html>
