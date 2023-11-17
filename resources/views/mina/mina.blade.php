@extends('plantilla.mina.index')

@section('titulo', 'Inicio')

@section('vinculo')
<li class="breadcrumb-item active">Inicio</li>
@endsection

@section('contenido')
<div class="card card-widget widget-user">
	<div class="widget-user-header bg-info">
        <div class="widget-user-image" style="margin-left: -100px;">
            <img style="width: 200px;" class="img-rounded elevation-2 bg-dark" src="{{ asset('img/logo_letras_blancas.png') }}" alt="Villa Ufaz">
        </div>
    	<h1 class="widget-user-username">AMIGO</h1>
    	<h5 class="widget-user-desc">GARZÓN ROMERO G. SAS</h5>
    </div>
    <div class="card-footer text-center p-5">
        <p style="color: #186A3B; font-size: 300%;"><b>AMIGO</b></p>
  		<p style="font-size: 200%;"><b style="color: #186A3B;">A</b>plicación <b style="color: #186A3B;">MI</b>nera <b style="color: #186A3B;">G</b>arzón R<b style="color: #186A3B;">O</b>mero</p>
    </div>
</div>
@endsection