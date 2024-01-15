{!! Form::open(['route' => ['operador.crearMaterial', $dato->id], 'name' => 'forma', 'class' => 'form-horizontal']) !!}
    <div class="row">
        <div class="col-md-3">
            <div class="form-group row">
                {{ Form::label('material_id', 'Material:', ['class' => 'col-md-4']) }}
                <div class="col-md-8">
                    {{ Form::select('material_id', $material, (!isset($dato)) ? 1 : null, ['class' => $errors->first('material_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm selectpicker', 'data-live-search' => 'true', 'required']) }}    
                </div>
                @if($errors->has('material_id'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('material_id') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group row">
                {{ Form::label('tarifa', 'Tarifa:', ['class' => 'col-md-4']) }}
                <div class="col-md-8">
                    {{ Form::number('tarifa', (!isset($dato)) ? 1 : null, ['class' => $errors->first('tarifa') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'min' => '0', 'step' => 'any', 'required']) }}    
                </div>
                @if($errors->has('tarifa'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('tarifa') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-2">
            {{ Form::button('<i class="fas fa-plus"></i> Agregar', ['type' => 'submit', 'class' => 'btn btn-sm btn-info']) }}
        </div>
        <div class="col-md-4 text-right">
            <a class="btn btn-sm btn-info ml-2" href="{{ route('operador') }}"><i class="fas fa-undo"></i> Regresar</a>
        </div>
    </div>
{!! Form::close() !!}
<div class="table-responsive">
    <table id="tablaMaterial" class="table table-bordered table-striped table-hover table-sm">
        <thead>
            <tr class="text-center">
                @canany(['Operador editar', 'Operador borrar'])
                    <th width="56px">Acción</th>
                @endcanany
                <th>Material</th>
                <th>Tarifa</th>
            </tr>
        </thead>
    </table>
</div>