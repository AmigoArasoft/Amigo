@if($accion == 'Nuevo')
	@can('Cubicaje crear')
		{{ Form::button('<i class="fas fa-save"></i> Guardar', ['type' => 'submit', 'class' => 'btn btn-info']) }}
	@endcan
@elseif($accion == 'Editar')
	@can('Cubicaje editar')
		{{ Form::button('<i class="fas fa-edit"></i> Modificar', ['type' => 'submit', 'class' => 'btn btn-info']) }}
	@endcan
@endif
<a class="btn btn-info ml-2" href="{{ route('cubicaje') }}"><i class="fas fa-undo"></i> Regresar</a>