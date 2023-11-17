<div class="card {{ ($accion == 'Borrar') ? 'card-danger' : 'card-info' }}">
    <div class="card-header">
        <h3 class="card-title">{{ $accion }} rol</h3>
    </div>
    @if($accion == 'Nuevo')
        {!! Form::open(['route' => 'rol.crear', 'class' => 'form-horizontal']) !!}
    @elseif ($accion == 'Editar')
        {!! Form::model($dato, ['route' => ['rol.editar', $dato->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
    @endif
    <div class="card-body">
        @include('mina.acceso.rol.campo')
    </div>
    <div class="card-footer">
        @include('mina.acceso.rol.boton')
    </div>
    @if($accion == 'Nuevo' || $accion == 'Editar')
        {!! Form::close() !!}
    @endif
</div>