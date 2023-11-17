<div class="card card-info card-tabs">
    <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link{{ ($tab == 1) ? ' active' : '' }}" id="custom-tabs-one-tab" data-toggle="pill" href="#custom-tabs-one" role="tab" aria-controls="custom-tabs-one" aria-selected="true">{{ $accion }} transportadora</a>
            </li>
            @if($accion == 'Editar')
                @can('Transporte editar')
                    <li class="nav-item">
                        <a class="nav-link{{ ($tab == 2) ? ' active' : '' }}" id="custom-tabs-two-tab" data-toggle="pill" href="#custom-tabs-two" role="tab" aria-controls="custom-tabs-two" aria-selected="false">Contactos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ ($tab == 3) ? ' active' : '' }}" id="custom-tabs-three-tab" data-toggle="pill" href="#custom-tabs-three" role="tab" aria-controls="custom-tabs-three" aria-selected="false">Vehículos</a>
                    </li>
                @endcan
            @endif
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-tabContent">
            <div class="tab-pane fade{{ ($tab == 1) ? '  show active' : '' }}" id="custom-tabs-one" role="tabpanel" aria-labelledby="custom-tabs-one-tab">
                @if($accion == 'Nuevo')
                    {!! Form::open(['route' => 'transporte.crear', 'name' => 'forma']) !!}
                @elseif ($accion == 'Editar')
                    {!! Form::model($dato, ['route' => ['transporte.editar', $dato->id], 'method' => 'PUT', 'name' => 'forma']) !!}
                @endif
                    @if($accion == 'Nuevo')
                        @include('mina.empresa.transporte.campo')
                    @elseif ($accion == 'Editar')
                        @include('mina.empresa.transporte.campoEdita')
                    @endif
                    @include('mina.empresa.transporte.boton')
                @if($accion == 'Nuevo' || $accion == 'Editar')
                    {!! Form::close() !!}
                @endif
            </div>
            @if($accion == 'Editar')
                @can('Transporte editar')
                    <div class="tab-pane fade{{ ($tab == 2) ? '  show active' : '' }}" id="custom-tabs-two" role="tabpanel" aria-labelledby="custom-tabs-two-tab">
                        @include('mina.empresa.transporte.formaContacto')
                    </div>
                    <div class="tab-pane fade{{ ($tab == 3) ? '  show active' : '' }}" id="custom-tabs-three" role="tabpanel" aria-labelledby="custom-tabs-three-tab">
                        @include('mina.empresa.transporte.formaVehiculo')
                    </div>
                @endcan
            @endif
        </div>
    </div>
</div>