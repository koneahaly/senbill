<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Elektra | Tableau de bord</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('dashboardAssets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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
</head>

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
        <a href="index3.html" class="nav-link">Accueil</a>
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
    <a href="." class="brand-link">
      <img src="{{ url('dashboardAssets/dist/img/logo-elektra-halo.png') }}" alt="Logo Elektra" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Tableau Elektra</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('dashboardAssets/dist/img/yassnana.jpg') }}" class="img-circle elevation-2" alt="Image utilisateur">
        </div>
        <div class="info">
          <a href="#" class="d-block">Yacine Ndiaye</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <!--  <li class="nav-item has-treeview"> -->
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Tableau de bord

              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Clients
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Paiements
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Transactions</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Factures</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Suivi paiements
              </p>
            </a>
          </li>

          <li class="nav-header">CONFIGURATIONS</li>
          <li class="nav-item">
            <a href="pages/calendar.html" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Profil admin
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/gallery.html" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Paramètres généraux
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Benana</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">Tableau de bord</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning elektraGradient2">
              <div class="inner">
                <h2>15 000 000 FCFA</h2>

                <p>En attente <a data-toggle="tooltip" data-placement="bottom" title="Ces fonds sont en attente de paiement auprès de vos clients finaux.  Les frais des partenaires ont déjà été appliqués et déduits du montant."> <i class="fas fa-info-circle iconElekRightDark"></i></a> </p>
              </div>

            <span class="small-box-footer elektraWarningGradient text-xs"> 12000 factures</span>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning elektraGradient2">
              <div class="inner">
                <h2>35 000 000 FCFA</h2>

                <p>Payés<a data-toggle="tooltip" data-placement="bottom" title="Ces fonds ont été payés par vos clients finaux et vous ont été versés.  Les frais des partenaires ont déjà été appliqués et déduits du montant."> <i class="fas fa-info-circle iconElekRightDark"></i></a> </p>
              </div>

              <span class="small-box-footer elektraSuccess text-xs"> 20000 factures</span>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning elektraGradient2">
              <div class="inner">
                <h2>50 000 000 FCFA</h2>

                <p> Impayées<a data-toggle="tooltip" data-placement="bottom" title="Ces factures n'ont pas été payés par vos clients finaux et les dates d'échéance des factures sont dépassées. Les frais des partenaires ont déjà été appliqués et déduits du montant."> <i class="fas fa-info-circle iconElekRightDark"></i></a> </p>
              </div>
              <span class="small-box-footer elektraError text-xs"> 35000 factures </span>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning elektraGradient2">
              <div class="inner">
                <h2>560</h2>

                <p>Utilisateurs inscrits</p>
              </div>
              <span class="small-box-footer elektraInfo text-xs hideUsers"> utilisateurs inscrits  </span>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Paiements
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Courbe</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#sales-chart" data-toggle="tab">Circulaire</a>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative; height: 300px;">
                      <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                   </div>
                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                  </div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- TO DO List -->
            <div class="card">
                <div class="card-header">

                  <h3 class="card-title">
                    <i class="fa fa-check-square mr-1" aria-hidden="true"></i>
                    Méthodes de paiement de vos clients</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th style="width: 10px"></th>
                        <th>Méthode</th>
                        <th>Pourcentage</th>
                        <th style="width: 40px"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1.</td>
                        <td>Orange Money</td>
                        <td>
                          <div class="progress progress-xs">
                            <div class="progress-bar progress-bar-danger elektraOM" style="width: 55%"></div>
                          </div>
                        </td>
                        <td><span class="badge bg-danger elektraOM">55%</span></td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Free Cash</td>
                        <td>
                          <div class="progress progress-xs">
                            <div class="progress-bar bg-warning elektraFree" style="width: 70%"></div>
                          </div>
                        </td>
                        <td><span class="badge bg-warning elektraFree">70%</span></td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Carte bancaire</td>
                        <td>
                          <div class="progress progress-xs progress-striped active">
                            <div class="progress-bar bg-primary elektraCB" style="width: 30%"></div>
                          </div>
                        </td>
                        <td><span class="badge bg-primary elektraCB">30%</span></td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Paypal</td>
                        <td>
                          <div class="progress progress-xs progress-striped active">
                            <div class="progress-bar bg-success elektraPaypal" style="width: 5%"></div>
                          </div>
                        </td>
                        <td><span class="badge bg-success elektraPaypal">5%</span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">

            <!-- Map card -->
            <div class="card bg-gradient-primary">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  Vos clients Elektra
                </h3>
                <!-- card tools -->
                <div class="card-tools">
                  <button type="button"
                          class="btn btn-primary btn-sm daterange"
                          data-toggle="tooltip"
                          title="Date range">
                    <i class="far fa-calendar-alt"></i>
                  </button>
                  <button type="button"
                          class="btn btn-primary btn-sm"
                          data-card-widget="collapse"
                          data-toggle="tooltip"
                          title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                <div id="world-map" style="height: 250px; width: 100%;"></div>
              </div>
              <!-- /.card-body-->
              <div class="card-footer bg-transparent">
                <div class="row">
                  <div class="col-4 text-center">
                    <div id="sparkline-1"></div>
                    <div class="text-white">Visitors</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <div id="sparkline-2"></div>
                    <div class="text-white">Online</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <div id="sparkline-3"></div>
                    <div class="text-white">Sales</div>
                  </div>
                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.card -->
            <!-- Calendar -->
            <div class="card bg-gradient-success elektraGradient">
              <div class="card-header border-0">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendrier des paiements
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <button type="button" class="btn btn-success btn-sm elektraButtonWhite" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!-- /.card-body -->
            </div>

            <!-- /.card -->

            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="">Elektra-S2SN </a>.</strong>
    Tous droits réservés.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ url('dashboardAssets/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ url('dashboardAssets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ url('dashboardAssets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ url('dashboardAssets/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ url('dashboardAssets/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ url('dashboardAssets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ url('dashboardAssets/plugins/jqvmap/maps/continents/jquery.vmap.africa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ url('dashboardAssets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ url('dashboardAssets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ url('dashboardAssets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ url('dashboardAssets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ url('dashboardAssets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ url('dashboardAssets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('dashboardAssets/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ url('dashboardAssets/dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('dashboardAssets/dist/js/demo.js') }}"></script>
<script>
$(document).ready(function() {
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
});
</script>
</body>
</html>
