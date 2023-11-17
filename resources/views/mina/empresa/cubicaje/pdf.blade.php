<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<style>
		body{
			font-size: 12px;
		}
		h1{
			font-size: 16px;
		}
		h2{
			font-size: 14px;
		}
		.table td, .table th {
    		padding: 4px;
		}
	</style>
</head>
<body>
	<img src="{{ asset('img/logo_letras_negras.png') }}" style="margin-left: 34%; max-width: 32%;" class="img-thumbnail" alt="Garzón Romero">
	<div class="text-center">
		<h1>ACTA DE CUBICAJE DE VOLQUETAS</h1>
	</div>
	<table class="table table-bordered">
		<tbody>
		  	<tr>
				<th>FECHA:</th>
				<td>{{ $cubicaje->fecha_nombre }}</td>
				<th>ACTA No.:</th>
				<td>{{ $cubicaje->id }}</td>
			</tr>
			<tr>
				<th>OBRA:</th>
				<td>TÍTULO MINERO 20718</td>
				<th>ACTIVIDAD:</th>
				<td>TRANSPORTE DE MATERIALES</td>
			</tr>
			<tr>
				<th>CONTRATANTE:</th>
				<td>GARZÓN ROMERO G. S.A.S.</td>
				<th>REPRESENTANTE:</th>
				<td>Claudia Patricia Garzón Orjuela</td>
			</tr>
			<tr>
				<th>OPERADOR:</th>
				<td>{{ $cubicaje->tercero->nombre }}</td>
				<th>REPRESENTANTE:</th>
				<td>{{ $cubicaje->tercero->gerente()->nombre }}</td>
		  	</tr>  
		</tbody>
	</table>
	<h2>VOLQUETAS Y MEDIDAS</h2>
	<table class="table table-bordered">
		<thead class="text-center">
			<tr>
				<th class="align-middle" rowspan="2">VEHÍCULO</th>
				<th class="align-middle" colspan="4" rowspan="2">VOLUMEN BRUTO</th>
				<th class="align-middle" colspan="9">DESCUENTO</th>
				<th class="align-middle" rowspan="3">VOL. REAL M3</th>
			</tr>
			<tr>
				<th class="align-middle" colspan="5">VOL. GATO HIDRÁULICO</th>
				<th class="align-middle" colspan="4">VOL. BORDES DEL VOLCO</th>
			</tr>
			<tr>
				<td>PLACA</td>
				<td>A</td>
				<td>L</td>
				<td>H</td>
				<th>VB</th>
				<td>BM</td>
				<td>Bm</td>
				<td>H</td>
				<td>A</td>
				<th>GH</th>
				<td>b</td>
				<td>H</td>
				<td>L</td>
				<th>BV</th>
			</tr>
		</thead>
		<tbody>
		  	<tr>
				<th class="text-center">{{ $cubicaje->vehiculo->placa }}</th>
				<th class="text-right">{{ number_format($cubicaje->volumen_ancho, 2, ',', '.') }}</th>
				<th class="text-right">{{ number_format($cubicaje->volumen_largo, 2, ',', '.') }}</th>
				<th class="text-right">{{ number_format($cubicaje->volumen_alto, 2, ',', '.') }}</th>
				<th class="text-right">{{ number_format($cubicaje->volumen_ancho * $cubicaje->volumen_largo * $cubicaje->volumen_alto, 2, ',', '.') }}</th>
				<th class="text-right">{{ number_format($cubicaje->gato_mayor, 2, ',', '.') }}</th>
				<th class="text-right">{{ number_format($cubicaje->gato_menor, 2, ',', '.') }}</th>
				<th class="text-right">{{ number_format($cubicaje->gato_alto, 2, ',', '.') }}</th>
				<th class="text-right">{{ number_format($cubicaje->gato_ancho, 2, ',', '.') }}</th>
				<th class="text-right">{{ number_format((($cubicaje->gato_mayor + $cubicaje->gato_menor)/2) * $cubicaje->gato_alto * $cubicaje->gato_ancho, 2, ',', '.') }}</th>
				<th class="text-right">{{ number_format($cubicaje->borde_base, 2, ',', '.') }}</th>
				<th class="text-right">{{ number_format($cubicaje->borde_alto, 2, ',', '.') }}</th>
				<th class="text-right">{{ number_format($cubicaje->borde_largo, 2, ',', '.') }}</th>
				<th class="text-right">{{ number_format((($cubicaje->borde_base * $cubicaje->borde_alto)/2) * $cubicaje->borde_largo * 2, 2, ',', '.') }}</th>
				<th class="text-right">{{ number_format($cubicaje->volumen, 2, ',', '.') }}</th>
			</tr>
		</tbody>
	</table>
	<h2>FÓRMULAS UTILIZADAS</h2>
	<table class="table table-bordered">
		<thead class="text-center">
			<tr>
				<th>VOLUMEN BRUTO = VB</th>
				<th>VOL. GATO HIDRÁULICO = GH</th>
				<th>VOL. BORDES DEL VOLCO = BV</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					Volumen de un prisma rectangular<br/>
					<img src="{{ asset('img/formula/VB.png') }}" alt="Garzón Romero"><br/>
					<b>A</b> = Ancho<br/>
					<b>L</b> = Largo<br/>
					<b>H</b> = Alto
				</td>
				<td>
					Área del Trapecio por el Ancho<br/>
					<img src="{{ asset('img/formula/GH.png') }}" alt="Garzón Romero"><br/>
					<b>BM</b> = Borde Mayor<br/>
					<b>Bm</b> = Borde Menor<br/>
					<b>H</b> = Alto<br/>
					<b>A</b> = Ancho
				</td>
				<td>
					Área del triángulo rectángulo X Largo X 2<br/>
					<img src="{{ asset('img/formula/BV.png') }}" alt="Garzón Romero"><br/>
					<b>b</b> = Base<br/>
					<b>H</b> = Alto<br/>
					<b>L</b> = Largo<br/>
				</td>
			</tr>
		</tbody>
	</table>
	<h2>VOLQUETAS Y MEDIDAS</h2>
	<p class="text-justify">{{ $cubicaje->observacion }}</p>
	<h2>Firmas</h2>
	<table class="table table-bordered">
		<thead class="text-center">
			<tr>
				<td class="p-5 m-5">&nbsp;</td>
				<td class="p-5 m-5">&nbsp;</td>
				<td class="p-5 m-5">&nbsp;</td>
			</tr>
			<tr>
				<th>{{ $cubicaje->titular }}</th>
				<th>{{ $cubicaje->operador }}</th>
				<th>{{ $cubicaje->transportador }}</th>
			</tr>
		</thead>
	</table>
</body>
</html>