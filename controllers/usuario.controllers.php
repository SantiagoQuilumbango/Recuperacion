<?php
error_reporting(0);
/*TODO: Requerimientos */
require_once('../config/sesiones.php');
require_once("../models/usuario.models.php");
//require_once("../models/Accesos.models.php");
$Usuarios = new Usuarios;
//$Accesos = new Accesos;
switch ($_GET["op"]) {
    /*TODO: Procedimiento para listar todos los registros */
    case 'todos':
        $datos = array();
        $datos = $Usuarios->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    /*TODO: Procedimiento para sacar un registro */
    case 'uno':
        $id_usuarios = $_POST["id_usuarios"];
        $datos = array();
        $datos = $Usuarios->uno($id_usuarios);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
    case "unoconDomicilio":
        $Domicilio = $_POST["domicilio"];
        $datos = array();
        $datos = $Usuarios->unoconDomicilio($Domicilio);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
    case "unoconTelefono":
        $Telefono = $_POST["telefono"];
        $datos = array();
        $datos = $Usuarios->unoconTelefono($Telefono);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
    /*TODO: Procedimiento para insertar */
    case 'insertar':
        $Nombre = $_POST["nombre"];
        $ApellidoPaterno = $_POST["apellido_paterno"];
        $ApellidoMaterno = $_POST["apellido_materno"];
        $Domicilio = $_POST["domicilio"];
        $Telefono = $_POST["telefono"];
        $datos = array();
        $datos = $Usuarios->Insertar($Nombre, $ApellidoPaterno, $ApellidoMaterno, $Domicilio, $Telefono);
        echo json_encode($datos);
        break;
    /*TODO: Procedimiento para actualizar */
    case 'actualizar':
        $id_usuarios = $_POST["id_usuarios"];
        $Nombre = $_POST["nombre"];
        $ApellidoPaterno = $_POST["apellido_paterno"];
        $ApellidoMaterno = $_POST["apellido_materno"];
        $Domicilio = $_POST["domicilio"];
        $Telefono = $_POST["telefono"];
        $datos = array();
        $datos = $Usuarios->Actualizar($id_usuarios, $Nombre, $ApellidoPaterno, $ApellidoMaterno, $Domicilio, $Telefono);
        echo json_encode($datos);
        break;
    /*TODO: Procedimiento para eliminar */
    case 'eliminar':
        $id_usuarios = $_POST["id_usuarios"];
        $datos = array();
        $datos = $Usuarios->Eliminar($id_usuarios);
        echo json_encode($datos);
        break;

    case 'login':
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
    
        // TODO: Si las variables están vacías regresa con error
        if (empty($nombre) or empty($telefono)) {
            header("Location:../index.php?op=2");
            exit();
        }
    
        try {
            $datos = array();
            $datos = $Usuarios->login($nombre);
            $res = mysqli_fetch_assoc($datos);
        } catch (Throwable $th) {
            header("Location:../index.php?op=1");
            exit();
        }
        // TODO: Control de si existe el registro en la base de datos
        try {
            if (is_array($res) and count($res) > 0) {
                if ($telefono == $res["telefono"]) {
                    $_SESSION["idUsuarios"] = $res["id_usuarios"];
                    $_SESSION["Usuarios_Nombres"] = $res["nombre"];
                    $_SESSION["Usuarios_Apellidos"] = $res["apellido_paterno"] . ' ' . $res["apellido_materno"];
                    $_SESSION["Usuarios_Telefono"] = $res["telefono"];
    
                    header("Location:../views/home.php");
                    exit();
                } else {
                    header("Location:../index.php?op=1");
                    exit();
                }
            } else {
                header("Location:../index.php?op=1");
                exit();
            }
        } catch (Exception $th) {
            echo ($th->getMessage());
        }
        break;
    }    