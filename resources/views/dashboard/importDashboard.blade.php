@extends('layouts.dashboardLayout', ['social_name' => session()->get('social_name'), 'full_name' => session()->get('full_name')])
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Importations</h1>
        </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">Importations</li>
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
            <div class="row">
              <div class="col-6">
                <h3 class="card-title">Toutes les importations</h3> <br/>
              </div>
              <div class="col-4">
                <div class="btn-group" style="float: right;">
                        <button type="button" class="btn btn-success dropdown-toggle toggleElek" data-toggle="dropdown" aria-expanded="false">Importer &nbsp</button>
                          <span class="sr-only">Dérouler menu</span>
                          <div class="dropdown-menu" role="menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: -130px; transform: translate3d(-1px, 37px, 0px);">
                            <a class="dropdown-item" href="#modal-lg"  data-toggle="modal" data-target="#modal-lg">Importer des clients</a>
                            <a class="dropdown-item" href="#modal-lg" data-toggle="modal" data-target="#modal-lg">Importer des factures</a>
                          </div>
                </div>
                <div class="col-2">
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="importTable" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Date de création</th>
                <th>Type d'importation</th>
                <th>Identification</th>
                <th>Statut</th>
                <th></th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td>08/07/2020</td>
                <td>Client</td>
                <td>CLI00345X2400</td>
                <td>Invalide</td>
                <td style="vertical-align: middle;text-align:center;"><i class="fas fa-dice-one fa-1x" style="color: red;" ></i>
              </tr>
              <tr>
                <td>09/07/2020</td>
                <td>Client</td>
                <td>CLI0034543R00</td>
                <td>Valide</td>
                <td style="vertical-align: middle;text-align:center;"><i class="fas fa-dice-one fa-1x" style="color: forestgreen;" ></i>
              </tr>
              <tr>
                <td>09/07/2020</td>
                <td>Facture</td>
                <td>FAC0034800U00</td>
                <td>Valide</td>
                <td style="vertical-align: middle;text-align:center;"><i class="fas fa-dice-one fa-1x" style="color: forestgreen;" ></i>
              </tr>
            </tbody>
            </table>
          </div>
          <!-- /.card-body -->

        </div>
        <!-- /.card -->

      </div><!-- /.container-fluid -->
      <!-- /.modal -->

      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Large Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
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

<!-- daterangepicker -->
<script src="{{ url('dashboardAssets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ url('dashboardAssets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Summernote -->
<script src="{{ url('dashboardAssets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ url('dashboardAssets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('dashboardAssets/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ url('dashboardAssets/dist/js/pages/dashboard.js') }}"></script>

<!-- DataTables -->
<script src="{{ url('dashboardAssets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('dashboardAssets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('dashboardAssets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('dashboardAssets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script>
  $(function () {
    $("#importTable").DataTable({
      "responsive": true,
      "autoWidth": false,
      "lengthChange": true,
      "info": false,
      "ordering": true,
      language: {
          "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json"
      }

    });
  });
</script>
