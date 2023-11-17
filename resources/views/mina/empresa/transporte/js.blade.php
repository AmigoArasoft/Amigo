<script>
$(document).ready(function() {
    $('#tabla').DataTable({
        "aaSorting": [[ 1 ]],
        "autoWidth": false,
    	"serverSide": true,
    	"ajax": "{{ route('transporte.listar') }}",
    	"columns": [
            @canany(['Transporte editar', 'Transporte borrar'])
    		    {data: 'botones', class: 'text-center', orderable: false},
            @endcanany
            {data: "nombre" },
            {data: 'telefono'},
            {data: 'email'},
    	],
    	"language": {
           	"url": "{{ asset('js/Spanish.lang') }}"
       	}
    });
} );
</script>