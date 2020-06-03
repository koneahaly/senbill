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
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
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
<link rel="stylesheet" type="text/css" href="{{url('css/realEstate.css')}}">

<!--===============================================================================================-->

@php
$active_1 ='none';
$active_2 ='none';
$active_3 ='none';
$home_directory = "transactions-proprietaire";
if($_SERVER['REQUEST_URI'] == '/infos-personnelles')
  $active_1 = 'active';
if($_SERVER['REQUEST_URI'] == '/mon-contrat')
  $active_2 = 'active';
if($_SERVER['REQUEST_URI'] == '/transactions-proprietaire')
  $active_3 = 'active';

if($_SERVER['REQUEST_URI'] == '/register')
  $home_directory = '.';
@endphp

</head>

<body>
<div id="app" class="s2sn-wrapper-login-container s2sn-js-login" style="background-image: url({{url('images/white-background/19366_Fotor1.jpg')}});">
  <!-- HEADER START -->
      <!--  Début Header  user connecté -->
      <div class="s2sn-login-header-desktop-elektra">
          <a class="s2sn-logo-elektra-connected" href="{{ $home_directory }}">
              <img src="{{url('images/logo-elektra-halo.png')}}" alt="logo-elektra" width="80" height="auto" class="s2sn-img-normal">
              <img src="{{url('images/logo-elektra-halo.png')}}" alt="logo-elektra" width="80" height="auto" class="s2sn-img-retina">
          </a>
          <div class="s2sn-login-header-nav  navbarElektra">
         <ul class="s2sn-navbar-elektra">
             @if($notification >=0)
               <li class="nav-item item-connected">
                 <a class="nav-link {{ $active_3 }}"  href="{{ route('mes-factures') }}">
                   <i  class="fa fa-envelope-open-text fa-2x ">
                      <?php if($notification > 0) echo '<span class="badge">'.$notification.'</span>'; ?>
                   </i> <p>Transactions</p>
                  </a>
               </li>
               <li class="nav-item item-connected">
                 <a class="nav-link {{ $active_2 }}"  href="{{ route('mon-contrat') }}">
                   <i class="fa fa-file-contract fa-2x"></i> <p>Mes Locataires</p>
                     <span class="sr-only">(current)</span>
                 </a>
               </li>
               <li class="nav-item item-connected">
                 <a class="nav-link {{ $active_1 }}"  href="{{ route('infos-personnelles') }}">
                   <i class="fa fa-address-card fa-2x"></i><p>Mes logements</p>
                   <span class="sr-only">(current)</span>
                 </a>
               </li>
               <li class="nav-item item-connected">
                 <a class="nav-link {{ $active_1 }}"  href="{{ route('infos-personnelles') }}">
                   <i class="fa fa-address-card fa-2x"></i><p>Mes informations</p>
                   <span class="sr-only">(current)</span>
                 </a>
               </li>
           @endif
             <li class="dropdown">
                 <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                   <i class="fa fa-user-alt-slash fa-2x"></i> <p>{{ Auth::user()->first_name }}</p>
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

              @if($notification >=0)
                <li class="nav-item">
                  <a class="nav-link {{ $active_3 }}"  href="{{ route('mes-factures') }}">
                  Factures et paiements
                   </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ $active_2 }}"  href="{{ route('mon-contrat') }}">
                  Mon contrat
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ $active_1 }}"  href="{{ route('infos-personnelles') }}">
                  Mes informations personnelles
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

          </ul>
      </div>

  </nav>
    @yield('content')
</div>
  <!-- HEADER END -->
</body>
</html>
