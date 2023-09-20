<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

class Conexion
{

    const CONFIGURACION = 1;
    const ASISTENCIAL = 2;
    const CONTABLE = 3;
    const BD = "nomina";
    const HOST = "localhost";
    const USUARIO = "root";
    const PASS = "";

    public static $bdActual = "";

    function conectarBd($tipoBase)
    {
        $bd = isset($_SESSION['bd']) ? $_SESSION['bd'] : "";
        date_default_timezone_set('America/Bogota');
        switch ($tipoBase) {
            case 1:
                $bdActual = "configuracionesnom";
                break;
            case 2:
                $bdActual = "nomina";
                break;
            case 3:
                $bdActual = "bdcontable";
                break;
            default:
                break;
        }
        try {
            $conexion = new mysqli(self::HOST, self::USUARIO, self::PASS, $bdActual);
            $conexion->set_charset("utf8");
            if (!$conexion) {
                echo 'ERROR DE CONEXION';
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $conexion;
    }

    function descconectarBd($conexion)
    {
        $close = mysqli_close($conexion);
        try {
            if (!$close) {
                echo 'Ha sucedido un error inexperado en la desconexion de la base de datos';
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        return $close;
    }

    function getSql($nombreSql, $ruta)
    {
        try {
            $sql = simplexml_load_file($ruta);
            return $sql->$nombreSql->sql;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
}
