<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">{{ $accion }} parámetro</h3>
    </div>
    @if($accion == 'Nuevo')
        {!! Form::open(['route' => 'parametro.crear', 'class' => 'form-horizontal']) !!}
    @elseif ($accion == 'Editar')
        {!! Form::model($dato, ['route' => ['parametro.editar', $dato->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
    @endif
    <div class="card-body">
        @include('mina.administracion.parametro.campo')
    </div>
    <div class="card-footer">
        @include('mina.administracion.parametro.boton')
    </div>
    @if($accion == 'Nuevo' || $accion == 'Editar')
        {!! Form::close() !!}
    @endif
</div>