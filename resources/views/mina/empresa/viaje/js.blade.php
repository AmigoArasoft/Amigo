<script>
$(document).ready(function() {
    $('#tabla').DataTable({
        "aaSorting": [[ 0, "desc" ]],
        "autoWidth": false,
    	"serverSide": true,
    	"ajax": "{{ route('viaje.listar') }}",
    	"columns": [
            {data: 'id', name: 'viajes.id'},
            @if(Auth::user()->tercero_id == 1)
                @canany(['Viaje editar', 'Viaje borrar'])
                    {data: 'botones', class: 'text-center', orderable: false},
                @endcanany
            @endif
            {data: 'nro_viaje', name: 'viajes.nro_viaje'},
            {data: 'fecha', name: 'viajes.fecha_nombre'},
            {data: 'operador', name: 'terceros.nombre'},
            {data: 'placa', name: 'vehiculos.placa'},
            {data: 'nombre', name: 'materias.nombre'},
            {data: 'volumen', name: 'viajes.volumen', className:'text-right'},
            {data: 'digitador', name: 'users.name'},
            {data: 'activo', class: 'text-center', orderable: false},
    	],
    	"language": {
           	"url": "{{ asset('js/Spanish.lang') }}"
       	}
    });
} );

function changeId(id){
    $("#certificado_origen").val(id);
}
</script>