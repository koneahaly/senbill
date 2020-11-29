<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <?php $raw_woyofal_users_demo = File::get(storage_path('classical_users.txt')); //filename inverted
              $raw_classical_users_demo = File::get(storage_path('woyofal_users.txt'));
              $user_cl="admin";
              $user_wy="admin";
              if(!empty($raw_woyofal_users_demo) and !empty($raw_classical_users_demo)){
                $classical_users_demo = substr($raw_classical_users_demo,0,-1);
                $woyofal_users_demo = substr($raw_woyofal_users_demo,0,-1);
                $classical_user_demo = explode(",", $classical_users_demo);
                $woyofal_user_demo = explode(",", $woyofal_users_demo);

                $rand_keys_cl = rand(0,count($classical_user_demo)-1);
                $rand_keys_wy = rand(0,count($woyofal_user_demo)-1);

                $user_cl = $classical_user_demo[$rand_keys_cl];
                $user_wy = $woyofal_user_demo[$rand_keys_wy];

              }
              //echo $rand_keys_cl.'-----'.$rand_keys_wy;
              //echo $classical_user_demo[$rand_keys_cl].'****'.$woyofal_user_demo[$rand_keys_wy];
              ?>

                <div class="panel-heading">SAISISSEZ VOS IDENTIFIANTS</div>

                <div class="panel-body">
                  <div class="alert alert-info" role="alert">
                    <h4 class="alert-heading">Bienvenue dans la version Demo d'elektra! </h4>
                    <p>Ne soumettez pas vos données confidentielles, elles seront visibles par le public.</p>
                    <hr>
                    <p class="mb-0">Pour vous connecter en tant que client <strong>classique</strong>, utilisez <span class="badge badge-pill badge-secondary"><?php echo e($user_cl); ?></span> comme nom d'utilisateur et <span class="badge badge-pill badge-secondary">demo123</span> comme mot de passe.</p>
                    <p class="mb-0">Pour vous connecter en tant que client <strong>woyofal</strong>, utilisez <span class="badge badge-pill badge-secondary"><?php echo e($user_wy); ?></span> comme nom d'utilisateur et <span class="badge badge-pill badge-secondary">demo123</span> comme mot de passe.</p>
                  </div>
                    <form class="form-horizontal" method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">Adresse mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-4 control-label">Mot de passe</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Se souvenir de moi
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Se connecter
                                </button>

                                <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                    Mot de passe oublié?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>