<script>
$(document).ready(function() {
    $('#tabla').DataTable({
        "aaSorting": [[ 1, "desc" ]],
        "autoWidth": false,
    	"serverSide": true,
    	"ajax": "{{ route('cubicaje.listar') }}",
    	"columns": [
            @canany(['Cubicaje editar', 'Cubicaje borrar'])
    		    {data: 'botones', class: 'text-center', orderable: false},
            @endcanany
            {data: 'id', name: 'cubicajes.id'},
            {data: 'fecha', name: 'cubicajes.fecha_nombre'},
            {data: 'operador', name: 'terceros.nombre'},
            {data: 'placa', name: 'vehiculos.placa'},
            {data: 'volumen', name: 'cubicajes.volumen', className:'text-right', render: $.fn.dataTable.render.number('.', ',', 2, '')},
            {data: 'activo', class: 'text-center', orderable: false},
    	],
    	"language": {
           	"url": "{{ asset('js/Spanish.lang') }}"
       	}
    });
} );
</script>