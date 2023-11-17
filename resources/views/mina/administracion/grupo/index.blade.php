@extends('plantilla.mina.index')

@section('titulo', 'Grupos')

@section('vinculo')
<li class="breadcrumb-item"><a href="{{ route('/') }}">Inicio</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')
@isset($accion)
	@include('mina.administracion.grupo.forma')
@else
    @include('mina.administracion.grupo.tabla')
@endisset
@endsection

@section('codigo')
@if(!isset($accion))
	@include('mina.administracion/grupo/js')
@elseif($accion == 'Editar')
	@include('mina.administracion/grupo/jsUno')
@endif
@endsection