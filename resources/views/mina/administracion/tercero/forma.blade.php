<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">{{ $accion }} tercero</h3>
    </div>
    @if($accion == 'Nuevo')
        {!! Form::open(['route' => 'tercero.crear', 'name' => 'forma']) !!}
    @elseif ($accion == 'Editar')
        {!! Form::model($dato, ['route' => ['tercero.editar', $dato->id], 'method' => 'PUT', 'name' => 'forma']) !!}
    @endif
    <div class="card-body">
        @include('mina.administracion.tercero.campo')
    </div>
    <div class="card-footer">
        @include('mina.administracion.tercero.boton')
    </div>
    @if($accion == 'Nuevo' || $accion == 'Editar')
        {!! Form::close() !!}
    @endif
</div>