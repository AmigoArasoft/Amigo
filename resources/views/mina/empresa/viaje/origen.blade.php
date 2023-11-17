<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ config('app.name', 'Laravel') }} - Certificado de origen</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}"/>
    <style>
        table {
            width: 100%;
            border: 1px solid #000;
            font-size: 12px;
            border-spacing: 0;
            border-collapse: collapse;
        }
        table, td {
            padding: 4px;
        }
        h1, h2 {
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
            border: 1px solid #000;
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
        .col {
            width: 12.5%;
        }
        .color0 {
            color: #fff;
            background-color: #008080;
        }
        .color1 {
            color: #000;
            background-color: #ABEBC6;
        }
        .color2 {
            color: #000;
            background-color: #fff;
        }
    </style>
</head>
<body>
    <table>
        <tbody>
            <tr>
                <td colspan="1" class=""><img src="{{ asset('img/anm.png') }}" class="logo"></td>
                <td colspan="6" class="centro">
                    <h1>VICEPRESIDENCIA DE SEGUIMIENTO CONTROL Y SEGURIDAD MINERA</h1>
                    <h2>Grupo de Regalías y Contraprestaciones Económicas</h2>
                </td>
                <td class="derecha"><img src="{{ asset('img/villaUfaz.jpg') }}" class="logo"></td>
            </tr>
            <tr>
                <td colspan="8" class="centro color0 borde">CERTIFICADO DE ORIGEN EXPLOTADOR MINERO AUTORIZADO</td>
            </tr>
            <tr class="centro">
                <td colspan="1" class="color1 borde-arriba">FECHA</td>
                <td colspan="2" class="borde-derecha">{{ $dato->fecha_nombre }}</td>
                <td colspan="4" class="color1">No. Consecutivo del certificado de origen</td>
                <td colspan="1">{{ $dato->id }}</td>
            </tr>
            <tr>
                <td colspan="8" class="centro color0 borde-arriba borde-abajo">INFORMACIÓN DEL PRODUCTOR DEL MINERAL</td>
            </tr>
            <tr class="color1">
                <td colspan="2" rowspan="2" class="borde-derecha centro">EXPLOTADOR MINERO AUTORIZADO</td>
                <td colspan="3" class="borde-derecha borde-abajo">Titular Minero <input class="flota-derecha" type="checkbox" checked></td>
                <td colspan="3" class="borde-abajo texto10">Beneficiario de Área de Reserva Especial <input class="flota-derecha" type="checkbox"></td>
            </tr>
            <tr class="color1">
                <td colspan="3" class="borde-derecha">Solicitante de  Legalización <input class="flota-derecha" type="checkbox"></td>
                <td colspan="3">Subcontrato de  Formalización <input class="flota-derecha" type="checkbox"></td>
            </tr>
            <tr class="centro">
                <td colspan="2" class="borde">CÓDIGO EXPEDIENTE</td>
                <td colspan="6" class="borde"><b>20718</b></td>
            </tr>
            <tr class="centro">
                <td colspan="2" class="borde">NOMBRES Y APELLIDOS O RAZON SOCIAL DEL EXPLOTADOR MINERO AUTORIZADO</td>
                <td colspan="6" class="borde"><b>GARZON ROMERO G. SAS</b></td>
            </tr>
            <tr>
                <td colspan="2" class="borde centro">TIPO DE IDENTIFICACIÓN DEL EXPLOTADOR MINERO AUTORIZADOR</td>
                <td colspan="1" class="borde texto10">NIT <input type="checkbox" checked></td>
                <td colspan="1" class="borde texto10">CÉDULA <input type="checkbox"></td>
                <td colspan="3" class="borde texto10">CÉDULA DE<br>EXTRANJERÍA <input type="checkbox"></td>
                <td colspan="1" class="borde texto10">RUT <input type="checkbox"></td>
            </tr>
            <tr class="centro">
                <td colspan="2" class="borde">No. DOCUMENTO DE IDENTIDAD  DEL EXPLOTADOR MINERO AUTORIZADOR</td>
                <td colspan="6" class="borde"><b>900.349.029-7</b></td>
            </tr>
            <tr class="centro">
                <td colspan="2" class="borde">DEPARTAMENTO (S) DONDE REALIZA LA EXPLOTACIÓN</td>
                <td colspan="6" class="borde"><b>CUNDINAMARCA</b></td>
            </tr>
            <tr class="centro">
                <td colspan="2" class="borde">MUNICIPIO(S) DONDE SE REALIZA LA EXPLOTACION</td>
                <td colspan="6" class="borde"><b>MOSQUERA</b></td>
            </tr>
            <tr class="centro">
                <td colspan="2" class="borde">MINERAL EXPLOTADO</td>
                <td colspan="6" class="borde"><b>{{ $dato->material->nombre }} - {{ $dato->submaterial->nombre }}</b></td>
            </tr>
            <tr class="centro">
                <td colspan="2" class="borde">CANTIDAD MINERAL COMERCIALIZADO</td>
                <td colspan="6" class="borde"><b>{{ $dato->volumen }}</b></td>
            </tr>
            <tr class="centro">
                <td colspan="2" class="borde">UNIDAD DE MEDIDA</td>
                <td colspan="6" class="borde"><b>Metro cúbico m3</b></td>
            </tr>
            <tr>
                <td colspan="8" class="centro color0 borde">INFORMACIÓN DEL COMPRADOR DEL MINERAL</td>
            </tr>
            <tr class="centro">
                <td colspan="2" class="borde color1">NOMBRES Y APELLIDOS O RAZON SOCIAL</td>
                <td colspan="6" class="borde"><b>{{ $dato->operador->nombre }}</b></td>
            </tr>
            <tr>
                <td colspan="2" class="borde centro color1">TIPO DE IDENTIFICACIÓN</td>
                <td colspan="1" class="borde texto10">NIT <input type="checkbox"{{ ($dato->operador->documento_id == 6) ? ' checked' : '' }}></td>
                <td colspan="1" class="borde texto10">CÉDULA <input type="checkbox"{{ ($dato->operador->documento_id == 3) ? ' checked' : '' }}></td>
                <td colspan="3" class="borde texto10">CÉDULA DE<br>EXTRANJERÍA <input type="checkbox"{{ ($dato->operador->documento_id == 4) ? ' checked' : '' }}></td>
                <td colspan="1" class="borde texto10">RUT <input type="checkbox"{{ ($dato->operador->documento_id == 7) ? ' checked' : '' }}></td>
            </tr>
            <tr>
                <td colspan="2" class="borde color1 centro">COMPRADOR</td>
                <td colspan="3" class="borde">COMERCIALIZADOR <input type="checkbox"{{ ($dato->operador->comprador_id == 49) ? ' checked' : '' }}></td>
                <td colspan="3" class="borde">CONSUMIDOR <input type="checkbox"{{ ($dato->operador->comprador_id == 50) ? ' checked' : '' }}></td>
            </tr>
            <tr class="centro">
                <td colspan="2" class="borde color1">No. DOCUMENTO DE IDENTIDAD</td>
                <td colspan="6" class="borde">{{ $dato->operador->documento }}</td>
            </tr>
            <tr class="centro">
                <td colspan="2" class="borde color1">RUCOM</td>
                <td colspan="6" class="borde">RUCOM-{{ $dato->operador->rucom }}</td>
            </tr>
            <tr class="centro">
                <td colspan="2" class="borde color0">FIRMA DEL EXPLOTADOR MINERO AUTORIZADO</td>
                <td colspan="6" class="borde">
                    <img src="{{ (is_null($dato->operador->firma)) ? asset('..'.$carpeta.'/storage/app/public/firma/firma.jpg') : asset('..'.$carpeta.'/storage/app/'.$dato->operador->firma) }}" class="firma" alt="Firma">
                </td>
            </tr>
        </tbody>
    </table>
    <<p class="texto10">Para verificar la autenticidad del presente Certificado de Orígen por favor consulte: <a href="https://garzonromero.com/mina/origen?id={{ $dato->id }}" href="blank">https://garzonromero.com/mina/origen?id={{ $dato->id }}</a></p>
</body>
</html>