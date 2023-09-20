<div class="modal fade " id="mdlParaf" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="">
                    <strong>Aportes a Parafiscales</strong>
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
                                        <th>Codigo</th>
                                        <th>Razon Social</th>
                                        <th>Tipo de Fondo</th>
                                        <th>Estado Fondo</th>
                                    </tr>
                                </thead>
                                <tbody id="tboBodyFondo" style="cursor: pointer"></tbody>
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