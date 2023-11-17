<script>
$(document).ready(function() {
    $('#tabla').DataTable({
        "aaSorting": [[ 1 ]],
        "autoWidth": false,
    	"serverSide": true,
    	"ajax": "{{ route('operador.listar') }}",
    	"columns": [
            @canany(['Operador editar', 'Operador borrar'])
    		    {data: 'botones', class: 'text-center', orderable: false},
            @endcanany
            {data: "nombre" },
            {data: 'telefono'},
            {data: 'email'},
            {data: 'frente', name: 'parametros.nombre'},
            {data: 'transportador', class: 'text-center', orderable: false},
    	],
    	"language": {
           	"url": "{{ asset('js/Spanish.lang') }}"
       	}
    });
} );
</script>