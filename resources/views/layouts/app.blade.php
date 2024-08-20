<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gestão Estoque e Nfe</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('img/entregavel.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('css/login/style.css') }}">
</head>
<body>
    <div id="app">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-11 col-lg-8">
                        <div class="row">
                            <div class="col-1 col-md-4 col-lg-6 position-relative">
                                <div class="bg"></div>
                            </div>
                            <div class="col-11 col-md-8 col-lg-6">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </main>
    </div>
</body>
</html>
