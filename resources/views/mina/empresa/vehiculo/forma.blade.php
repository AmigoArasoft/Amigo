<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">{{ $accion }} vehículo</h3>
    </div>
    @if($accion == 'Nuevo')
        {!! Form::open(['route' => 'vehiculo.crear', 'name' => 'forma']) !!}
    @elseif ($accion == 'Editar')
        {!! Form::model($dato, ['route' => ['vehiculo.editar', $dato->id], 'method' => 'PUT', 'name' => 'forma']) !!}
    @endif
    <div class="card-body">
        @include('mina.empresa.vehiculo.campo')
    </div>
    <div class="card-footer">
        @include('mina.empresa.vehiculo.boton')
    </div>
    @if($accion == 'Nuevo' || $accion == 'Editar')
        {!! Form::close() !!}
    @endif
</div>