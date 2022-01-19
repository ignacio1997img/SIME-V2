@extends('Layout.HomeAseoUrbano')
@section('content')

    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-road"></i> Calles</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('aseourbano')}}">Home</a></li>       
              <li class="breadcrumb-item active">Calles</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>



    <div class="container" style="width: 80%">
        <div style="padding-bottom: 5px;">
            <a class="btn btn-warning" data-toggle="tooltip" href="{{route('aseourbano')}}" title="Volver al menu principal">
                <i class="fas fa-arrow-alt-circle-left"></i>
                Volver
            </a>  
            @can('au-calles.store')      
                <a class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar" title="Registrar Nuevo Dsitrito">
                    <i class="fas fa-plus"></i>
                    Registrar
                </a>
            @endcan
        </div>
        <div class="card table-responsive card-outline card-info">
            <div class="card-header">
                <div>
                    <th>
                    <h4 class="card-title text-center ">
                    LISTA DE CALLES
                    </h4>
                    </th>
                </div>
            </div>
            <div class="card-body" >
                <table class="table table-bordered table-hover table-sm" id="example2">
                    <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">CALLE</th>
                        <th class="text-center">BARRIO</th>                       
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($calles as $calle)
                        <tr>
                            <td style="text-transform:uppercase;">{{$calle->id}}</td>
                            <td style="text-transform:uppercase;">{{$calle->calle}}</td>
                            <td style="text-transform:uppercase;">{{$calle->barrio}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

         <!-- The Modal Registrar-->
<div class="modal fade" id="modalRegistrar">
    <div class="modal-dialog">s
        <div class="modal-content">        
            <!-- Modal Header -->
            <div class="modal-header bg-success">
                <h4 class="modal-title">Registrar Calle</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
            {!! Form::open(['route' => 'calle.store', 'class' => 'was-validated'])!!}
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Barrios</b></span>
                    </div>
                    <select class="form-control custom-select rounded-0" name="barrio_id" id="barrio_id" style="text-transform:uppercase" required>
                        <option value="">Seleccione un barrio..</option>
                        @foreach($barrios as $bar)
                            <option value="{{$bar->id}}">{{$bar->descripcion}}</option>
                        @endforeach    
                    </select>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><b>Calle</b></span>
                    </div>
                    <input type="text" id="calle" name="calle" class="form-control" style="text-transform:uppercase" minlength="3" maxlength="100" required>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>Descripcion</b></span>
                    </div>
                    <textarea class="form-control" rows="3" name="descripcion" id="descripcion" style="text-transform:uppercase"></textarea>
                    <div class="invalid-feedback">Debes Ingresar datos</div>
                    <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
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