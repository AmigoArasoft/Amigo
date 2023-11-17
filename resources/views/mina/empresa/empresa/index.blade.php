@extends('plantilla.mina.index')

@section('titulo', 'Empresa')

@section('vinculo')
<li class="breadcrumb-item"><a href="{{ route('/') }}">Inicio</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')
@include('mina.empresa.empresa.forma')
@endsection

@section('codigo')
@include('mina.empresa/empresa/js')
@endsection