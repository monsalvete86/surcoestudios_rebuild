<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- CSRF Token -->
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

      <title>Surcoestudios</title>
      
    
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
       
        <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
        <link rel="stylesheet" href="/fonts/icomoon/style.css">
    
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/jquery-ui.css">
        <link rel="stylesheet" href="/css/owl.carousel.min.css">
        <link rel="stylesheet" href="/css/owl.theme.default.min.css">
        <link rel="stylesheet" href="/css/owl.theme.default.min.css">
    
        <link rel="stylesheet" href="/css/jquery.fancybox.min.css">
    
        <link rel="stylesheet" href="/css/bootstrap-datepicker.css">
    
        <link rel="stylesheet" href="/fonts/flaticon/font/flaticon.css">
    
        <link rel="stylesheet" href="/css/aos.css">
        <link href="/css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">
    
        <link rel="stylesheet" href="/css/style.css">
    </head>
    
    <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    
      <div class="site-wrap">
    
        <div class="site-mobile-menu site-navbar-target">
          <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
              <span class="icon-close2 js-menu-toggle"></span>
            </div>
          </div>
          <div class="site-mobile-menu-body"></div>
        </div>
    
    
        <div class="py-2 bg-light">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-xl-8 d-none d-lg-block">
                <a href="#" class="small mr-3"><span class="icon-question-circle-o mr-2"></span> Alguna inquietud?</a> 
                <a href="#" class="small mr-3"><span class="icon-phone2 mr-2"></span> 320 468 8543</a> 
                <a href="#" class="small mr-3"><span class="icon-envelope-o mr-2"></span> coordinacion@surcoestudios.com</a> 
              </div>
              <?php if(auth()->guard()->guest()): ?>
                <div class="col-xl-4 text-right">
                  <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-primary px-4 py-2 small mr-3 rounded-0">
                    <span class="icon-unlock-alt"></span> Iniciar sesión
                  </a>
                  <a href="<?php echo e(route('register')); ?>" class="small btn btn-primary px-4 py-2 rounded-0">
                    <span class="icon-users"></span> Registrate
                  </a>
                </div>
              <?php else: ?>
                <div class="col-xl-4 text-right">
                  <a href="dashboard" class="small btn btn-primary px-4 py-2 rounded-0">
                    <span class="icon-users"></span> Panel Administrativo
                  </a>
                  <a href="logout"           class="btn btn-outline-danger small ml-3 px-4 py-2 rounded-0 " onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span class="icon-unlock-alt"></span> Salir                    
                 </a>
                 <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                  <?php echo csrf_field(); ?>
                </form>

                 
                  
                </div>

               
              <?php endif; ?>
            </div>
          </div>
        </div>
        <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
    
          <div class="container">
            <div class="d-flex align-items-center">
              <div class="site-logo">
                <a href="/" class="d-block">
                  <img src="/img/logo.jpg"  style="max-width: 170px" alt="Image" class="img-fluid">
                </a>
              </div>
              <div class="mr-auto">
                <nav class="site-navigation position-relative text-right" role="navigation">
                  <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                    <li class="active">
                      <a href="/" class="nav-link text-left">Inicio</a>
                    </li>
                    <li class="has-children">
                      <a href="#nosotros" class="nav-link text-left">Nosotros</a>
                      <ul class="dropdown">                        
                        <li><a  href="#nosotros">Nuestra Institución</a></li>
                        <li><a href="#teachers">Nuestros Instructores</a></li>
                      </ul>
                    </li>
                    <li>
                      <a href="/oferta" class="nav-link text-left">Cursos</a>
                    </li>  
                    <li>
                      <a href="/diplomados" class="nav-link text-left">Diplomados</a>
                    </li>                  
                    <li>
                        <a href="#contact" class="nav-link text-left">Contáctenos</a>
                      </li>
                  </ul>                                                                                                                                                                                                                                                                                          </ul>
                </nav>
    
              </div>
              <div class="ml-auto">
                <div class="social-wrap">
                  <a href="#"><span class="icon-facebook"></span></a>
                  <a href="#"><span class="icon-twitter"></span></a>
                  <a href="#"><span class="icon-linkedin"></span></a>
    
                  <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><span
                    class="icon-menu h3"></span></a>
                </div>
              </div>
             
            </div>
          </div>
    
        </header>