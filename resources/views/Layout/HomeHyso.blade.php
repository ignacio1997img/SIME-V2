<!DOCTYPE html>
<html lang="es">
<head>
@include('Layout.include.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed text-sm">
    <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('dist/img/Emaut.ico')}}" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
        @include('Layout.include.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-warning elevation-4">
      <!-- Brand Logo -->
      <a href="{{route('hyso')}}" class="brand-link text-center">
        <img src="{{ asset('dist/img/Emaut.ico')}}" width="80" height="40"><br>
        <small class="brand-text font-weight-light"><b>HYSO</b></small>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         
              <li class="nav-item has-treeview">              
                <a href="#" class="nav-link active  bg-warning">
                    Documentos HYSO
                    <i class="right fa fa-angle-left"></i>
     
                </a>                 
                <ul class="nav nav-treeview"> 
                  
                    
                  
                    <li class="nav-item">
                      <a href="{{route('formulario.index')}}" class="nav-link">
                        <i class="fab fa-wpforms"></i>
                        <p>Formularios</p>
                      </a>
                    </li>
            
                    
                </ul>
              </li>
   
              <li class="nav-item has-treeview">              
                <a href="#" class="nav-link active  bg-warning">
                    Prueba
                    <i class="right fa fa-angle-left"></i>
     
                </a>                 
                <ul class="nav nav-treeview"> 
                  
                    <li class="nav-item">
                      <a href="{{route('glicemia.index')}}" class="nav-link">
                        <i class="fas fa-notes-medical"></i>
                        <p>Glicemia</p>
                      </a>
                    </li>
                </ul>
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
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- <footer> -->
    @include('Layout.include.footer')
    <!-- </footer> -->

    </div>
<!-- ./wrapper -->

@include('Layout.include.script')
</body>
</html>
