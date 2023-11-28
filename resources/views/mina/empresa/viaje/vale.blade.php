<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ config('app.name', 'Laravel') }} - Certificado Vale</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}"/>
    <style>
        *{
            font-family: 'Arial', sans-serif;
        }
        #table {
            width: 100%;
            border: 1px solid #000;
            font-size: 12px;
            border-spacing: 0;
            border-radius: 10px !important;
        }
        h1{
            font-family: 'Arial', sans-serif;
            font-size: 25px;
            font-weight: bold !important;
        }
        h2 {
            font-size: 12px;
            margin-left: 4px;
            margin-right: 4px;
            font-weight: bold;
        }
        .logo {
            height: 40px;
        }
        .firma {
            height: 60px;
        }
        .texto10{
            font-size: 10px;
        }
        .derecha {
            text-align: right;
        }
        .flota-derecha {
            float: right;
        }
        .centro {
            text-align: center;
        }
        .borde {
            border-top: 1px solid #000;
        }
        .borde-arriba {
            border-top: 1px solid #000;
        }
        .borde-abajo {
            border-bottom: 1px solid #000;
        }
        .borde-derecha {
            border-right: 1px solid #000;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td>
                <img src="{{ asset('img/villaUfaz.jpg') }}" style="width: 170px;height:80px;" class="logo">
            </td>
            <td>
                <h1>DESPACHO DE MATERIALES No.</h1>
            </td>
            <td class="centro">
                <div style="padding: 0px 40px;border: 1px solid #000;border-radius:10px;">
                    <h1>{{ $dato->id }}</h1>
                </div>
            </td>
        </tr>
    </table>
    <h5 style="position:absolute;top:10%;left:4%;">NIT. 900.349.029-7</h5>
    <table id="table">
        <tbody>
            <tr class="centro">
                <td colspan="1" class="borde-derecha">
                    <h4>FECHA</h4>
                </td>
                <td colspan="1" class="borde-derecha">{{ $dato->fecha_nombre }}</td>
                <td colspan="2" class="borde-derecha">
                    <h4>REMISIÓN</h4>
                </td>
                <td colspan="4">
                    {{ $dato->nro_viaje }}
                </td>
            </tr>
            <tr class="centro">
                <td class="borde">
                    <h4>MATERIAL</h4>
                </td>
                <td colspan="7" class="borde">
                    {{ $dato->material->nombre }}
                </td>
            </tr>
            <tr class="centro">
                <td class="borde">
                    <h4>M3</h4>
                </td>
                <td colspan="7" class="borde">
                    {{ $dato->volumen }} M3
                </td>
            </tr>
            <tr class="centro">
                <td class="borde">
                    <h4>CLIENTE</h4>
                </td>
                <td colspan="7" class="borde">
                    {{ $dato->cliente ?? "" }}
                </td>
            </tr>
            <tr class="centro">
                <td class="borde">
                    <h4>DESTINO</h4>
                </td>
                <td colspan="7" class="borde">
                    {{ $dato->destino ?? "" }}
                </td>
            </tr>
            <tr class="centro">
                <td class="borde">
                    <h4>CONDUCTOR</h4>
                </td>
                <td colspan="7" class="borde">
                    {{ $dato->conductor->nombre }}
                </td>
            </tr>
            <tr class="centro">
                <td class="borde">
                    <h4>PLACA</h4>
                </td>
                <td colspan="7" class="borde">
                    {{ $dato->vehiculo->placa }}
                </td>
            </tr>
            <tr class="centro">
                <td class="borde">
                    <h4>DESPACHADO</h4>
                </td>
                <td colspan="7" class="borde">
                    {{ $dato->usuarioCreado->name }}
                </td>
            </tr>
            <tr class="centro">
                <td class="borde">
                    <h4>ACEPTADO</h4>
                </td>
                <td colspan="7" class="borde">
                    <img src="{{ (is_null($dato->operador->firma)) ? asset('..'.$carpeta.'/storage/app/public/firma/firma.jpg') : asset('..'.$carpeta.'/storage/app/'.$dato->operador->firma) }}" class="firma" alt="Firma">
                </td>
            </tr>
        </tbody>
    </table>
    <p class="centro">KM 4 VÍA LA MESA, HACIENDA VENECIA (MOSQUERA) VEREDA BALSILLAS.</p>
    <p class="centro">Tels. 3125408487 - 3002182686</p>
</body>
</html>