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
            {data: 'volumen', className:'text-right'},
            {
                data: 'volumen_manual',
                className:'text-center',
                render: function(data) {
                    return data == 1 ? 'SI' : 'NO';
                }
            },
            {data: 'digitador', name: 'users.name'},
            {data: 'activo', class: 'text-center', orderable: false},
            {data: 'certificado', class: 'text-center', orderable: false},
    	],
    	"language": {
           	"url": "{{ asset('js/Spanish.lang') }}"
       	}
    });
} );

function changeId(id, type){
    $("#exampleModalLabel").text(type == "origen" ? "Enviar certificado de origen" : "Enviar vale")
    $("#tipo_documento").val(type);
    $("#id_documento_correo").val(id);
}

function cambiarVolumen(id){
    $("#id_viaje").val(id);
}

function getOperadores(){

    $.ajax({
        type: "GET",
        url: "{{ route('viaje.getOperadores') }}",
        data: {},
        success: function (response) {
            if(response.data){
                $("#modalCertificateTrips").modal("show");

                $.each(response.data, function (i, v) { 
                    $("#operador_id").append(`
                        <option value="${i}">${v}</option>
                    `)
                });

                $("#operador_id").selectpicker("refresh");
                $("#operador_id option:first").prop('selected', 'selected');
                $("#operador_id").selectpicker("refresh");

                getOperadorViajeCertificado();
            }
        }
    });
}

function getOperadorViajeCertificado(){
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        type: "POST",
        url: "{{ route('viaje.getOperadorViajeCertificado') }}",
        data: {
            operador_id: $("#operador_id").val(),
            _token: csrfToken
        },
        success: function (response) {
            if(response.data){
                $("#viajes_id").empty();
                $.each(response.data, function (i, v) { 
                    $("#viajes_id").append(`
                        <option value="${v.id}">${v.id} ${v.nro_viaje ? "| Vale: " + v.nro_viaje : ""}</option>
                    `)
                });

                $("#viajes_id").selectpicker("refresh");
            }
        }
    });
}

</script>