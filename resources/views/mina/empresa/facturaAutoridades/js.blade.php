<script>
    function dataTable(){
        desde = $("#desdeForm").val();
        hasta = $("#hastaForm").val();
        
        // Destruir el DataTable existente si existe
        if ($.fn.DataTable.isDataTable('#tabla')) {
            $('#tabla').DataTable().destroy();
        }

        $('#tabla').DataTable({
            "aaSorting": [[ 1, "desc" ]],
            "autoWidth": false,
            "serverSide": true,
            "ajax":  {
                url: `{{ route('facturaAutoridades.listar') }}`,
                type: 'GET',
                data: {
                    desde: desde,
                    hasta: hasta,
                    _token: '{{ csrf_token() }}',
                }
            },
            "columns": [
                @canany(['Factura editar', 'Factura borrar'])
                    {data: 'botones', class: 'text-center', orderable: false},
                @endcanany
                {data: 'id', name: 'facturas.id'},
                {data: 'fecha', name: 'facturas.fecha_nombre'},
                {data: 'operador', name: 'terceros.nombre'},
                {data: 'desde', name: 'facturas.fecha_desde'},
                {data: 'hasta', name: 'facturas.fecha_hasta'},
                {data: 'valor', name: 'facturas.valor', className:'text-right', render: $.fn.dataTable.render.number('.', ',', 0, '$ ')},
                {data: 'activo', class: 'text-center', orderable: false},
            ],
            "language": {
                "url": "{{ asset('js/Spanish.lang') }}"
            }
        });
    }
    $(document).ready(function() {
        dataTable();
    } );
</script>