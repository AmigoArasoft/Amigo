<script>
$(document).ready(function() {
    $('#tablaContacto').DataTable({
        "aaSorting": [[ 1 ]],
        "autoWidth": false,
    	"serverSide": true,
    	"ajax": "{{ route('operador.listarContacto', $dato->id) }}",
    	"columns": [
            @canany(['Operador editar', 'Operador borrar'])
    		    {data: 'botones', class: 'text-center', orderable: false},
            @endcanany
            {data: "nombre", name: "terceros.nombre"},
            {data: 'telefono'},
            {data: 'email'},
            {data: 'funcion', name: "parametros.nombre"},
    	],
    	"language": {
           	"url": "{{ asset('js/Spanish.lang') }}"
       	}
    });
    $('#tablaTransporte').DataTable({
        "aaSorting": [[ 1 ]],
        "autoWidth": false,
        "serverSide": true,
        "ajax": "{{ route('operador.listarTransporte', $dato->id) }}",
        "columns": [
            @canany(['Operador editar', 'Operador borrar'])
                {data: 'botones', class: 'text-center', orderable: false},
            @endcanany
            {data: "nombre", name: "terceros.nombre"},
            {data: 'telefono'},
            {data: 'email'},
        ],
        "language": {
            "url": "{{ asset('js/Spanish.lang') }}"
        }
    });
    $('#tablaMaterial').DataTable({
        "aaSorting": [[ 1 ]],
        "autoWidth": false,
        "serverSide": true,
        "ajax": "{{ route('operador.listarMaterial', $dato->id) }}",
        "columns": [
            @canany(['Operador editar', 'Operador borrar'])
                {data: 'botones', class: 'text-center', orderable: false},
            @endcanany
            {data: "nombre", name: "tarifas.nombre"},
            {data: 'tarifa', name: "tercero_tarifa.tarifa", render: $.fn.dataTable.render.number('.', ',', 2, '$ '), className:'text-right'},
        ],
        "language": {
            "url": "{{ asset('js/Spanish.lang') }}"
        }
    });
} );
</script>
