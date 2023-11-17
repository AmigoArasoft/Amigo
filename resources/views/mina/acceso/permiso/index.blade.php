@extends('plantilla.mina.index')

@section('titulo', 'Permisos')

@section('vinculo')
<li class="breadcrumb-item"><a href="{{ route('/') }}">Inicio</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')
@isset($accion)
	@include('mina.acceso.permiso.forma')
@else
    @include('mina.acceso.permiso.tabla')
@endisset
@endsection

@section('codigo')
@if(!isset($accion))
	@include('mina.acceso/permiso/js')
@endif
@endsection