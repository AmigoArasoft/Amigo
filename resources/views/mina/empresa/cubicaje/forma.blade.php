<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">{{ $accion }} cubicaje</h3>
    </div>
    @if($accion == 'Nuevo')
        {!! Form::open(['route' => 'cubicaje.crear', 'name' => 'forma']) !!}
    @elseif ($accion == 'Editar')
        {!! Form::model($dato, ['route' => ['cubicaje.editar', $dato->id], 'method' => 'PUT', 'name' => 'forma']) !!}
    @endif
    <div class="card-body">
        @include('mina.empresa.cubicaje.campo')
    </div>
    <div class="card-footer">
        @include('mina.empresa.cubicaje.boton')
    </div>
    @if($accion == 'Nuevo' || $accion == 'Editar')
        {!! Form::close() !!}
    @endif
</div>