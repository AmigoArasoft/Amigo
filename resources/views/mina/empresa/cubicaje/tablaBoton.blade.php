@can('Cubicaje editar')
	<a class="btn btn-xs btn-info" href="{{ route('cubicaje.editar', $id) }}"><i class="fas fa-edit"></i> Editar</a>
@endcan
@can('Cubicaje borrar')
	@if($activo==1)
		<a class="btn btn-xs btn-danger" href="{{ route('cubicaje.activar', $id) }}"><i class="fas fa-times-circle"></i> Inactivar</a>
	@else
		<a class="btn btn-xs btn-info" href="{{ route('cubicaje.activar', $id) }}"><i class="fas fa-check-circle"></i> Activar</a>
	@endif
@endcan
<a class="btn btn-xs btn-info" href="{{ route('cubicaje.pdf', $id) }}"><i class="fas fa-file-pdf"></i> Pdf</a>