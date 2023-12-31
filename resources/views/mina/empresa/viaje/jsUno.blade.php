<script>
var gruposubmat_material = @json($subgrupo_materia);
var materiales = @json($materiales);

@foreach($operadores as $d)
    var mate_{{ $d->id }}=[
        @foreach($d->materiales->sortBy('nombre') as $m)
            [{{$m->id}}, "{{ $m->nombre }}"],
        @endforeach
    ];
@endforeach
@foreach($operadores as $d)
    var vehi_{{ $d->id }}=[
        @foreach($d->transportesVehiculos->sortBy('placa') as $t)
            [{{$t->id}}, "{{ $t->placa }}"],
        @endforeach
    ];
@endforeach

@foreach($vehiculos as $m)
    var v_{{ $m->id }}=[
        [{{ $m->tercero_id }}, "{{ $m->volumen }}", {{ $m->conductor_id }}],
    ];
@endforeach
@foreach($operadores as $d)
    @foreach($d->transportes as $t)
        var tran_{{ $t->id }}=[
            @foreach ($t->conductores as $m)
                [{{$m->id}}, "{{ $m->nombre }}"],
            @endforeach
        ];
    @endforeach
@endforeach

getVehicleCubage(document.forma.vehiculo_id.value);

function cambiaOperador(valor){
    if (valor !== '') {
        mi_valor = eval("mate_" + valor);
        num_valor = mi_valor.length;
        document.forma.material_id.length = num_valor;
        for(i=0;i<num_valor;i++){
            document.forma.material_id.options[i].value = mi_valor[i][0];
            document.forma.material_id.options[i].text = mi_valor[i][1];
        }
        mi_valor = eval("vehi_" + valor);
        num_valor = mi_valor.length;
        document.forma.vehiculo_id.length = num_valor;
        for(i=0;i<num_valor;i++){
            document.forma.vehiculo_id.options[i].value = mi_valor[i][0];
            document.forma.vehiculo_id.options[i].text = mi_valor[i][1];
        }
    }else{
        document.forma.material_id.length = 1;
        document.forma.material_id.options[0].value = "";
        document.forma.material_id.options[0].text = "";
        document.forma.vehiculo_id.length = 1;
        document.forma.vehiculo_id.options[0].value = "";
        document.forma.vehiculo_id.options[0].text = "";
    }
    document.forma.material_id.options[0].selected = true;
    cambiaMaterial(document.getElementById('subgrupo_id').value);
    cambiaVehiculo(document.getElementById('vehiculo_id').value);
}
function cambiaMaterial(valor){
    if (valor !== '') {
        var subgrupoMateriales = gruposubmat_material.filter(x => x.gruposubmat_id == parseInt(valor));
        num_valor = subgrupoMateriales.length;
        document.forma.material_id.length = num_valor;
        for(i=0;i<num_valor;i++){
            material_id = subgrupoMateriales[i].material_id;
            document.forma.material_id.options[i].value = material_id;
            document.forma.material_id.options[i].text = materiales[material_id];
        }
    }else{
        document.forma.material_id.length = 1;
        document.forma.material_id.options[0].value = "";
        document.forma.material_id.options[0].text = "";
    }
    document.forma.material_id.options[0].selected = true;
}
function cambiaVehiculo(valor){
    if (valor !== '') {
        x_valor = eval("v_" + valor);

        getVehicleCubage(valor);

        mi_valor = eval("tran_" + x_valor[0][0]);
        num_valor = mi_valor.length;
        document.forma.conductor_id.length = num_valor;
        for(i=0;i<num_valor;i++){
            document.forma.conductor_id.options[i].value = mi_valor[i][0];
            document.forma.conductor_id.options[i].text = mi_valor[i][1];
            if(mi_valor[i][0] == x_valor[0][2]){
                document.forma.conductor_id.options[i].selected = true;
            }
        }
    }else{
        document.forma.volumen.value = 1;
        document.forma.conductor_id.length = 1;
        document.forma.conductor_id.options[0].value = "";
        document.forma.conductor_id.options[0].text = "";
    }
}

function getVehicleCubage(valor){
    x_valor = eval("v_" + valor);

    $.ajax({
        type: "GET",
        url: "{{ route('viaje.getVehicleCubage') }}",
        data: {
            id_vehiculo: valor
        },
        success: function (response) {
            document.forma.volumen.disabled = false;
            document.forma.volumen.max = x_valor[0][1];
            document.forma.volumen.value = x_valor[0][1];

            if(response.data){
                document.forma.volumen.value = response.data.volumen;
                document.forma.volumen.disabled = true;
            }
        }
    });
}

function formSubmit(){
    document.forma.volumen.disabled = false;
}
</script>