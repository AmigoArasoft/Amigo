<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">{{ $accion }} viaje</h3>
    </div>
    @if($accion == 'Nuevo')
        {!! Form::open(['route' => 'viaje.crear', 'name' => 'forma']) !!}
    @elseif ($accion == 'Editar')
        {!! Form::model($dato, ['route' => ['viaje.editar', $dato->id], 'method' => 'PUT', 'name' => 'forma']) !!}
    @endif
    <div class="card-body">
        @include('mina.empresa.viaje.campo')
    </div>
    <div class="card-footer">
        @include('mina.empresa.viaje.boton')
    </div>
    @if($accion == 'Nuevo' || $accion == 'Editar')
        {!! Form::close() !!}
    @endif
</div>