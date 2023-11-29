<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>
<body>
	<div style="font-size:16px !important;">
		<img src="{{storage_path('app/public/villaUfaz.jpg')}}">
		<h4 style="font-size:16px !important;">Relación de material extraído de la mina el {{ $factura->fecha_nombre }}</h4>
		<h4 style="font-size:16px !important;">{{ $factura->tercero->nombre }}</h4>
	</div>
	<table style="border-collapse: collapse;">
	    <tbody>
			<tr>
				<td style="border: 2px solid #000;font-weight:bold;font-size:14px !important;">
					<b>Período de facturación</b>
				</td>
				<td style="text-align: right;border: 2px solid #000;">{{ $factura->fecha_nombre }}</td>
			</tr>
			<tr>
				<td style="border: 2px solid #000;font-weight:bold;font-size:14px !important;">
					<b>Total viajes</b>
				</td>
				<td style="text-align: right;border: 2px solid #000;">{{ count($viajes) }}</td>
			</tr>
			<tr>
				<td style="border: 2px solid #000;font-weight:bold;font-size:14px !important;">
					<b>Valor</b>
				</td>
				<td style="border: 2px solid #000;text-align:right;font-weight:bold;font-size:14px !important;">
					$ {{ number_format($factura->valor, 0, ',', '.') }}
				</td>
			</tr>
	    </tbody>
	</table>

	<div class="centro">
		<h4 style="font-size:16px !important;">
			DETALLE
		</h4>
	</div>
	<table style="border-collapse: collapse;">
		<thead>
			<tr>
				<th style="border: 2px solid #000;text-align:center;font-weight:bold;font-size:14px !important;"><b>Material</b></th>
				<th style="border: 2px solid #000;text-align:center;font-weight:bold;font-size:14px !important;"><b>m3</b></th>
				<th style="border: 2px solid #000;text-align:center;font-weight:bold;font-size:14px !important;"><b>Valor Unit.</b></th>
				<th style="border: 2px solid #000;text-align:center;font-weight:bold;font-size:14px !important;"><b>Valor Total</b></th>
			</tr>
		</thead>
	    <tbody >
			@foreach ($factura->materiales as $item)
				<tr>
					<td style="border: 1px solid #000;font-size:12px !important;">
						{{ $item->nombre }}
					</td>
					<td style="text-align: right;border: 1px solid #000;font-size:12px !important;">
						{{ $item->volumen }}
					</td>
					<td style="text-align: right;border: 1px solid #000;font-size:12px !important;">
						$ {{ number_format($item->valor, 0, ',', '.') }}
					</td>
					<td style="text-align: right;border: 1px solid #000;font-size:12px !important;">
						$ {{ number_format($item->total, 0, ',', '.') }}
					</td>
				</tr>
			@endforeach
			<tr>
				<td style="border: 2px solid #000;font-weight:bold;font-size:14px !important;">
					TOTAL
				</td>
				<td style="border: 2px solid #000;text-align:right;font-weight:bold;font-size:14px !important;">
					{{ $factura->materiales->sum('volumen') }}
				</td>
				<td style="border: 2px solid #000;text-align:right;font-weight:bold;font-size:14px !important;">
				</td>
				<td style="border: 2px solid #000;text-align:right;font-weight:bold;font-size:14px !important;">
					$ {{ number_format($factura->materiales->sum('total'), 0, ',', '.') }}
				</td>
			</tr>
	    </tbody>
	</table>
	<table style="border-collapse: collapse;">
	    <thead>
	        <tr>
	            <th style="border: 2px solid #000;text-align:center;font-weight:bold;font-size:14px !important;">Fecha</th>
	            <th style="border: 2px solid #000;text-align:center;font-weight:bold;font-size:14px !important;">Placa</th>
	            <th style="border: 2px solid #000;text-align:center;font-weight:bold;font-size:14px !important;">Subgrupo</th>
	            <th style="border: 2px solid #000;text-align:center;font-weight:bold;font-size:14px !important;">Material</th>
	            <th style="border: 2px solid #000;text-align:center;font-weight:bold;font-size:14px !important;">Volumen</th>
	        </tr>
	    </thead>
	    <tbody>
	    	@foreach ($viajes as $e)
	    		<tr>
	    			<td style="border: 1px solid #000;font-size:12px !important;">{{ $e->fecha }}</td>
	    			<td style="border: 1px solid #000;font-size:12px !important;">{{ $e->placa }}</td>
	    			<td style="border: 1px solid #000;font-size:12px !important;">{{ $e->subgrupo->nombre }}</td>
	    			<td style="border: 1px solid #000;font-size:12px !important;">{{ $e->material->nombre }}</td>
	    			<td style="border: 1px solid #000;font-size:12px !important;">{{ $e->volumen }}</td>
	    		</tr>
	    	@endforeach
	    </tbody>
	</table>
</body>
</html>