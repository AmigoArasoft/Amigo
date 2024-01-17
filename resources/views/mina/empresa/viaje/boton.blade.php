@if($accion == 'Nuevo')
	@can('Viaje crear')
		{{ Form::button('<i class="fas fa-save"></i> Guardar', ['type' => 'submit', 'class' => 'btn btn-info', 'onclick' => 'formSubmit(event)']) }}
	@endcan
@elseif($accion == 'Editar')
	@can('Viaje editar')
		{{ Form::button('<i class="fas fa-edit"></i> Modificar', ['type' => 'submit', 'class' => 'btn btn-info', 'onclick' => 'formSubmit(event)']) }}
	@endcan
@endif
<a class="btn btn-info ml-2" href="{{ route('viaje') }}"><i class="fas fa-undo"></i> Regresar</a>