@extends('plantilla.mina.index')

@section('titulo', 'Vehículos')

@section('vinculo')
<li class="breadcrumb-item"><a href="{{ route('/') }}">Inicio</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')
@isset($accion)
	@include('mina.empresa.vehiculo.forma')
@else
    @include('mina.empresa.vehiculo.tabla')
@endisset
@endsection

@section('codigo')
@if(!isset($accion))
	@include('mina.empresa/vehiculo/js')
@else
	@include('mina.empresa/vehiculo/jsUno')
@endif
@endsection