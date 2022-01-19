<!DOCTYPE html>
<html lang="es">
@include('Layout.include.head')
    <style type="text/css">
        body {
            font-family: 'Roboto', sans-serif;
            background: url({{ asset('dist/img/fondo3.png')}}) no-repeat center center fixed;
            background-size: 100% 100%;
        }


        .abs-center {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .form {
            width: 550px;
        }

        
    </style>

<body>

<!-- style="background-color:rgba(255, 215, 0, 0.6);" -->
    <div class="abs-center">
        <div>
            <p><b>S</b> = Sistema</p>
            <p><b>I</b> = Integrago</p>
            <p><b>M</b> = Modular</p>
            <p><b>E</b> = EMAUT</p>
            <a class="btn btn-warning" data-toggle="tooltip" href="{{ URL::previous() }}">
                <i class="fas fa-arrow-alt-circle-left"></i>
                Volver
            </a>
        </div>
    </div>
</body>



@include('Layout.include.script')

</html>