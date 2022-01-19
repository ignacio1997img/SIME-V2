<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

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
</head>
<body>
    <div class="container-responsive abs-center" id="app">
        <main id="colormodal">
            @yield('content')
        </main>
    </div>
</body>
</html>
