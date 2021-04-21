<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('/img/bg_1.jpg')">
        <div class="container">
            <div class="row align-items-end justify-content-center text-center">
                <div class="col-lg-7">
                    <h2 class="mb-0">Recuperación de correo</h2>
                    <p>Recupera tu correo para poder inciar sesion en Surcoestudios</p>
                </div>
            </div>
        </div>
    </div> 


    <div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="/">Inicio</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <span class="current">Restablecer</span>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">  
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('password.email')); ?>" aria-label="<?php echo e(__('Reset Password')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="email" class=" col-md-4 col-form-label text-md-right"><?php echo e(__('Dirección de correo')); ?></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback " role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary  rounded-0">
                                    <?php echo e(__('Enviar link de restablecimiento')); ?>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
            
<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

