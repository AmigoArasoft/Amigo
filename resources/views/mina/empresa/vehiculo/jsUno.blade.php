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


refreshSelectpicker();
</script>