@can('Factura editar')
	<a class="btn btn-xs btn-info" href="{{ route('factura.editar', $id) }}"><i class="fas fa-edit"></i> Editar</a>
	<a class="btn btn-xs btn-info" href="{{ route('factura.pdf', $id) }}"><i class="fas fa-file-pdf"></i> Pdf</a>
	<a class="btn btn-xs btn-info" href="{{ route('factura.excel', $id) }}"><i class="fas fa-file-excel"></i> Excel</a>
@endcan