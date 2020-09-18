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
    <link rel="icon" href="./img/mars.png">
    <title>Inversiones y Construcciones Suramérica</title>
  
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <link href="https://fonts.googleapis.com/css?family=Monoton&display=swap" rel="stylesheet">

    <style>
      .dark{
        background-color: #0a0a0a;
        color: #ffffff;
      }
      .white{
        color:  white;
      }
      .white:hover{
        color:  white;
      }
      .orangered{
        background-color: #ff3000;
        color: #ffffff; 
      }

      .orangered:hover{
        color: #ffffff;
      }
    </style>
  </head>

  <body class="hold-transition sidebar-mini">
    <div class="wrapper" id="app">

      <!-- Navbar -->  
      <nav class="main-header navbar navbar-expand dark">

        <!-- Left navbar links -->  
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars px-1"></i></a>
          </li>
        </ul>

        <!-- SEARCH FORM -->
        <div class="input-group input-group-sm">
          <b-input-group size="sm">
            <b-form-input
            v-model="filter"
            type="search"
            id="filterinput"
            placeholder="Buscar"
            @keyUp.enter="buscar"
            ></b-form-input>
            <b-input-group-append>
              <b-button :disabled="filter" @click="filter = ''">Limpiar</b-button>  
          </b-input-group> 
        </div>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar dark elevation-4 layout-fixed">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="./img/mars.png" alt="MARS Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
        <span class="brand-text font-weight-light white ml-5">MARS</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="./img/profile/{{ Auth::user()->photo }}" class="img-circle elevation-2" alt="Imagen de usuario">
          </div>
          <div class="info">
            <router-link to="/profile" class="d-block white">
                {{ Auth::user()->name }} 
            </router-link>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->

            <li class="nav-item">
              <router-link to="/Dashboard" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt white"></i>
                <p class="white">
                  Inicio
                </p>
              </router-link>
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-tie cyan"></i>
                <p class="white">
                  Personal
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link to="/personal" class="nav-link">  
                  <i class="nav-icon fas fa-id-card"></i>
                    <p class="white">
                    Empleados y Entes</p>
                  </router-link>
                </li>
              </ul>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link to="/nomina" class="nav-link">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p class="white">
                    Nóminas</p>
                  </router-link>
                </li>
              </ul>
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-shopping-cart teal"></i>
                <p class="white">
                  Inventario
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link to="/inventario" class="nav-link">
                    <i class="nav-icon fas fa-warehouse"></i>
                    <p class="white">Almacén</p>
                  </router-link>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link to="/esa" class="nav-link">
                    <i class="nav-icon fas fa-shipping-fast"></i>
                    <p class="white">Entradas, Salidas y Ajustes</p>
                  </router-link>
                </li>
              </ul>
            </li>
          
            <li class="nav-item">
              <router-link to="/VEM" class="nav-link">
                <i class="nav-icon fas fa-snowplow green"></i>
                <p class="white">
                  Maquinaria y vehículos
                </p>
              </router-link>
            </li>

            <li class="nav-item">
              <router-link to="/contratos" class="nav-link">
                <i class="nav-icon fas fa-file-contract purple"></i>
                <p class="white">
                  Contratos
                </p>
              </router-link>
            </li>

          
            @can('isAdmin')
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-cog yellow"></i>
                  <p class="white">
                    Herramientas
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
          

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link to="/users" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p class="white">Usuarios</p>
                  </router-link>
                </li>
              </ul>
              </li>
            @endcan
          
            @can('isAdmin')
              <li class="nav-item">
                <router-link to="/developer" class="nav-link">
                  <i class="nav-icon fas fa-cogs orange"></i>
                  <p class="white">
                    Desarrollador
                  </p>
                </router-link>
              </li>
            @endcan
          
            <li class="nav-item">
              <router-link to="/profile" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p class="white">
                  Perfil
                </p>
              </router-link>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                <i class="nav-icon fa fa-power-off red"></i>
                <p class="white">
                  {{ __('Desconectarse') }}
                </p>
              </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
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
  <footer class="main-footer dark">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Todos los derechos reservados
    </div>
    <!-- Default to the left -->
    <span style="color: orangered; font-family: Monoton">Mars</span> &COPY; v0.1
  </footer>
  </div>
  <!-- ./wrapper -->

@auth
<script>
    window.user = @json(auth()->user())
</script>
@endauth

<script src="/js/app.js"></script>

</body>
</html>
