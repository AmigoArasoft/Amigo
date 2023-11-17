@extends('plantilla.mina.index')

@section('titulo', 'Viajes')

@section('vinculo')
<li class="breadcrumb-item"><a href="{{ route('/') }}">Inicio</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')
@isset($accion)
	@include('mina.empresa.viaje.forma')
@else
    @include('mina.empresa.viaje.tabla')
@endisset
@endsection

@section('codigo')
@if(!isset($accion))
	@include('mina.empresa/viaje/js')
@else
	@include('mina.empresa/viaje/jsUno')
@endif
@endsection