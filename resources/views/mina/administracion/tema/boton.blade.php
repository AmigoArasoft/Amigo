@if($accion == 'Nuevo')
	@can('Tema crear')
		{{ Form::button('<i class="fas fa-save"></i> Guardar', ['type' => 'submit', 'class' => 'btn btn-info']) }}
	@endcan
@elseif($accion == 'Editar')
	@can('Tema editar')
		{{ Form::button('<i class="fas fa-edit"></i> Modificar', ['type' => 'submit', 'class' => 'btn btn-info']) }}
	@endcan
@endif
<a class="btn btn-info ml-2" href="{{ route('tema') }}"><i class="fas fa-undo"></i> Regresar</a>