@extends('plantilla.mina.index')

@section('titulo', 'Materiales')

@section('vinculo')
<li class="breadcrumb-item"><a href="{{ route('/') }}">Inicio</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')
    <livewire:app-administracion-material-component />
@endsection

@section('codigo')
<script>
    window.livewire.on('alert', param => {
        toastr[param['type']](param['message']);
    });
</script>
@endsection