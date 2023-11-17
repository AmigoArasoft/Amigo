<script>
$(document).ready(function() {
    $('#tabla').DataTable({
        "aaSorting": [[ 1 ]],
        "autoWidth": false,
    	"serverSide": true,
    	"ajax": "{{ route('usuario.listar') }}",
    	"columns": [
            @canany(['Usuario editar', 'Usuario borrar'])
    		    {data: 'botones', class: 'text-center', orderable: false},
            @endcanany
    		{data: 'name'},
            {data: 'email'},
            {data: 'empresa', name: 'terceros.nombre'},
            {data: 'roles', orderable: false},
            {data: 'activo', class: 'text-center', orderable: false},
    	],
    	"language": {
           	"url": "{{ asset('js/Spanish.lang') }}"
       	}
    });
} );
</script>