@extends('Layout.HomeAseoUrbano')
@section('content')

<div class="content-header">
    <div>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-print"></i> Reportes</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('aseourbano')}}">Home</a></li>       
                    <li class="breadcrumb-item active">Reportes</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

    <div class="container">
{!! Form::open(['route' => 'au-reportes.reporteconstructor','class' => 'was-validated']) !!}
  
             
        <div class="card table-responsive card-outline card-info">
            <div class="card-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6">
                            <h4>CONSTRUCTOR DE REPORTES</h4>
                        </div>
                        <div class="input-group mb-2 col-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>Opcion</b></span>
                            </div>
                            <select class="form-control custom-select rounded-0" name="opcion" id="opcion" style="text-transform:uppercase" required>
                                <option value="">Seleccione una Opcion..</option>
                                <option value="1">Distritos</option>
                                <option value="2">Barrio</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                
                    <div class="input-group mb-2" id="tipo">
                        <!-- distrito/barrio -->
                    </div>
                    <div class="input-group mb-2" id="segunda">
                        
                    </div>  
                
                <div class="input-group mb-2 col-6" id="segunda1">
                        
                </div>  

            </div>
            <div class="card-footer">
                <div class="modal-footer justify-content-between">
                    <a class="btn btn-warning" data-toggle="tooltip" href="{{route('aseourbano')}}" title="Volver al menu principal">
                        <i class="fas fa-arrow-alt-circle-left"></i>
                        Volver
                    </a> 

                    <button type="submit" class="btn btn-success btn-sm" title="Continuar">
                        Generar
                    </button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}


<script type="text/javascript">
 var html_dist=''
 var html_rad=''
 var html_barrio=''
 var select_barrio=''
    

    $(function()
    {
        $('#opcion').on('change', onselect_opcion);

    });

    function onselect_opcion()
    {
        var op =  $(this).val();
    
        if(op == 1)
        {
            html_barrio=''
            $('#segunda').html(html_barrio);
            html_rad1=''
            $('#segunda1').html(html_rad1);
            div_distrito(1)
        }
        else
        {
            if(op == 2)
            {
                div_distrito(2)
                // html_rad=''
                // $('#segunda').html(html_rad);
                html_rad1=''
                $('#segunda1').html(html_rad1);
                div_barrio()

            }
            else
            {

                html_dist=''
                $('#tipo').html(html_dist);
                // html_rad=''
                // $('#segunda').html(html_rad);
                html_barrio=''
                $('#segunda').html(html_barrio);
                html_rad1=''
                $('#segunda1').html(html_rad1);
            }
        }
    }
    function div_distrito(x)
    {
        html_dist =     '<div class="input-group-prepend">'
        html_dist+=         '<span class="input-group-text"><b>Distrito</b></span>'
        html_dist+=     '</div>'
        html_dist+=     '<select class="form-control custom-select rounded-0" name="distrito_id" id="distrito_id" style="text-transform:uppercase" required>'
        html_dist+=     '<option value="">Seleccione un distrito..</option>'
        html_dist+=         '<option value="TODOS">TODOS</option>'
        html_dist+=         '@foreach($distritos as $dist)'
        html_dist+=             '<option value="{{$dist->id}}">{{$dist->descripcion}}</option>'
        html_dist+=         '@endforeach'    
        html_dist+=     '</select>'
        html_dist+=     '<div class="invalid-feedback">Debes Ingresar datos</div>'
        html_dist+=     '<div class="valid-feedback">¡Se esta Ingresando Datos!</div>'
        $('#tipo').html(html_dist);
        if(x == 1)
        {
            $('#distrito_id').on('change', div_radio);            
        }
        else
        {
            $('#distrito_id').on('change', onselect_barrio);
        }
    }
   

    function div_barrio()
    {

        html_barrio =     '<div class="input-group-prepend">'
        html_barrio+=         '<span class="input-group-text"><b>Barrio</b></span>'
        html_barrio+=     '</div>'
        html_barrio+=     '<select class="form-control custom-select rounded-0" name="barrio_id" id="barrio_id" style="text-transform:uppercase" required>'

        html_barrio+=     '</select>'
        html_barrio+=     '<div class="invalid-feedback">Debes Ingresar datos</div>'
        html_barrio+=     '<div class="valid-feedback">¡Se esta Ingresando Datos!</div>'
        $('#segunda').html(html_barrio);

        $('#barrio_id').on('change', div_radio1);
    }



    function div_radio1()
    {        
        var op =  $(this).val();

        if(op == 'TODOS1')
        {
            html_rad1 =      '<div class="form-group row">'
            html_rad1+=          '<label>Contacto:&nbsp; </label>'
            html_rad1+=          '<div class="custom-control custom-radio">'
            html_rad1+=              '<input class="custom-control-input" type="radio" value="1" id="customRadio1" name="contacto">'
            html_rad1+=              '<label for="customRadio1" class="custom-control-label text-dark">Si&nbsp;</label>'
            html_rad1+=          '</div>'
            html_rad1+=          '<div class="custom-control custom-radio">'
            html_rad1+=              '<input class="custom-control-input" type="radio" value="0" id="customRadio2" name="contacto" checked>'
            html_rad1+=              '<label for="customRadio2" class="custom-control-label text-dark">No</label>'
            html_rad1+=      '</div>'  
        }
        else
        {
            html_rad1=''
        }
        $('#segunda1').html(html_rad1);
    }
    function onselect_barrio()
    {
        var distrito =  $(this).val();    

        if(distrito >=1 || distrito === 'TODOS')
        {
          $.get('{{route('selectajaxbarrios')}}/'+distrito, function(data){
                if(data != '')
                {
                    select_barrio=    '<option value="">Seleccione un barrio..</option>'
                    select_barrio+=   '<option value="TODOS1">TODOS</option>'
                    for(var i=0; i<data.length; ++i)
                    select_barrio += '<option value="'+data[i].id+'">'+data[i].descripcion+'</option>'
                    $('#barrio_id').html(select_barrio).css("color", "black")       
                }
                else
                {
                    select_barrio=    '<option value="">SIN REGISTRO</option>'
                    $('#barrio_id').html(select_barrio).css("color", "red")
                    
                }                
          });
          html_rad1=''
            $('#segunda1').html(html_rad1);
        }
        else
        {
          select_barrio=    ''       
          $('#barrio_id').html(select_barrio);
          html_rad1=''
            $('#segunda1').html(html_rad1);
        }
    };





</script>

@endsection