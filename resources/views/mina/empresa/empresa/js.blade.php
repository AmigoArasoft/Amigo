<script>
$(document).ready(function() {
    $('#tablaContacto').DataTable({
        "aaSorting": [[ 1 ]],
        "autoWidth": false,
    	"serverSide": true,
    	"ajax": "{{ route('empresa.listarContacto', $dato->id) }}",
    	"columns": [
            @canany(['Empresa editar', 'Empresa borrar'])
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
} );
</script>