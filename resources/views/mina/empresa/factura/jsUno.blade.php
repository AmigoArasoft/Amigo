<script>
$(document).ready(function() {
    var table = $('#tabla').DataTable({
        "aaSorting": [[ 0, "asc" ]],
        "autoWidth": false,
        "serverSide": true,
        @if ($accion == 'Nuevo' || ($accion == 'Editar' && $dato->valor == 0))
            "ajax": "{{ route('viaje.listarOperador', [$ope, $desde, $hasta]) }}",
        @else ($accion == 'Editar' && $dato->valor > 0)
            "ajax": "{{ route('viaje.listarFactura', [$dato->id]) }}",
        @endif
        "columns": [
            {data: 'fecha', name: 'viajes.fecha_nombre'},
            {data: 'operador', name: 'terceros.nombre'},
            {data: 'placa', name: 'vehiculos.placa'},
            {data: 'nombre', name: 'materias.nombre'},
            {data: 'volumen', name: 'viajes.volumen', className:'text-right', render: $.fn.dataTable.render.number('.', ',', 2, '')},
            {data: 'nro_viaje', name: 'viajes.nro_viaje', className:'text-right'},
            @if (Auth::user()->role->role_id == 1 || Auth::user()->role->role_id == 3)
                {data: 'valor', name: 'viajes.valor', className:'text-right', render: $.fn.dataTable.render.number('.', ',', 0, '$ ')},
                {data: 'total', name: 'viajes.total', className:'text-right', render: $.fn.dataTable.render.number('.', ',', 2, '$ ')},
            @endif
        ],
        "language": {
            "url": "{{ asset('js/Spanish.lang') }}"
        }
    });
} );
function cambia(){
    this.table.ajax.reload();
}
</script>