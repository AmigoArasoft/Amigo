<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">{{ $accion }} tema</h3>
    </div>
    @if($accion == 'Nuevo')
        {!! Form::open(['route' => 'tema.crear', 'class' => 'form-horizontal']) !!}
    @elseif ($accion == 'Editar')
        {!! Form::model($dato, ['route' => ['tema.editar', $dato->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
    @endif
    <div class="card-body">
        @include('mina.administracion.tema.campo')
    </div>
    <div class="card-footer">
        @include('mina.administracion.tema.boton')
    </div>
    @if($accion == 'Nuevo' || $accion == 'Editar')
        {!! Form::close() !!}
    @endif
</div>
@if($accion == 'Editar')
    @include('mina.administracion.tema.tablaUno')
@endif