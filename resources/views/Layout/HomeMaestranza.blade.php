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
      <a href="{{route('maestranza')}}" class="brand-link text-center">
        <img src="{{ asset('dist/img/Emaut.ico')}}" width="80" height="40"><br>
        <small class="brand-text font-weight-light"><b>MAESTRANZA</b></small>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @can('ma-opcion-maquinariaequipo')
              <li class="nav-item has-treeview">              
                <a href="#" class="nav-link active  bg-warning">
                <i class="fas fa-snowplow"></i> <i class="fas fa-shipping-fast"></i> 
                 
                    Maquinaria Equipo
                    <i class="right fa fa-angle-left"></i>
     
                </a>                 
                <ul class="nav nav-treeview"> 
                  @can('ma-sub-marca')
                    <li class="nav-item">
                      <a href="{{route('marca.index')}}" class="nav-link">
                        <i class="far fa-object-ungroup"></i>
                        <p>Marca de Vehiculo</p>
                      </a>
                    </li>
                  @endcan
                  @can('ma-sub-modelovehiculo')
                    <li class="nav-item">
                      <a href="{{route('modelo.index')}}" class="nav-link">
                        <i class="far fa-object-group"></i>
                        <p>Modelo de Vehiculo</p>
                      </a>
                    </li>
                  @endcan
                  @can('ma-sub-tipovehiculo')
                    <li class="nav-item">
                      <a href="{{route('tipovehiculo.index')}}" class="nav-link">
                        <i class="fas fa-tasks"></i>
                        <p>Tipo De Vehiculo</p>
                      </a>
                    </li>
                  @endcan
                    <li class="nav-item">
                      <a href="{{route('vehiculo.index')}}" class="nav-link">
                        <i class="fas fa-building"></i>
                        <p>Vehiculo</p>
                      </a>
                    </li>  
             
                </ul>
              </li>
            @endcan
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
