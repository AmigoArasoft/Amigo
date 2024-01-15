{!! Form::open(['route' => ['transporte.crearContacto', $dato->id], 'name' => 'forma', 'class' => 'form-horizontal']) !!}
    <div class="row">
        <div class="col-md-4">
            <div class="form-group row">
                {{ Form::label('contacto_id', 'Persona natural:', ['class' => 'col-md-4']) }}
                <div class="col-md-8">
                    {{ Form::select('contacto_id', $terceros, (!isset($dato)) ? 1 : null, ['class' => $errors->first('contacto_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm selectpicker', 'data-live-search' => 'true', 'required', 'autofocus']) }}    
                </div>
                @if($errors->has('contacto_id'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('contacto_id') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group row">
                {{ Form::label('funcion_id', 'Función:', ['class' => 'col-md-4']) }}
                <div class="col-md-8">
                    {{ Form::select('funcion_id', $funcion, (!isset($dato)) ? 1 : null, ['class' => $errors->first('funcion_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm selectpicker', 'data-live-search' => 'true', 'required']) }}    
                </div>
                @if($errors->has('funcion_id'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('funcion_id') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-2">
            {{ Form::button('<i class="fas fa-plus"></i> Agregar', ['type' => 'submit', 'class' => 'btn btn-sm btn-info']) }}
        </div>
        <div class="col-md-3 text-right">
            <a class="btn btn-sm btn-info ml-2" href="{{ route('transporte') }}"><i class="fas fa-undo"></i> Regresar</a>
        </div>
    </div>
{!! Form::close() !!}
<div class="table-responsive">
    <table id="tablaContacto" class="table table-bordered table-striped table-hover table-sm">
        <thead>
            <tr class="text-center">
                @canany(['Transporte editar', 'Transporte borrar'])
                    <th width="56px">Acción</th>
                @endcanany
                <th>Nombres</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Función</th>
            </tr>
        </thead>
    </table>
</div>