<?php
error_reporting(0);
/*TODO: Requerimientos */
require_once('../config/sesiones.php');
require_once("../models/prestamo.models.php");

$Prestamos = new Prestamos;

switch ($_GET["op"]) {
    /*TODO: Procedimiento para listar todos los registros */
    case 'todos':
        $datos = array();
        
        $datos = $Prestamos->todos();
        
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    /*TODO: Procedimiento para sacar un registro */
   
    case 'uno':
        $id_prestamos = $_POST["id_prestamos"];
        
        $datos = array();
        $datos = $Prestamos->uno($id_prestamos);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

        case 'stock':
            $id_libro = $_POST["id_libro"];
            
            $datos = array();
            $datos = $Prestamos->selectLibroStock($id_libro);
            $res = mysqli_fetch_assoc($datos);
            echo json_encode($res);
            break;
    /*TODO: Procedimiento para insertar */
    case 'insertar':
        $id_usuarios = $_POST["id_usuarios"];
        $id_libros = $_POST["id_libros"];
        $fechaSalida = $_POST["fecha_salida"];
        $fechaDevolucion = $_POST["fecha_devolucion"];
        $cantidad = $_POST["cantidad"];
        $observaciones = $_POST["observaciones"];
        $datos = array();
        $datos = $Prestamos->Insertar($id_usuarios, $id_libros, $fechaSalida, $fechaDevolucion, $cantidad, $observaciones);
        echo json_encode($datos);
        break;
    /*TODO: Procedimiento para actualizar */
    case 'actualizar':
        $id_prestamos = $_POST["id_prestamos"];
        $id_usuarios = $_POST["id_usuarios"];
        $id_libros = $_POST["id_libros"];
        $fechaSalida = $_POST["fecha_salida"];
        $fechaDevolucion = $_POST["fecha_devolucion"];
        $cantidad = $_POST["cantidad"];
        $observaciones = $_POST["observaciones"];
        $datos = array();
        $datos = $Prestamos->Actualizar($id_prestamos, $id_usuarios, $id_libros, $fechaSalida, $fechaDevolucion, $cantidad, $observaciones);
        echo json_encode($datos);
        break;
    /*TODO: Procedimiento para eliminar */
    case 'eliminar':
        $id_prestamos = $_POST["id_prestamos"];
        $datos = array();
        $datos = $Prestamos->Eliminar($id_prestamos);
        echo json_encode($datos);
        break;
    /*TODO: Procedimiento para insertar */
    
}
?>
