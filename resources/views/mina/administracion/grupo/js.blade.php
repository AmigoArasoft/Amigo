<script>
$(document).ready(function() {
    $('#tabla').DataTable({
        "aaSorting": [[ 1 ]],
        "autoWidth": false,
    	"serverSide": true,
    	"ajax": "{{ route('grupo.listar') }}",
    	"columns": [
            @canany(['Grupo editar', 'Grupo borrar'])
    		    {data: 'botones', class: 'text-center', orderable: false},
            @endcanany
    		{data: 'nombre'},
            {data: 'parametros', orderable: false},
    	],
    	"language": {
           	"url": "{{ asset('/asset/datatables/Spanish.lang') }}"
       	}
    });
} );
</script>