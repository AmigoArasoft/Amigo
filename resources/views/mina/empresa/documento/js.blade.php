<script>
$(document).ready(function() {
    $('#tabla').DataTable({
        "aaSorting": [[ 1 ]],
        "autoWidth": false,
    	"serverSide": true,
    	"ajax": "{{ route('documento.listar') }}",
    	"columns": [
            @canany(['Documento editar', 'Documento borrar'])
    		    {data: 'botones', class: 'text-center', orderable: false},
            @endcanany
    		{data: 'titulo'},
            {data: 'descripcion'},
            {data: 'tema', name:'temas.nombre'},
            {data: 'subtema', name:'parametros.nombre'},
            {data: 'activo', class: 'text-center', orderable: false},
    	],
    	"language": {
           	"url": "{{ asset('js/Spanish.lang') }}"
       	}
    });
} );
</script>