<script>
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
@foreach($materiales as $m)
    var m_{{ $m->id }}=[
        @foreach($m->submateriales as $s)
            [{{ $s->id }}, "{{ $s->nombre }}"],
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
    cambiaMaterial(document.getElementById('material_id').value);
    cambiaVehiculo(document.getElementById('vehiculo_id').value);
}
function cambiaMaterial(valor){
    if (valor !== '') {
        mi_valor = eval("m_" + valor[0][0]);
        num_valor = mi_valor.length;
        document.forma.submaterial_id.length = num_valor;
        for(i=0;i<num_valor;i++){
            document.forma.submaterial_id.options[i].value = mi_valor[i][0];
            document.forma.submaterial_id.options[i].text = mi_valor[i][1];
        }
    }else{
        document.forma.submaterial_id.length = 1;
        document.forma.submaterial_id.options[0].value = "";
        document.forma.submaterial_id.options[0].text = "";
    }
    document.forma.submaterial_id.options[0].selected = true;
}
function cambiaVehiculo(valor){
    if (valor !== '') {
        x_valor = eval("v_" + valor);
        document.forma.volumen.value = x_valor[0][1];
        document.forma.volumen.max = x_valor[0][1];
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
</script>