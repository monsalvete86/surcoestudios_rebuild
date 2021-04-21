
    <?php echo $__env->make('header2', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('../img/bg_1.jpg')">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-7">
              <h2 class="mb-0">Nombre Curso</h2>
              <p>Conoce mas detalles sobre este curso.</p>
            </div>
          </div>
        </div>
      </div> 
    

    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="/">Inicio</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <a href="/oferta">Cursos</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Detalles Curso</span>
      </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <p>
                        <img src="/img/<?php echo e($curso->img ? $curso->img : 'course_2.jpg'); ?>" alt="Image" class="img-fluid">
                    </p>
                </div>
                <div class="col-lg-5 ml-auto align-self-center">
                    <?php if($curso->tipo == 1): ?>
                                Curso de capacitación en
                              <?php else: ?>
                                Diplomado en
                              <?php endif; ?>
                        <h2 class="section-title-underline mb-5">
                            <span> 
                                <?php echo e($curso->nombre); ?>

                            </span>
                        </h2>
                        
                        <p><strong class="text-black d-block">Instructor:</strong> <?php echo e($tutores[$curso->tutor]); ?></p>
                        <p><strong class="text-black d-block">Duracion:</strong> <?php echo e($curso->duracion); ?>

                            
                            <?php if($curso->tipo_duracion == 1): ?> Horas
                            <?php elseif($curso->tipo_duracion == 2): ?> Días
                            <?php else: ?> Meses
                            <?php endif; ?></p>
                        <p><strong class="text-black d-block">Categoria:</strong> <?php echo e($categorias[$curso->categoria]); ?></p>
                        <p><?php echo e($curso->descripcion); ?></p>
                        <p><strong class="text-black d-block">Valor:</strong> <?php echo e(number_format($curso->valor,0)); ?></p>
                        <p><?php echo e($curso->descripcion); ?></p>
                        <!--<p>Modi sit dolor repellat esse! Sed necessitatibus itaque libero odit placeat nesciunt, voluptatum totam facere.</p>
    
                        <ul class="ul-check primary list-unstyled mb-5">
                            <li>Lorem ipsum dolor sit amet consectetur</li>
                            <li>consectetur adipisicing  </li>
                            <li>Sit dolor repellat esse</li>
                            <li>Necessitatibus</li>
                            <li>Sed necessitatibus itaque </li>
                        </ul>-->

                        <p>
                            
                          
                            <?php if(auth()->guard()->guest()): ?>
                            <p><a href="#" onclick="alert('Debes iniciar sessión o registrarte para poder inscribirte a este curso')" class="btn btn-primary rounded-0 px-4">Inscribirse</a></p>
                          <?php else: ?>
                            <p><a onClick="if(!confirm('Esta seguro de inscribirte a este curso?')){reu" href="/inscribirme/<?php echo e($curso->id); ?>" class="btn btn-primary rounded-0 px-4">Inscribirse</a></p>
                           
                          <?php endif; ?>
                          
                        </p>
    
                    </div>
            </div>
        </div>
    </div>

      
    <?php echo $__env->make('contactenos2', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <?php echo $__env->make('footer2', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>