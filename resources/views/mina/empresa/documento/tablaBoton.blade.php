@if (substr(URL::current(), 0, 16) == 'http://localhost')
	<a class="btn btn-xs btn-info" href="../storage/{{ substr($archivo, 6) }}" target="blank"><i class="fas fa-download"></i> Descargar</a>
@else
	<a class="btn btn-xs btn-info" href="../mina_app/storage/app/{{ $archivo }}" target="blank"><i class="fas fa-download"></i> Descargar</a>
@endif
@can('Documento editar')
	<a class="btn btn-xs btn-info" href="{{ route('documento.editar', $id) }}"><i class="fas fa-edit"></i> Editar</a>
@endcan
@can('Documento borrar')
	@if($activo==1)
		<a class="btn btn-xs btn-danger" href="{{ route('documento.activar', $id) }}"><i class="fas fa-times-circle"></i> Inactivar</a>
	@else
		<a class="btn btn-xs btn-info" href="{{ route('documento.activar', $id) }}"><i class="fas fa-check-circle"></i> Activar</a>
	@endif
@endcan