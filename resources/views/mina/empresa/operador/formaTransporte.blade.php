{!! Form::open(['route' => ['operador.crearTransporte', $dato->id], 'name' => 'forma', 'class' => 'form-horizontal']) !!}
    <div class="row">
        <div class="col-md-4">
            <div class="form-group row">
                {{ Form::label('transporte_id', 'Transportadora:', ['class' => 'col-md-4']) }}
                <div class="col-md-8">
                    {{ Form::select('transporte_id', $transportes, (!isset($dato)) ? 1 : null, ['class' => $errors->first('transporte_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'required', 'autofocus']) }}    
                </div>
                @if($errors->has('transporte_id'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('transporte_id') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-2">
            {{ Form::button('<i class="fas fa-plus"></i> Agregar', ['type' => 'submit', 'class' => 'btn btn-sm btn-info']) }}
        </div>
        <div class="col-md-6 text-right">
            <a class="btn btn-sm btn-info ml-2" href="{{ route('operador') }}"><i class="fas fa-undo"></i> Regresar</a>
        </div>
    </div>
{!! Form::close() !!}
<div class="table-responsive">
    <table id="tablaTransporte" class="table table-bordered table-striped table-hover table-sm">
        <thead>
            <tr class="text-center">
                @canany(['Operador editar', 'Operador borrar'])
                    <th width="56px">Acción</th>
                @endcanany
                <th>Nombres</th>
                <th>Teléfono</th>
                <th>Email</th>
            </tr>
        </thead>
    </table>
</div>