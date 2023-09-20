<?php
$ruta = substr($_GET["action"], 3);
//$nuevaRuta = str_replace(".php", "",  $ruta);
$op = $_GET["op"];
$array = json_decode($_GET["parametros"]);
$arrayobject = new ArrayObject($array);
$iterator = $arrayobject->getIterator();
?>
<html>
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">        
    </head>
    <body>
        <label style="float:left; margin-left:45%; margin-top:18%; font-size:22px;">Cargando...</label>
        <form name="form_parametros" id="form_parametros" method="post" action="<?php echo $ruta ?>">
            <input type="hidden" name="op" id="op" value="<?php echo $op; ?>">
            <?php
            foreach ($iterator as $value) {
                ?>
                <input type="hidden"  name="<?php echo $iterator->key(); ?>" id="<?php echo $iterator->key(); ?>" value="<?php echo $value; ?>">
                <?php
            }
            ?>
        </form>
        <script>
            document.getElementById("form_parametros").submit();
        </script>
    </body>
</html>