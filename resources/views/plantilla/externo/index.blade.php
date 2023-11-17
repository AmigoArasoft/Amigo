<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - @yield('titulo')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}"/>
    <link href="{{ asset('css/adminlte.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="layout-sidebar-fixed sidebar-collapse">
    <div class="wrapper" id="app">
        @include('plantilla.externo.encabezado')
        <div class="content-wrapper">
            @include('plantilla.externo.vinculo')
            <section class="content">
                <div class="container-fluid">
                    @yield('contenido')
                </div>
            </section>
        </div>
        @include('plantilla.webPie')
    </div>
</body>
</html>