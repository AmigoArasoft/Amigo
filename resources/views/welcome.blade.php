@extends('plantilla.web')

@section('titulo', 'Garzón Romero')

@section('contenido')
<div data-spy="scroll" data-target="#menuWeb" data-offset="0">
    <div id="inicio">
        @include('plantilla.webCarrusel')
    </div>
    @include('plantilla.webMenu')
    <div class="bg-light pt-5" id="nosotros">
        <div class="container py-5 text-justify">
            <h2 class="text-center pardo">NOSOTROS</h2>
            <h3 class="text-center pardo py-4">RESEÑA HISTÓRICA</h3>
            <p>La gestión para la adjudicación de la mina <b>VILLA UFAZ</b>, se inició en junio de 1997, 10 años después, junio de 2007, 
                la autoridad minera: Ingeominas, hoy <a href="https://www.anm.gov.co" target="_blank">Agencia Nacional Minera</a>; otorga 
                el título minero 20718, modalidad contrato de concesión.<p>
            <p>Cuenta con licencia ambiental, resolución No. 1943 de 22 de junio de 2010, expedida por la 
                <a href="https://www.car.gov.co" target="_blank">Corporación Autónoma Regional de Cundinamarca – CAR</a>. 
                Expediente ambiental  No. 34076 de la CAR regional de Facatativá.</p>
            <p>En el primer frente, se iniciaron labores mineras de explotación desde el 11 de marzo del año 2014, con actividades de 
                preparación de patios, labores de descapote construcción de vías de acceso y se da inicio a los cortes de acuerdo a los 
                estudios del PTO y PMA en terrazas de trabajo provisional en julio del mismo año.</p>
            <p>El segundo frente de trabajo, se inició la explotación el 13 de enero de 2017.</p>
            <p>Los dos frentes se entregaron, bajo sendos contratos, en la modalidad de operación minera, los operan empresas legalmente 
                constituidas quienes se apegan a las obligaciones mineras y ambientales y están  amparadas con pólizas de cumplimiento que 
                prevén un efectivo cumplimiento, incluida seguridad social y  garantías laborales.</p>
            <p>El tercer frente está inactivo por dificultades de servidumbre minera que se están ventilando por vía administrativa con la 
                alcaldía correspondiente.</p>
        </div>
    </div>
    <div class="parallax text-white bg-gradiente50" style="background-image: url('{{ asset('img/fondo2.jpg') }}');">
        <div class="bg-gradiente50 py-5">
            <div class="container text-justify">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mr-md-2">
                            <h3 class="text-center pardoClaro pb-3">MISIÓN</h3>
                            <p>Explotar materiales de construcción (recebo) y sus derivados.</p>
                            <p>Cumplir las clausulas en desarrollo del objeto del contrato de concesión minera.</p>
                            <p>Cumplir las obligaciones contraídas en la licencia ambiental, procurando disminuir el impacto ambiental, basado en las Guías Minero Ambientales publicadas por los Ministerios de Minas y Energía y Medio Ambiente y los Términos de Referencia para la Elaboración de Estudios de Impacto Ambiental (EIA), para canteras de Materiales de Construcción y Arcillas entregadas en la Corporación Autónoma Regional de Cundinamarca - CAR.</p>
                            <p>Cumplir con la legislación vigente en Seguridad en el trabajo y normativa laboral del ordenamiento legal colombiano.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="ml-md-2">
                            <h3 class="text-center pardoClaro pb-3">VISIÓN</h3>
                            <p>Empresa reconocida a nivel nacional  y número uno a nivel regional, que provee  los mejores materiales pétreos para la construcción, que cumplan con las normas, necesidades y garanticen con calidad obras urbanísticas y civiles en nuestro país.</p>
                            <p>Utiliza  maquinaria de última  generación y amigable con el medio ambiente.</p>
                            <p>nnovadora y a la vanguardia de una minería limpia, protectora del ambiente y la dignidad de las personas, comprometida con la sociedad. Digna de mostrar a nivel nacional, regional e internacional por sus mejores prácticas mineras de cantera.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-light pt-5" id="operacion">
        <div class="container py-5 text-justify">
            <h2 class="text-center pardo">OPERACIÓN</h2>
        </div>
    </div>
    <div>
        <img src="{{ asset('img/animacion/villaufaz.gif') }}" class="img-fluid" alt="Operación VillaUfaz">
    </div>
    <div class="bg-light pt-5" id="descarga">
        <div class="container py-5 text-justify">
            <h2 class="text-center pardo">DESCARGA</h2>
        </div>
    </div>
    <div class="parallax text-white bg-gradiente50" style="background-image: url('{{ asset('img/fondo1.jpg') }}');">
        <div class="bg-gradiente50 py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 text-center text-md-right">DESCARGAR NUESTRO BROCHURE</div>
                    <div class="col-md-3 text-center text-md-left">
                        <a href="{{ asset('doc/brouchure.pdf') }}" target="_blank" class="btn btn-outline-light">Descarga aquí</a>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-9 text-center text-md-right">PROTOCOLO DE OPERACIÓN PARA REDUCCIÓN DE RIESGO DE EXPOSICIÓN Y CONTAGIO DE COVID-19</div>
                    <div class="col-md-3 text-center text-md-left">
                        <a href="{{ asset('doc/protocolo_operacion_mina_VillaUfaz.pdf') }}" target="_blank" class="btn btn-outline-light">Descarga aquí</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-light pt-5" id="galeria">
        <div class="container py-5 text-justify">
            <h2 class="text-center pardo">GALERÍA DE IMÁGENES</h2>
        </div>
    </div>
    <div class="bg-pardoClaro">
        <div class="container" id="galeriaImagen">
            <div class="row py-3">
                @for($i = 1; $i < 22; $i++)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="" data-toggle="modal" data-target="#modal{{ $i }}">
                            <img class="img-fluid my-2" src="{{ asset('img/galeria/mina0'.$i.'.jpg') }}" alt="Galería de imágenes VillaUfaz">
                        </a>
                    </div>
                @endfor
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <img class="img-fluid my-2" src="{{ asset('img/galeria/sMina01.jpg') }}" alt="Galería de imágenes VillaUfaz">
                </div>
            </div>
        </div>
    </div>
    <div class="bg-light pt-5" id="contacto">
        <div class="container py-5 text-center">
            <h2 class="pardo">CONTACTO</h2>
        </div>
    </div>
    <div class="parallax text-white bg-gradiente50" style="background-image: url('{{ asset('img/fondo3.jpg') }}');">
        <div class="bg-gradiente50 py-5">
            <p class="text-center pb-5">Si nos quieres contactar, lo puedes hacer desde esta sección.</p>
            <div class="container">
                @if(Session::has('success'))
                    <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                        <b>{{Session::get('success')}}</b>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form method="POST" action="{{ route('contacto') }}">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <input name="nombre" id="nombre" type="text" class="form-control form-control-lg text-center" placeholder="Escribe tu nombre">
                            @if ($errors->has('nombre'))
                                <div class="text-warning">
                                    {{ $errors->first('nombre') }}
                                </div>
                            @endif
                        </div>
                        <div class="col">
                            <input name="correo" id="correo" type="email" class="form-control form-control-lg text-center" placeholder="Escribe tu email">
                            @if ($errors->has('correo'))
                                <div class="text-warning">
                                    {{ $errors->first('correo') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row py-5">
                        <div class="col">
                            <textarea name="mensaje" id="mensaje" class="form-control form-control-lg text-center" rows="5" placeholder="Escribe tu mensaje"></textarea>
                            @if ($errors->has('mensaje'))
                                <div class="text-warning">
                                    {{ $errors->first('mensaje') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-light btn-lg">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@for($i = 1; $i < 22; $i++)
<div class="modal fade" id="modal{{ $i }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body p-0">
                <button type="button" class="close pr-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <img class="img-fluid" src="{{ asset('img/galeria/mina0'.$i.'.jpg') }}" alt="Galería de imágenes VillaUfaz">
            </div>
        </div>
    </div>
 </div>
@endfor
@endsection

@section('codigo')
<script src="{{ asset('js/webMina.js') }}"></script>
@endsection