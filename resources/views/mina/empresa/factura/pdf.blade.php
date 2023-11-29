<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href="{{ asset('asset/adminLTE/css/adminlte.min.css') }}" rel="stylesheet">
	<style>
		* {
			font-family: Arial, Helvetica, sans-serif;
		}

		.centro {
			width: 100%;
			text-align: center;
		}

		h4{
			font-weight: bold;
		}

		table {
			border-collapse: collapse;
		}

		table, td, th {
			border: 2px solid #000;
		}

		td {
			padding: 0 5px 0 5px;
		}

		.left-position {
			text-align: right;
		}
	</style>
</head>
<body>
	<div class="centro">
		<img src="{{ asset('/img/villaUfaz.jpg') }}">
		<h4>Relación de material extraído de la mina el {{ $factura->fecha_nombre }}</h4>
		<h4>{{ $factura->tercero->nombre }}</h4>
	</div>
	<table>
	    <tbody>
			<tr>
				<td>
					<b>Período de facturación</b>
				</td>
				<td class="left-position">{{ $factura->fecha_nombre }}</td>
			</tr>
			<tr>
				<td>
					<b>Total viajes</b>
				</td>
				<td class="left-position">{{ count($viajes) }}</td>
			</tr>
			<tr>
				<td>
					<b>Valor</b>
				</td>
				<td class="left-position">$ {{ number_format($factura->valor, 0, ',', '.') }}</td>
			</tr>
	    </tbody>
	</table>

	<div class="centro">
		<h4>
			DETALLE
		</h4>
	</div>
	<table style="width: 100%;">
		<thead>
			<tr>
				<th>Material</th>
				<th>m3</th>
				<th>Valor Unit.</th>
				<th>Valor Total</th>
			</tr>
		</thead>
	    <tbody>
			@foreach ($factura->materiales as $item)
				<tr>
					<td>
						{{ $item->nombre }}
					</td>
					<td class="left-position">
						{{ $item->volumen }}
					</td>
					<td class="left-position">
						$ {{ number_format($item->valor, 0, ',', '.') }}
					</td>
					<td class="left-position">
						$ {{ number_format($item->total, 0, ',', '.') }}
					</td>
				</tr>
			@endforeach
	    </tbody>
	</table>
	<div class="centro">
		<h4>
			DISCRIMINACIÓN
		</h4>
	</div>
	<table style="width: 100%;">
	    <thead>
	        <tr>
	            <th>Fecha</th>
	            <th>Placa</th>
	            <th>Subgrupo</th>
	            <th>Material</th>
	            <th>Volumen</th>
	        </tr>
	    </thead>
	    <tbody>
	    	@foreach ($viajes as $e)
	    		<tr>
	    			<td>{{ $e->fecha }}</td>
	    			<td>{{ $e->placa }}</td>
	    			<td>{{ $e->subgrupo->nombre }}</td>
	    			<td>{{ $e->material->nombre }}</td>
	    			<td>{{ $e->volumen }}</td>
	    		</tr>
	    	@endforeach
	    </tbody>
	</table>
</body>
</html>