
    <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    

    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('img/bg_1.jpg')">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-7">
              <h2 class="mb-0">Diplomados</h2>
              <p>Conoce nuestros diplomados.</p>
            </div>
          </div>
        </div>
      </div> 
    

    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="/">Inicio</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Dipolomados</span>
      </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
              <?php $__currentLoopData = $cursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="course-1-item">
                        <figure class="thumnail">
                          <a href="/detalle/<?php echo e($curso->id); ?>">
                            <img src="img/<?php echo e($curso->img ? $curso->img : 'course_2.jpg'); ?>" alt="Image" class="img-fluid">
                          </a>
                          <div style="background: #d86a0b;" class="price">$ <?php echo e(number_format($curso->valor,0)); ?></div>
                          <div class="category"> Diplomado en <h3><?php echo e($curso->nombre); ?></h3>
                          
                          </div>  
                        </figure>
                        <div class="course-1-content pb-4">
                          <p class="text-left"><b>Categoria:</b><?php echo e($categorias[$curso->categoria]); ?></p>
                          <p class="text-left"><b>Duracion:</b><?php echo e($curso->duracion); ?> 
                            <?php if($curso->tipo_duracion == 1): ?> Horas
                            <?php elseif($curso->tipo_duracion == 2): ?> Días
                            <?php else: ?> Meses
                            <?php endif; ?>
                          </p>
                          
                        <!--
                        <div class="rating text-center mb-3">
                            <span class="icon-star2 text-warning"></span>
                            <span class="icon-star2 text-warning"></span>
                            <span class="icon-star2 text-warning"></span>
                            <span class="icon-star2 text-warning"></span>
                            <span class="icon-star2 text-warning"></span>
                        </div>
                        <p class="desc mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Similique accusantium ipsam.</p>-->
                        
                          <p><a href="/detalle/<?php echo e($curso->id); ?> " class="btn btn-primary rounded-0 px-4">Ver mas</a></p>
                        
                        </div>
                    </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

      
    <?php echo $__env->make('contactenos', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
     