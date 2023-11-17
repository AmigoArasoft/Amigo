<div class="card card-info card-tabs">
    <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link{{ ($tab == 1) ? ' active' : '' }}" id="custom-tabs-one-tab" data-toggle="pill" href="#custom-tabs-one" role="tab" aria-controls="custom-tabs-one" aria-selected="true">{{ $accion }} operador</a>
            </li>
            @if($accion == 'Editar')
                @can('Operador editar')
                    <li class="nav-item">
                        <a class="nav-link{{ ($tab == 2) ? ' active' : '' }}" id="custom-tabs-two-tab" data-toggle="pill" href="#custom-tabs-two" role="tab" aria-controls="custom-tabs-two" aria-selected="false">Contactos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ ($tab == 3) ? ' active' : '' }}" id="custom-tabs-three-tab" data-toggle="pill" href="#custom-tabs-three" role="tab" aria-controls="custom-tabs-three" aria-selected="false">Transportadores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ ($tab == 4) ? ' active' : '' }}" id="custom-tabs-four-tab" data-toggle="pill" href="#custom-tabs-four" role="tab" aria-controls="custom-tabs-four" aria-selected="false">Materiales</a>
                    </li>
                @endcan
            @endif
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-tabContent">
            <div class="tab-pane fade{{ ($tab == 1) ? '  show active' : '' }}" id="custom-tabs-one" role="tabpanel" aria-labelledby="custom-tabs-one-tab">
                @if($accion == 'Nuevo')
                    {!! Form::open(['route' => 'operador.crear', 'name' => 'forma', 'files' => true]) !!}
                @elseif ($accion == 'Editar')
                    {!! Form::model($dato, ['route' => ['operador.editar', $dato->id], 'method' => 'PUT', 'name' => 'forma', 'files' => true]) !!}
                @endif
                    @if($accion == 'Nuevo')
                        @include('mina.empresa.operador.campo')
                    @elseif ($accion == 'Editar')
                        @include('mina.empresa.operador.campoEdita')
                    @endif
                    @include('mina.empresa.operador.boton')
                @if($accion == 'Nuevo' || $accion == 'Editar')
                    {!! Form::close() !!}
                @endif
            </div>
            @if($accion == 'Editar')
                @can('Operador editar')
                    <div class="tab-pane fade{{ ($tab == 2) ? '  show active' : '' }}" id="custom-tabs-two" role="tabpanel" aria-labelledby="custom-tabs-two-tab">
                        @include('mina.empresa.operador.formaContacto')
                    </div>
                    <div class="tab-pane fade{{ ($tab == 3) ? '  show active' : '' }}" id="custom-tabs-three" role="tabpanel" aria-labelledby="custom-tabs-three-tab">
                        @include('mina.empresa.operador.formaTransporte')
                    </div>
                    <div class="tab-pane fade{{ ($tab == 4) ? '  show active' : '' }}" id="custom-tabs-four" role="tabpanel" aria-labelledby="custom-tabs-four-tab">
                        @include('mina.empresa.operador.formaMaterial')
                    </div>
                @endcan
            @endif
        </div>
    </div>
</div>