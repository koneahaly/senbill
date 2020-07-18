<?php $__env->startSection('content'); ?>

<?php
if(isset($_GET['data'])){
  $data = $_GET['data'];
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
              <div class="alert alert-success alert-dismissible alert-contact-green">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <i class="icon fas fa-check "> Le fichier a  été bien chargé.</i>
              </div>
              <div class="alert alert-danger alert-dismissible alert-contact-red">
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
              <div class="card-body">
                <dl class="row">
                  <?php if(!empty($data)): ?>
                  <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <dt class="col-sm-4"><?php echo e(substr($dt,1,strlen($dt)-2)); ?></dt>
                  <dd class="col-sm-8">
                    <div class="form-group">
                      <select class="form-control">
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'cni') echo 'selected';?> >CNI</option>
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'email') echo 'selected';?> >Email</option>
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'phone') echo 'selected';?> >Téléphone</option>
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'address_1') echo 'selected';?> >Adresse 1</option>
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'address_2') echo 'selected';?> >Adresse 2</option>
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'first_name') echo 'selected';?> >Prénom</option>
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'last_name') echo 'selected';?> >Nom</option>
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'status') echo 'selected';?> >Statut client</option>
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'service_id') echo 'selected';?> >Service</option>
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'partner_id') echo 'selected';?> >Partenaire</option>
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'status') echo 'selected';?> >Statut souscription</option>
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'salutation') echo 'selected';?> >Civilité</option>
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'dob') echo 'selected';?> >Date de naissance</option>
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'pob') echo 'selected';?> >Lieu de naissance</option>
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'billing_period') echo 'selected';?> >Fréquence de facturation</option>
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
              <button type="button" class="btn btn-primary">Importer des clients</button>
            </div>
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
              <div class="card-body">
                <dl class="row">
                  <?php if(!empty($data)): ?>
                  <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <dt class="col-sm-4"><?php echo e(substr($dt,1,strlen($dt)-2)); ?></dt>
                  <dd class="col-sm-8">
                    <div class="form-group">
                      <select class="form-control">
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'cni') echo 'selected';?> >CNI</option>
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'souscription') echo 'selected';?> >Souscription</option>
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'order_number') echo 'selected';?> >Numéro de facturation</option>
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'title') echo 'selected';?> >Intitulé facture</option>
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'min_payment_due') echo 'selected';?> >Minimum à payer</option>
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'tot_payment_due') echo 'selected';?> >Total à payer</option>
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'payment_due_date') echo 'selected';?> >Date d'échéance</option>
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'payment_method') echo 'selected';?> >Moyen de paiement</option>
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'payment_status') echo 'selected';?> >Statut du paiement</option>
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'provider') echo 'selected';?> >Partenaire</option>
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'import_status') echo 'selected';?> >Statut import</option>
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'paid_amount') echo 'selected';?> >Somme payée</option>
                        <option <?php if(substr($dt,1,strlen($dt)-2) == 'bill') echo 'selected';?> >Description</option>
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
              <button type="button" class="btn btn-primary">Importer des clients</button>
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
  <?php
  if(isset($_GET['id']) && $_GET['id'] == '2_success'){
    echo '<script>
        $(".imp_contacts").click();
        $(".alert-contact-red").remove();
    </script>';
  }
  if(isset($_GET['id']) && $_GET['id'] == '2_error'){
    echo '<script>
        $(".imp_contacts").click();
        $(".alert-contact-green").remove();
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
