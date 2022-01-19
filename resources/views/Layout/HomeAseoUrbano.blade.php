<!DOCTYPE html>
<html lang="es">
<head>
@include('Layout.include.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

    <!-- Preloader -->
    {{-- <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('dist/img/Emaut.ico')}}" alt="AdminLTELogo" height="60" width="60">
    </div> --}}

    <!-- Navbar -->
        @include('Layout.include.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-warning elevation-4">
      <!-- Brand Logo -->
      <a href="{{route('aseourbano')}}" class="brand-link text-center">
        <img src="{{ asset('dist/img/Emaut.ico')}}" width="80" height="40"><br>
        <small class="brand-text font-weight-light"><b>ASEO URBANO</b></small>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @can('au-opcion-informacionbasica')
            <li class="nav-item has-treeviewe">
              <a href="#" class="nav-link active">
                <i class="fas fa-tags"></i>
                <p>
                  Información Básica
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview"> 
                @can('au-sub-contactos') 
                  <li class="nav-item">
                    <a href="{{route('contacto.index')}}" class="nav-link">
                      <i class="fas fa-address-book"></i>
                      <p>                        
                        Contactos
                      </p>
                    </a>
                  </li>
                @endcan
                @can('au-sub-distritos') 
                  <li class="nav-item">
                    <a href="{{route('distrito.index')}}" class="nav-link">
                      <i class="fas fa-globe"></i>
                      <p>                        
                        Distritos
                      </p>
                    </a>
                  </li>
                @endcan
                @can('au-sub-barrios') 
                  <li class="nav-item">
                    <a href="{{route('barrio.index')}}" class="nav-link">
                      <i class="fas fa-map-signs"></i>
                      <p>                        
                        Barrios
                      </p>
                    </a>
                  </li>
                @endcan
                @can('au-sub-calles') 
                  <li class="nav-item">
                    <a href="{{route('calle.index')}}" class="nav-link">
                      <i class="fas fa-road"></i>
                      <p>                        
                        Calles
                      </p>
                    </a>
                  </li>
                @endcan
                <!-- @can('au-sub-tiposervicioaseo') 
                  <li class="nav-item">
                    <a href="{{route('tiposervicioaseo.index')}}" class="nav-link">
                      <i class="fas fa-sign"></i>
                      <p>                        
                        Tipos Servicios
                      </p>
                    </a>
                  </li>
                @endcan -->
                @can('au-sub-reportesinformacionbasica') 
                  <li class="nav-item">
                    <a href="{{route('contructor.index')}}" class="nav-link">
                      <i class="fas fa-print"></i>
                      <p>                        
                        Reportes
                      </p>
                    </a>
                  </li>
                @endcan
                
              </ul>
            </li>
          @endcan
          @can('au-opcion-rtdomiciliario')
            <li class="nav-item has-treeviewe">
              <a href="#" class="nav-link active">
                <i class="fas fa-truck-moving"></i>
                <p>
                  R.T. Domiciliario
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview"> 
                  @can('au-sub-zonas')
                  <li class="nav-item">
                    <a href="{{route('zona.index')}}" class="nav-link">  
                      <i class="fas fa-map-marked-alt"></i>                  
                      <p>                        
                        Zonas
                      </p>
                    </a>
                  </li>
                  @endcan
                  @can('au-sub-rutas')
                  <li class="nav-item">
                    <a href="{{route('ruta.index')}}" class="nav-link">
                      <i class="fas fa-route"></i>
                      <p>                        
                        Rutas
                      </p>
                    </a>
                  </li>
                  @endcan
                  @can('au-sub-despachort')
                  <li class="nav-item">
                    <a href="{{route('despacho.index')}}" class="nav-link">
                      <i class="fas fa-dumpster"></i>
                      <p>                        
                        Despacho
                      </p>
                    </a>
                  </li> 
                  @endcan
                  @can('au-sub-reportedespacho')
                  <li class="nav-item">
                    <a href="{{route('reportedomiciliario.index')}}" class="nav-link">
                      <i class="fas fa-print"></i>
                      <p>                        
                        Reporte
                      </p>
                    </a>
                  </li> 
                  @endcan
                
              </ul>
            </li>
            @endcan
            @can('au-opcion-barrido')
            <li class="nav-item has-treeviewe">
              <a href="#" class="nav-link active">
                <i class="fas fa-broom"></i>
                <p>
                  R.T. Barrido
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">     
                  @can('au-sub-rutabarrido')

                  <li class="nav-item">
                    <a href="{{route('barridoruta.index')}}" class="nav-link">
                      <i class="fas fa-route"></i>
                      <p>
                        Rutas
                      </p>
                    </a>
                  </li>
                  @endcan
                  @can('au-sub-despachobarrido')
                  <li class="nav-item">
                    <a href="{{route('barridodespacho.index')}}" class="nav-link">
                      <i class="fas fa-dumpster"></i>
                      <p>
                        Despacho
                      </p>
                    </a>
                  </li>  
                  @endcan
                  
                
                  
              </ul>
            </li>
          @endcan
          @can('au-opcion-gestionreclamo')
            <li class="nav-item has-treeviewe">
              <a href="#" class="nav-link active">
                <i class="fas fa-headset"></i>
                <p>
                  Gestion Reclamos
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              @can('au-sub-reclamos')
                <ul class="nav nav-treeview">                 
                  <li class="nav-item">
                    <a href="{{route('reclamo.index')}}" class="nav-link">
                      <i class="fas fa-phone-volume"></i>
                      <p>
                        Reclamos
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('reportereclamo.index')}}" class="nav-link">
                      <i class="fas fa-print"></i>
                      <p>                        
                        Reporte
                      </p>
                    </a>
                  </li> 
                </ul>
              @endcan
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
