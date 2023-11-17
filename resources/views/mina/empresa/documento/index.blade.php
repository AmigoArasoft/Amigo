@extends('plantilla.mina.index')

@section('titulo', 'Documentos')

@section('vinculo')
<li class="breadcrumb-item"><a href="{{ route('/') }}">Inicio</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')
@isset($accion)
	@include('mina.empresa.documento.forma')
@else
    @include('mina.empresa.documento.tabla')
@endisset
@endsection

@section('codigo')
@if(!isset($accion))
	@include('mina.empresa/documento/js')
@else
	@include('mina.empresa/documento/jsUno')
@endif
@endsection