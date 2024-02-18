<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enviar Certificado de Origen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => 'enviar.correos']) !!}
          <div class="form-group">
            <label for="emails">Correos a enviar</label>
            <input type="text" class="form-control" name="emails" placeholder="Ejemplo: correo@correo.com,otrocorreo@correo.com">
            <small id="emailHelp" class="form-text text-muted">Para enviar múltiples correos, utilice este ejemplo: correo@correo.com,otrocorreo@correo.com</small>
          </div>
          <input type="hidden" name="id" id="id_documento_correo">
          <input type="hidden" name="tipo_documento" id="tipo_documento">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Enviar correos</button>
      </div>
        {!! Form::close() !!}
    </div>
  </div>
</div>

<div class="modal fade" id="modalCargando" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span>Cargando...</span>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalChangeVolume" tabindex="-1" role="dialog" aria-labelledby="modalChangeVolumeLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalChangeVolumeLabel">Cambiar Volumen M3</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => 'cambiar.volumen']) !!}
          <div class="form-group">
            <label for="volumen">Cantidad M3</label>
            <input type="number" class="form-control" name="volumen" placeholder="Ingrese la cantidad a cambiar" step=".01">
            <small id="emailHelp" class="form-text text-muted">El monto debe ser numérico</small>
          </div>
          <input type="hidden" name="id_viaje" id="id_viaje">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

<div class="modal fade" id="modalCertificateTrips" tabindex="-1" role="dialog" aria-labelledby="modalCertificateTripsLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCertificateTripsLabel">Certificar viajes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => 'viaje.certificar']) !!}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="volumen">Operador</label>
                <select name="operador_id" id="operador_id" class="form-control form-control-sm selectpicker" data-live-search="true" onchange="getOperadorViajeCertificado()">
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="volumen">Viajes</label>
                <select name="viajes_id[]" id="viajes_id" class="form-control form-control-sm selectpicker" data-live-search="true" multiple>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="fecha_certificacion">Fecha de certificación</label>
                <input type="date" class="form-control" name="fecha_certificacion" placeholder="Ingrese la fecha de certificado" value="now">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="numero_certificacion">Número de certificación</label>
                <input type="text" class="form-control" name="numero_certificacion" placeholder="Ingrese el numero de certificado">
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>