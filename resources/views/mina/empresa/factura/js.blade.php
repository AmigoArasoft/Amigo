<script>
$(document).ready(function() {
    $('#tabla').DataTable({
        "aaSorting": [[ 1, "desc" ]],
        "autoWidth": false,
    	"serverSide": true,
    	"ajax": "{{ route('factura.listar') }}",
    	"columns": [
            @canany(['Factura editar', 'Factura borrar', 'Factura leer'])
    		    {data: 'botones', class: 'text-center', orderable: false},
            @endcanany
            {data: 'id', name: 'facturas.id'},
            {data: 'fecha', name: 'facturas.fecha_nombre'},
            {data: 'operador', name: 'terceros.nombre'},
            {data: 'desde', name: 'facturas.fecha_desde'},
            {data: 'hasta', name: 'facturas.fecha_hasta'},
            {data: 'valor', name: 'facturas.valor', className:'text-right', render: $.fn.dataTable.render.number('.', ',', 0, '$ ')},
            {data: 'metros', name: 'facturas.metros', className:'text-right', render: $.fn.dataTable.render.number('.', ',', 2, '')},
            {data: 'activo', class: 'text-center', orderable: false},
    	],
    	"language": {
           	"url": "{{ asset('js/Spanish.lang') }}"
       	}
    });
} );
</script>