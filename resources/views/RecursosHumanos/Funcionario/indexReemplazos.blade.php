@extends('Layout.HomeRecursosHumanos')
@section('content')



    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="fas fa-id-card"></i> Reemplazo</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('recursoshumanos')}}">Home</a></li>       
              <li class="breadcrumb-item active">Reemplazo</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    
<div class="container">
   <div style="padding-bottom: 5px;">
      <a class="btn btn-warning" data-toggle="tooltip" href="" title="Volver al menu principal">
         <i class="fas fa-arrow-alt-circle-left" style="width:20; height:20;">
         </i>
         Volver
      </a>
      @can('rrhh-reemplazo.store')
        <a class="btn btn-success" data-toggle="modal" data-target="#modalRegistrar" title="Registrar Reemplazo">
          <i class="fas fa-plus"></i>
          Registrar
        </a>
      @endcan
   </div>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" href="#home">Activo</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#menu1">Inactivo</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="container tab-pane active"><br>  
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center" width="30%">INTERINO</th>
            <th class="text-center" width="30%">REEMPLAZO A</th>
            <th class="text-center" width="15%">DOCUMENTO</th>
            <th class="text-center" width="8%">TIPO</th>
            <th class="text-center" width="10%">INICIO</th>
            <th class="text-center" width="10%">FIN</th>
            @can('rrhh-reemplazo.update')
              <th width="1%"></th>
            @endcan
          </tr>
        </thead>
        <tbody>
          @foreach($tabs as $tab)
            @if($tab->activo == 1)
              <tr style="text-transform:uppercase">
                <td><font size=2>{{$tab->nombre}} {{$tab->apellidopaterno}} {{$tab->apellidomaterno}} - {{$tab->cargo}}</font></td>
                <td><font size=2>{{$tab->a}}</font></td>
                <td><font size=2>{{$tab->documento}}</font></td>
                <td><font size=2>{{$tab->tipo}}</font></td>
                <td><font size=2>{{\Carbon\Carbon::parse($tab->inicio)->format('d/m/Y')}}</font></td>
                @if($tab->fin == null)
                  <td></td>
                @else
                  <td><font size=2>{{\Carbon\Carbon::parse($tab->fin)->format('d/m/Y')}}</font></td>
                @endif
                @can('rrhh-reemplazo.update')
                <td>
                  <button type="button" data-toggle="modal" data-target="#modalFinalizar" class="btn btn-primary btn-sm"
                    data-id="{{$tab->id}}" data-interino="{{$tab->nombre}} {{$tab->apellidopaterno}} {{$tab->apellidomaterno}} - {{$tab->cargo}}"
                    data-a="{{$tab->a}}" data-inicio="{{$tab->inicio}}" data-fin="{{$tab->fin}}" title="Finalizar Reemplazo">
                    Corte
                  </button>
                </td>
                @endcan
              </tr>
            @endif
          @endforeach
        </tbody>
      </table>
    </div>
    <div id="menu1" class="container tab-pane fade"><br>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center" width="25%">INTERINO</th>
            <th class="text-center" width="25%">REEMPLAZO A</th>
            <th class="text-center" width="10%">TIPO</th>
            <th class="text-center" width="10%">INICIO</th>
            <th class="text-center" width="10%">CORTE</th>
            <th class="text-center" width="10%">FIN</th>
            <th class="text-center" width="20%">OBSERVACION</th>
          </tr>
        </thead>
        <tbody>
          @foreach($tabs as $tab)
            @if($tab->activo == 0)
              <tr style="text-transform:uppercase">
                <td>
                  <font size=2>{{$tab->nombre}} {{$tab->apellidopaterno}} {{$tab->apellidomaterno}} - {{$tab->cargo}}</font>
                </td>
                <td><font size=2>{{$tab->a}}</font></td>
                <td><font size=2>{{$tab->tipo}}</font></td>
                <td><font size=2>{{\Carbon\Carbon::parse($tab->inicio)->format('d/m/Y')}}</font></td>
                <td><font size=2>{{\Carbon\Carbon::parse($tab->fins)->format('d/m/Y')}}</font></td>
                @if($tab->fin == null)
                  <td>------</td>
                @else
                  <td><font size=2>{{\Carbon\Carbon::parse($tab->fin)->format('d/m/Y')}}</font></td>
                @endif
                <td><font size=2>{{$tab->observacion}}</font></td>
              </tr>
            @endif
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>


  <!-- The Modal Registrar-->
<div class="modal fade" id="modalRegistrar">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success">
          <h4 class="modal-title">Registrar Reemplazo</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'reemplazo.store', 'class' => 'was-validated'])!!}

          <div class="input-group mb-2">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Tipo Baja</b></span>
                </div>
                <select class="form-control custom-select rounded-0" name="tipo_reemplazo" id="tipo_reemplazo" style="text-transform:uppercase" required>
                  <option value="">Seleccione una Opcion..</option>    
                  <option value="1">Baja Temporal</option>
                  <option value="2">Baja Definitivo</option>
                </select>
                <div class="invalid-feedback">Debes Ingresar datos</div>
                <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
          </div>

          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><b>Interino</b></span>
            </div>
            <select class="form-control custom-select" style="width: 60%; height: 50%; " name="funcar_id" id="funcar_id" style="text-transform:uppercase" required>
              <option value="">Seleccione.....</option>
              @foreach($personas as $persona)
                <option value="{{$persona->funcar_id}}">{{$persona->nombre}} {{$persona->apellidopaterno}} {{$persona->apellidomaterno}} - {{$persona->cargo}}</option>
              @endforeach
            </select>
            <div class="invalid-feedback">Debes Ingresar datos</div>
            <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
          </div>

          <div class="input-group" id="div_cargo">
            
              
          </div>

          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><b>Inicio</b></span>
            </div>
            <input type="date" class="form-control" id="inicio"  name="inicio" required>
            <div class="invalid-feedback">Debes Ingresar datos</div>
            <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
          </div>

          <div class="row" id="div_fin">
                            
          </div>

          <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text"><b>Documento</b></span>
              </div>
              <textarea class="form-control" rows="3" name="documento" id="documento" style="text-transform:uppercase"></textarea>
              <div class="valid-feedback">¡Campo opcional!</div>
          </div>  
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip" title="Volver al Listado">Cancelar
          </button>
          <button type="submit" class="btn btn-success btn-sm" title="Continuar">Guardar
          </button>
        </div>
        {!! Form::close()!!} 
        
      </div>
    </div>
</div>

<div class="modal fade" id="modalFinalizar">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-danger">
          <h4 class="modal-title">Finalizar Reemplazo</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        {!! Form::open(['route' => 'rrhh-reemplazo.update', 'class' => 'was-validated'])!!}

            <div class="row" style="padding: 10px;">
                
                <div class="col-2 input-group mb-2">               
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>ID</b></span>
                    </div>
                    <input type="text" class="form-control"  id="id" name="id" disabled>            
                </div>
                <input type="hidden" id="id" name="id">

                <div class="col-6"></div>
                <div class="input-group mb-2 col-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><b>INICIO</b></span>
                    </div>
                    <input type="date" class="form-control" id="inicio"   disabled>
                </div>
            </div>
            <div class="input-group mb-2" style="padding: 10px;">               
              <div class="input-group-prepend">
                <span class="input-group-text"><b>INTERINO</b></span>
              </div>
              <input type="text" class="form-control"  id="interino" style="text-transform:uppercase"disabled>            
            </div>
            <div class="input-group mb-2" style="padding: 10px;">               
              <div class="input-group-prepend">
                <span class="input-group-text"><b>REEMPLAZA A</b></span>
              </div>
              <input type="text" class="form-control"  id="a" style="text-transform:uppercase" disabled>            
            </div>
            <div class="text-center" style=" border: solid 1px; border-radius: 10px;">
              <span><b>INGRESE DATOS DE LA FINALIZACION DEL REEMPLAZO</b></span>
            </div>
     
     
          <div class="row" style="padding: 10px;">
              <div class="input-group mb-2" id="div_fin_baja">
                
                  
              </div>
              <div class=" input-group mb-2" id="div_fins">
                
                  
              </div>
          </div>

            <div class="input-group mb-2" style="padding: 10px;">
              <div class="input-group-prepend">
                <span class="input-group-text"><b>Observacion</b></span>
              </div>
              <textarea class="form-control" rows="3" name="observacion" id="observacion" style="text-transform:uppercase" required></textarea>
              <div class="invalid-feedback">Debes Ingresar datos</div>
              <div class="valid-feedback">¡Se esta Ingresando Datos!</div>
            </div> 

          
        
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer justify-content-between">
          <button type="button text-left" class="btn btn-secondary btn-sm" data-dismiss="modal" data-toggle="tooltip" title="Volver al Listado">Cancelar
          </button>
          <button type="submit" class="btn btn-danger btn-sm" title="Continuar">
          Guardar
        </button>
        </div>
        {!! Form::close()!!} 
        
      </div>
    </div>
</div>



<script type="text/javascript">
    var html_tem=''
    var html_def=''
    var html_fin=''

    var html_fin_baja=''
    var html_fins=''

    $(document).ready(function(){
      $(".nav-tabs a").click(function(){
        $(this).tab('show');
      });
    });

    $(function()
    {    
        $('#tipo_reemplazo').on('change', onselect_baja);
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        })     
        $('.select2bs5').select2({
          theme: 'bootstrap4'
        }) 
    });

    function onselect_baja()
    {
      var tipo =  $(this).val(); 

      if(tipo == 1)
      {
        div_fin()
        div_temporal();
      }
      else
      {
        if(tipo >= 2)
        {
          div_definitivo();
          html_fin=''
          $('#div_fin').html(html_fin)          
        }
        else
        {
          html_fin=''
          $('#div_fin').html(html_fin)
          html_tem=''
          $('#div_cargo').html(html_tem)
          html_def=''
          $('#div_cargo').html(html_def)
        }
      }
    };

    function div_fin()
    {
      html_fin=  '<div class="col-12">'
      html_fin+=   '<div class="input-group  ">'
      html_fin+=     '<div class="input-group-prepend">'
      html_fin+=       '<span class="input-group-text"><b>Fecha Fin</b></span>'
      html_fin+=     '</div>'
      html_fin+=     '<input type="date" class="form-control" id="fin"  name="fin" required>'
      html_fin+=     '<div class="invalid-feedback">Debes Ingresar datos</div>'
      html_fin+=     '<div class="valid-feedback">¡Se esta Ingresando Datos!</div>'
      html_fin+=   '</div>'
      html_fin+= '</div>'
      $('#div_fin').html(html_fin)
    };

    function div_temporal()
    {
      html_tem ='<div class="input-group-prepend">'
      html_tem+='<span class="input-group-text"><b>Remplazar A </b></span>'
      html_tem+='</div>'
      html_tem+='<select class="form-control custom-select" style="width: 60%; height: 50%; " name="baja_id" id="baja_id" style="text-transform:uppercase" required>'
      html_tem+=  '<option value="">Seleccione una Persona..</option>'
      html_tem+=  '@foreach($reemplazos as $reemplazo)'
      html_tem+=    '<option value="{{$reemplazo->baja_id}}">{{$reemplazo->nombre}} {{$reemplazo->apellidopaterno}} {{$reemplazo->apellidomaterno}} - {{$reemplazo->cargo}}</option>'
      html_tem+=  '@endforeach'
      html_tem+='</select>'
      html_tem+='<div class="invalid-feedback">Debes Ingresar datos</div>'
      html_tem+='<div class="valid-feedback">¡Se esta Ingresando Datos!</div>'
      $('#div_cargo').html(html_tem)
    }

    function div_definitivo()
    {
      html_def ='<div class="input-group-prepend">'
      html_def+='<span class="input-group-text"><b>Remplazar A </b></span>'
      html_def+='</div>'
      html_def+='<select class="form-control custom-select" style="width: 60%; height: 50%; " name="cargo_id" id="cargo_id" style="text-transform:uppercase" required>'
      html_def+=  '<option value="">Seleccione un Cargo...</option>'
      html_def+=  '@foreach($cargos as $cargo)'
      html_def+=    '<option value="{{$cargo->id}}">{{$cargo->nombre}}</option>'
      html_def+=  '@endforeach'
      html_def+='</select>'
      html_def+='<div class="invalid-feedback">Debes Ingresar datos</div>'
      html_def+='<div class="valid-feedback">¡Se esta Ingresando Datos!</div>'
      $('#div_cargo').html(html_def)
    }



    //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
    $('#modalFinalizar').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) //captura valor del data-empresa=""

      var id = button.data('id')
      var inicio = button.data('inicio')
      var interino = button.data('interino')
      var a = button.data('a')
      var fin = button.data('fin')
      
      var modal = $(this)

        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #inicio').val(inicio)
        modal.find('.modal-body #interino').val(interino)
        modal.find('.modal-body #a').val(a)
        
        // div_fin_enable()

        if(fin=='')
        {
          div_fin_enable()
          html_fins=''
          $('#div_fins').html(html_fins)
        }
        else
        {
          div_fin_disable()
          modal.find('.modal-body #fin').val(fin)
          div_fins()
        }
        
   
   

      
    });
    function div_fin_enable()
    {
      html_fin_baja= '<div class="input-group mb-2 col-4">'
      html_fin_baja+='<div class="input-group-prepend">'
      html_fin_baja+=   '<span class="input-group-text"><b>FIN</b></span>'
      html_fin_baja+='</div>'
      html_fin_baja+='<input type="date" class="form-control" id="fin"  name="fin" required>'
      html_fin_baja+='<div class="invalid-feedback">Debes Ingresar datos</div>'
      html_fin_baja+='<div class="valid-feedback">¡Se esta Ingresando Datos!</div>'
      html_fin_baja+='</div>'
      $('#div_fin_baja').html(html_fin_baja)
    }
    function div_fin_disable()
    {
      html_fin_baja= '<div class="input-group mb-2 col-5">'
      html_fin_baja+='<div class="input-group-prepend">'
      html_fin_baja+=   '<span class="input-group-text"><b>FIN</b></span>'
      html_fin_baja+='</div>'
      html_fin_baja+='<input type="date" class="form-control" id="fin" disabled>'
      html_fin_baja+='<div class="invalid-feedback">Debes Ingresar datos</div>'
      html_fin_baja+='<div class="valid-feedback">¡Se esta Ingresando Datos!</div>'
      html_fin_baja+='</div>'
      $('#div_fin_baja').html(html_fin_baja)
    }

    function div_fins()
    {
      html_fins= '<div class="input-group mb-2 col-5">'
      html_fins+='<div class="input-group-prepend">'
      html_fins+=   '<span class="input-group-text"><b>FINS</b></span>'
      html_fins+='</div>'
      html_fins+='<input type="date" class="form-control" id="fins"  name="fins" required>'
      html_fins+='<div class="invalid-feedback">Debes Ingresar datos</div>'
      html_fins+='<div class="valid-feedback">¡Se esta Ingresando Datos!</div>'
      html_fins+='</div>'
      $('#div_fins').html(html_fins)
    }
    
  </script>




@endsection