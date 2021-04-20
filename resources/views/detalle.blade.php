
    @include('header2')

    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('../img/bg_1.jpg')">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-7">
              <h2 class="mb-0">{{$curso->nombre}}</h2>
              <p>Conoce más detalles sobre este curso.</p>
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
                        <img src="/img/cursos/{{$curso->img ? $curso->img : 'course_2.jpg' }}" alt="Image" class="img-fluid">
                    </p>
                </div>
                <div class="col-lg-5 ml-auto align-self-center">
                    @if ($curso->tipo == 1)
                                Curso 
                              @else
                                Diplomado 
                              @endif
                        <h2 class="section-title-underline mb-5">
                            <span> 
                                {{$curso->nombre}}
                            </span>
                        </h2>
                        
                        <p><strong class="text-black d-block">Instructor:</strong> {{isset($tutores[$curso->tutor])? $tutores[$curso->tutor] : "Rodolfo Silva" }}</p>
                        <p><strong class="text-black d-block">Duración:</strong> {{$curso->duracion}}
                            
                            @if($curso->tipo_duracion == 1) Horas
                            @elseif($curso->tipo_duracion == 2) Días
                            @else Meses
                            @endif</p>
                        <p><strong class="text-black d-block">Categoría:</strong> {{$categorias[$curso->categoria]}}</p>
                        <p>{{$curso->descripcion}}</p>
                        <!--<p><strong class="text-black d-block">Valor:</strong> {{number_format($curso->valor,0)}}</p>-->
                        
                        <!--<p>Modi sit dolor repellat esse! Sed necessitatibus itaque libero odit placeat nesciunt, voluptatum totam facere.</p>
    
                        <ul class="ul-check primary list-unstyled mb-5">
                            <li>Lorem ipsum dolor sit amet consectetur</li>
                            <li>consectetur adipisicing  </li>
                            <li>Sit dolor repellat esse</li>
                            <li>Necessitatibus</li>
                            <li>Sed necessitatibus itaque </li>
                        </ul>-->

                        <p>
                            
                          
                            @guest
                            <p><a href="#" onclick="alert('Debes iniciar sessión o registrarte para poder inscribirte a este curso')" class="btn btn-primary rounded-0 px-4">Inscribirse</a></p>
                          @else
                            <p><a onClick="if(!confirm('Esta seguro de inscribirte a este curso?')){reu" href="{{env('APP_URL')}}/inscribirme/{{ $curso->id}}" class="btn btn-primary rounded-0 px-4">Inscribirse</a></p>
                           
                          @endguest
                          
                        </p>
    
                    </div>
            </div>
        </div>
    </div>

      
    @include('contactenos2')
    
    @include('footer2')