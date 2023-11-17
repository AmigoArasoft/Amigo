@extends('plantilla.mina.index')

@section('titulo', 'Parámetros')

@section('vinculo')
<li class="breadcrumb-item"><a href="{{ route('/') }}">Inicio</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')
@isset($accion)
	@include('mina.administracion.parametro.forma')
@else
    @include('mina.administracion.parametro.tabla')
@endisset
@endsection

@section('codigo')
@if(!isset($accion))
	@include('mina.administracion/parametro/js')
@endif
@endsection