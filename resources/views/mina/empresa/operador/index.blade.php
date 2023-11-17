@extends('plantilla.mina.index')

@section('titulo', 'Operadores')

@section('vinculo')
<li class="breadcrumb-item"><a href="{{ route('/') }}">Inicio</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')
@isset($accion)
	@include('mina.empresa.operador.forma')
@else
    @include('mina.empresa.operador.tabla')
@endisset
@endsection

@section('codigo')
@if(!isset($accion))
	@include('mina.empresa/operador/js')
@elseif($accion == 'Editar')
	@include('mina.empresa/operador/jsEdita')
@endif
@endsection