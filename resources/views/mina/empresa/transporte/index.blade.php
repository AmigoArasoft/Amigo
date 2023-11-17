@extends('plantilla.mina.index')

@section('titulo', 'Transportadores')

@section('vinculo')
<li class="breadcrumb-item"><a href="{{ route('/') }}">Inicio</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')
@isset($accion)
	@include('mina.empresa.transporte.forma')
@else
    @include('mina.empresa.transporte.tabla')
@endisset
@endsection

@section('codigo')
@if(!isset($accion))
	@include('mina.empresa/transporte/js')
@elseif($accion == 'Editar')
	@include('mina.empresa/transporte/jsEdita')
@endif
@endsection