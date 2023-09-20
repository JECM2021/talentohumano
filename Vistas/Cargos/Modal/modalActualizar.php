<div div class="modal fade " id="modalEdiCargos" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id=""><strong>Actualizar informaci&oacute;n.</strong></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form name="" method="" action="" id="">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Codigo:</label>
                                    <input type="text" class="form-control input-sm" id="txtCodigoEdi" name="txtCodigoEdi" value="" placeholder="">
                                </div>
                                <div class="col-md-3">
                                    <label>Nombre o Descripcion:</label>
                                    <input type="text" class="form-control input-sm" id="txtNombreEdi" name="txtNombreEdi" value="" placeholder="">
                                </div>
                                <div class="col-md-3">
                                    <label>Fecha de Creacion:</label>
                                    <input type="date" class="form-control input-sm" name="fechaCreacionEdi" id="fechaCreacionEdi">
                                </div>
                                <div class="col-md-3">
                                    <label>Estado del Cargo:</label>
                                    <div class="">
                                        <select id="cmbTipoEstadoEdi" name="cmbTipoEstadoEdi" class="form-control input-sm ">
                                            <option value="">Seleccione</option>
                                            <option value="A">Activo</option>
                                            <option value="I">Inactivo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm " id="btnActualizar" name="btnActualizar">Actualizar</button>
                <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Cancelar.</button>
            </div>
        </div>
    </div>
</div>