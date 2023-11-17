{!! Form::open(['route' => ['transporte.crearVehiculo', $dato->id], 'name' => 'forma', 'class' => 'form-horizontal']) !!}
    <div class="row">
        <div class="col-md-4">
            <div class="form-group row">
                {{ Form::label('vehiculo_id', 'Vehículo:', ['class' => 'col-md-4']) }}
                <div class="col-md-8">
                    {{ Form::select('vehiculo_id', $vehiculos, (!isset($dato)) ? 1 : null, ['class' => $errors->first('vehiculo_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'required', 'autofocus']) }}    
                </div>
                @if($errors->has('vehiculo_id'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('vehiculo_id') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-2">
            {{ Form::button('<i class="fas fa-plus"></i> Agregar', ['type' => 'submit', 'class' => 'btn btn-sm btn-info']) }}
        </div>
        <div class="col-md-6 text-right">
            <a class="btn btn-sm btn-info ml-2" href="{{ route('transporte') }}"><i class="fas fa-undo"></i> Regresar</a>
        </div>
    </div>
{!! Form::close() !!}
<div class="table-responsive">
    <table id="tablaVehiculo" class="table table-bordered table-striped table-hover table-sm">
        <thead>
            <tr class="text-center">
                @canany(['Transporte editar', 'Transporte borrar'])
                    <th width="56px">Acción</th>
                @endcanany
                <th>Placa</th>
                <th>Volúmen</th>
                <th>Marca</th>
                <th>Conductor</th>
            </tr>
        </thead>
    </table>
</div>