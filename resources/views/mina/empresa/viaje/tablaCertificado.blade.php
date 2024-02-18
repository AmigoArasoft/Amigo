@if($certificado)
	Nro: {{$numero_certificacion}} | {{ date('d/m/Y', strtotime($fecha_certificacion)) }}
@else
	NO
@endif