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
        <small class="brand-text font-weight-light"><b>ADMINISTRACION DEL SISTEMA</b></small>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @can('adm-opcion-empresa')
              <li class="nav-item has-treeview">              
                <a href="#" class="nav-link active  bg-warning">
                  <i class="fas fa-city"></i>
                  <p>
                    Empresa
                    <i class="right fa fa-angle-left"></i>
                  </p>
                </a>                 
                <ul class="nav nav-treeview"> 
                  @can('adm-sub-grupoempresa')               
                    <li class="nav-item">
                      <a href="{{route('grupoempresa.index')}}" class="nav-link">
                        <i class="far fa-object-ungroup"></i>
                        <p>Grupo Empresas</p>
                      </a>
                    </li>
                  @endcan  

                  @can('adm-sub-subgrupoempresa')
                    <li class="nav-item">
                      <a href="{{route('subgrupo.index')}}" class="nav-link">
                        <i class="far fa-object-group"></i>
                        <p>Subgrupo Empresas</p>
                      </a>
                    </li>
                  @endcan 

                  @can('adm-sub-rubroempresa')
                    <li class="nav-item">
                      <a href="{{route('rubro.index')}}" class="nav-link">
                        <i class="fas fa-tasks"></i>
                        <p>Rubro Empresas</p>
                      </a>
                    </li>
                  @endcan
                  @can('adm-sub-empresas')
                    <li class="nav-item">
                      <a href="{{route('empresa.index')}}" class="nav-link">
                        <i class="fas fa-building"></i>
                        <p>Empresas</p>
                      </a>
                    </li>  
                  @endcan                
                </ul>
              </li>
            @endcan

            @can('adm-opcion-recursohumano')
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link active bg-warning">
                  <i class="fas fa-user-friends"></i>
                  <p>
                    Recursos Humanos
                    <i class="right fa fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  @can('adm-sub-personas') 
                    <li class="nav-item">
                      <a href="{{route('persona.index')}}" class="nav-link">
                        <i class="fas fa-users"></i>
                        <p>Personas</p>
                      </a>
                    </li>
                  @endcan

                  @can('adm-sub-areas') 
                    <li class="nav-item">
                      <a href="{{route('area.index')}}" class="nav-link">
                        <i class="fas fa-sitemap"></i>
                        <p>Areas</p>
                      </a>
                    </li>
                  @endcan

                  @can('adm-sub-tipos')
                    <li class="nav-item">
                      <a href="{{route('tipocargo.index')}}" class="nav-link">
                        <i class="fas fa-user-tag"></i>
                        <p>Tipos de Cargos</p>
                      </a>
                    </li>
                  @endcan

                  @can('adm-sub-cargos')
                    <li class="nav-item">
                      <a href="{{route('cargo.index')}}" class="nav-link">
                      <i class="fas fa-id-card-alt"></i>
                        <p>Cargos</p>
                      </a>
                    </li>
                  @endcan
                  @can('adm-sub-funcionarios')
                    <li class="nav-item">
                      <a href="{{route('funcionario.index')}}" class="nav-link">
                        <i class="fas fa-user-tie"></i>
                        <p>Funcionario</p>
                      </a>
                    </li>
                  @endcan
                  
                  @can('adm-sub-reemplazo')
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
            
            @can('adm-opcion-getionusuario')
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link active bg-warning">
                  <i class="fas fa-user-cog"></i>
                  <p>
                    Gestion De Usuario
                    <i class="right fa fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  @can('adm-sub-usuarios')
                    <li class="nav-item">
                      <a href="{{ route('user.index') }}" class="nav-link">
                        <i class="fas fa-users"></i>
                        <p>Usuarios</p>
                      </a>
                    </li> 
                  @endcan               
                </ul>
              </li>
            @endcan            

            @can('adm-opcion-documentacion')
              <li class="nav-item has-treeview">            
                <a href="#" class="nav-link active bg-warning">
                  <i class="far fa-file-alt"></i>
                  <p>
                    Documentacion
                    <i class="right fa fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  @can('adm-sub-tipodocumentacion')
                    <li class="nav-item">
                      <a href="{{route('tipo_doc.index')}}" class="nav-link">
                        <i class="fas fa-file-contract"></i>
                        <p>Tipo de Documento</p>
                      </a>
                    </li>
                  @endcan
                </ul>            
              </li>
            @endcan

            @can('adm-opcion-sistemas')
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link active bg-warning">
                <i class="fas fa-desktop"></i>
                <p>
                  Sistema
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @can('adm-sub-modulos')
                  <li class="nav-item">
                    <a href="{{route('modulo.index')}}" class="nav-link">
                      <i class="fas fa-cubes"></i>
                      <p>Modulos</p>
                    </a>
                  </li>
                @endcan

                @can('adm-sub-opciones')
                  <li class="nav-item">
                    <a href="{{route('opciones.index')}}" class="nav-link">
                      <i class="far fa-list-alt"></i>
                      <p>Opciones</p>
                    </a>
                  </li>
                @endcan

                @can('adm-sub-subopciones')
                  <li class="nav-item">
                    <a href="{{route('subopciones.index')}}" class="nav-link">
                      <i class="far fa-list-alt"></i>
                      <p>Sub Opciones</p>
                    </a>
                  </li>
                @endcan

                @can('adm-sub-permisos')
                  <li class="nav-item">
                    <a href="{{ route('permiso.index') }}" class="nav-link">
                      <i class="far fa-id-card"></i>
                      <p>Permisos</p>
                    </a>
                  </li>
                @endcan

                @can('adm-sub-roles')
                  <li class="nav-item">
                    <a href="{{ route('role.index') }}" class="nav-link">
                      <i class="fas fa-id-card-alt"></i>
                      <p>Roles</p>
                    </a>
                  </li>
                @endcan      
                @can('adm-sub-roles')
                  <li class="nav-item">
                    <a href="{{ route('designacionsistema.index') }}" class="nav-link">
                      <i class="fab fa-ubuntu"></i>
                      <p>Designaciones</p>
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
