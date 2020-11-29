<?php
session_start();
$notification = (isset($_SESSION["numberOfBillsNonPaid"])) ? $_SESSION["numberOfBillsNonPaid"] : '';
if (!empty(Auth::user()->date_activation_code)) $_SESSION['profilNotif'] = 0;
?>


<?php $__env->startSection('content'); ?>
<div class="container-fluid page-body-wrapper">
    <div class="main-panel" style="background-image: url(<?php echo e(url('images/white-background/19366_Fotor1.jpg')); ?>);">
      <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body" style="text-align:center">
              <h4 class="card-title">Mes informations personnelles</h4>
              <?php if(!empty($message)): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Félicitations <?php echo e(Auth::user()->first_name); ?>!</strong> <?php echo e($message); ?>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?php endif; ?>
              <?php if(!empty($error_message)): ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oups!</strong> <?php echo e($error_message); ?>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?php endif; ?>
              <div class="row" style="margin-top:50px">
                  <div class="col-md-12 col-md-offset-1">
                      <div class="panel panel-default personalInfoPanel">
                          <div class="panel-body">
                              <?php if(session('status')): ?>
                                  <div class="alert alert-success">
                                      <?php echo e(session('status')); ?>

                                  </div>
                              <?php endif; ?>

                              <form method="post" action="../infos-personnelles/<?php echo e($_SESSION['current_service']); ?>">
                                <?php echo e(csrf_field()); ?>

                                <!-- TESTTT -->
                                <div class="row">
                                <div class="col-md-6 grid-margin stretch-card">
                                  <div class="card">
                                    <div class="card-body">
                                      <h4 class="card-title">Mes données personnelles</h4>
                                      <p class="card-description">
                                        <button style="background:rgba(137,180,213,1);color:white" class="btn btn-sm">
                                          <span class="mdi mdi-account-edit">
                                          </span>Modifier mes données personnelles
                                        </button>
                                        <input type="hidden" name="update_perso_data" value="true"/>
                                        <input type="hidden" name="service" value="<?php echo e($_SESSION['current_service']); ?>"/>
                                      </p>

                                      </form>

                                      <div class="template-demo">
                                        <?php if(!isset($_POST['update_perso_data'])): ?>
                                          <div class="col-md-6" style="margin-bottom:10px">
                                            <p><strong>CIVILITE</strong></p>
                                            <span class="recapData"><?php echo e(Auth::user()->civilite); ?></span>
                                          </div>
                                        <div class="row">
                                          <div class="col-md-6" style="margin-bottom:10px">
                                            <p><strong>PRENOM</strong></p>
                                            <span class="recapData"><?php echo e(Auth::user()->first_name); ?></span>
                                          </div>

                                          <div class="col-md-6" style="margin-bottom:10px">
                                            <p><strong>NOM</strong></p>
                                            <span class="recapData"><?php echo e(Auth::user()->name); ?></span>
                                          </div>
                                        </div>

                                        <div class="col-md-6" style="margin-bottom:10px">
                                          <p><strong>CNI</strong></p>
                                          <span class="recapData"><?php echo e(Auth::user()->customerId); ?></span>
                                        </div>

                                        <div class="row">
                                          <div class="col-md-6" style="margin-bottom:10px">
                                            <p><strong>ADRESSE</strong></p>
                                            <span class="recapData"><?php echo e(Auth::user()->address); ?></span>
                                          </div>

                                          <div class="col-md-6" style="margin-bottom:10px;">
                                            <p><strong>RECEVOIR LA NEWSLETTER</strong></p>
                                            <span class="recapData">NON</span>
                                          </div>
                                        </div>
                                        <?php endif; ?>

                                        <?php if(isset($_POST['update_perso_data'])): ?>
                                        <form method="post" action="../infos-personnelles/<?php echo e($_SESSION['current_service']); ?>/update">
                                          <?php echo e(csrf_field()); ?>

                                          <div class="row" style="margin-bottom:2px;margin-left:5px">
                                              <div class="form-group col-md-3">
                                                <label for="exampleFormControlSelect1">CIVILITE</label>
                                                <select class="form-control" name="salutation" id="exampleFormControlSelect1">
                                                  <option value="" disabled="disabled">--Votre civilité--</option>
                                                  <?php if(Auth::user()->civilite == 'Mme'): ?>
                                                    <option value="Mme">Madame</option>
                                                    <option value="Mr">Monsieur</option>
                                                  <?php endif; ?>
                                                  <?php if(Auth::user()->civilite == 'Mr'): ?>
                                                    <option value="Mr">Monsieur</option>
                                                    <option value="Mme">Madame</option>
                                                  <?php endif; ?>
                                                </select>
                                              </div>
                                            </div>

                                          <div class="col-md-6" style="margin-bottom:10px">
                                            <p><strong>PRENOM:</strong></p>
                                            <input pattern="[a-zA-Z ]{2,30}" title="le prénom renseigné n'est pas correct." class="col-form-label" name="first_name" value="<?php echo e(Auth::user()->first_name); ?>" style="border-bottom:3px solid #084f78 !important" required>
                                          </div>

                                          <div class="col-md-6" style="margin-bottom:10px">
                                            <p><strong>NOM:</strong></p>
                                            <input pattern="[a-zA-Z ]{2,30}" title="le nom renseigné n'est pas correct." class="col-form-label" name="name" value="<?php echo e(Auth::user()->name); ?>" style="border-bottom:3px solid #084f78 !important" required>
                                          </div>


                                          <div class="col-md-6" style="margin-bottom:10px">
                                            <p><strong>ADRESSE DE FACTURATION:</strong></p>
                                            <input pattern="[0-9]{1,3}(([,. ]?){1}[-a-zA-Zàâäéèêëïîôöùûüç']+)*" title="l'adresse renseigné n'est pas valide." class="col-form-label" name="address" value="<?php echo e(Auth::user()->address); ?>" style="border-bottom:3px solid #084f78 !important" required>
                                          </div>
                                          <br />
                                          <div class="row form-check" style="margin-bottom:10px;margin-left:18px">
                                              <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                              <label class="form-check-label" for="exampleCheck1">RECEVOIR LA NEWSLETTER</label>
                                          </div>
                                          <div class="row" style="margin-bottom:10px;margin-left:18px">
                                            <button type="submit" name="action" value="save" style="margin-top:8px" class="btn btn-primary">
                                              <span class="glyphicon glyphicon-save"></span> Enregister
                                            </button>
                                            <button type="submit" name="action" value="cancel" style="margin-top:8px" class="btn btn-warning">
                                              <span class="glyphicon glyphicon-remove-circle"></span> Annuler
                                            </button>
                                          </div>
                                          <input type="hidden" name="service" value="<?php echo e($_SESSION['current_service']); ?>"/>
                                        </form>
                                        <?php endif; ?>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-6 grid-margin stretch-card">
                                  <div class="card">
                                    <div class="card-body">
                                      <h4 class="card-title">Mes coordonnées de contact</h4>
                                      <div class="template-demo">

                                                                  <?php if(!isset($_POST['update_email'])): ?>
                                                                    <form method="post" action="../infos-personnelles/<?php echo e($_SESSION['current_service']); ?>">
                                                                      <?php echo e(csrf_field()); ?>

                                                                      <div class="col-md-12" style="margin-bottom:10px">
                                                                        <p><strong>EMAIL</strong></p>
                                                                        <span class="recapData"><?php echo e(Auth::user()->email); ?></span>
                                                                        <div>
                                                                          <button style="background:rgba(137,180,213,1);color:white;margin-top:8px" class="btn">
                                                                            <span class="glyphicon glyphicon-edit"></span> Modifier
                                                                          </button>
                                                                        </div>
                                                                      </div>
                                                                      <input type="hidden" name="update_email" value="true"/>
                                                                      <input type="hidden" name="service" value="<?php echo e($_SESSION['current_service']); ?>"/>
                                                                    </form>
                                                                  <?php endif; ?>

                                                                  <?php if(isset($_POST['update_email'])): ?>
                                                                    <form method="post" action="../infos-personnelles/<?php echo e($_SESSION['current_service']); ?>/update">
                                                                      <?php echo e(csrf_field()); ?>

                                                                      <div class="col-md-6" style="margin-bottom:10px">
                                                                        <p><strong>EMAIL:</strong></p>
                                                                        <input <input pattern="\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+" title="l'adresse mail n'est pas valide." class="col-form-label" name="email" value="<?php echo e(Auth::user()->email); ?>" style="border-bottom:3px solid #084f78 !important">
                                                                        <div>
                                                                          <button type="submit" name="action_email" value='save' style="margin-top:8px" class="btn btn-primary">
                                                                            <span class="glyphicon glyphicon-edit"></span> Enregistrer
                                                                          </button>
                                                                          <button type="submit" name="action_email" value='cancel' style="margin-top:8px" class="btn btn-warning">
                                                                            <span class="glyphicon glyphicon-edit"></span> Annuler
                                                                          </button>
                                                                        </div>
                                                                      </div>
                                                                      <input type="hidden" name="service" value="<?php echo e($_SESSION['current_service']); ?>"/>
                                                                    </form>
                                                                  <?php endif; ?>

                                                                  <?php if(!isset($_POST['update_phone'])): ?>
                                                                      <div class="col-md-12" style="margin-bottom:10px">
                                                                        <p><strong>T&Eacute;L&Eacute;PHONE</strong></p>
                                                                        <span class="recapData"><?php echo e(Auth::user()->phone); ?></span>
                                                                        <?php if(!empty(Auth::user()->date_activation_code)): ?>
                                                                          <span class="glyphicon glyphicon-ok-circle text-success " style="font-size:15px"></span>
                                                                        <?php endif; ?>
                                                                        <div class="row">
                                                                          <?php if(empty(Auth::user()->date_activation_code)): ?>
                                                                          <div class="col-md-12">
                                                                            <?php if(Auth::user()->attempt_sms_sent < 3): ?>
                                                                              <form method="post" action="../infos-personnelles/<?php echo e($_SESSION['current_service']); ?>">
                                                                                <?php echo e(csrf_field()); ?>

                                                                                <button class="btn btn-success" style="color:white;margin-top:8px">
                                                                                  <span class="glyphicon glyphicon-saved"></span> Vérifier
                                                                                </button>
                                                                                <input type="hidden" name="verify_phone" value="yes"/>
                                                                                <input type="hidden" name="phone" value="<?php echo e(Auth::user()->phone); ?>"/>
                                                                                <input type="hidden" name="service" value="<?php echo e($_SESSION['current_service']); ?>"/>
                                                                              </form>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                          <?php endif; ?>
                                                                          <div class="col-md-12">
                                                                            <form method="post" action="../infos-personnelles/<?php echo e($_SESSION['current_service']); ?>">
                                                                              <?php echo e(csrf_field()); ?>

                                                                              <button style="background:rgba(137,180,213,1);color:white;margin-top:8px" class="btn">
                                                                                <span class="glyphicon glyphicon-edit"></span> Modifier
                                                                              </button>
                                                                              <input type="hidden" name="update_phone" value="true"/>
                                                                              <input type="hidden" name="service" value="<?php echo e($_SESSION['current_service']); ?>"/>
                                                                            </form>
                                                                          </div>
                                                                        </div>
                                                                      </div>
                                                                  <?php endif; ?>

                                                                  <?php if(isset($_POST['update_phone'])): ?>
                                                                    <form method="post" action="../infos-personnelles/<?php echo e($_SESSION['current_service']); ?>/update">
                                                                      <?php echo e(csrf_field()); ?>

                                                                      <div class="col-md-6" style="margin-bottom:10px">
                                                                        <p><strong>PHONE:</strong></p>
                                                                        <input <input pattern="^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$" title="le numéro de téléphone n'est pas valide." class="col-form-label" name="phone" value="<?php echo e(Auth::user()->phone); ?>" style="border-bottom:3px solid #084f78 !important">
                                                                        <div>
                                                                          <button type="submit" name="action_phone" value='save' style="margin-top:8px" class="btn btn-primary">
                                                                            <span class="glyphicon glyphicon-edit"></span> Enregistrer
                                                                          </button>
                                                                          <button type="submit" name="action_phone" value='cancel' style="margin-top:8px" class="btn btn-warning">
                                                                            <span class="glyphicon glyphicon-edit"></span> Annuler
                                                                          </button>
                                                                        </div>
                                                                      </div>
                                                                      <input type="hidden" name="service" value="<?php echo e($_SESSION['current_service']); ?>"/>
                                                                    </form>
                                                                  <?php endif; ?>


                                      </div>
                                    </div>
                                  </div>
                                </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6 grid-margin stretch-card">
                                    <div class="card">
                                      <div class="card-body">
                                        <h4 class="card-title">Mes informations bancaires</h4>
                                        <p class="card-description">
                                          <button style="background:rgba(137,180,213,1);color:white;margin-top:8px" class="btn btn-sm" disabled="disabled">
                                            <span class="glyphicon glyphicon-edit"> </span> Ajouter un moyen de paiement
                                          </button>
                                        </p>
                                        <div class="template-demo">
                                          <h4>Adresse de facturation</h4>
                                          <div class="col-md-12" style="margin-bottom:10px;">
                                            <span class="recapData"><strong><?php echo e(Auth::user()->address); ?></strong></span>
                                            </div>
                                          <h4>Moyen de paiement</h4>
                                          <div class="col-md-12" style="margin-bottom:10px">
                                            <span>Compte OrangeMoney : <strong class="recapData"><?php echo e(substr(Auth::user()->phone,0,2)); ?>******<?php echo e(substr(Auth::user()->phone,-2,2)); ?></strong> </br>
                                            Paiement :<strong class="recapData"> ponctuel</strong> <br />
                                            Statut : <strong style="color:green"> Valide</strong></span>
                                            <div>
                                              <button style="background:rgba(137,180,213,1);color:white;margin-top:8px" class="btn" disabled="disabled">
                                              <span class="glyphicon glyphicon-edit"></span> Modifier
                                              </button></div>
                                          </div>

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <!-- FIN TEST -->

                          </div>
                      </div>



              </div>
          </div>

              </div>
            </div>
          </div>

        </div>

      </div>
      <!-- content-wrapper ends   -->

      <!-- partial   -->
</div>
<!-- partial:partials/_footer.html   -->
<footer class="footer">
  <div class="footer-wrap">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © services2sn 2020</span>
      <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Solution de <a href="https://www.services2sn.com/" target="_blank">Services2sn.com</a></span>
    </div>
  </div>
</footer>








<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="../infos-personnelles/<?php echo e($_SESSION['current_service']); ?>">
      <?php echo e(csrf_field()); ?>

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Vérification du numéro de téléphone</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input name="verification_code" type="text" placeholder="code à 5 chiffres" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">Vérifier</button>
        <input type="hidden" name="verify" value="yes" />
      </div>
    </div>
  </form>
  </div>
</div>

<?php

if($withPopup == "true"){
  echo '<script>
        $(document).ready(function() {
          $("#exampleModal").modal("show");
      });
  </script>';
}
 ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.appv2', ['notification' => $notification, 'service' => $_SESSION['current_service'], 'services' => $actived_services, 'profilNotif' => $_SESSION['profilNotif']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>