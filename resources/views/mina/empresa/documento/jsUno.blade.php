<script>
@foreach($temas as $d)
    var tema_{{ $d->id }}=[
        ["", "Seleccione..."],
        @foreach($d->subtemas as $m)
            [{{$m->id}}, "{{ $m->nombre }}"],
        @endforeach
    ];
@endforeach
function cambiaTema(valor){
    if (valor !== '') {
        mi_valor = eval("tema_" + valor);
        num_valor = mi_valor.length;
        document.forma.subtema_id.length = num_valor;
        for(i=0;i<num_valor;i++){
            document.forma.subtema_id.options[i].value = mi_valor[i][0];
            document.forma.subtema_id.options[i].text = mi_valor[i][1];
        }
    }else{
        document.forma.subtema_id.length = 1;
        document.forma.subtema_id.options[0].value = "";
        document.forma.subtema_id.options[0].text = "Seleccione...";
    }
    document.forma.subtema_id.options[0].selected = true;
}
</script>