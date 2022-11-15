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
          <h1 class="m-0 text-dark">{{ (session()->get('service_id') == 6) ? 'Demandes' : 'Factures'}}</h1>
        </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">{{ (session()->get('service_id') == 6) ? 'Demandes' : 'Factures'}}</li>
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
            <h3 class="card-title">{{ (session()->get('service_id') == 6) ? 'Suivi des demandes' : 'Suivi des factures'}}</h3> <br />
            <?php
              if(strpos($_SERVER['REQUEST_URI'],"factures") == true && strpos($_SERVER['REQUEST_URI'],"declined") !== true && strpos($_SERVER['REQUEST_URI'],"finished") !== true){
                $sub_title = 'Les demandes de vos clients en attente de paiements.';
            }
            if(strpos($_SERVER['REQUEST_URI'],"factures") !== true && strpos($_SERVER['REQUEST_URI'],"declined") == true && strpos($_SERVER['REQUEST_URI'],"finished") !== true){
              $sub_title = 'Les demandes de vos clients ayant été déclinées ou annulées.';
            }
            if(strpos($_SERVER['REQUEST_URI'],"factures") !== true && strpos($_SERVER['REQUEST_URI'],"declined") !== true && strpos($_SERVER['REQUEST_URI'],"finished") == true){
              $sub_title = 'Les demandes de vos clients ayant été finalisées avec succès.';
            }
            ?>
            <p> {{ $sub_title }} </p>
          </div>
          <!-- /.card-header -->
          <?php $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre']; ?>
          <div class="card-body">
            <table id="clientsTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th></th>
                @if(session()->get('service_id') == 6)
                  <th>ID</th>
                @endif
                <th>Numéro Identification Nationale</th>
                <th>Prénom(s)</th>
                <th>Nom</th>
                <th>Facture</th>
                <th>Montant</th>
                @if(session()->get('service_id') == 6)
                  <th>Actions</th>
                @endif
                <th>Statut</th>
              </tr>
              </thead>
              <tbody>
                @foreach($infos_factures as $infos_facture)
                  <tr>

                  @if(session()->get('service_id') == 6)
                    <?php
                      if($infos_facture->demands_status == "A"){
                        $color = '#337DFF';
                        $status = 'en cours';
                      }
                      if($infos_facture->demands_status == "P"){
                        $color = '#FFE333';
                        $status = 'en attente';
                      }
                      if($infos_facture->demands_status == "D"){
                        $color = 'red';
                        $status = 'annulée';
                      }
                      if($infos_facture->demands_status == "T"){
                        $color = 'forestgreen';
                        $status = 'finalisée';
                      }
                    ?>
                    <td style="vertical-align: middle;text-align:center;"><i class="fas fa-dice-one fa-1x" style="color: {{$color}};" ></i>
                    <td>{{ $infos_facture->request_id }}</td>
                    <td>{{ $infos_facture->customer_id}}</td>
                    <td>{{ $infos_facture->first_name}}
                    </td>
                    <td>{{ $infos_facture->last_name}}</td>
                    <td> Frais de {{ $infos_facture->sp_label }} </td>
                    <td> 220 </td>
                    <td><button href="#modal-lg" data-toggle="modal" data-target="#modal_{{$infos_facture->demands_id}}" class="btn btn-xs btn-primary"> Visualisez</button></td>
                    <div class="modal fade" id="modal_{{$infos_facture->demands_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">{{ $infos_facture->sp_label }} n° {{ $infos_facture->demands_id }}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <h6> <u> Les informations personnelles du demandeur </u> </h6>
                          <br />
                            <div class="row">
                              <div class="col-md-6" style="margin-bottom:10px">
                                <p><strong>CIVILITE</strong></p>
                                <span class="recapData">Mr</span>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6" style="margin-bottom:10px">
                                <p><strong>PRENOM</strong></p>
                                <span class="recapData">{{ $infos_facture->first_name }}</span>
                              </div>

                              <div class="col-md-6" style="margin-bottom:10px">
                                <p><strong>NOM</strong></p>
                                <span class="recapData">{{ $infos_facture->last_name }}</span>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-6" style="margin-bottom:10px">
                                <p><strong>DATE DE NAISSANCE</strong></p>
                                <span class="recapData">{{$infos_facture->dob}}</span>
                              </div>

                              <div class="col-md-6" style="margin-bottom:10px">
                                <p><strong>LIEU DE NAISSANCE</strong></p>
                                <span class="recapData">{{$infos_facture->pob}}</span>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-6" style="margin-bottom:10px">
                                <p><strong>CNI</strong></p>
                                <span class="recapData">{{$infos_facture->customer_id}}</span>
                              </div>

                              <div class="col-md-6" style="margin-bottom:10px">
                                <p><strong>DOMICILE</strong></p>
                                <span class="recapData">{{$infos_facture->physical_address}}</span>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6" style="margin-bottom:10px">
                                <p><strong>TELEPHONE</strong></p>
                                <span class="recapData">{{$infos_facture->phone}}</span>
                              </div>

                              <div class="col-md-6" style="margin-bottom:10px">
                                <p><strong>ADRESSE MAIL</strong></p>
                                <span class="recapData">{{$infos_facture->email}}</span>
                              </div>
                            </div>
                            <br />

                            <h6> <u> Les informations complémentaires à la demande </u> </h6>
                            <br />
                            <div class="row">
                              <div class="col-md-6" style="margin-bottom:10px">
                                <p><strong>NOM DU PERE</strong></p>
                                <span class="recapData">{{$infos_facture->father_last_name}}</span>
                              </div>

                              <div class="col-md-6" style="margin-bottom:10px">
                                <p><strong>PRENOM DU PERE</strong></p>
                                <span class="recapData">{{$infos_facture->father_first_name}}</span>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-6" style="margin-bottom:10px">
                                <p><strong>NOM DE LA MERE</strong></p>
                                <span class="recapData">{{$infos_facture->mother_last_name}}</span>
                              </div>

                              <div class="col-md-6" style="margin-bottom:10px">
                                <p><strong>PRENOM DE LA MERE</strong></p>
                                <span class="recapData">{{$infos_facture->mother_first_name}}</span>
                              </div>
                            </div>
                            <br />

                            <h6> <u> Les pièces jointes associées à la demande </u> </h6>
                            <br />
                            <ul>
                              @foreach($pjs as $pj)
                                @foreach($pj as $j)
                                  @if($j->request_id == $infos_facture->demands_id)
                                    <li>
                                      <a href="{{ $j->pj_link }}">{{ $j->pj_name }}</a>&nbsp;
                                      <a href="{{ $j->pj_link }}" target='_blank' download><i class="fas fa-download"></i> </a>
                                      
                                    </li>
                                  @endif
                                @endforeach
                              @endforeach
                            </ul>
                            <br />
                        </div>
                        <div class="modal-footer">
                        @if(in_array($infos_facture->demands_status, ['A','P']))
                        <form method="POST" action="<?php echo e(route('bills.dashboard')); ?>">
                          <?php echo e(csrf_field()); ?>
                            <input type="hidden" name = "id_demand_to_treat" value = "{{ $infos_facture->demands_id }}" />
                            <input type="hidden" name = "requester_id" value = "{{ $infos_facture->customer_id }}" />
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button href="#modal-lg" data-toggle="modal" type="button" data-target="#modal_decline" name ="action" value= "{{ ($infos_facture->demands_status == 'A') ? 'Decline' : 'Cancel' }}" class="btn btn-danger">{{ ($infos_facture->demands_status == 'A') ? 'Décliner' : 'Annuler' }}</button>
                            <button href="#modal-lg" data-toggle="modal" type="button" data-target="#modal_accept" name ="action" value= "{{ ($infos_facture->demands_status == 'A') ? 'Accept' : 'Validate' }}" class="btn btn-success">{{ ($infos_facture->demands_status == 'A') ? 'Accepter' : 'Valider' }}</button>
                          </form>
                        @endif
                        </div>
                      </div>
                    </div>
                  </div>
                    <td>{{ $status }}</td>
                    </td>
                    @endif

                    @if(session()->get('service_id') != 6)
                    <td style="vertical-align: middle;text-align:center;"><i class="fas fa-dice-one fa-1x" <?php if($infos_facture->payment_status == "Payée") echo 'style="color: forestgreen;"'; else{ echo 'style="color: red;"';} ?> ></i>
                    <td>{{ $infos_facture->customerId}}</td>
                    <td>{{ $infos_facture->first_name}}
                    </td>
                    <td>{{ $infos_facture->last_name}}</td>
                    <?php
                      $creation_date = explode("-",$infos_facture->deadline);
                     ?>
                    <td> Facture du mois de {{ $months[(int)$creation_date[1] - 1] }} {{ $creation_date[0]}}</td>
                    <td> Frais de {{ $infos_facture->paid_amount }} </td>
                    <td>{{ $infos_facture->payment_status}}</td>
                    </td>
                    @endif
                    <div class="modal fade" id="modal_decline" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ $infos_facture->sp_label }} n° {{ $infos_facture->demands_id }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form method="POST" action="<?php echo e(route('bills.dashboard')); ?>">
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
                            <input type="hidden" name = "id_demand_to_treat" value = "{{ $infos_facture->demands_id }}" />
                            <input type="hidden" name = "requester_id" value = "{{ $infos_facture->customer_id }}" />
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
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ $infos_facture->sp_label }} n° {{ $infos_facture->demands_id }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form method="POST" action="<?php echo e(route('bills.dashboard')); ?>">
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
                            <input type="hidden" name = "id_demand_to_treat" value = "{{ $infos_facture->demands_id }}" />
                            <input type="hidden" name = "requester_id" value = "{{ $infos_facture->customer_id }}" />
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="submit" name ="action" value = "Validate" class="btn btn-success">Confirmer</button>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
                  </tr>
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
