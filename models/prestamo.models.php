<?php
//TODO: Requerimientos 
require_once('../config/conexion.php');

class Prestamos
{

    public function Insertar($id_usuarios, $id_libros, $fecha_salida, $fecha_devolucion)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "INSERT INTO prestamos (id_usuarios, id_libros, fecha_salida, fecha_devolucion) VALUES ('$id_usuarios', '$id_libros', '$fecha_salida', '$fecha_devolucion')";
        if (mysqli_query($con, $cadena)) {
            $id = mysqli_insert_id($con);
            return 'ok';
        } else {
            return 'Error al insertar en la base de datos el préstamo';
        }
        $con->close();
    }

    /*public function InsertarImagen($id_prestamos)
    {
        if ($_FILES["imagenPrestamo"]["name"] != '') {
            $extesion = explode(".", $_FILES["imagenPrestamo"]["name"]);
            $nombreNuevo = $id_prestamos . '.' . end($extesion);
            $destino = "../public/images/prestamos/" . $nombreNuevo;  //para guardar la imagen en el servidor    ../
            copy($_FILES["imagenPrestamo"]["tmp_name"], $destino);
            $con = new ClaseConectar();
            $con = $con->ProcedimientoConectar();
            //para guardar en la base de datos ../../
            $destino = '../' . $destino; //para guardar en la base de datos
            $cadena = "UPDATE Prestamos SET imagen = '$destino' WHERE id_prestamos = $id_prestamos";
            if (mysqli_query($con, $cadena)) {
                return 'ok';
            } else {
                return 'Error al guardar la imagen';
            }
        }
    }*/

    public function todos()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT Libros.id_libros, Libros.titulo, Usuarios.id_usuarios, Usuarios.nombre, Prestamos.id_prestamos, Prestamos.fecha_salida, Prestamos.fecha_devolucion FROM Prestamos INNER JOIN Usuarios ON Prestamos.id_usuarios = Usuarios.id_usuarios INNER JOIN Libros ON Prestamos.id_libros = Libros.id_libros";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

   

    public function uno($id_prestamos)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        //$cadena = "SELECT prestamos.id:prestamos, libros.titulo, usuarios.nombre, libros.id_libros, usuarios.id_usuarios, Prestamos.fecha_salida, Prestamos.fecha_devolucion FROM Prestamos INNER JOIN Usuarios ON Prestamos.id_usuarios = Usuarios.id_usuarios INNER JOIN Libros ON Prestamos.id_libros = Libros.id_libros WHERE id_prestamos = $id_prestamos";
        $cadena = "SELECT * FROM prestamos WHERE id_prestamos = $id_prestamos";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

    public function Actualizar($id_prestamos, $id_usuarios, $id_libros, $fecha_salida, $fecha_devolucion)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "UPDATE prestamos SET id_usuarios = '$id_usuarios', id_libros = '$id_libros', fecha_salida = '$fecha_salida', fecha_devolucion = '$fecha_devolucion' WHERE id_prestamos = $id_prestamos";
        if (mysqli_query($con, $cadena)) {
            return 'ok';
        } else {
            return 'Error al actualizar el registro del préstamo';
        }
        $con->close();
    }

    public function Eliminar($id_prestamos)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "DELETE FROM prestamos WHERE id_prestamos = $id_prestamos";
        if (mysqli_query($con, $cadena)) {
            return 'ok';
        } else {
            return false;
        }
        $con->close();
    }
}
?>
