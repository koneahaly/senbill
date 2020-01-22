<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'eLECTRA') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/graphicalChart.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('css/common.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
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
<!--===============================================================================================-->
<style>
.active{
  background-color:#d90000;
  color:#fff;

}
</style>
@php
$active_1 ='none';
$active_2 ='none';
$active_3 ='none';

if(basename($_SERVER['PHP_SELF']) == 'infos-personnelles')
  $active_1 = 'active';
if(basename($_SERVER['PHP_SELF']) == 'mon-contrat')
  $active_2 = 'active';
if(basename($_SERVER['PHP_SELF']) == 'mes-factures')
  $active_3 = 'active';
@endphp
</head>
<body style="background: url('{{ asset('images/white-background/19366_Fotor1.jpg') }}') 0 0 repeat;background-size:cover;opacity:1;">
    <div id="app">
        <nav class="navbar navbar-light navbar-expand-lg navbar-icon-top" style="background-color:#22a7b5">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'eLECTRA') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right navdesign mr-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Se connecter</a></li>
                            <li><a href="{{ route('register') }}">S'inscrire</a></li>
                        @else
                            <li class="nav-item">
                              <a class="nav-link {{ $active_3 }}"  href="{{ route('mes-factures') }}">
                                <i class="fa fa-envelope-open-text">
                                  <span class="badge">2</span>
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
            </div>
        </nav>

        @yield('content')
    </div>




    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/iframe.js') }}"></script>
    <!-- JS scripts -->
</script>
</body>
</html>
