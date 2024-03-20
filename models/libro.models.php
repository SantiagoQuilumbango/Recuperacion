<?php
//TODO: Requerimientos 
require_once('../config/conexion.php');

class Libros
{

    public function Insertar($Titulo, $Fecha, $Autor, $Categoria, $Descripcion, $Ejemplares)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "INSERT INTO libros (titulo, fecha, autor, categoria, descripcion, ejemplares) VALUES ('$Titulo', '$Fecha', '$Autor', '$Categoria', '$Descripcion', '$Ejemplares')";

        if (mysqli_query($con, $cadena)) {
            $id = mysqli_insert_id($con);
            return 'ok';
        } else {
            return 'Error al insertar en la base de datos el libro';
        }
        $con->close();
    }

    public function todos()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM libros";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

    public function uno($id_libros)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM libros WHERE id_libros = $id_libros";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

    public function unoconTitulo($Titulo)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM libros WHERE titulo = '$Titulo'";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

    public function unoconAutor($Autor)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM libros WHERE autor = '$Autor'";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

    public function Actualizar($id_libros, $Titulo, $Fecha, $Autor, $Categoria, $Descripcion, $Ejemplares)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "UPDATE libros SET titulo = '$Titulo', fecha = '$Fecha', autor = '$Autor', categoria = '$Categoria', descripcion = '$Descripcion', ejemplares = '$Ejemplares' WHERE id_libros = $id_libros";
        if (mysqli_query($con, $cadena)) {
            return 'ok';
        } else {
            return 'Error al actualizar el registro del libro';
        }
        $con->close();
    }

    public function Eliminar($id_libros)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "DELETE FROM libros WHERE id_libros = $id_libros";
        if (mysqli_query($con, $cadena)) {
            return 'ok';
        } else {
            return false;
        }
        $con->close();
    }
}

