<div class="card {{ ($accion == 'Borrar' && $dato->activo == 1) ? 'card-danger' : 'card-info' }}">
    <div class="card-header">
        @if ($accion != 'Borrar')
            <h3 class="card-title">{{ $accion }} usuario</h3>
        @else()
            @if ($dato->activo == 1)
                <h3 class="card-title">Inactivar usuario</h3>
            @else
                <h3 class="card-title">Activar usuario</h3>
            @endif
        @endif
    </div>
    @if($accion == 'Nuevo')
        {!! Form::open(['route' => 'usuario.crear', 'class' => 'form-horizontal']) !!}
    @elseif ($accion == 'Editar')
        {!! Form::model($dato, ['route' => ['usuario.editar', $dato->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
    @endif
    <div class="card-body">
        @include('mina.acceso.usuario.campo')
    </div>
    <div class="card-footer">
        @include('mina.acceso.usuario.boton')
    </div>
    @if($accion == 'Nuevo' || $accion == 'Editar')
        {!! Form::close() !!}
    @endif
</div>