@extends('layouts.dashboardLayout', ['social_name' => session()->get('social_name'), 'full_name' => session()->get('full_name')])
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Paramètres utilisateur</h1>
        </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">Profil</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ url('dashboardAssets/dist/img/yassnana.jpg') }}"
                       alt="Photo de profil">
                </div>

                <h3 class="profile-username text-center">Yacine Ndiaye</h3>

                <p class="text-muted text-center">Software Engineer</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header elektraGradient">

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fa fa-calendar mr-1"></i> Dernière connexion</strong>

                <p class="text-muted">
                  le 11/07/2020
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Localisation</strong>

                <p class="text-muted">Dakar, Sénégal</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card ">
              <div class="card-header elektraGradient">
                <h3 class="card-title">Informations personnelles</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="" class="label">Adresse email</label>
                    <input type="text" class="form-control" placeholder="prénom" value="{{ $infos_company->email }}" disabled>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn elektraBlue">Demander une modification</button>
                </div>
              </form>
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Changer de mot de passe</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="{{ route('profile.dashboard.change_password')}}">
                <?php echo e(csrf_field()); ?>
                @if(session('message'))
                 <div class="alert alert-danger">
                        <p>{{ session('message') }}</p>
                  </div>
                @endif
                <div class="card-body">
                  <div class="row">
                  <div class="col-3">
                  </div>
                  <div class="col-9">
                    <label for="" class="label required">Mot de passe actuel</label>
                    <input type="text" name="current_password" class="form-control" placeholder="mot de passe actuel">
                    <label for="" class="label required" data-toggle="tooltip" data-placement="left" title="Choisissez un nouveau mot de passe ici. Pour garantir la sécurité de votre compte, choisissez un mot passe de 12 chiffres avec des caractètres alphanumériques.">Nouveau mot de passe</label>
                    <input type="text" name="new_password" class="form-control" placeholder="nouveau mot de passe">
                  </div>
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn elektraBlue">Enregistrer les modifications</button>
                </div>
                  <input type="hidden" name="email" value="{{ $infos_company->email}}" />
              </form>
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Notifications</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                  <div class="row">
                  <div class="col-6">
                    <p>Vous pouvez choisir les notifications que vous souhaitez activer ou désactiver ici. Ces notifications vous informent details
                    activités liées à votre compte et clients</p>
                  </div>
                  <div class="col-6">
                    <div class="callout callout-info">
                    <div class="row">
                      <div class="col-6">
                        <h5 style="display: inline-flex;">Nouveaux clients</h5>
                      </div>
                      <div class="col-6">
                        <input type="checkbox" name="clients-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success" class="float-right">
                      </div>
                    </div>
                  <p>Recevez une notification lorsqu'un de vos clients s'inscrit sur Elektra</p>
                </div>
                <div class="callout callout-info">
                  <div class="row">
                    <div class="col-6">
                      <h5 style="display: inline-flex;">Paiements</h5>
                    </div>
                    <div class="col-6">
                      <input type="checkbox" name="payments-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success" class="float-right">
                        </div>
                      </div>
                  <p>Recevez une notification lorsqu'un de vos clients paie une facture</p>
                </div>
                  </div>
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn elektraBlue">Enregistrer les modifications</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.col -->

        </div>
        <!-- /.row -->
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
<!-- Bootstrap 4 -->
<script src="{{ url('dashboardAssets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('dashboardAssets/dist/js/adminlte.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ url('dashboardAssets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>


<script>
$(document).ready(function() {
  $(function () {
    $('[data-toggle="tooltip"]').tooltip('show')
  })

  $("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  });
});


</script>
</body>
</html>
