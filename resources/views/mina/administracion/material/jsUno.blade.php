<script>
$(document).ready(function() {
    $('#tablaUno').DataTable({
        "aaSorting": [[ 1 ]],
        "autoWidth": false,
    	"serverSide": true,
    	"ajax": "{{ route('material.listarParametro', $dato->id) }}",
    	"columns": [
            @canany(['Material editar', 'Material borrar'])
    		    {data: 'botones', class: 'text-center', orderable: false},
            @endcanany
    		{data: 'nombre'},
    	],
    	"language": {
           	"url": "{{ asset('js/Spanish.lang') }}"
       	}
    });
} );
</script>