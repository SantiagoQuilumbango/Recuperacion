<?php
//TODO: Requerimientos 
require_once('../config/conexion.php');
class Prestamos_Libros_Usuarios
{
    /*TODO: Procedimiento para sacar todos los registros*/
    public function todos()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "select * from prestamos_libros_usuarios";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    /*TODO: Procedimiento para sacar un registro*/
    public function uno($idPrestamosLibrosUsuarios)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT  * FROM prestamos_libros_usuarios WHERE idPrestamosLibrosUsuarios = $idPrestamosLibrosUsuarios";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }
    /*TODO: Procedimiento para insertar */
    public function Insertar($Prestamos_id_prestamos, $Libros_id_libros, $Usuarios_id_usuarios)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "INSERT into prestamos_libros_usuarios(Prestamos_id_prestamos, Libros_id_libros, Usuarios_id_usuarios) values ($Prestamos_id_prestamos, $Libros_id_libros, $Usuarios_id_usuarios)";

        if (mysqli_query($con, $cadena)) {
            $con->close();
            return "ok";
        } else {
            $con->close();
            return 'Error al insertar en la base de datos';
        }
    }
    /*TODO: Procedimiento para actualizar */
    public function Actualizar($Prestamos_id_prestamos, $Libros_id_libros, $Usuarios_id_usuarios, $idPrestamosLibrosUsuarios)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "update prestamos_libros_usuarios set Prestamos_id_prestamos=$Prestamos_id_prestamos, Libros_id_libros=$Libros_id_libros, Usuarios_id_usuarios=$Usuarios_id_usuarios where idPrestamosLibrosUsuarios= $idPrestamosLibrosUsuarios";
        if (mysqli_query($con, $cadena)) {
            $con->close();
            return "ok";
        } else {
            $con->close();
            return 'error al actualizar el registro';
        }
    }
    /*TODO: Procedimiento para Eliminar */
    public function Eliminar($Usuarios_id_usuarios)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "DELETE FROM `prestamos_libros_usuarios` WHERE `Usuarios_id_usuarios`= $Usuarios_id_usuarios";

        if (mysqli_query($con, $cadena)) {
            $con->close();
            return 'ok';
        } else {
            $con->close();
            return false;
        }
    }
}
?>
