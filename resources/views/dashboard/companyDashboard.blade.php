@extends('layouts.dashboardLayout', ['social_name' => session()->get('social_name'), 'full_name' => session()->get('full_name')])
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Paramètres généraux</h1>
        </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">Paramètres</li>
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
          <!-- /.col -->
          <div class="col">
            <div class="card ">
              <div class="card-header elektraGradient">
                <h3 class="card-title">Informations sur la société</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                  <div class="row">
                  <div class="col-6">
                    <label for="" class="label">Société</label>
                    <input type="text" class="form-control" placeholder="prénom" value="Benana Salon" disabled>
                  </div>
                  <div class="col-6">
                    <label for="" class="label">Adresse</label>
                    <input type="text" class="form-control" placeholder="nom" value="Hann Maristes 2 Villa Y46" disabled>
                  </div>
                </div>
                <div class="row">
                <div class="col-6">
                  <label for="" class="label">Type de société</label>
                  <input type="text" class="form-control" placeholder="prénom" value="SARL" disabled>
                </div>
                <div class="col-6">
                  <label for="" class="label">Pays</label>
                  <input type="text" class="form-control" placeholder="nom" value="Sénégal" disabled>
                </div>
              </div>
              <div class="row">
              <div class="col-6">
                <label for="" class="label">SIREN</label>
                <input type="text" class="form-control" placeholder="prénom" value="123456789098765432" disabled>
              </div>

            </div>
                <div class="row">
                  <div class="col-4">
                    <label for="" class="label">Type d'offre</label>
                    <input type="text" class="form-control" placeholder="prénom" value="Elektra Standard" disabled>
                </div>
                </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn elektraBlue">Nous contacter pour une modification</button>
                </div>
              </form>
            </div>
            <div class="card ">
              <div class="card-header elektraGradient">
                <h3 class="card-title">Informations sur le compte de versement</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                  <div class="row">
                  <div class="col-6">
                    <label for="" class="label">Prénom détenteur</label>
                    <input type="text" class="form-control" placeholder="prénom" value="Yacine" disabled>
                  </div>
                  <div class="col-6">
                    <label for="" class="label">Nom détenteur</label>
                    <input type="text" class="form-control" placeholder="nom" value="Koné" disabled>
                  </div>
                </div>
                <div class="row">
                <div class="col-6">
                  <label for="" class="label">Type de compte</label>
                  <input type="text" class="form-control" placeholder="prénom" value="Orange Money" disabled>
                </div>
                <div class="col-6">
                  <label for="" class="label">Numéro de compte</label>
                  <input type="text" class="form-control" placeholder="nom" value="773228879" disabled>
                </div>
              </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn elektraBlue">Nous contacter pour une modification</button>
                </div>
              </form>
            </div>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Demander une facture</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <p>Sélectionnez un ou plusieurs mois et nous vous enverrons par email la facture du montant versé dans votre compte pour les mois selectionnés.</p>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label>Facture mois</label>
                    <select class="select2bs4" multiple="multiple" data-placeholder="Selectionnez mois"
                            style="width: 100%;">
                      <option>Janvier</option>
                      <option>Février</option>
                      <option>Mars</option>
                      <option>Avril</option>
                      <option>Mai</option>
                      <option>Juin</option>
                      <option>Juillet</option>
                      <option>Août</option>
                      <option>Septembre</option>
                      <option>Octobre</option>
                      <option>Novembre</option>
                      <option>Décembre</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn elektraBlue">Faire une demande</button>
            </div>
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
<!-- Bootstrap 4 -->
<script src="{{ url('dashboardAssets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ url('dashboardAssets/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('dashboardAssets/dist/js/adminlte.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ url('dashboardAssets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>


<script>
$(document).ready(function() {
  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  })
});


</script>
</body>
</html>
