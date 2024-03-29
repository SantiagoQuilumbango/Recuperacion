<?php
//TODO: Requerimientos 
require_once('../config/conexion.php');

class Usuarios
{

    public function Insertar($Nombre, $ApellidoPaterno, $ApellidoMaterno, $Domicilio, $Telefono)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "INSERT INTO usuarios (nombre, apellido_paterno, apellido_materno, domicilio, telefono) VALUES ('$Nombre', '$ApellidoPaterno', '$ApellidoMaterno', '$Domicilio', '$Telefono')";

        if (mysqli_query($con, $cadena)) {
            $id = mysqli_insert_id($con);
            return 'ok';
        } else {
            return 'Error al insertar en la base de datos el usuario';
        }
        $con->close();
    }

    public function todos()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM usuarios";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

    public function uno($id_usuarios)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM usuarios WHERE id_usuarios = $id_usuarios";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

    public function unoconDomicilio($Domicilio)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT count(*) as numero FROM usuarios WHERE domicilio = $Domicilio";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

    public function unoconTelefono($Telefono)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT count(*) as numero FROM usuarios WHERE telefono = $Telefono";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

    public function Actualizar($id_usuarios, $Nombre, $ApellidoPaterno, $ApellidoMaterno, $Domicilio, $Telefono)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "UPDATE usuarios SET nombre = '$Nombre', apellido_paterno = '$ApellidoPaterno', apellido_materno = '$ApellidoMaterno', domicilio = '$Domicilio', telefono = '$Telefono' WHERE id_usuarios = $id_usuarios";
        if (mysqli_query($con, $cadena)) {
            return 'ok';
        } else {
            return 'Error al actualizar el registro del usuario';
        }
        $con->close();
    }

    public function Eliminar($id_usuarios)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "DELETE FROM usuarios WHERE id_usuarios = $id_usuarios";
        if (mysqli_query($con, $cadena)) {
            return 'ok';
        } else {
            return false;
        }
        $con->close();
    }

    public function login($Nombre)
{
    try {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT id_usuarios, nombre, apellido_paterno, apellido_materno, domicilio, telefono FROM Usuarios WHERE nombre='$Nombre'";
        $datos = mysqli_query($con, $cadena);
        return $datos;
    } catch (Throwable $th) {
        return $th->getMessage();
    }
    $con->close();
}


}
?>
