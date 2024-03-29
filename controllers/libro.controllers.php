<?php
error_reporting(0);
/*TODO: Requerimientos */
require_once('../config/sesiones.php');
require_once("../models/libro.models.php");
//require_once("../models/Accesos.models.php");
$Libros = new Libros;
//$Accesos = new Accesos;
switch ($_GET["op"]) {
    /*TODO: Procedimiento para listar todos los registros */
    case 'todos':
        $datos = array();
        $datos = $Libros->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
    /*TODO: Procedimiento para sacar un registro */
    case 'uno':
        $id_libros = $_POST["id_libros"];
        $datos = array();
        $datos = $Libros->uno($id_libros);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;
    
    /*TODO: Procedimiento para insertar */
    case 'insertar':
        $Titulo = $_POST["titulo"];
        $Fecha = $_POST["fecha"];
        $Autor = $_POST["autor"];
        $Categoria = $_POST["categoria"];
        $Descripcion = $_POST["descripcion"];
        $Ejemplares = $_POST["ejemplares"];
        $datos = array();
        $datos = $Libros->Insertar($Titulo, $Fecha, $Autor, $Categoria, $Descripcion, $Ejemplares);
        echo json_encode($datos);
        break;
    /*TODO: Procedimiento para actualizar */
    case 'actualizar':
        $id_libros = $_POST["id_libros"];
        $Titulo = $_POST["titulo"];
        $Fecha = $_POST["fecha"];
        $Autor = $_POST["autor"];
        $Categoria = $_POST["categoria"];
        $Descripcion = $_POST["descripcion"];
        $Ejemplares = $_POST["ejemplares"];
        $datos = array();
        $datos = $Libros->Actualizar($id_libros, $Titulo, $Fecha, $Autor, $Categoria, $Descripcion, $Ejemplares);
        echo json_encode($datos);
        break;
    /*TODO: Procedimiento para eliminar */
    case 'eliminar':
        $id_libros = $_POST["id_libros"];
        $datos = array();
        $datos = $Libros->Eliminar($id_libros);
        echo json_encode($datos);
        break;
    /*TODO: Procedimiento para insertar */
    
}



