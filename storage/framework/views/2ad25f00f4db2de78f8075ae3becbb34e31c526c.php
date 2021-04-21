<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Surcoestudios</title>
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" href="css/app.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">

    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>

    </ul>

    <!-- SEARCH FORM -->
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" @keyup="searchit" v-model="search" type="search" placeholder="Buscar" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" @click="searchit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img style src="img/logo.jpg" alt="Surcoestudios" class="brand-image img-circle elevation-3"
           style="opacity: .8;">
      <span class="brand-text font-weight-light">.</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="img/profile.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
              <?php echo e(Auth::user()->name); ?>

              <p><?php echo e(Auth::user()->type); ?></p>
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <router-link to="dashboard" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt blue"></i>
                <p>Panel Admistrativo</p>
              </router-link>
            </li>        
          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('isAdmin')): ?>    
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-cog green"></i>
                <p>
                  Administración
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link to="/users" style="opacity: 0.7;" class="nav-link">
                    <i class="fas fa-users nav-icon green"></i>
                    <p>Usuarios</p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link to="/empresas" style="opacity: 0.7;" class="nav-link">                   
                    <i class="fas fa-building nav-icon green"></i>
                    <p>Empresas</p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link to="/categorias" style="opacity: 0.7;" class="nav-link">                   
                    <i class="fas fa-list-alt nav-icon green"></i>
                    <p>Categorias</p>
                  </router-link>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <router-link to="/cursos" class="nav-link">                   
                <i class="nav-icon fas fa-graduation-cap blue"></i>
                <p>Cursos</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/inscripciones" class="nav-link">                   
                <i class="nav-icon fas fa-address-book yellow"></i>
                <p>Inscripciones</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/developer" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>Desarrollador</p>
              </router-link>
            </li>
          <?php endif; ?>
          <li class="nav-item">
            <router-link to="/clases" class="nav-link">                   
              <i class="nav-icon fas fa-book-reader yellow"></i>
              <p>Mis cursos</p>
            </router-link>
          
          <li class="nav-item">
            <router-link to="/profile" class="nav-link">
              <i class="nav-icon fas fa-user orange"></i>
              <p>Perfil</p>
            </router-link>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('logout')); ?>"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              <i class="nav-icon fa fa-power-off red"></i>
              <p><?php echo e(__('Salir')); ?></p>
            </a>
             <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                 <?php echo csrf_field(); ?>
             </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <router-view></router-view>

        <vue-progress-bar></vue-progress-bar>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      
    </div>
    <!-- Default to the left -->
    <strong>Desarrollado por <a href="https://fractalagenciadigital.com">Agencia Digital Fractal</a> 2020</strong> 
  </footer>
</div>
<!-- ./wrapper -->

<?php if(auth()->guard()->check()): ?>
<script>
    window.user = <?php echo json_encode(auth()->user(), 15, 512) ?>
</script>
<?php endif; ?>

<script src="js/app.js"></script>
</body>
</html>
