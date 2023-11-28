@extends('plantilla.mina.index')

@section('titulo', 'Informes')

@section('vinculo')
<li class="breadcrumb-item"><a href="{{ route('/') }}">Inicio</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')
    @include('mina.empresa.facturaAutoridades.forma')
    @include('mina.empresa.facturaAutoridades.tabla')
@endsection

@section('codigo')
	@include('mina.empresa/facturaAutoridades/js')
@endsection