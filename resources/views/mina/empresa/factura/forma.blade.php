<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">{{ $accion }} factura</h3>
    </div>
    <div class="card-body">
        @if($accion == 'Nuevo' || ($accion == 'Editar' && $dato->valor == 0))
            <h4 class="border-bottom">Consultar viajes</h4>
            @if ($accion == 'Nuevo')
                {!! Form::open(['route' => 'factura.buscar', 'name' => 'forma_0']) !!}
            @else
                {!! Form::open(['route' => ['factura.buscarEditar', $dato->id], 'name' => 'forma_0']) !!}
            @endif
                @include('mina.empresa.factura.campoBuscar')
            {!! Form::close() !!}
        @endif
        <h4 class="border-bottom">{{ $accion }} factura</h4>
        @if ($accion == 'Nuevo')
            {!! Form::open(['route' => 'factura.crear', 'name' => 'forma']) !!}
                @include('mina.empresa.factura.campo')
            {!! Form::close() !!}
        @elseif($accion == 'Editar' && $dato->valor > 0)
            @include('mina.empresa.factura.campoAnular')
        @else
            {!! Form::model($dato, ['route' => ['factura.editar', $dato->id], 'method' => 'PUT', 'name' => 'forma']) !!}
                @include('mina.empresa.factura.campo')
            {!! Form::close() !!}
        @endif
    </div>
</div>
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Viajes</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="tabla" class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="text-center">
                        <th>Fecha</th>
                        <th>Operador</th>
                        <th>Vehículo</th>
                        <th>Material</th>
                        <th>Volúmen</th>
                        <th>Valor</th>
                        <th>Total</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>