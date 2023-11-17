@extends('plantilla.mina.index')

@section('titulo', 'Materiales')

@section('vinculo')
<li class="breadcrumb-item"><a href="{{ route('/') }}">Inicio</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')
@isset($accion)
	@include('mina.administracion.material.forma')
@else
    @include('mina.administracion.material.tabla')
@endisset
@endsection

@section('codigo')
@if(!isset($accion))
	@include('mina.administracion/material/js')
@elseif($accion == 'Editar')
	@include('mina.administracion/material/jsUno')
@endif
@endsection