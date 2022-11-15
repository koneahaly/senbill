<?php
session_start();

?>

@extends('layouts.dashboardLayout', ['social_name' => session()->get('social_name'), 'full_name' => session()->get('full_name')])
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Accueil</h1>
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
<style>
*{
  padding:0;margin:0;
}
li.inner{
  list-style:none;
}
:root {
  --w: 300;
  --speed: 5.5s;
}
.g-container {
  width: calc(--w * 1px);
  overflow: hidden;
}
ul.slide {
  display: flex;
  flex-wrap: nowrap;
   animation: move calc(var(--speed) * var(--s)) steps(var(--s)) infinite;
}
ul.slide li {
  flex-shrink: 0;
  width: 110%;
  height: 100%;
  animation: liMove calc(var(--speed)) infinite;
}
@keyframes move {
  0% {
    transform: translate(0, 0);
  }
  100% {
    transform: translate(calc(var(--s) * var(--w) * -1px), 0);
  }
}
@keyframes liMove {
  0% {
    transform: translate(0, 0);
  }
  80%,
  100%  {
    transform: translate(calc(var(--w) * -1px), 0);
  }
}
</style>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            @if($offer->libelle != 'servicepublic' AND $offer->libelle != 'Location')
            <div class="small-box bg-warning elektraGradient2">
              <div class="inner">
                <h2>{{ $pending_amount }} FCFA</h2>

                <p>En attente <a data-toggle="tooltip" data-placement="bottom" title="Ces fonds sont en attente de paiement auprès de vos clients finaux.  Les frais des partenaires ont déjà été appliqués et déduits du montant."> <i class="fas fa-info-circle iconElekRightDark"></i></a> </p>
              </div>

            <span class="small-box-footer elektraWarningGradient text-xs"> {{ $nb_pending_amount }} factures</span>
            </div>
            @endif
            @if($offer->libelle == 'servicepublic')
            <div class="small-box bg-warning elektraGradient2">
              <div class="inner">
                <h2>Demandes</h2>

                <p>En attente <a data-toggle="tooltip" data-placement="bottom" title="Ces fonds sont en attente de paiement auprès de vos clients finaux.  Les frais des partenaires ont déjà été appliqués et déduits du montant."> <i class="fas fa-info-circle iconElekRightDark"></i></a> </p>
              </div>

            <span class="small-box-footer elektraWarningGradient text-xs"> {{ $nb_pending_amount }} factures</span>
            </div>
            @endif
            @if($offer->libelle == 'Location')
              <div class="small-box bg-warning elektraGradient2">
              <div class="g-container">
                  <ul style="--s: 3" class="slide">

                  <li class="inner">
                    <h2>{{ $infos_proprio_c1 }} </h2>

                      <p> Logements déclarés <a data-toggle="tooltip" data-placement="bottom" title="Il s'agit des logements déclarés par les propriétaires de biens immobiliers ou par le biais des agences."> <i class="fas fa-info-circle iconElekRightDark"></i></a> </p>
                    </li>

                    <li class="inner">
                    <h2>{{ $infos_reports_c1 }} </h2>

                      <p> Logements signalés <a data-toggle="tooltip" data-placement="bottom" title="Il s'agit des logements signalés par les locataires ou par les services de l'Etat."> <i class="fas fa-info-circle iconElekRightDark"></i></a> </p>
                    </li>

                    <li class="inner">
                    <h2>{{ $mean_price_c1 }} </h2>
                      <p> Loyer moyen <a data-toggle="tooltip" data-placement="bottom" title="Il s'agit de la moyenne des loyers payés par les locataires pour une catégorie de logement donnée."> <i class="fas fa-info-circle iconElekRightDark"></i></a> </p>
                    </li>

                    <li class="inner">
                    <h2>{{ $infos_proprio_c1 }} </h2>

                      <p> Logements déclarés <a data-toggle="tooltip" data-placement="bottom" title="Il s'agit des logements déclarés par les propriétaires de biens immobiliers ou par le biais des agences."> <i class="fas fa-info-circle iconElekRightDark"></i></a> </p>
                    </li>

                  </ul>
                </div>
              <span class="small-box-footer elektraWarningGradient text-xs"> Catégorie A </span>
            </div>
            @endif
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            @if($offer->libelle != 'servicepublic' AND $offer->libelle != 'Location')
            <div class="small-box bg-warning elektraGradient2">
              <div class="inner">
                <h2>{{ $paid_amount }} FCFA</h2>

                <p>Payés<a data-toggle="tooltip" data-placement="bottom" title="Ces fonds ont été payés par vos clients finaux et vous ont été versés.  Les frais des partenaires ont déjà été appliqués et déduits du montant."> <i class="fas fa-info-circle iconElekRightDark"></i></a> </p>
              </div>

              <span class="small-box-footer elektraSuccess text-xs"> {{ $nb_paid_amount}} factures</span>
            </div>
            @endif
            @if($offer->libelle == 'servicepublic')
            <div class="small-box bg-warning elektraGradient2">
              <div class="inner">
                <h2>Demandes</h2>

                <p>traitées<a data-toggle="tooltip" data-placement="bottom" title="Ces fonds ont été payés par vos clients finaux et vous ont été versés.  Les frais des partenaires ont déjà été appliqués et déduits du montant."> <i class="fas fa-info-circle iconElekRightDark"></i></a> </p>
              </div>

              <span class="small-box-footer elektraSuccess text-xs"> {{ $nb_paid_amount}} factures</span>
            </div>
            @endif
            @if($offer->libelle == 'Location')
            <div class="small-box bg-warning elektraGradient2">
            <div class="g-container">
                  <ul style="--s: 3" class="slide">

                  <li class="inner">
                    <h2>{{ $infos_proprio_c2 }} </h2>

                      <p> Logements déclarés <a data-toggle="tooltip" data-placement="bottom" title="Il s'agit des logements déclarés par les propriétaires de biens immobiliers ou par le biais des agences."> <i class="fas fa-info-circle iconElekRightDark"></i></a> </p>
                    </li>

                    <li class="inner">
                    <h2>{{ $infos_reports_c2 }} </h2>

                      <p> Logements signalés <a data-toggle="tooltip" data-placement="bottom" title="Il s'agit des logements signalés par les locataires ou par les services de l'Etat."> <i class="fas fa-info-circle iconElekRightDark"></i></a> </p>
                    </li>

                    <li class="inner">
                    <h2>{{ $mean_price_c2 }} </h2>
                      <p> Loyer moyen <a data-toggle="tooltip" data-placement="bottom" title="Il s'agit de la moyenne des loyers payés par les locataires pour une catégorie de logement donnée."> <i class="fas fa-info-circle iconElekRightDark"></i></a> </p>
                    </li>

                    <li class="inner">
                    <h2>{{ $infos_proprio_c2 }} </h2>

                      <p> Logements déclarés <a data-toggle="tooltip" data-placement="bottom" title="Il s'agit des logements déclarés par les propriétaires de biens immobiliers ou par le biais des agences."> <i class="fas fa-info-circle iconElekRightDark"></i></a> </p>
                    </li>

                  </ul>
                </div>

            <span class="small-box-footer elektraSuccess text-xs"> Catégorie B,C </span>
            </div>
            @endif
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            @if($offer->libelle != 'servicepublic' AND $offer->libelle != 'Location')
            <div class="small-box bg-warning elektraGradient2">
              <div class="inner">
                <h2>{{ $unpaid_amount }} FCFA</h2>

                <p> Impayées<a data-toggle="tooltip" data-placement="bottom" title="Ces factures n'ont pas été payés par vos clients finaux et les dates d'échéance des factures sont dépassées. Les frais des partenaires ont déjà été appliqués et déduits du montant."> <i class="fas fa-info-circle iconElekRightDark"></i></a> </p>
              </div>
              <span class="small-box-footer elektraError text-xs"> {{ $nb_unpaid_amount }} factures </span>
            </div>
            @endif
            @if($offer->libelle == 'servicepublic')
            <div class="small-box bg-warning elektraGradient2">
              <div class="inner">
                <h2>Demandes</h2>

                <p> En attente de paiement<a data-toggle="tooltip" data-placement="bottom" title="Ces factures n'ont pas été payés par vos clients finaux et les dates d'échéance des factures sont dépassées. Les frais des partenaires ont déjà été appliqués et déduits du montant."> <i class="fas fa-info-circle iconElekRightDark"></i></a> </p>
              </div>
              <span class="small-box-footer elektraError text-xs"> {{ $nb_unpaid_amount }} factures </span>
            </div>
            @endif
            @if($offer->libelle == 'Location')
            <div class="small-box bg-warning elektraGradient2">
            <div class="g-container">
                  <ul style="--s: 3" class="slide">

                    <li class="inner">
                    <h2>{{ $infos_proprio_c3 }} </h2>

                      <p> Logements déclarés <a data-toggle="tooltip" data-placement="bottom" title="Il s'agit des logements déclarés par les propriétaires de biens immobiliers ou par le biais des agences."> <i class="fas fa-info-circle iconElekRightDark"></i></a> </p>
                    </li>

                    <li class="inner">
                    <h2>{{ $infos_reports_c3 }} </h2>

                      <p> Logements signalés <a data-toggle="tooltip" data-placement="bottom" title="Il s'agit des logements signalés par les locataires ou par les services de l'Etat."> <i class="fas fa-info-circle iconElekRightDark"></i></a> </p>
                    </li>

                    <li class="inner">
                    <h2>{{ $mean_price_c3 }} </h2>
                      <p> Loyer moyen <a data-toggle="tooltip" data-placement="bottom" title="Il s'agit de la moyenne des loyers payés par les locataires pour une catégorie de logement donnée."> <i class="fas fa-info-circle iconElekRightDark"></i></a> </p>
                    </li>

                    <li class="inner">
                    <h2>{{ $infos_proprio_c3 }} </h2>

                      <p> Logements déclarés <a data-toggle="tooltip" data-placement="bottom" title="Il s'agit des logements déclarés par les propriétaires de biens immobiliers ou par le biais des agences."> <i class="fas fa-info-circle iconElekRightDark"></i></a> </p>
                    </li>

                  </ul>
                </div>

            <span class="small-box-footer elektraError text-xs"> Catégorie D,E,F,G </span>
            </div>
            @endif
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            @if($offer->libelle != 'servicepublic' AND $offer->libelle != 'Location')
            <div class="small-box bg-warning elektraGradient2">
              <div class="inner">
                <h2>{{ $nb_contacts }}</h2>

                <p>Utilisateurs inscrits</p>
              </div>
              <span class="small-box-footer elektraInfo text-xs hideUsers"> utilisateurs inscrits  </span>
            </div>
            @endif
            @if($offer->libelle == 'servicepublic')
            <div class="small-box bg-warning elektraGradient2">
              <div class="inner">
                <h2>{{ $nb_contacts }}</h2>

                <p>Demandeurs </p>
              </div>
              <span class="small-box-footer elektraInfo text-xs hideUsers"> utilisateurs inscrits  </span>
            </div>
            @endif
            @if($offer->libelle == 'Location')
            <div class="small-box bg-warning elektraGradient2">
            <div class="g-container">
              <ul style="--s: 2" class="slide">
                <li class="inner">
                  <h2>{{ $nb_contacts_proprio }}</h2>

                  <p>Propriétaires</p>
                </li>
                <li class="inner">
                  <h2>{{ $nb_contacts_loc }}</h2>

                  <p>Locataires</p>
                </li>
                <li class="inner">
                  <h2>{{ $nb_contacts_proprio }}</h2>

                  <p>Propriétaires</p>
                </li>
              </ul>
            </div>
              <span class="small-box-footer elektraInfo text-xs hideUsers"> utilisateurs inscrits  </span>
            </div>
            @endif
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
                @if($offer->libelle != 'servicepublic' AND $offer->libelle != 'Location')
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Paiements
                </h3>
                @endif
                @if($offer->libelle == 'servicepublic')
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Demandes
                </h3>
                @endif
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
            <?php
              $sum_nb_payments = $nb_paid_om+$nb_paid_cb+$nb_paid_fc+$nb_paid_wz;
            ?>
            <!-- TO DO List -->
            @if($offer->libelle != 'servicepublic' AND $offer->libelle != 'Location')
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
                            <div class="progress-bar progress-bar-danger elektraOM" style="width: {{ ($sum_nb_payments > 0) ? $nb_paid_om*100/$sum_nb_payments : 0 }}%"></div>
                          </div>
                        </td>
                        <td><span class="badge bg-danger elektraOM">{{ ($sum_nb_payments > 0) ? $nb_paid_om*100/$sum_nb_payments : 0 }}%</span></td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Free Cash</td>
                        <td>
                          <div class="progress progress-xs">
                            <div class="progress-bar bg-warning elektraFree" style="width: {{ ($sum_nb_payments > 0) ? $nb_paid_fc*100/$sum_nb_payments : 0 }}%"></div>
                          </div>
                        </td>
                        <td><span class="badge bg-warning elektraFree">{{ ($sum_nb_payments > 0) ? $nb_paid_fc*100/$sum_nb_payments : 0 }}%</span></td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Carte bancaire</td>
                        <td>
                          <div class="progress progress-xs progress-striped active">
                            <div class="progress-bar bg-primary elektraCB" style="width: {{ ($sum_nb_payments > 0) ? $nb_paid_cb*100/$sum_nb_payments : 0}}%"></div>
                          </div>
                        </td>
                        <td><span class="badge bg-primary elektraCB">{{ ($sum_nb_payments > 0) ? $nb_paid_cb*100/$sum_nb_payments : 0}}%</span></td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Wizall</td>
                        <td>
                          <div class="progress progress-xs progress-striped active">
                            <div class="progress-bar bg-success elektraPaypal" style="width: {{ ($sum_nb_payments > 0) ? $nb_paid_wz*100/$sum_nb_payments : 0 }}%"></div>
                          </div>
                        </td>
                        <td><span class="badge bg-success elektraPaypal">{{ ($sum_nb_payments > 0) ? $nb_paid_wz*100/$sum_nb_payments : 0 }}%</span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
            <!-- /.card -->
            @endif

             <!-- TO DO List -->
             @if($offer->libelle == 'Location')
            <div class="card">
                <div class="card-header">

                  <h3 class="card-title">
                    <i class="fa fa-check-square mr-1" aria-hidden="true"></i>
                    Loyer moyen des locataires</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th style="width: 10px"></th>
                        <th>Type de logement</th>
                        <th>Montant</th>
                        <th style="width: 40px"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1.</td>
                        <td>Catégorie A</td>
                        <td>
                          <div class="progress progress-xs">
                            <div class="progress-bar progress-bar-danger elektraOM" style="width: {{ ($mean_price_c1 > 0) ? $mean_price_c1*100/150000 : 0 }}%"></div>
                          </div>
                        </td>
                        <td><span class="badge bg-danger elektraOM">{{ ($mean_price_c1 > 0) ? $mean_price_c1 : 0 }} FCFA</span></td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Catégorie B,C</td>
                        <td>
                          <div class="progress progress-xs">
                            <div class="progress-bar bg-warning elektraFree" style="width: {{ ($mean_price_c2 > 0) ? $mean_price_c2*100/500000 : 0 }}%"></div>
                          </div>
                        </td>
                        <td><span class="badge bg-warning elektraFree">{{ ($mean_price_c2 > 0) ? $mean_price_c2 : 0 }} FCFA</span></td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Catégorie D,E,F,G</td>
                        <td>
                          <div class="progress progress-xs progress-striped active">
                            <div class="progress-bar bg-primary elektraCB" style="width: {{ ($mean_price_c3 > 0) ? $mean_price_c3*100/5000000 : 0}}%"></div>
                          </div>
                        </td>
                        <td><span class="badge bg-primary elektraCB">{{ ($mean_price_c3 > 0) ? $mean_price_c3 : 0 }} FCFA</span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
            <!-- /.card -->
            @endif
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">

            <!-- Map card -->
            <div class="card bg-gradient-primary">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  Vos clients Senbill
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
<script src="{{ url('dashboardAssets/plugins/jqvmap/maps/jquery.vmap.senegal.js') }}"></script>
<script src="{{ url('dashboardAssets/plugins/jqvmap/maps/jquery.vmap.france.js') }}"></script>


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
