@extends('plantilla.mina.index')

@section('titulo', 'Roles')

@section('vinculo')
<li class="breadcrumb-item"><a href="{{ route('/') }}">Inicio</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')
@isset($accion)
	@include('mina.acceso.rol.forma')
@else
    @include('mina.acceso.rol.tabla')
@endisset
@endsection

@section('codigo')
@if(!isset($accion))
	@include('mina.acceso/rol/js')
@endif
@endsection