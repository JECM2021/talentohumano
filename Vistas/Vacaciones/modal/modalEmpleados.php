<div class="modal fade " id="mdlEmpleados" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="">
                    <strong>Empleados.</strong>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <input type="text" name="txtFiltroFondo" id="txtFiltroFondo" class="form-control input-sm" onclick="filtrarDatos('txtFiltroFondo', 'tblFiltradoFondo')" placeholder="Buscar..."><br>
                        <div id="divVisualizarFondo" style="overflow: auto; width: 100%; height:350px" class="">
                            <table id='tbl_visualizar_fondo' style='font-size: 11px;' class='table-condensed table-bordered  table table-bordered callback1 table-hover'>
                                <thead class="">
                                    <tr class="info">
                                        <th>Tipo de Documento</th>
                                        <th>Numero de Documento</th>
                                        <th>Nombres y Apellidos</th>
                                        <th>Tipo Contratacion</th>
                                    </tr>
                                </thead>
                                <tbody id="tboBodyEmpleado" style="cursor: pointer"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-warning btn-sm" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalActulizarHistorial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titleModal">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    Acompañante
                </h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Periodo vencido Desde</label>
                            <input type="hidden" id="txtIdVacDet" name="txtIdVacDet" value="0" />
                            <input type="date" class="form-control input-sm" name="txtFechaInicioPvAct" id="txtFechaInicioPvAct">
                        </div>
                        <div class="col-md-3">
                            <label>Periodo Vencido Hasta</label>
                            <input type="date" class="form-control input-sm" name="txtFechaFinPvAct" id="txtFechaFinPvAct">
                        </div>
                        <div class="col-md-3">
                            <label>Inicio Vacaciones</label>
                            <input type="date" class="form-control input-sm" name="txtFechaInicioVacAct" id="txtFechaInicioVacAct">
                        </div>
                        <div class="col-md-3">
                            <label>Final Vacaciones</label>
                            <input type="date" class="form-control input-sm" name="txtFechaFinVacAct" id="txtFechaFinVacAct">
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Estado Vacaciones</label>
                            <select class="form-control  input-sm" id="cmbEstadoVacaciones" name="cmbEstadoVacaciones">
                                <option value="">Seleccione</option>
                                <option value="C">Completadas</option>
                                <option value="I">No Completadas</option>
                            </select>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Observaciones</label>
                            <div class="">
                                <textarea class="form-control" id="txtObservacionesAct" name="txtObservacionesAct" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnActualizar" name="btnActualizar">Actualizar</button>
            </div>
        </div>
    </div>
</div>