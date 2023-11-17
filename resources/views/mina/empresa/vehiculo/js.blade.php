<script>
$(document).ready(function() {
    $('#tabla').DataTable({
        "aaSorting": [[ 1 ]],
        "autoWidth": false,
    	"serverSide": true,
    	"ajax": "{{ route('vehiculo.listar') }}",
    	"columns": [
            @canany(['Vehiculo editar', 'Vehiculo borrar'])
    		    {data: 'botones', class: 'text-center', orderable: false},
            @endcanany
    		{data: 'operador', name:'operador.nombre'},
            {data: 'conductor', name:'conductor.nombre'},
            {data: 'placa', class: 'text-center'},
            {data: 'volumen', class: 'text-right'},
            {data: 'marca'},
            {data: 'activo', class: 'text-center', orderable: false},
    	],
    	"language": {
           	"url": "{{ asset('js/Spanish.lang') }}"
       	}
    });
} );
</script>