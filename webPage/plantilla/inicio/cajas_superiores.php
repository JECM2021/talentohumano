<div class="col-md-12">
    <input type="text" name="txtFiltroDasBorad" id="txtFiltroDasBorad" onclick="filtrarDatos('txtFiltroDasBorad', 'filtrame')" class="form-control input-sm" placeholder="buscar..."> <br>
    <div class="">
        <div class="panel-group" id="accordion">
            <?php
            if (count($lisMenReport) > 0) {
                $concoll = 0;
                foreach ($lisMenReport as $rsListado) {
                    $concoll++;
            ?>
                    <div class="panel panel-default filtrame" id="">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $concoll; ?>">
                                    <?php echo $rsListado['pagina_menu']; ?></a>
                            </h4>
                        </div>
                        <div id="collapse<?php echo $concoll; ?>" class="panel-collapse collapse <?php echo $concoll === 1 ? "in" : ""; ?> ">
                            <div class="panel-body">
                                <div class="row">
                                    <?php
                                    $i = 41;
                                    foreach ($lisMenPagReport as $rsListadopaginas) {
                                        if ($rsListado['menu_id'] === $rsListadopaginas['men_id']) {
                                    ?>
                                            <div class="col-lg-3 col-xs-6">
                                                <!-- small box -->
                                                <div class="small-box bg-aqua">
                                                    <div class="inner">
                                                        <h3><?= $i?></h3>

                                                        <p><?php echo $rsListadopaginas['nombre']; ?></p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-person-add"></i>
                                                    </div>
                                                    <a href="javascript:ventanaSecundaria('<?php echo $rsListadopaginas['url'] ?>?cod=<?php echo $empresa ?>&url=Principal')" class="small-box-footer">Ver mas <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div>
                                            <!--<div class="col-md-3">
                                                <div class="small-box bg-aqua" >
                                                    <div class="inner">
                                                        <p><?php echo $rsListadopaginas['nombre']; ?></p>
                                                    </div>
                                                    <a href="javascript:ventanaSecundaria('<?php echo $rsListadopaginas['url'] ?>?cod=<?php echo $empresa ?>&url=Principal')" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div>-->
                                    <?php
                                        }
                                        $i++;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <center>
                    <div style="padding: 20px 30px;  font-size: 16px; font-weight: 600;" class="alert alert-danger"><a style="color: rgba(255, 255, 255, 0.9); display: inline-block; margin-right: 10px; text-decoration: none;">Lo sentimos, su perfil no cuenta con los privilegios suficientes para la visualización del Dashboard. Por favor consulte con el administrador del sistema. </a></div>
                </center>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<script language="javascript" type="text/javascript">
    function ventanaSecundaria(URL) {
        var alto = parseInt((screen.height));
        var ancho = parseInt((screen.width));
        window.open(URL, "ventana1", "width=" + ancho + ",height=" + alto + ",scrollbars=NO ");
    }
</script>