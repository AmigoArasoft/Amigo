<script>
@foreach($transportes as $d)
    var tran_{{ $d->id }}=[
        ["", "Seleccione..."],
        @foreach($d->conductores as $m)
            [{{$m->id}}, "{{ $m->nombre }}"],
        @endforeach
    ];
@endforeach

function refreshSelectpicker(){
    $(".selectpicker").selectpicker("refresh");
}

function cambiaTransportador(valor){
    if (valor !== '') {
        mi_valor = eval("tran_" + valor);
        num_valor = mi_valor.length;
        document.forma.conductor_id.length = num_valor;
        for(i=0;i<num_valor;i++){
            document.forma.conductor_id.options[i].value = mi_valor[i][0];
            document.forma.conductor_id.options[i].text = mi_valor[i][1];
        }
    }else{
        document.forma.conductor_id.length = 1;
        document.forma.conductor_id.options[0].value = "";
        document.forma.conductor_id.options[0].text = "Seleccione...";
    }
    document.forma.conductor_id.options[0].selected = true;
    refreshSelectpicker();
}
</script>