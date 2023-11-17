<script>
var natural =[
    @foreach($natural as $k => $d)
      [{{$k}}, "{{ $d }}"],
    @endforeach
];
var juridica =[
    @foreach($juridica as $k => $d)
      [{{$k}}, "{{ $d }}"],
    @endforeach
];
function doc(valor) {
    if (valor == 1){
      	campo=eval("natural");
      	numero = campo.length;
      	document.forma.documento_id.length = numero;
      	for(i=0;i<numero;i++){
        	document.forma.documento_id.options[i].value=campo[i][0];
        	document.forma.documento_id.options[i].text=campo[i][1];
      	}
    }
    if (valor == 2){
      	campo=eval("juridica");
      	numero = campo.length;
      	document.forma.documento_id.length = numero;
      	for(i=0;i<numero;i++){
        	document.forma.documento_id.options[i].value=campo[i][0];
        	document.forma.documento_id.options[i].text=campo[i][1];
      	}
    }
}
function carga() {
    doc(document.getElementById('persona_id').value);
}
window.onload = carga;
</script>