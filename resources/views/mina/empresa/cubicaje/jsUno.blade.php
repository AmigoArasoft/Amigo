<script>
@foreach($operadores as $d)
    var ope_{{ $d->id }}=[
        @foreach($d->transportesVehiculos->sortBy('placa') as $m)
            [{{$m->id}}, "{{ $m->placa }}"],
        @endforeach
    ];
    var rep_{{ $d->id }}="{{ $d->gerente()->nombre ?? null }}";
@endforeach
@foreach($operadores as $d)
    @foreach($d->transportesVehiculos->sortBy('placa') as $m)
        var veh_{{ $m->id }}="{{ $m->tercero->nombre }}";
    @endforeach
@endforeach
function cambiaOperador(valor){
    if (valor !== '') {
        document.forma.operador.value = eval("rep_" + valor);
        mi_valor = eval("ope_" + valor);
        num_valor = mi_valor.length;
        document.forma.vehiculo_id.length = num_valor;
        for(i=0;i<num_valor;i++){
            document.forma.vehiculo_id.options[i].value = mi_valor[i][0];
            document.forma.vehiculo_id.options[i].text = mi_valor[i][1];
        }
    }else{
        document.forma.vehiculo_id.length = 1;
        document.forma.vehiculo_id.options[0].value = "";
        document.forma.vehiculo_id.options[0].text = "Seleccione...";
        document.forma.operador.value = "";
    }
    document.forma.vehiculo_id.options[0].selected = true;
    cambiaVehiculo(document.forma.vehiculo_id.value);
}
function cambiaVehiculo(valor){
    if (valor !== '') {
        document.forma.transportador.value = eval("veh_" + valor);
    }else{
        document.forma.transportador.value = "";
    }
}
function cambiaVol(){
    document.forma.volumen_bruto.value =  document.forma.volumen_ancho.value * document.forma.volumen_largo.value * document.forma.volumen_alto.value;
    document.forma.volumen_gato.value =  ((parseFloat(document.forma.gato_mayor.value) + parseFloat(document.forma.gato_menor.value))/2) * document.forma.gato_alto.value * document.forma.gato_ancho.value;
    document.forma.volumen_borde.value =  ((document.forma.borde_base.value * document.forma.borde_alto.value)/2) * document.forma.borde_largo.value * 2;
    document.forma.volumen.value =  document.forma.volumen_bruto.value - document.forma.volumen_gato.value - document.forma.volumen_borde.value;
}
function carga() {
    cambiaVol();
}
window.onload = carga;
</script>