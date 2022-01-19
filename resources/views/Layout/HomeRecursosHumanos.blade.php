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
      <a href="{{route('administracion')}}" class="brand-link text-center">
        <img src="{{ asset('dist/img/Emaut.ico')}}" width="80" height="40"><br>
        <small class="brand-text font-weight-light"><b>RECURSOS HUMANOS</b></small>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              @can('rrhh-opcion-estructuraempresa')
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link active bg-warning">
                  <i class="fas fa-user-friends"></i>
                  <p>
                    Estructura Empresa
                    <i class="right fa fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">                
                  @can('rrhh-sub-areas') 
                    <li class="nav-item">
                      <a href="{{route('area.index')}}" class="nav-link">
                        <i class="fas fa-sitemap"></i>
                        <p>Areas</p>
                      </a>
                    </li>
                  @endcan

                  @can('rrhh-sub-tipos')
                    <li class="nav-item">
                      <a href="{{route('tipocargo.index')}}" class="nav-link">
                        <i class="fas fa-user-tag"></i>
                        <p>Tipos de Cargos</p>
                      </a>
                    </li>
                  @endcan

                  @can('rrhh-sub-cargos')
                    <li class="nav-item">
                      <a href="{{route('cargo.index')}}" class="nav-link">
                      <i class="fas fa-id-card-alt"></i>
                        <p>Cargos</p>
                      </a>
                    </li>
                  @endcan
                </ul>
              </li>
              @endcan
              @can('rrhh-opcion-funcionarios')
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link active bg-warning">
                  <i class="fas fa-user-friends"></i>
                  <p>
                    Funcionarios
                    <i class="right fa fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  @can('rrhh-sub-personas') 
                    <li class="nav-item">
                      <a href="{{route('persona.index')}}" class="nav-link">
                        <i class="fas fa-users"></i>
                        <p>Personas</p>
                      </a>
                    </li>
                  @endcan
                  @can('rrhh-sub-funcionarios')
                    <li class="nav-item">
                      <a href="{{route('funcionario.index')}}" class="nav-link">
                        <i class="fas fa-user-tie"></i>
                        <p>Funcionario</p>
                      </a>
                    </li>
                  @endcan
                  
                  @can('rrhh-sub-reemplazo')
                    <li class="nav-item">
                      <a href="{{route('reemplazo.index')}}" class="nav-link">
                      <i class="fas fa-id-card"></i>
                        <p>Reemplazo</p>
                      </a>
                    </li>
                  @endcan
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
