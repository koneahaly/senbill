@extends('layouts.dashboardLayout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Opérations</h1>
        </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">Transactions</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.METTRE TABLEAU ICI -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Suivi des transactions</h3> <br/>
            <p> Les opérations de paiement de vos clients correctement exécutées</p>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="clientsTable" class="table table-bordered table-striped table-hover">
              <thead>
              <tr>
                <th>Date de création</th>
                <th>Type d'opération</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>CNI</th>
                <th>Montant</th>
                <th>Devise</th>
                <th>Méthode de paiement</th>
                <th></th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td>09/07/2020</td>
                <td>Mensualité</td>
                <td>Yacine</td>
                <td>Gadiagua</td>
                <td> 1234567890123</td>
                <td>250 000</td>
                <td>FCFA</td>
                <td>Orange Money</td>
                <td>  <img src="{{ url('images/Orange_Money-Logo.png') }}" alt="Logo OM" class="brand-image img-circle elevation-3" style="max-height: 40px;">
                </td>
              </tr>
              <tr>
                <td>09/07/2020</td>
                <td>Régularisation</td>
                <td>Oumar</td>
                <td>Mbodj</td>
                <td> 1234567897123</td>
                <td>150 000</td>
                <td>FCFA</td>
                <td>Free Money</td>
                <td>  <img src="{{ url('images/logo-free-money.png') }}" alt="Logo OM" class="brand-image img-circle elevation-3" style="max-height: 40px;">
                </td>
              </tr>
              <tr>
                <td>09/07/2020</td>
                <td>Paiement Facture</td>
                <td>Khady</td>
                <td>Diagne</td>
                <td> 1244567890123</td>
                <td>250 000</td>
                <td>FCFA</td>
                <td>Carte bancaire</td>
                <td>  <img src="{{ url('images/CB.png') }}" alt="Logo OM" class="brand-image img-circle elevation-3" style="max-height: 40px;">
                </td>
              </tr>
              <tr>
                <td>09/07/2020</td>
                <td>Paiement Facture</td>
                <td>Aliou</td>
                <td>Sall</td>
                <td> 1244567890723</td>
                <td>50 000</td>
                <td>FCFA</td>
                <td>Paypal</td>
                <td>  <img src="{{ url('images/logo-paypal.png') }}" alt="Logo OM" class="brand-image img-circle elevation-3" style="max-height: 40px;">
                </td>
              </tr>


              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
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
@endsection
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
<!-- DataTables -->
<script src="{{ url('dashboardAssets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('dashboardAssets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('dashboardAssets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('dashboardAssets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script>
$(document).ready(function() {
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
});
</script>
<script>
  $(function () {
    $("#clientsTable").DataTable({
      "responsive": true,
      "autoWidth": false,
      "lengthChange": true,
      "info": true,
      "ordering": true,
      language: {
          "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json"
      }

    });
  });
</script>
