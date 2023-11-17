<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href="{{ asset('asset/adminLTE/css/adminlte.min.css') }}" rel="stylesheet">
</head>
<body>
	<table>
	    <thead>
	        <tr>
	            <th>Fecha</th>
	            <th>Vehículo</th>
	            <th>Material</th>
	            <th>Sub material</th>
	            <th>Volúmen</th>
	        </tr>
	    </thead>
	    <tbody>
	    	@foreach ($viajes as $e)
	    		<tr>
	    			<td>{{ $e->fecha }}</td>
	    			<td>{{ $e->placa }}</td>
	    			<td>{{ $e->material }}</td>
	    			<td>{{ $e->submaterial }}</td>
	    			<td>{{ $e->volumen }}</td>
	    		</tr>
	    	@endforeach
	    </tbody>
	</table>
</body>
</html>