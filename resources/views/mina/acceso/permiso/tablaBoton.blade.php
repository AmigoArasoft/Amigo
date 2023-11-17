@can('Permiso editar')
	<a class="btn btn-xs btn-info" href="{{ route('permiso.editar', $id) }}"><i class="fas fa-edit"></i> Editar</a>
@endcan
@can('Permiso borrar')
	<a class="btn btn-xs btn-danger" href="{{ route('permiso.ver', $id) }}"><i class="fas fa-trash"></i> Eliminar</a>
@endcan