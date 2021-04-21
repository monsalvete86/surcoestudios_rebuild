<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script async src="https://www.google.com/recaptcha/api.js"></script>
<div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('img/bg_1.jpg')">
    <div class="container">
        <div class="row align-items-end justify-content-center text-center">
            <div class="col-lg-7">
                <h2 class="mb-0">Registrase</h2>
                <p>Tenemos una gran variedad de Cursos de Capacitación y Diplomados.</p>
            </div>
        </div>
    </div>
</div> 
<div class="custom-breadcrumns border-bottom">
    <div class="container">
        <a href="/">Inicio</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Registro</span>
    </div>
</div>
<div class="site-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">                
                <form method="POST" onSubmit="return validaCapcha()"  action="<?php echo e(route('register')); ?>" aria-label="<?php echo e(__('Registro')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right"><?php echo e(__('Nombre')); ?></label>

                        <div class="col-12 col-md-4">
                            <input id="name" type="text" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" value="<?php echo e(old('name')); ?>" required autofocus>

                            <?php if($errors->has('name')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('name')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                        <label for="email" class="col-md-2 col-form-label text-md-right"><?php echo e(__('Correo')); ?></label>

                        <div class="col-md-4">
                            <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required>

                            <?php if($errors->has('email')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right"><?php echo e(__('Tipo Documento')); ?></label>

                        <div class="col-12 col-md-4">
                            
                            <select name="tipo_id" name="tipo_id" class="form-control<?php echo e($errors->has('tipo_id') ? ' is-invalid' : ''); ?>" required autofocus>
                                <option valuee="Cédula de Ciudadanía" <?php if(old('tipo_id')=="Cédula de Ciudadanía"): ?> <?php echo e('selected'); ?> <?php endif; ?>>
                                    Cédula de Ciudadanía
                                </option>
                                <option valuee="Cédula de Ciudadanía" <?php if(old('tipo_id')=="Cédula de Extrangería"): ?> <?php echo e('selected'); ?> <?php endif; ?>>
                                    Cédula de Extrangería
                                </option>
                                <option valuee="Cédula de Ciudadanía" <?php if(old('tipo_id')=="Tarjeta de Identidad"): ?> <?php echo e('selected'); ?> <?php endif; ?>>
                                    Tarjeta de Identidad
                                </option>
                            </select>
                            <?php if($errors->has('tipo_id')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('tipo_id')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                        <label for="email" class="col-md-2 col-form-label text-md-right"><?php echo e(__('Documento')); ?></label>

                        <div class="col-md-4">
                            <input id="documento" type="documento" class="form-control<?php echo e($errors->has('documento') ? ' is-invalid' : ''); ?>" name="documento" value="<?php echo e(old('documento')); ?>" required>

                            <?php if($errors->has('documento')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('documento')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="form-group row">
                        <label for="telefonos" class="col-md-2 col-form-label text-md-right"><?php echo e(__('Lugar Expedición')); ?></label>

                        <div class="col-md-4">
                            <input id="lugar_expe" type="text" class="form-control<?php echo e($errors->has('lugar_expe') ? ' is-invalid' : ''); ?>" name="lugar_expe" value="<?php echo e(old('lugar_expe')); ?>" required autofocus>

                            <?php if($errors->has('lugar_expe')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('lugar_expe')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                        <label for="telefonos" class="col-md-2 col-form-label text-md-right"><?php echo e(__('Telefonos')); ?></label>

                        <div class="col-md-4">
                            <input id="telefonos" type="text" class="form-control<?php echo e($errors->has('telefonos') ? ' is-invalid' : ''); ?>" name="telefonos" value="<?php echo e(old('telefonos')); ?>" required autofocus>

                            <?php if($errors->has('telefonos')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('telefonos')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-2 col-form-label text-md-right"><?php echo e(__('Password')); ?></label>

                        <div class="col-md-4">
                            <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required>

                            <?php if($errors->has('password')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('password')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>                   
                        <label for="password-confirm" class="col-md-2 col-form-label text-md-right"><?php echo e(__('Confirmar Password')); ?></label>

                        <div class="col-md-4 ">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>
                     <div class="form-group row">
                            <div class="col-md-6 text-md-right">
                                <div class=" g-recaptcha" data-sitekey="6LeuiX4aAAAAAIupjEEhatCLied82rZRAU8rBmKl"></div>
                                
                            </div>
                        </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-2">
                            <button type="submit" class="btn btn-primary">
                                <?php echo e(__('Registrarme')); ?>
                            </button>
                        </div>
                    </div>
                </form>                    
            </div>
        </div>
    </div>
</div> 
<script>
   function onSubmit(token) {
     document.getElementById("demo-form").submit();
   }
   function validaCapcha(evt) {
        var response = grecaptcha.getResponse();
        if(response.length == 0) 
        { 
        //reCaptcha not verified
          alert("please verify you are humann!"); 
              return false;
            evt.preventDefault();
            return false;
        }
        else {
            return true;
        }
       
   }

 </script>





<!--
<div class="site-section">
    <div class="container">
        <form method="POST" action="<?php echo e(route('register')); ?>" aria-label="<?php echo e(__('Register')); ?>">

            <div class="row justify-content-center">
                <div class="col-md-10 col-sm-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 form-group">
                            <label for="name">Nombre</label>
                            <input type="text" id="name" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" value="<?php echo e(old('name')); ?>" required autofocus>
                        </div>
                        <div class="col-md-6 col-sm-12 form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" id="apellido" class="form-control<?php echo e($errors->has('apellido') ? ' is-invalid' : ''); ?>">
                        </div>
                        <div class="col-md-6 col-sm-12 form-group">
                            <label for="tipo_id">Tipo de identificación</label>
                            
                            <select id="tipo_id" class="form-control ">
                                <option value="Cedula de Ciudadania">Cedula de Ciudadania</option>
                                <option value="Cedula de Extrangeria">Cedula de Extrangeria</option>
                                <option value="Pasaporte">Pasaporte</option>
                                <option value="Tarjeta de Identidad">Tarjeta de Identidad</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-sm-12 form-group">
                            <label for="documento">No. identificación</label>
                            <input type="text" id="documento" class="form-control ">
                        </div>
                        <div class="col-md-6 col-sm-12 form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control ">
                        </div>
                        <div class="col-md-6 col-sm-12 form-group">
                            <label for="pword">Clave</label>
                            <input type="password" id="pword" class="form-control ">
                        </div>
                        <div class="col-md-6 col-sm-12 form-group">
                            <label for="pword2">Confirmar clave</label>
                            <input type="password" id="pword2" class="form-control ">
                        </div>
                        <div class="col-md-6 col-sm-12 form-group">
                            <label for="celular">Celular</label>
                            <input type="tel" id="celular" class="form-control ">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="submit" value="Registrase" class="btn btn-primary btn-lg px-5">
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
-->
<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

