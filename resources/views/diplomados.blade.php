
    @include('header')
    
    

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
              @foreach ($cursos as $curso)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="course-1-item">
                        <figure class="thumnail">
                          <a href="/detalle/{{ $curso->id}}">
                            <img src="img/cursos/{{$curso->img ? $curso->img : 'course_2.jpg'}}" alt="Image" class="img-fluid">
                          </a>
                          <!--<div style="background: #d86a0b;" class="price">$ {{number_format($curso->valor,0)}}</div>-->
                          <div class="category"> Diplomado en <h3>{{$curso->nombre}}</h3>
                          
                          </div>  
                        </figure>
                        <div class="course-1-content pb-4">
                          <p class="text-left"><b>Categoria:</b>{{$categorias[$curso->categoria]}}</p>
                          <p class="text-left"><b>Duracion:</b>{{$curso->duracion}} 
                            @if($curso->tipo_duracion == 1) Horas
                            @elseif($curso->tipo_duracion == 2) Días
                            @else Meses
                            @endif
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
                        
                          <p><a href="/detalle/{{$curso->id}} " class="btn btn-primary rounded-0 px-4">Ver más</a></p>
                        
                        </div>
                    </div>
                </div>
              @endforeach
            </div>
        </div>
    </div>

      
    @include('contactenos')
    
    @include('footer')
     