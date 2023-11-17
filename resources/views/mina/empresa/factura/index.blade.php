@extends('plantilla.mina.index')

@section('titulo', 'Informes')

@section('vinculo')
<li class="breadcrumb-item"><a href="{{ route('/') }}">Inicio</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')
@isset($accion)
	@include('mina.empresa.factura.forma')
@else
    @include('mina.empresa.factura.tabla')
@endisset
@endsection

@section('codigo')
@if(!isset($accion))
	@include('mina.empresa/factura/js')
@else
	@include('mina.empresa/factura/jsUno')
@endif
@endsection