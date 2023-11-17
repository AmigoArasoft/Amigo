@extends('plantilla.mina.index')

@section('titulo', 'Usuarios')

@section('vinculo')
<li class="breadcrumb-item"><a href="{{ route('/') }}">Inicio</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')
@isset($accion)
	@include('mina.acceso.usuario.forma')
@else
    @include('mina.acceso.usuario.tabla')
@endisset
@endsection

@section('codigo')
@if(!isset($accion))
	@include('mina.acceso/usuario/js')
@endif
@endsection