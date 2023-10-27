  <!--Modal buscar Pacientes -->
  <div class="modal fade" id="mdlBuscarEmpleados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                          <div id="divVisualizarPacientes" style=" width: 100%; height:auto" class="">
                              <table id='tbl_visualizar_Pacientes' style='font-size: 11px;width: 100%;' class='table-condensed table-bordered  table table-bordered callback1 table-hover'>
                                  <thead class="">
                                      <tr class="info">
                                          <th class='center'>#</th>
                                          <th class='center'>DOCUMENTO </th>
                                          <th class='center'>NOMBRES Y APELLIDOS</th>
                                          <th class="center">NUMERO DE CONTRATO</th>
                                          <th class='center'>CENTRO DE TRABAJO</th>
                                      </tr>
                                  </thead>
                                  <tbody id="tbodyPacientes" style="cursor: pointer"></tbody>
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
  <!--========aqui Inicia el modal pdf===========-->
  <div class="modal fade" id="ModalPdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content" style="height: 850px;">
              <div class="modal-header">
                  <h4 class="modal-title" id="exampleModalLabel"><i class="far fa-file-pdf" aria-hidden="true"></i><strong> Visualizar Anexos.</strong></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <iframe id="iframePDF" frameborder="0" scrolling="no" width="100%" height="700px"></iframe>
              </div>
          </div>
      </div>
  </div>
  <!--Modal Editar--->
  <div class="modal fade" id="modalEditarAnexo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" style="width:600px" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="exampleModalLabel"><i class="far fa-file-pdf" aria-hidden="true"></i><strong> Editar Informacion Anexo.</strong></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="row">
                              <div class="col-md-4">
                                  <label>Documento</label>
                                  <div class="">
                                      <input type="text" name="txtDocumentoEditar" id="txtDocumentoEditar" class="input-sm form-control solo-numero" disabled="">
                                      <input type="hidden" name="txtIdAnexo" id="txtIdAnexo">
                                  </div>
                              </div>
                              <div class="col-md-8">
                                  <label>Nombre</label>
                                  <div class="">
                                      <input type="text" name="txtNombrePacienteEditar" id="txtNombrePacienteEditar" class="input-sm form-control" disabled="">
                                      <input name="idPac" id="idPac" type="hidden" />
                                  </div>
                              </div>
                          </div><br>
                          <div class="row">
                              <div class="col-md-12">
                                  <label>Fecha creacion documento</label>
                                  <div class="">
                                      <input type="date" class="form-control input-sm" name="txtFechaDocumentoEditar" id="txtFechaDocumentoEditar">
                                  </div>
                              </div>
                          </div><br>
                          <div class="row">
                              <div class="col-md-12">
                                  <label>Fecha vencimiento documento</label>
                                  <div class="">
                                      <input type="date" class="form-control input-sm" name="txtFechaVenciEditar" id="txtFechaVenciEditar">
                                  </div>
                              </div>
                          </div><br>
                          <div class="row">
                              <div class="col-md-12">
                                  <label>Tipo de Anexo</label>
                                  <select class="form-control input-sm" id="cmbTipoAnexoEditar" name="cmbTipoAnexoEditar">
                                      <option value="">Seleccione</option>
                                  </select>
                              </div>
                          </div>
                          <br>
                          <div class="row">
                              <div class="col-md-12 ">
                                  <label>Seleccionar Documento</label>
                                  <input type="text" name="txturl" id="txturl" class="input-sm form-control" disabled="">
                              </div>
                          </div>
                          <br>
                          <div class="row">
                              <div class="col-md-12">
                                  <label>Nombre o Descripcion</label>
                                  <div class="">
                                      <input type="text" name="txtNombreEditarAnexo" id="txtNombreEditarAnexo" class="input-sm form-control" disabled="">
                                  </div>
                              </div>
                          </div><br>
                          <div class="row">
                              <div class="col-md-12">
                                  <label>Detalle del Documento</label>
                                  <div class="">
                                      <textarea class="form-control" id="txtDetalleEditarDocumento" name="txtDetalleEditarDocumento" rows="3"></textarea>
                                  </div>
                              </div>
                          </div>

                      </div>
                  </div><br>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-primary" name="btnActualizarA" id="btnActualizarA">Actualizar</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  </div>
              </div>
          </div>
      </div>