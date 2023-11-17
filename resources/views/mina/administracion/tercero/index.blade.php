@extends('plantilla.mina.index')

@section('titulo', 'Terceros')

@section('vinculo')
<li class="breadcrumb-item"><a href="{{ route('/') }}">Inicio</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')
@isset($accion)
	@include('mina.administracion.tercero.forma')
@else
    @include('mina.administracion.tercero.tabla')
@endisset
@endsection

@section('codigo')
@if(!isset($accion))
	@include('mina.administracion/tercero/js')
@else
	@include('mina.administracion/tercero/jsUno')
@endif
@endsection