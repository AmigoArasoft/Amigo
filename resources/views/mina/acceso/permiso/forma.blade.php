<div class="card {{ ($accion == 'Borrar') ? 'card-danger' : 'card-info' }}">
    <div class="card-header">
        <h3 class="card-title">{{ $accion }} permiso</h3>
    </div>
    @if($accion == 'Nuevo')
        {!! Form::open(['route' => 'permiso.crear', 'class' => 'form-horizontal']) !!}
    @elseif ($accion == 'Editar')
        {!! Form::model($dato, ['route' => ['permiso.editar', $dato->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
    @endif
    <div class="card-body">
        @include('mina.acceso.permiso.campo')
    </div>
    <div class="card-footer">
        @include('mina.acceso.permiso.boton')
    </div>
    @if($accion == 'Nuevo' || $accion == 'Editar')
        {!! Form::close() !!}
    @endif
</div>