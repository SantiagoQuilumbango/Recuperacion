<?php
error_reporting(0);
/*TODO: Requerimientos */
require_once('../config/sesiones.php');
require_once("../models/reporte.models.php");

$Reporte = new Reporte;

switch ($_GET["op"]) {
    /*TODO: Procedimiento para listar todos los registros */
    case 'reporteLibrosPrestados':
        $datos = array();
        
        $datos = $Reporte->reporteLibrosPrestados();
        
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
        
    case 'reporteLibros':
        $datos = array();
            
        $datos = $Reporte->reporteLibros();
            
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
}
?>
