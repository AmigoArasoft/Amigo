<script>
$(document).ready(function() {
    $('#tablaUno').DataTable({
        "aaSorting": [[ 1 ]],
        "autoWidth": false,
    	"serverSide": true,
    	"ajax": "{{ route('grupo.listarParametro', $dato->id) }}",
    	"columns": [
            @canany(['Grupo editar', 'Grupo borrar'])
    		    {data: 'botones', class: 'text-center', orderable: false},
            @endcanany
    		{data: 'nombre'},
    	],
    	"language": {
           	"url": "{{ asset('/asset/datatables/Spanish.lang') }}"
       	}
    });
} );
</script>