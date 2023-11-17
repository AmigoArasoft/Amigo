<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">{{ $accion }} material</h3>
    </div>
    @if($accion == 'Nuevo')
        {!! Form::open(['route' => 'material.crear', 'class' => 'form-horizontal']) !!}
    @elseif ($accion == 'Editar')
        {!! Form::model($dato, ['route' => ['material.editar', $dato->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
    @endif
    <div class="card-body">
        @include('mina.administracion.material.campo')
    </div>
    <div class="card-footer">
        @include('mina.administracion.material.boton')
    </div>
    @if($accion == 'Nuevo' || $accion == 'Editar')
        {!! Form::close() !!}
    @endif
</div>
@if($accion == 'Editar')
    @include('mina.administracion.material.tablaUno')
@endif