<?php
require_once '../../validaSession.php';
require_once '../../Modelo/Empleados/MdlEmpleados.php';
require_once '../../Modelo/Empleados/Bean/EmpleadosVO.php';


$op = addslashes(htmlspecialchars($_POST["op"]));

switch ($op) {
    case 1:
        listarComboTipoDocumento();
        break;
    case 2:
        listarComboEstadoCivil();
        break;
    case 3:
        listarComboSexo();
        break;
    case 4:
        listarComboGrupoSanguineo();
        break;
    case 5:
        listarComboEscolaridad();
        break;
    case 6:
        listarComboNivelSocioEconomico();
        break;
    case 7:
        listarComboDepartamento();
        break;
    case 8:
        listarComboCiudad();
        break;
    case 9:
        registrarEmpleado();
        break;
    case 10:
        buscarEmpleados();
        break;
    case 11:
        actulizarDatosEmpleado();
        break;
    case 12:
        visualizarEmpleados();
        break;
}

function listarComboTipoDocumento()
{
    $mdlEmpleados = new mdlEmpleados();
    try {
        $listarTipoDocumento = $mdlEmpleados->listarComboTipoDocumento();
        if ($listarTipoDocumento !== null) {
            $json = json_encode($listarTipoDocumento);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarComboEstadoCivil()
{
    $mdlEmpleados = new mdlEmpleados();
    try {
        $listarEstadoCivil = $mdlEmpleados->listarComboEstadoCivil();
        if ($listarEstadoCivil !== null) {
            $json = json_encode($listarEstadoCivil);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarComboSexo()
{
    $mdlEmpleados = new mdlEmpleados();
    try {
        $listarSexo = $mdlEmpleados->listarComboSexo();
        if ($listarSexo !== null) {
            $json = json_encode($listarSexo);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarComboGrupoSanguineo()
{
    $mdlEmpleados = new mdlEmpleados();
    try {
        $listarGrupoSanguineo = $mdlEmpleados->listarComboGrupoSanguineo();
        if ($listarGrupoSanguineo !== null) {
            $json = json_encode($listarGrupoSanguineo);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarComboEscolaridad()
{
    $mdlEmpleados = new mdlEmpleados();
    try {
        $listarEscolaridad = $mdlEmpleados->listarComboEscolaridad();
        if ($listarEscolaridad !== null) {
            $json = json_encode($listarEscolaridad);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarComboNivelSocioEconomico()
{
    $mdlEmpleados = new mdlEmpleados();
    try {
        $listarEstrato = $mdlEmpleados->listarComboNivelSocioEconomico();
        if ($listarEstrato !== null) {
            $json = json_encode($listarEstrato);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarComboDepartamento()
{
    $mdlEmpleados = new mdlEmpleados();
    try {
        $listarDepartamento = $mdlEmpleados->listarComboDepartamento();
        if ($listarDepartamento !== null) {
            $json = json_encode($listarDepartamento);
            echo $json;
        } else {
            echo "Lita vacia.";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function listarComboCiudad()
{
    $mdlEmpleados = new mdlEmpleados();
    $idDepartamento = addslashes(htmlspecialchars($_POST["idDepartamento"]));
    try {
        $listarComboCiudad = $mdlEmpleados->listarComboCiudad($idDepartamento);

        if ($listarComboCiudad !== null) {
            $json = json_encode($listarComboCiudad);
            echo $json;
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function registrarEmpleado()
{
    $mdlEmpleados = new mdlEmpleados();
    $tipoDocumento = addslashes(htmlspecialchars($_POST["tipoDocumento"]));
    $numDocumento = addslashes(htmlspecialchars($_POST["numDocumento"]));
    $primerNombre = addslashes(htmlspecialchars($_POST["primerNombre"]));
    $segundoNombre = addslashes(htmlspecialchars($_POST["segundoNombre"]));
    $primerApellido = addslashes(htmlspecialchars($_POST["primerApellido"]));
    $segundoApellido = addslashes(htmlspecialchars($_POST["segundoApellido"]));
    $fechaNacimiento = addslashes(htmlspecialchars($_POST["fechaNacimiento"]));
    $departamento = addslashes(htmlspecialchars($_POST["departamento"]));
    $ciudad = addslashes(htmlspecialchars($_POST["ciudad"]));
    $estadoCivil = addslashes(htmlspecialchars($_POST["estadoCivil"]));
    $sexo = addslashes(htmlspecialchars($_POST["sexo"]));
    $grupoSanguineo = addslashes(htmlspecialchars($_POST["grupoSanguineo"]));
    $estratoSocial = addslashes(htmlspecialchars($_POST["estratoSocial"]));
    $correo = addslashes(htmlspecialchars($_POST["correo"]));
    $nivelEscolaridad = addslashes(htmlspecialchars($_POST["nivelEscolaridad"]));
    $estado = addslashes(htmlspecialchars($_POST["estado"]));
    $editar = addslashes(htmlspecialchars($_POST["editar"]));
    $idEmpleado = addslashes(htmlspecialchars($_POST["idEmpleado"]));
    $EmpleadosVO = new EmpleadosVO();
    $EmpleadosVO->setTipoDocumento($tipoDocumento);
    $EmpleadosVO->setNumDocumento($numDocumento);
    $EmpleadosVO->setPrimerNombre($primerNombre);
    $EmpleadosVO->setSegundoNombre($segundoNombre);
    $EmpleadosVO->setPrimerApellido($primerApellido);
    $EmpleadosVO->setSegundoApellido($segundoApellido);
    $EmpleadosVO->setFechaNacimiento($fechaNacimiento);
    $EmpleadosVO->setDepartamento($departamento);
    $EmpleadosVO->setCiudad($ciudad);
    $EmpleadosVO->setEstadoCivil($estadoCivil);
    $EmpleadosVO->setSexo($sexo);
    $EmpleadosVO->setGrupoSanguineo($grupoSanguineo);
    $EmpleadosVO->setEstratoSocial($estratoSocial);
    $EmpleadosVO->setCorreo($correo);
    $EmpleadosVO->setNivelEscolaridad($nivelEscolaridad);
    $EmpleadosVO->setEstado($estado);
    $EmpleadosVO->setIdEmpleado($idEmpleado);
    $statusJson = array();
    try {
        $parametrosEmpleado = $mdlEmpleados->registrarEmpleados($EmpleadosVO);
        $msj = "Empleado Guardado Correctamente";
        if ($parametrosEmpleado > 0) {
            $statusJson["success"] = $msj;
        } else if ($parametrosEmpleado == -1) {
            $statusJson["error"] = "El documento ya se encentra creado";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function buscarEmpleados()
{
    $documento = addslashes(htmlspecialchars($_POST["documento"]));

    $mdlEmpleados = new mdlEmpleados();
    $EmpleadosVO = new EmpleadosVO();

    $EmpleadosVO->setNumDocumento($documento);
    try {
        $listarEmpleados = $mdlEmpleados->buscarEmpleados($EmpleadosVO);
        //  die(var_dump($listarEmpleados));
        if ($listarEmpleados != null) {
            $json = json_encode($listarEmpleados);
            // die(var_dump($json));
            echo $json;
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function actulizarDatosEmpleado()
{
    $mdlEmpleados = new mdlEmpleados();
    $tipoDocumento = addslashes(htmlspecialchars($_POST["tipoDocumento"]));
    $numDocumento = addslashes(htmlspecialchars($_POST["documento"]));
    $primerNombre = addslashes(htmlspecialchars($_POST["primerNombre"]));
    $segundoNombre = addslashes(htmlspecialchars($_POST["segundoNombre"]));
    $primerApellido = addslashes(htmlspecialchars($_POST["primerApellido"]));
    $segundoApellido = addslashes(htmlspecialchars($_POST["segundoApellido"]));
    $fechaNacimiento = addslashes(htmlspecialchars($_POST["fechaNacimiento"]));
    $departamento = addslashes(htmlspecialchars($_POST["departamento"]));
    $ciudad = addslashes(htmlspecialchars($_POST["ciudad"]));
    $estadoCivil = addslashes(htmlspecialchars($_POST["estadoCivil"]));
    $sexo = addslashes(htmlspecialchars($_POST["sexo"]));
    $grupoSanguineo = addslashes(htmlspecialchars($_POST["grupoSanguineo"]));
    $estratoSocial = addslashes(htmlspecialchars($_POST["estratoSocial"]));
    $correo = addslashes(htmlspecialchars($_POST["email"]));
    $nivelEscolaridad = addslashes(htmlspecialchars($_POST["nivelEscolar"]));
    $estado = addslashes(htmlspecialchars($_POST["estado"]));
    // $editar = addslashes(htmlspecialchars($_POST["editar"]));
    $idEmpleado = addslashes(htmlspecialchars($_POST["idEmpleado"]));

    $EmpleadosVO = new EmpleadosVO();
    $EmpleadosVO->setTipoDocumento($tipoDocumento);
    $EmpleadosVO->setNumDocumento($numDocumento);
    $EmpleadosVO->setPrimerNombre($primerNombre);
    $EmpleadosVO->setSegundoNombre($segundoNombre);
    $EmpleadosVO->setPrimerApellido($primerApellido);
    $EmpleadosVO->setSegundoApellido($segundoApellido);
    $EmpleadosVO->setFechaNacimiento($fechaNacimiento);
    $EmpleadosVO->setDepartamento($departamento);
    $EmpleadosVO->setCiudad($ciudad);
    $EmpleadosVO->setEstadoCivil($estadoCivil);
    $EmpleadosVO->setSexo($sexo);
    $EmpleadosVO->setGrupoSanguineo($grupoSanguineo);
    $EmpleadosVO->setEstratoSocial($estratoSocial);
    $EmpleadosVO->setCorreo($correo);
    $EmpleadosVO->setNivelEscolaridad($nivelEscolaridad);
    $EmpleadosVO->setEstado($estado);
    $EmpleadosVO->setIdEmpleado($idEmpleado);
    $statusJson = array();
    try {
        $listarEmpleados = $mdlEmpleados->actulizarDatosEmpleado($EmpleadosVO);
        if ($listarEmpleados > 0) {
            $statusJson["success"] = "Empleado actualizado correctamente.";
        } else {
            $statusJson["error"] = "Error al intentar ejecutar la peticion.";
        }
        echo json_encode($statusJson);
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

function visualizarEmpleados()
{

    $form = $_REQUEST;
    $paramet = $_POST["columns"];
    $dt_params = [
        "order" => $_POST["order"],
        "start" => $_POST["start"],
        "length" => $_POST["length"]
    ];
    $statusJson = array();
    $mdlEmpleados = new mdlEmpleados();
    //die(var_dump($mdlEmpleados));
    $data = $mdlEmpleados->visualizarEmpleados($form, $dt_params);
    //die(var_dump($data));
    echo $data;
}
