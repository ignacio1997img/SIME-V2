@extends('Layout.HomeAseoUrbano')
@section('content')

    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-dumpster"></i> Despacho Barrido</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('aseourbano')}}">Home</a></li>       
              <li class="breadcrumb-item active">Barrido Despacho</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

<div class="container-fluid">
  <div class="card">
    <div class="card-header bg-secondary">
      <div class="row">
        <div class="col-6">
          <h3>            
            <b>Despacho Barrido</b>
          </h3>
        </div>
        @if($cant == 0)
          <div class="col-6">
            <div class="dropdown dropleft float-right">
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar">
                <i class="fas fa-plus"></i>
                Nuevo
              </button>
            </div>
          </div>
        @endif
      </div> 
    </div>
    <div class="card-body">
      <table id="example2" class="table table-md table-bordered table-hover table-striped">
        <thead>
          <tr>
            <th class="text-center">ID</th>
            <th class="text-center">FECHA</th>
            <th class="text-center">ESTADO</th>
            <th class="text-center">OBSERVACION</th>
            <th class="text-center">OPCIONES</th>
          </tr>
        </thead>
        <tbody>
            @foreach($despachos as $despacho)
                <tr>
                    <td>{{$despacho->id}}</td>
                    <td>{{\Jenssegers\Date\Date::parse($despacho->fecha)->format('l j F Y')}}</td>
                    <td>
                        @if($despacho->estado == 1)
                            <span class="badge badge-danger">Abierto</span>
                        @else
                            <span class="badge badge-success">Cerrado</span>
                        @endif
                    </td>
                    <td>{{$despacho->observacion}}</td>
                    <td class="text-center" style="width: 5%">
                        <div class="container">
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                    <i class="fas fa-cogs"></i>
                                    Acciones
                                </button>
                                <div class="dropdown-menu">
                                  
                                    <a class="dropdown-item" href="{{route('au-rtbarrido.despacho.viewdespachodetalle', $despacho->id)}}">Rutas</a>
                                  
                                    @if($despacho->estado == 0)
                                      <a class="dropdown-item" href="{{route('au-rtbarrido.despacho.despacho.printf', $despacho->id)}}">Imprimir</a> 
                                    @endif     
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach        
        </tbody>
      </table>
    </div>
  </div>
</div>

  <!-- The Modal Registrar-->
  <div class="modal fade" id="modalRegistrar">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success">
          <h4 class="modal-title">Registrar Despacho</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            {!! Form::open(['route' => 'barridodespacho.store', 'class' => 'was-validated'])!!}
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Fecha</b></span>
                    </div>
                    <input type="date" class="form-control" id="fecha"  name="fecha" required>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Observacion</b></span>
                    </div>
                    <textarea class="form-control" rows="3" name="observacion" id="observacion" style="text-transform:uppercase"></textarea>
                    <div class="valid-feedback">¡Campo opcional!</div>
                </div>
        
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer justify-content-between">
          <button type="button text-left" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip" title="Volver al Listado">Cancelar
          </button>
          <button type="submit" class="btn btn-success btn-sm" title="Continuar">
          Guardar
        </button>
        </div>
        {!! Form::close()!!} 
        
      </div>
    </div>
</div>



@endsection