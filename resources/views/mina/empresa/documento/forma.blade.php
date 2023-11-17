<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">{{ $accion }} documento</h3>
    </div>
    @if($accion == 'Nuevo')
        {!! Form::open(['route' => 'documento.crear', 'name' => 'forma', 'files' => true]) !!}
    @elseif ($accion == 'Editar')
        {!! Form::model($dato, ['route' => ['documento.editar', $dato->id], 'method' => 'PUT', 'name' => 'forma', 'files' => true]) !!}
    @endif
    <div class="card-body">
        @include('mina.empresa.documento.campo')
    </div>
    <div class="card-footer">
        @include('mina.empresa.documento.boton')
    </div>
    @if($accion == 'Nuevo' || $accion == 'Editar')
        {!! Form::close() !!}
    @endif
</div>