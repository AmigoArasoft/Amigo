<script>
$(document).ready(function() {
    $('#tablaContacto').DataTable({
        "aaSorting": [[ 1 ]],
        "autoWidth": false,
    	"serverSide": true,
    	"ajax": "{{ route('transporte.listarContacto', $dato->id) }}",
    	"columns": [
            @canany(['Transporte editar', 'Transporte borrar'])
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
    $('#tablaVehiculo').DataTable({
        "aaSorting": [[ 1 ]],
        "autoWidth": false,
        "serverSide": true,
        "ajax": "{{ route('transporte.listarVehiculo', $dato->id) }}",
        "columns": [
            @canany(['Transporte editar', 'Transporte borrar'])
                {data: 'botones', class: 'text-center', orderable: false},
            @endcanany
            {data: "placa"},
            {data: 'volumen'},
            {data: 'marca'},
            {data: 'conductor', name: 'terceros.nombre'},
        ],
        "language": {
            "url": "{{ asset('js/Spanish.lang') }}"
        }
    });
} );
</script>