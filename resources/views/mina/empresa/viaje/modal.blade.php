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