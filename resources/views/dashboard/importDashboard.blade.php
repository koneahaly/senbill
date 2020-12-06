<?php $__env->startSection('content'); ?>

<?php
if(isset($_GET['data_contacts'])){
  $data_contacts = $_GET['data_contacts'];
}
if(isset($_GET['data_invoices'])){
  $data_invoices = $_GET['data_invoices'];
}
 ?>
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
                            <a class="dropdown-item imp_contacts" href="#modal-lg"  data-toggle="modal" data-target="#modal-clients">Importer des clients</a>
                            <a class="dropdown-item imp_invoices" href="#modal-lg" data-toggle="modal" data-target="#modal-factures">Importer des factures</a>
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
              @foreach($infos_imports as $infos_import)
              <tr>
                <td>{{ $infos_import->created_at }}</td>
                <td>{{ $infos_import->import_type }}</td>
                <td>{{ $infos_import->import_number }}</td>
                <td> <?php if($infos_import->status == 'Y') echo 'Active'; else{echo 'Inactive';} ?> </td>
                <td style="vertical-align: middle;text-align:center;"><i class="fas fa-dice-one fa-1x" <?php if($infos_import->status == 'Y') echo 'style="color: forestgreen;"'; else{echo 'style="color: red;"';} ?> ></i>
              </tr>
              @endforeach
            </tbody>
            </table>
          </div>
          <!-- /.card-body -->

        </div>
        <!-- /.card -->

      </div><!-- /.container-fluid -->
      <!-- /.modal -->

      <div class="modal fade" id="modal-clients">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Importer de nouveaux clients</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="text-muted">Vous pouvez ajouter plusieurs clients à la fois via un fichier CSV.</p>

              <p class="text-muted">Après l'importation, vos clients pourront commencer à utiliser vos services de facturation.  </p>

              <p class="text-muted">L'importation via un fichier vous permet d'ajouter  vos clients en masse sans développement. Seul un fichier csv est à éditer puis à charger via cette interface.</p>
              <p  style="margin-bottom: var(--space-s);"> Première étape : Template Elektra</p>
              <p class="text-muted">Vous pouvez  utiliser notre template Elektra standard et y ajouter les données que vous voulez importer. Si les champs du template ne sont pas  adaptés à votre modèle, vous pouvez toujours utiliser votre fichier  personnalisé. </p>
              <span class="elektra-button-wrapper"><a href="<?php echo e(route('import.dashboard.download_contacts_tpl')); ?>">
                <i class="fa fa-download"><span class="elektra-button">&nbsp &nbsp Télécharger le template</span></i>
              </a>
              </span>
              <br/>
              <p  style="margin-bottom: var(--space-s);"> Deuxième étape : Chargement du fichier de données</p>
              <p class="text-muted">Charger le  template que vous avez déjà  modifié ou votre fichier personnalisé. </p>
              <form action="<?php echo e(route('import.dashboard.load_contacts')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

              <div class="input-group add-alert">
                      <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choisir fichier</label>
                      </div>
                        <div class="input-group-append">
                          <button class="input-group-text" id="">Charger</button>
                        </div>
              </div>
              </form>
              <br/>
              <br/>
              <p  style="margin-bottom: var(--space-s);"> Troisième étape : Vérification du mapping</p>
              <p class="text-muted">Merci de vérifier que  tous  les champs sont bien mappés </p>
              <div class="card">
              <div class="card-header">
                  <div class="row">
                    <dt class="col-sm-4">Champs du fichier importé</dt>
                    <dd class="col-sm-8">Champs Elektra</dd>
                  </div>
              </div>
              <!-- /.card-header -->
              <form method="POST" action="<?php echo e(route('import.dashboard.final_load_contacts')); ?>">
                <?php echo e(csrf_field()); ?>
              <div class="card-body">
                <dl class="row">
                  <?php if(!empty($data_contacts)): ?>
                  <?php $__currentLoopData = $data_contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <dt class="col-sm-4"><?php echo e(substr($dt,1,strlen($dt)-2)); ?></dt>
                  <dd class="col-sm-8">
                    <div class="form-group">
                      <select class="form-control" name='fields[]'>
                        <option value='customerId' <?php if(substr($dt,1,strlen($dt)-2) == 'cni') echo 'selected';?> >CNI</option>
                        <option value='email' <?php if(substr($dt,1,strlen($dt)-2) == 'email') echo 'selected';?> >Email</option>
                        <option value='phone' <?php if(substr($dt,1,strlen($dt)-2) == 'phone') echo 'selected';?> >Téléphone</option>
                        <option value='address_1' <?php if(substr($dt,1,strlen($dt)-2) == 'address_1') echo 'selected';?> >Adresse 1</option>
                        <option value='address_2' <?php if(substr($dt,1,strlen($dt)-2) == 'address_2') echo 'selected';?> >Adresse 2</option>
                        <option value='first_name' <?php if(substr($dt,1,strlen($dt)-2) == 'first_name') echo 'selected';?> >Prénom</option>
                        <option value='last_name' <?php if(substr($dt,1,strlen($dt)-2) == 'last_name') echo 'selected';?> >Nom</option>
                        <option value='status' <?php if(substr($dt,1,strlen($dt)-2) == 'status') echo 'selected';?> >Statut client</option>
                        <option value='service_id' <?php if(substr($dt,1,strlen($dt)-2) == 'service_id') echo 'selected';?> >Service</option>
                        <option value='partner_id' <?php if(substr($dt,1,strlen($dt)-2) == 'partner_id') echo 'selected';?> >Partenaire</option>
                        <option value='status' <?php if(substr($dt,1,strlen($dt)-2) == 'status') echo 'selected';?> >Statut souscription</option>
                        <option value='salutation' <?php if(substr($dt,1,strlen($dt)-2) == 'salutation') echo 'selected';?> >Civilité</option>
                        <option value='dob'<?php if(substr($dt,1,strlen($dt)-2) == 'dob') echo 'selected';?> >Date de naissance</option>
                        <option value='pob'<?php if(substr($dt,1,strlen($dt)-2) == 'pob') echo 'selected';?> >Lieu de naissance</option>
                        <option value='billing_period' <?php if(substr($dt,1,strlen($dt)-2) == 'billing_period') echo 'selected';?> >Fréquence de facturation</option>
                      </select>
                    </div>
                  </dd>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                </dl>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-primary">Importer des clients</button>
            </div>
            <input type='hidden' name="file_to_import" value="<?php if(isset($_GET['file_to_import'])) echo $_GET['file_to_import']; else{echo '';} ?>" />
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <!-- /.modal -->

      <div class="modal fade" id="modal-factures">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Importer de nouvelles factures</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="text-muted">Vous pouvez ajouter plusieurs factures à la fois via un fichier CSV.</p>

              <p class="text-muted">Après l'importation, vos clients pourront avoir accès à leurs facture dès leur connexion.  </p>

              <p class="text-muted">L'importation via un fichier vous permet d'ajouter  vos factures en masse sans développement. Seul un fichier csv est à éditer puis à charger via cette interface.</p>
              <p  style="margin-bottom: var(--space-s);"> Première étape : Template Elektra</p>
              <p class="text-muted">Vous pouvez  utiliser notre template Elektra standard et y ajouter les données que vous voulez importer. Si les champs du template ne sont pas  adaptés à votre modèle, vous pouvez toujours utiliser votre fichier  personnalisé. </p>
              <span class="elektra-button-wrapper"><a href="<?php echo e(route('import.dashboard.download_invoices_tpl')); ?>">
                <i class="fa fa-download"><span class="elektra-button">&nbsp &nbsp Télécharger le template</span></i>
              </a>
              </span>
              <br/>
              <p  style="margin-bottom: var(--space-s);"> Deuxième étape : Chargement du fichier de données</p>
              <p class="text-muted">Charger le  template que vous avez déjà  modifié ou votre fichier personnalisé. </p>
              <form action="<?php echo e(route('import.dashboard.load_invoices')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

              <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choisir fichier</label>
                      </div>
                        <div class="input-group-append">
                          <button class="input-group-text" id="">Charger</button>
                        </div>
              </div>
              </form>
              <br/>
              <div class="alert alert-success alert-dismissible alert-invoice-green">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <i class="icon fas fa-check "> Le fichier a  été bien chargé.</i>
              </div>
              <div class="alert alert-danger alert-dismissible alert-invoice-red">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <i class="icon fas fa-ban "> Le fichier n'a pas été chargé.</i>
              </div>
              <br/>
              <p  style="margin-bottom: var(--space-s);"> Troisième étape : Vérification du mapping</p>
              <p class="text-muted">Merci de vérifier que  tous  les champs sont bien mappés </p>
              <div class="card">
              <div class="card-header">
                  <div class="row">
                    <dt class="col-sm-4">Champs du fichier importé</dt>
                    <dd class="col-sm-8">Champs Elektra</dd>
                  </div>
              </div>
              <!-- /.card-header -->
              <form method="POST" action="<?php echo e(route('import.dashboard.final_load_invoices')); ?>">
                <?php echo e(csrf_field()); ?>
              <div class="card-body">
                <dl class="row">
                  <?php if(!empty($data_invoices)): ?>
                  <?php $__currentLoopData = $data_invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <dt class="col-sm-4"><?php echo e(substr($dt,1,strlen($dt)-2)); ?></dt>
                  <dd class="col-sm-8">
                    <div class="form-group">
                      <select class="form-control" name='fields[]'>
                        <option value='customerId' <?php if(substr($dt,1,strlen($dt)-2) == 'cni') echo 'selected';?> >CNI</option>
                        <option value='souscription_id' <?php if(substr($dt,1,strlen($dt)-2) == 'souscription') echo 'selected';?> >Souscription</option>
                        <option value='order_number' <?php if(substr($dt,1,strlen($dt)-2) == 'order_number') echo 'selected';?> >Numéro de facturation</option>
                        <option value='title' <?php if(substr($dt,1,strlen($dt)-2) == 'title') echo 'selected';?> >Intitulé facture</option>
                        <option value='min_payment_due' <?php if(substr($dt,1,strlen($dt)-2) == 'min_payment_due') echo 'selected';?> >Minimum à payer</option>
                        <option value='tot_payment_due' <?php if(substr($dt,1,strlen($dt)-2) == 'tot_payment_due') echo 'selected';?> >Total à payer</option>
                        <option value='payment_due_date' <?php if(substr($dt,1,strlen($dt)-2) == 'payment_due_date') echo 'selected';?> >Date d'échéance</option>
                        <option value='payment_method' <?php if(substr($dt,1,strlen($dt)-2) == 'payment_method') echo 'selected';?> >Moyen de paiement</option>
                        <option value='payment_status' <?php if(substr($dt,1,strlen($dt)-2) == 'payment_status') echo 'selected';?> >Statut du paiement</option>
                        <option value='provider' <?php if(substr($dt,1,strlen($dt)-2) == 'provider') echo 'selected';?> >Partenaire</option>
                        <option value='import_status' <?php if(substr($dt,1,strlen($dt)-2) == 'import_status') echo 'selected';?> >Statut import</option>
                        <option value='paid_amount' <?php if(substr($dt,1,strlen($dt)-2) == 'paid_amount') echo 'selected';?> >Somme payée</option>
                        <option value='bill' <?php if(substr($dt,1,strlen($dt)-2) == 'bill') echo 'selected';?> >Description</option>
                        <option value='month' <?php if(substr($dt,1,strlen($dt)-2) == 'month') echo 'selected';?> >Mois</option>
                        <option value='year' <?php if(substr($dt,1,strlen($dt)-2) == 'year') echo 'selected';?> >Année</option>
                      </select>
                    </div>
                  </dd>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                </dl>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-primary">Importer des factures</button>
            </div>
            <input type='hidden' name="file_to_import" value="<?php if(isset($_GET['file_to_import'])) echo $_GET['file_to_import']; else{echo '';} ?>" />
          </form>
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
  <?php
  if(isset($_GET['id']) && $_GET['id'] == '2_success'){
    echo '<script>
        $(".imp_contacts").click();
        $(".add-alert").after(`<br /> <div class="alert alert-success alert-dismissible alert-contact-green">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fas fa-check "> Le fichier a  été bien chargé.</i>
        </div>`);
    </script>';
  }
  if(isset($_GET['id']) && $_GET['id'] == '2_error'){
    echo '<script>
        $(".imp_contacts").click();
        $(".add-alert").after(`<br /> <div class="alert alert-danger alert-dismissible alert-contact-red">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fas fa-ban "> Le fichier n\'a pas été chargé.</i>
        </div>`);
    </script>';
  }

  if(isset($_GET['id']) && $_GET['id'] == '3_success'){
    echo '<script>
        $(".imp_invoices").click();
        $(".alert-invoice-red").remove();
    </script>';
  }

  if(isset($_GET['id']) && $_GET['id'] == '3_error'){
    echo '<script>
        $(".imp_invoices").click();
        $(".alert-invoice-green").remove();
    </script>';
  }

   ?>
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
<?php $__env->stopSection(); ?>
<!-- jQuery -->
<script src="<?php echo e(url('dashboardAssets/plugins/jquery/jquery.min.js')); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo e(url('dashboardAssets/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(url('dashboardAssets/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

<!-- daterangepicker -->
<script src="<?php echo e(url('dashboardAssets/plugins/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(url('dashboardAssets/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
<!-- Summernote -->
<script src="<?php echo e(url('dashboardAssets/plugins/summernote/summernote-bs4.min.js')); ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo e(url('dashboardAssets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(url('dashboardAssets/dist/js/adminlte.js')); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo e(url('dashboardAssets/dist/js/pages/dashboard.js')); ?>"></script>

<!-- DataTables -->
<script src="<?php echo e(url('dashboardAssets/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(url('dashboardAssets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(url('dashboardAssets/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(url('dashboardAssets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>
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

<?php echo $__env->make('layouts.dashboardLayout', ['social_name' => session()->get('social_name'), 'full_name' => session()->get('full_name')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
