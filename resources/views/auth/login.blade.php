@extends('layouts.app')

@section('content')

<div class="conatiner-fluid conatiner-responsive">

                <div class="card-header text-center"  style="background-color:rgba(255, 215, 0, 0.6);"><b> {{ __('INGRESAR') }}</b></div>

                <div class="card-body" style="background-color:rgba(255, 215, 0, 0.5);">
                    <form class="border p-3 form" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label"><b>{{ __('Usuario')}}</b></label>

                            <div class="col-md-10">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-2 col-form-label"><b>{{ __('Contraseña')}}</b></label>

                            <div class="col-md-10">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row" id="div_modulo">
                            <label for="password" class="col-md-2 col-form-label"><b>{{ __('Modulo')}}</b></label>
                            <div class="col-md-10">
                                <select class="form-control custom-form {{ $errors->has('modulo') ? ' is-invalid' : '' }}" name="modulo" id="modulo">
                                </select>
                                @if ($errors->has('modulo'))
                                    <span class="invalid-feedback" role="alert" style="color:#f5faf9;">
                                        <strong>{{ $errors->first('modulo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ingresar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div> 
</div>   
<!-- <example-component/>   -->

<script type="text/javascript">

        $(function () {
            $('#email').on('change', onselect);
        });

        function onselect() {
            
            var usuario = $(this).val();
            
            if (usuario != '') {
                
                $.get('{{route('select_modulo')}}/' + usuario, function (data) {
                    
                    // console.log(data);//
                    if (data!='' && usuario != '') {
                        var html_select = '<option value = ""> Seleccione el Modulo</option>';
                        for (var i = 0; i < data.length; ++i)
                            html_select += '<option value="' + data[i].nombre + '">' + data[i].nombre + '</option>';
                        $('#modulo').html(html_select).css("color", "#000000");
                    } else {
                        var html_select = '<option value = ""> Usuario no Autorizado</option>';
                        $('#modulo').html(html_select).css("color", "red");
                    }
                });
            } 
            else {
                $('select > option').remove();
                $('#modulo').css("color", "#000000");
            }

        }
</script>








@endsection