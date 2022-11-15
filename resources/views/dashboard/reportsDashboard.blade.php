@extends('layouts.dashboardLayout', ['social_name' => session()->get('social_name'), 'full_name' => session()->get('full_name')])
@section('content')
<!-- Content Wrapper. Contains page content -->

<style>
h6{
        text-align: center;
    }
</style>

@if(session('message'))
<input  type='hidden' class="mess" value="{{ session('message') }}">
<script>
 $(document).ready(function() {
  var  mess= $('.mess').val();
  showAddPropertyNotif(mess);
  });
 </script>
@endif

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"> Signalements </h1>
        </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active"> Signalements </li>
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
            <h3 class="card-title"> Suivi des signalements </h3> <br />

            <p> Les réclamations des locataires </p>
          </div>
          <!-- /.card-header -->
          <?php $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre']; ?>
          <div class="card-body">
            <table id="clientsTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th></th>
                <th>ID</th>
                <th>Date de la réclamation</th>
                <th>Ville</th>
                <th>Adresse</th>
                <th>Caution</th>
                <th>Loyer</th>
                <th>Statut</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>
              <?php $nb = 1; ?>
                @foreach($infos_reports as $infos_report)
                  <tr>

                    <td style="vertical-align: middle;text-align:center;"><i class="fas fa-dice-one fa-1x" style="color: red;" ></i>
                    <td>{{ $nb }}</td>
                    <td>{{ $infos_report->created_at}}</td>
                    <td>{{ $infos_report->city}}
                    </td>
                    <td>{{ $infos_report->address}}</td>
                    <td>{{ $infos_report->caution}}</td>
                    <td> Frais de {{ $infos_report->monthly_pm }} </td>
                    <td>{{ $infos_report->status }}</td>
                    <td><button href="#modal-lg" data-toggle="modal" data-target="#modal_{{$infos_report->id}}" class="btn btn-xs btn-primary"> Visualisez</button></td>
                    <div class="modal fade" id="modal_{{$infos_report->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Signalement n° {{ $infos_report->id }}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <h6> <u> Les informations personnelles du signaleur </u> </h6>
                          <br />
                            <div class="row">
                              <div class="col-md-6" style="margin-bottom:10px">
                                <p><strong>CIVILITE</strong></p>
                                <span class="recapData">Mr</span>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6" style="margin-bottom:10px">
                                <p><strong>NOM COMPLET</strong></p>
                                <span class="recapData">{{ $infos_report->current_occupant_name }}</span>
                              </div>

                              <div class="col-md-6" style="margin-bottom:10px">
                                <p><strong>DOMICILE</strong></p>
                                <span class="recapData">{{$infos_report->address}}</span>
                              </div>

                            </div>

                            <div class="row">
                              <div class="col-md-6" style="margin-bottom:10px">
                                <p><strong>TELEPHONE</strong></p>
                                <span class="recapData">{{$infos_report->current_occupant_phone}}</span>
                              </div>

                              <div class="col-md-6" style="margin-bottom:10px">
                                <p><strong>ADRESSE MAIL</strong></p>
                                <span class="recapData">{{$infos_report->current_occupant_email}}</span>
                              </div>
                            </div>
                            <br />

                            <h6> <u> Les informations complémentaires à la demande </u> </h6>
                            <br />
                            <div class="row">
                              <div class="col-md-6" style="margin-bottom:10px">
                                <p><strong>NOM COMPLET DU PROPRIO </strong></p>
                                <span class="recapData">{{$infos_report->owner_name}}</span>
                              </div>

                              <div class="col-md-6" style="margin-bottom:10px">
                                <p><strong>TELEPHONE DU PROPRIO</strong></p>
                                <span class="recapData">{{$infos_report->owner_phone}}</span>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-6" style="margin-bottom:10px">
                                <p><strong>SURFACE DU LOGEMENT</strong></p>
                                <span class="recapData">{{$infos_report->surface }} m2</span>
                              </div>

                              <div class="col-md-6" style="margin-bottom:10px">
                                <p><strong>TYPE DE LOGEMENT </strong></p>
                                <span class="recapData">{{$infos_report->nb_rooms}}</span>
                              </div>
                            </div>
                            <br />


                        </div>
                        <div class="modal-footer">
                        <form method="POST" action="<?php echo e(route('reports.dashboard')); ?>">
                          <?php echo e(csrf_field()); ?>
                            <input type="hidden" name = "id_demand_to_treat" value = "{{ $infos_report->id }}" />
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button href="#modal-lg" data-toggle="modal" type="button" data-target="#modal_decline" name ="action" value= "{{ ($infos_report->status == 'A') ? 'Decline' : 'Cancel' }}" class="btn btn-danger">{{ ($infos_report->status == 'A') ? 'Décliner' : 'Annuler' }}</button>
                            <button href="#modal-lg" data-toggle="modal" type="button" data-target="#modal_accept" name ="action" value= "{{ ($infos_report->status == 'A') ? 'Accept' : 'Validate' }}" class="btn btn-success">{{ ($infos_report->status == 'A') ? 'Accepter' : 'Valider' }}</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                    </td>
            


                    <div class="modal fade" id="modal_decline" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Signalement n° {{ $nb }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form method="POST" action="<?php echo e(route('reports.dashboard')); ?>">
                          <?php echo e(csrf_field()); ?>
                          <div class="modal-body">
                            <h6> <u> Motif d'annulation </u> </h6>
                            <br />
                              
                            <div class="form-group">
                              <label for="exampleFormControlTextarea1">Commentaires</label>
                              <textarea class="form-control" name="comments" id="exampleFormControlTextarea1" rows="5"></textarea>
                            </div>

                          </div>
                          <div class="modal-footer">
                            <input type="hidden" name = "id_demand_to_treat" value = "{{ $infos_report->id }}" />
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="submit" name ="action" value = "Cancel" class="btn btn-success">Confirmer</button>
                          </div>
                      </form>
                    </div>
                </div>
              </div>

                <div class="modal fade" id="modal_accept" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Signalement n° {{ $nb }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form method="POST" action="<?php echo e(route('reports.dashboard')); ?>">
                          <?php echo e(csrf_field()); ?>
                          <div class="modal-body">
                            <h6> <u> Plus de détails </u> </h6>
                            <br />
                              
                            <div class="form-group">
                              <label for="exampleFormControlTextarea1">Commentaires</label>
                              <textarea class="form-control" name="comments" id="exampleFormControlTextarea1" rows="5"></textarea>
                            </div>

                          </div>
                          <div class="modal-footer">
                            <input type="hidden" name = "id_demand_to_treat" value = "{{ $infos_report->id }}" />
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="submit" name ="action" value = "Validate" class="btn btn-success">Confirmer</button>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
                  </tr>
                  <?php $nb++; ?>
              @endforeach


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
    <strong>Copyright &copy; 2020 <a href="">Senbill-S2SN </a>.</strong>
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

  function showAddPropertyNotif(message) {
         $('.content').notify(message, {
           // whether to hide the notification on click
          clickToHide: true,
          // whether to auto-hide the notification
          autoHide: true,
          // if autoHide, hide after milliseconds
          autoHideDelay: 10000,
          // show the arrow pointing at the element
          arrowShow: true,
          // arrow size in pixels
          arrowSize: 5,
          // position defines the notification position though uses the defaults below
          position: 'top',
          // default positions
          elementPosition: 'top left',
          globalPosition: 'top left',
          // default style
          style: 'bootstrap',
          // default class (string or [string])
          className: 'success',
          // show animation
          showAnimation: 'slideDown',
          // show animation duration
          showDuration: 400,
          // hide animation
          hideAnimation: 'slideUp',
          // hide animation duration
          hideDuration: 200,
          // padding between element and notification
          gap: -2,
          });
       }
</script>
