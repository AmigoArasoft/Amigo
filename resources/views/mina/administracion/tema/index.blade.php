@extends('plantilla.mina.index')

@section('titulo', 'Temas')

@section('vinculo')
<li class="breadcrumb-item"><a href="{{ route('/') }}">Inicio</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')
@isset($accion)
	@include('mina.administracion.tema.forma')
@else
    @include('mina.administracion.tema.tabla')
@endisset
@endsection

@section('codigo')
@if(!isset($accion))
	@include('mina.administracion/tema/js')
@elseif($accion == 'Editar')
	@include('mina.administracion/tema/jsUno')
@endif
@endsection