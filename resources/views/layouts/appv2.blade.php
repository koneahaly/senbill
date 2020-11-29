<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'SENBILL') }}</title>

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="{!! mix('js/app.js') !!}"></script>
    @yield('scripts')
    <!-- base:css -->
    <link rel="stylesheet" href="{{url('appAssets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{url('appAssets/vendors/base/vendor.bundle.base.css')}}">

    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <script src="{{ url('js/jquery.range.js') }}"></script>

    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{url('css/jquery.range.css')}}">

    <link rel="stylesheet" href="{{url('appAssets/css/style.css')}}">
    <link href="{{ asset('css/graphicalChart.css') }}" rel="stylesheet">

    <!-- endinject -->
    <link rel="shortcut icon" href="{{url('images/logo-senbill-dark.png')}}"/>
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
    .disabled {
      color: currentColor;
      cursor: not-allowed;
      opacity: 0.5;
      text-decoration: none;
    }

    </style>
  </head>
  <body>
    <div id="app" class="container-scroller">
				<div class="pro-banner" id="pro-banner">
						<div class="card pro-banner-bg border-0 rounded-0">
							<div class="card-body py-3 px-4 d-flex align-items-center justify-content-between flex-wrap">
								<p class="mb-0 text-white font-weight-medium mb-2 mb-lg-0 mb-xl-0">Vous avez une nouvelle facture disponible</p>
								<div class="d-flex">
									<a href="" target="_blank" class="btn btn-outline-dark mr-2">Payer maintenant</a>
									<button id="bannerClose" class="btn border-0 p-0">
										<i class="mdi mdi-close text-white"></i>
									</button>
								</div>
						</div>
					</div>
				</div>
		<!-- partial:partials/_horizontal-navbar.html -->
    <div class="horizontal-menu">
      <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container-fluid">
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
            <ul class="navbar-nav navbar-nav-left">
              <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
                  <i class="mdi mdi-bell mx-0"></i>
                  <span class="count bg-success">1</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <div class="preview-icon bg-success">
                          <i class="mdi mdi-information mx-0"></i>
                        </div>
                    </div>
                    <div class="preview-item-content">
                        <h6 class="preview-subject font-weight-normal">Une facture impayée</h6>
                        <p class="font-weight-light small-text mb-0 text-muted">
                          Facture de mai 2020
                        </p>
                    </div>
                  </a>
                </div>
              </li>
            </ul>
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center" style="margin-left: 25%;">
                <a class="navbar-brand brand-logo" href="{{ $home_directory }}"><img src="{{url('images/logo-senbill-halo.png')}}" alt="logo"/></a>
                <a class="navbar-brand brand-logo-mini" href="{{ $home_directory }}"><img src="{{url('images/logo-senbill-halo.png')}}" alt="logo"/></a>
            </div>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item dropdown  d-lg-flex d-none">
                  <!--  POUR ELECTRICITE -->
                  @if( $service == "electricite")
                  <button type="button" class="btn btn-inverse-primary btn-sm disabled" style="cursor: auto!important;">Espace Electricité </button>
                    <lottie-player src="{{url('images/lottie/light.json')}}"  background="transparent"  speed="1" style="width:50px; height:50px"   loop  autoplay></lottie-player>
                  @endif
                  @if( $service == "eau")
                  <button type="button" class="btn btn-inverse-primary btn-sm disabled" style="cursor: auto!important;">Espace eau </button>
                    <lottie-player src="{{url('images/lottie/water.json')}}"  background="transparent"  speed="1" style="width:50px; height:50px"   loop  autoplay></lottie-player>
                  @endif
                  @if( $service == "tv")
                  <button type="button" class="btn btn-inverse-primary btn-sm disabled" style="cursor: auto!important;">Espace Télévision </button>
                    <lottie-player src="{{url('images/lottie/tv.json')}}"  background="transparent"  speed="1" style="width:50px; height:50px"    loop  autoplay></lottie-player>
                  @endif
                  @if( $service == "mobile")
                  <button type="button" class="btn btn-inverse-primary btn-sm disabled" style="cursor: auto!important;">Espace Mobile & Internet </button>
                    <lottie-player src="{{url('images/lottie/wifi.json')}}"  background="transparent"  speed="1" style="width:50px; height:50px"    loop  autoplay></lottie-player>
                  @endif
                  @if( $service == "locataire")
                  <button type="button" class="btn btn-inverse-primary btn-sm disabled" style="cursor: auto!important;">Espace Locataire </button>
                    <lottie-player src="{{url('images/lottie/key.json')}}"  background="transparent"  speed="1" style="width:50px; height:50px"    loop  autoplay></lottie-player>
                  @endif
                  @if( $service == "scolarite")
                  <button type="button" class="btn btn-inverse-primary btn-sm disabled" style="cursor: auto!important;">Espace Scolarité </button>
                    <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_JYe5t7/data2.json"  background="transparent"  speed="1" style="width:50px; height:50px"    loop  autoplay></lottie-player>
                  @endif
                  @if( $service == "sport")
                  <button type="button" class="btn btn-inverse-primary btn-sm disabled" style="cursor: auto!important;">Espace Sport </button>
                    <lottie-player src="{{url('images/lottie/7206-run-for-loading.json')}}"  background="transparent"  speed="1" style="width:50px; height:50px"    loop  autoplay></lottie-player>
                  @endif
                </li>
                <li class="nav-item dropdown d-lg-flex d-none">
                  <a class="dropdown-toggle show-dropdown-arrow btn btn-inverse-primary btn-sm" id="nreportDropdown" href="#" data-toggle="dropdown">
                  Changer d'espace
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="nreportDropdown">
                      <p class="mb-0 font-weight-medium float-left dropdown-header">Aller à</p>
                      <a href="../mes-factures/eau" class="dropdown-item {{ (!empty($services->service_1) && $actived_services->service_1 != 'NULL') ? '' : 'disabled' }}">
                        <i class="mdi mdi-water-pump text-primary"></i>
                        Eau
                      </a>
                      <a href="../mes-factures/electricite" class="dropdown-item {{ (!empty($services->service_2) && $actived_services->service_2 != 'NULL') ? '' : 'disabled' }}">
                        <i class="mdi mdi-lightbulb text-primary"></i>
                        Electricité
                      </a>
                      <a href="../mes-factures/tv" class="dropdown-item {{ (!empty($services->service_3) && $actived_services->service_3 != 'NULL') ? '' : 'disabled' }}">
                        <i class="mdi mdi-television-classic text-primary"></i>
                        TV
                      </a>
                      <a href="../mes-factures/mobile" class="dropdown-item {{ (!empty($services->service_4) && $actived_services->service_4 != 'NULL') ? '' : 'disabled' }}">
                        <i class="mdi mdi-wifi text-primary"></i>
                        Mobile & Internet
                      </a>
                      <a href="../transactions-proprietaire" class="dropdown-item {{ (!empty($services->service_5) && $actived_services->service_5 != 'NULL') ? '' : 'disabled' }}">
                        <i class="mdi mdi-home text-primary"></i>
                        Propriétaire
                      </a>
                      <a href="../mes-factures/locataire" class="dropdown-item {{ (!empty($services->service_6) && $actived_services->service_6 != 'NULL') ? '' : 'disabled' }}">
                        <i class="mdi mdi-key-variant text-primary"></i>
                        Locataire
                      </a>
                      <a href="../mes-factures/scolarite" class="dropdown-item {{ (!empty($services->service_7) && $actived_services->service_7 != 'NULL') ? '' : 'disabled' }}">
                        <i class="mdi mdi-school text-primary"></i>
                        Scolarité
                      </a>
                      <a href="../mes-factures/sport" class="dropdown-item {{ (!empty($services->service_8) && $actived_services->service_8 != 'NULL') ? '' : 'disabled' }}">
                        <i class="mdi mdi-run text-primary"></i>
                        Sport
                      </a>
                  </div>
                </li>

                <li class="nav-item nav-profile dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    <span class="nav-profile-name">Yacine</span>
                    <span class="online-status"></span>
                    <img src="{{url('images/avatar_profile.png')}}" alt="profile"/>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                      <a class="dropdown-item" href="../infos-personnelles/{{ $service }}">
                        <i class="mdi mdi-settings text-primary"></i>
                        Mes informations personnelles
                      </a>
                      <a class="dropdown-item" href="../infos-services/{{ $service }}">
                        <i class="mdi mdi-package-variant text-primary"></i>
                        Mes services souscrits
                      </a>
                      <a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout text-primary"></i>
                        Se déconnecter
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                  </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </div>
      </nav>
      <nav class="bottom-navbar">
        <div class="container">
            <ul class="nav page-navigation">
              <li class="nav-item {{ $active_3 }}">
                <a class="nav-link" href="../mes-factures/{{ $service }}">
                  <i class="mdi mdi-receipt menu-icon"></i>
                  <span class="menu-title">Factures et paiements</span>
                </a>
              </li>
              <li class="nav-item {{ $active_4 }}">
                  <a href="../suivi-conso/{{ $service }}" class="nav-link">
                    <i class="mdi mdi-chart-areaspline menu-icon"></i>
                    <span class="menu-title">Suivi Consommation</span>
                    <i class="menu-arrow"></i>
                  </a>
              </li>

              <li class="nav-item {{ $active_2 }}">
                  <a href="../mon-contrat/{{ $service }}" class="nav-link ">
                    <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                    <span class="menu-title">Contrat</span></a>
              </li>
              <li class="nav-item {{ $active_1 }}">
                  <a href="#" class="nav-link">
                    <i class="mdi mdi-account menu-icon"></i>
                    <span class="menu-title">Profil</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="submenu">
                      <ul class="submenu-item">
                          <li class="nav-item"><a class="nav-link" href="../infos-personnelles/{{ $service }}">Informations personnelles</a></li>
                          <li class="nav-item"><a class="nav-link" href="../infos-services/{{ $service }}">Services souscrits</a></li>
                      </ul>
                  </div>
              </li>

            </ul>
        </div>
      </nav>
    </div>
    <div style="position:relative;margin-top: 10%;">
      <div class="custom-shape-divider-bottom-1606317460">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
        </svg>
      </div>
    </div>
      @yield('content')
    <!-- partial -->
	<!--  <div class="container-fluid page-body-wrapper">
			<div class="main-panel">
				<div class="content-wrapper">

          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body" style="text-align:center">
                <h4 class="card-title" >Mes factures</h4>
                <p class="card-description">
                  Tous vos paiement sont <span "style=color:green !important">à jour!</span>
                </p>
                <div class="table-responsive pt-3">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="font-weight: 700;">
                          Echéance
                        </th>
                        <th style="font-weight: 700;">
                          Montant
                        </th>
                        <th style="font-weight: 700;">
                          Etat
                        </th>
                        <th style="font-weight: 700;">
                          Moyen de paiement
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          Avril 2020
                        </td>
                        <td>
                          15372 FCFA
                        </td>
                        <td>
                          <label class="badge badge-success">Payé</label>
                          <br>
                          <span style="font-size:0.7em;font-weight: lighter;color:black;">  le 2020-06-03 10:34:45 <span> </span></span>
                        </td>
                        <td>
                          Orange Money
                        </td>
                      </tr>
                      <tr>
                        <tr>
                          <td>
                            Mai 2020
                          </td>
                          <td>
                            25070 FCFA
                          </td>
                          <td>
                            <a href="">
                              <label class="badge badge-danger">Régler</label>
                            </a>
                            <br>
                            <span style="font-size:0.7em;font-weight: lighter;color:black;"> avant le 2020-06-03 10:34:45 <span> </span></span>
                          </td>
                          <td>
                            Carte bancaire
                          </td>
                        </tr>
                        <tr>

                        <td>
                          Messsy Adam
                        </td>
                        <td>
                          <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                        <td>
                          $245.30
                        </td>
                        <td>
                          July 1, 2015
                        </td>
                      </tr>
                      <tr>

                        <td>
                          John Richards
                        </td>
                        <td>
                          <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                        <td>
                          $138.00
                        </td>
                        <td>
                          Apr 12, 2015
                        </td>
                      </tr>
                      <tr>

                        <td>
                          Peter Meggik
                        </td>
                        <td>
                          <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                        <td>
                          $ 77.99
                        </td>
                        <td>
                          May 15, 2015
                        </td>
                      </tr>
                      <tr>

                        <td>
                          Edward
                        </td>
                        <td>
                          <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                        <td>
                          $ 160.25
                        </td>
                        <td>
                          May 03, 2015
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

				</div>
				<!-- content-wrapper ends
				<!-- partial:partials/_footer.html
				<footer class="footer">
          <div class="footer-wrap">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © services2sn 2020</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Solution de <a href="https://www.services2sn.com/" target="_blank">Services2sn.com</a></span>
            </div>
          </div>
        </footer>
				<!-- partial
			</div>

			<!-- main-panel ends
		</div>

  -->
		<!-- page-body-wrapper ends -->
    </div>
		<!-- container-scroller -->

    <!-- base:js -->
    <script src="{{url('appAssets/vendors/base/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{url('appAssets/js/template.js')}}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <!-- End plugin js for this page -->
    <script src="{{url('appAssets/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{url('appAssets/vendors/progressbar.js/progressbar.min.js')}}"></script>
		<script src="{{url('appAssets/vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js')}}"></script>
		<script src="{{url('appAssets/vendors/justgage/raphael-2.1.4.min.js')}}"></script>
		<script src="{{url('appAssets/vendors/justgage/justgage.js')}}"></script>
    <!-- Custom js for this page-->
    <script src="{{url('appAssets/js/dashboard.js')}}"></script>
    <script src="{{ url('js/lottie-player.js') }}"></script>
    <script src="{{ url('js/jquery.range.js') }}"></script>


    <!-- End custom js for this page-->
  </body>
</html>
