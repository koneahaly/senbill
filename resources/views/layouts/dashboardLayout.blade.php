<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Senbill | Tableau de bord</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('dashboardAssets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{url('dashboardAssets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{url('dashboardAssets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{url('dashboardAssets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{url('dashboardAssets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{url('dashboardAssets/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('dashboardAssets/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{url('dashboardAssets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{url('dashboardAssets/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{url('dashboardAssets/plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- Select2 -->
  <link rel="stylesheet" href="{{url('dashboardAssets/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{url('dashboardAssets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('vendor/animate/animate.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('vendor/animsition/css/animsition.min.css')}}">

  <script src="{{ url('js/notify.js') }}"></script>
</head>
@php
$active_dashboard ='none';
$active_clients ='none';
$active_transactions ='none';
$active_factures ='none';
$active_paiements ='none';
$active_paiements_declined ='none';
$active_paiements_finished ='none';
$active_menu ='none';
$active_profile ='none';
$active_general ='none';
$active_import ='none';

if(strpos($_SERVER['REQUEST_URI'],"accueil") == true){
  $active_dashboard = 'active';
}
if(strpos($_SERVER['REQUEST_URI'],"clients") == true){
  $active_clients = 'active';
}
if(strpos($_SERVER['REQUEST_URI'],"paiements") == true){
  $active_paiements = 'active';
}

if(strpos($_SERVER['REQUEST_URI'],"transactions") == true){
  $active_paiements = 'active';
  $active_transactions = 'active';
  $active_menu = 'menu-open';
}
if(strpos($_SERVER['REQUEST_URI'],"factures") == true && strpos($_SERVER['REQUEST_URI'],"declined") !== true && strpos($_SERVER['REQUEST_URI'],"finished") !== true){
    $active_paiements = 'active';
    $active_factures = 'active';
    $active_menu = 'menu-open';
}
if(strpos($_SERVER['REQUEST_URI'],"factures") !== true && strpos($_SERVER['REQUEST_URI'],"declined") == true && strpos($_SERVER['REQUEST_URI'],"finished") !== true){
    $active_paiements_declined = 'active';
    $active_paiements = 'none';
    $active_factures = 'none';
    $active_menu = 'menu-open';
}
if(strpos($_SERVER['REQUEST_URI'],"factures") !== true && strpos($_SERVER['REQUEST_URI'],"declined") !== true && strpos($_SERVER['REQUEST_URI'],"finished") == true){
    $active_paiements_finished = 'active';
    $active_paiements = 'none';
    $active_factures = 'none';
    $active_menu = 'menu-open';
}
if(strpos($_SERVER['REQUEST_URI'],"profil") == true){
  $active_profile = 'active';
}
if(strpos($_SERVER['REQUEST_URI'],"general") == true){
  $active_general = 'active';
}
if(strpos($_SERVER['REQUEST_URI'],"import") == true){
  $active_import = 'active';
}
@endphp
<style>

.elektraGradient {
    background: linear-gradient(90deg, rgba(48,116,155,1) 0%, rgba(155,192,221,1) 50%, rgba(189,202,210,1) 100%) !important;
}
.elektraGradient2 {
background: linear-gradient(90deg, rgb(255, 255, 255) 0%, rgb(222, 238, 251) 50%, rgb(245, 249, 251) 100%) !important;

}
.elektraWarningGradient{
background: #fc0 !important;
color:#0000008a !important;

}
.elektraSuccess{
background: #228b22 !important;
color:#0000008a !important;

}
.elektraOM{
background-color: #ff7600 !important;

}
.elektraFree{
background-color: #f93b0f !important;

}
.elektraPaypal{
background-color: #2282e4 !important;

}
.elektraCB{
background-color: #228b22 !important;

}

.elektraError{
background: #c13312 !important;
color:#0000008a !important;

}
.elektraInfo{
background: #2282e4 !important;
color:#0000008a !important;

}
.elektraButtonWhite{
background: #eef2f7 !important;
color:#0000008a !important;
border-color: #425a6f !important;;

}
.hideUsers{
color:#2282e4 !important;
}

.textAlignRight{
  text-align: right !important;

}
.marginTextRight{
  margin-right: 2%!important;
}

.iconElekRight{
  margin-right: 2%!important;
  color:#ffdead;
}
.iconElekRightDark{
  margin-right: 2%!important;
  color:#b79e79;
}
.bgElek{
  background:url('/Users/yndiaye/Sites/electra/public/images/white-background/19366_Fotor1.jpg') no-repeat center center fixed !important;
  background-size: cover;

}
.nav-sidebar .nav-treeview {
    transition: padding .3s ease-in-out  !important;
    padding-left: 1rem !important;
}
.dataTables_length label{
    display: inline-flex  !important;
}
.dataTables_length label select{
    margin-left:4%!important;
    margin-right:4%!important;
    width: max-content;
}
.dataTables_filter label{
    display: inline-flex  !important;
}
.dataTables_filter input{
    margin-left:4%!important;
}
.label.required:after {
  content:"*";
  color:red;
}
.card-primary.card-outline {
    border-top: 3px solid #6181a2 !important;
}
.elektraBlue {
    background: rgba(155,192,221,1) !important;
}
.toggleElek::after {
    vertical-align: 0em !important;
}
/* Mac Download Button */
    .elektra-button-wrapper {
        color: #ffffff !important;
        border-color: #ffffff;
        background-color: #007bff;
        padding: 10px 34px;
        -webkit-transition: all 0.2s linear;
        -o-transition: all 0.2s linear;
        transition: all 0.2s linear;
        min-width: 200px;
        text-align: center;
        border-radius: 45px;
        border: 1px solid #007bff;
        margin-left: auto;
        margin-right: auto;
        display: table;
   }
   .elektra-button-wrapper a {
       color: #ffffff !important;
  }
    .elektra-button {
        font: 500 16px "Cabin", sans-serif;
   }
    .elektra-button-wrapper:hover {
        color: #007bff;
        background: #ffffff;
        border-color: #ffffff;
        -webkit-box-shadow: 0px 20px 30px 0px rgba(12, 0, 46, 0.1);
                box-shadow: 0px 20px 30px 0px rgba(12, 0, 46, 0.1);

   }
   .elektra-button-wrapper:hover a {
       color: #007bff !important;
  }
  .custom-file-label::after {
    content: "Parcourir" !important;;
}
</style>
<body class="hold-transition sidebar-mini layout-fixed bgElek">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-navy navbar-dark  sidebar-light-blue elektraGradient">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">{{ $social_name }}</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-navy elevation-4 elektraGradient2">
    <!-- Brand Logo -->
    <a href="{{ route('welcome.dashboard') }}" class="brand-link">
      <img src="{{ url('dashboardAssets/dist/img/logo-senbill-halo.png') }}" alt="Logo Elektra" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Tableau Senbill</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('dashboardAssets/dist/img/momar.jpeg') }}" class="img-circle elevation-2" alt="Image utilisateur">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ $full_name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <!--  <li class="nav-item has-treeview"> -->
          <li class="nav-item">
            <a href="{{ route('welcome.get.dashboard') }}" class="nav-link {{ $active_dashboard }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Tableau de bord

              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('clients.dashboard') }}" class="nav-link {{ $active_clients }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Clients
                <!-- <span class="right badge badge-danger">Nouveau</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview {{ $active_menu }}">
            <a href="#" class="nav-link {{ $active_paiements }}">
              <i class="nav-icon fas fa-copy"></i>
              @if($offer->libelle != 'servicepublic' AND $offer->libelle != 'Location')
              <p>
                Paiements
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
              @endif
              @if($offer->libelle == 'servicepublic')
              <p>
                Demandes
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
              @endif
              @if($offer->libelle == 'Location')
              <p>
                Locations
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
              @endif
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                @if($offer->libelle != 'servicepublic' AND $offer->libelle != 'Location')
                <a href="{{ route('transactions.dashboard') }}" class="nav-link {{ $active_transactions }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Transactions</p>
                </a>
                @endif
                @if($offer->libelle == 'servicepublic')
                <a href="{{ route('transactions.dashboard') }}" class="nav-link {{ $active_transactions }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Traitements en attente</p>
                </a>
                @endif
                @if($offer->libelle == 'Location')
                <a href="{{ route('transactions.dashboard') }}" class="nav-link {{ $active_transactions }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Déclarations</p>
                </a>
                @endif
              </li>

              @if($offer->libelle != 'servicepublic' AND $offer->libelle != 'Location')
              <li class="nav-item">
                <a href="{{ route('bills.dashboard') }}" class="nav-link {{ $active_factures}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Factures </p>
                </a>
              </li>
              @endif
              @if($offer->libelle == 'servicepublic')
              <li class="nav-item">
                <a href="{{ route('bills.dashboard') }}" class="nav-link {{ $active_factures}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Paiements en attente </p>
                </a>
              </li>
              @endif
              @if($offer->libelle == 'Location')
              <li class="nav-item">
                <a href="{{ route('reports.dashboard') }}" class="nav-link {{ $active_paiements_declined}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> signalements </p>
                </a>
              </li>
              @endif
              @if($offer->libelle == 'servicepublic')
              <li class="nav-item">
                <a href="{{ route('bills.dashboard.declined') }}" class="nav-link {{ $active_paiements_declined}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Demandes déclin&eacute;es </p>
                </a>
              </li>
              @endif
              @if($offer->libelle == 'servicepublic')
              <li class="nav-item">
                <a href="{{ route('bills.dashboard.finished') }}" class="nav-link {{ $active_paiements_finished}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Demandes termin&eacute;es </p>
                </a>
              </li>
              @endif
            </ul>
          </li>

          <li class="nav-header">CONFIGURATIONS</li>
          <li class="nav-item">
            <a href="{{ route('profile.dashboard') }}" class="nav-link {{ $active_profile }}">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Profil admin
                <!-- <span class="badge badge-info right">2</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('company.dashboard') }}" class="nav-link {{ $active_general }}">
              <i class="nav-icon far fa-image"></i>
              <p>
                Paramètres généraux
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="{{ route('import.dashboard',['name' => $social_name]) }}" class="nav-link {{ $active_import }}">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Importer
              </p>
            </a>
          </li>

          <li class="nav-header">ALERTES</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Important</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Attention</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Informations</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

          @yield('content')

  </body>
</html>
