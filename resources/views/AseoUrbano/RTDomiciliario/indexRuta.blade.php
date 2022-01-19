@extends('Layout.HomeAseoUrbano')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-route"></i> Rutas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('aseourbano')}}">Home</a></li>       
              <li class="breadcrumb-item active">Rutas</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container">
   <div style="padding-bottom: 5px;">
      <a class="btn btn-warning" data-toggle="tooltip" href="" title="Volver al menu principal">
         <i class="fas fa-arrow-alt-circle-left" style="width:20; height:20;"></i>
         Volver
      </a>
      @can('au-rutas.store')
        <a class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar" title="Registrar Ruta">
          <i class="fas fa-plus">
          </i>
          Registrar
        </a>
      @endcan
   </div>
   <div class="card table-responsive card-outline card-info">
      <div class="card-header">
         <div>
            <th>
               <h4 class="card-title text-center ">
               LISTA DE RUTAS
               </h4>
            </th>
         </div>
      </div>
      <div class="card-body" >
         <table class="table table-bordered table-hover table-sm" id="example2">
            <thead>
               <tr>
                  <th class="text-center" width="50">ID</th>
                  <th class="text-center">RUTA</th> 
                  <th class="text-center">TURNO</th> 
                  <th class="text-center">FRECUENCIA</th> 
                  @can('au-rutas.kardex')
                    <th class="text-center"></th> 
                  @endcan                            
               </tr>
            </thead>
            <tbody>
                @foreach($rutas as $ruta)
                    <tr style="text-transform:uppercase">
                        <td class="text-center">{{$ruta->id}}</td>
                        <td class="text-center">{{$ruta->descripcion}}</td>
                        <td class="text-center">{{$ruta->turno}}</td>
                        <?php 
                            $aux = '';
                            $cadena='';
                        ?>
                        @foreach($frecuencias as $fre)
                            @if($ruta->id == $fre->id) 
                                <?php 
                                    $aux =$aux.' '.$fre->nombre.' - ';
                                ?>
                            @endif  
                        @endforeach  
                        <?php 
                            for($i=0; $i< (strlen($aux)-2); $i++)
                            {
                                $cadena = $cadena.$aux[$i];
                            }
                        ?>
                        <td >{{$cadena}}</td>
                        @can('au-rutas.kardex')
                        <td class="text-center" style="width: 5%">
                            
                            <a class="btn btn-primary" data-toggle="tooltip" href="{{route('au-rutas.kardex', $ruta->id)}}" title="Ver Informacion">
                                <i class="fas fa-file-image"></i>
                            </a>
                        </td>
                        @endcan
                    </tr> 
                @endforeach              
            </tbody>
         </table>
      </div>
   </div>
</div>


<div class="modal fade" id="modalRegistrar">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success">
          <h4 class="modal-title">Registrar Ruta</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'ruta.store', 'class' => 'was-validated', 'enctype' => 'multipart/form-data'])!!}
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Nombre</b></span>
                </div>
                <input type="text" id="descripcion" name="descripcion" class="form-control" style="text-transform:uppercase" required>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Turno</b></span>
                </div>
                <select class="form-control custom-select rounded-0" name="turno" required>
                    <option value="">Seleccione un turno..</option>
                    <option value="DIURNO">Diurno</option>
                    <option value="nOCTURNO">Nocturno</option>              
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Zona</b></span>
                </div>
                <select class="form-control custom-select rounded-0" name="zona_id" id="zona_id" required>
                <option value="">Seleccione una zona..</option>
                    @foreach($zonas as $zona)
                        <option value="{{$zona->id}}">{{$zona->nombre}}</option>
                    @endforeach    
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div>

            <input type="file" name="urlimg" required>
        
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