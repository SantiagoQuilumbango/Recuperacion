<?php
//TODO: Requerimientos 
require_once('../config/conexion.php');

class Reporte
{

    public function reporteLibrosPrestados()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT Libros.id_libros, Libros.titulo, Usuarios.id_usuarios, Usuarios.nombre, Prestamos.id_prestamos, Prestamos.fecha_salida, Prestamos.fecha_devolucion, Prestamos.cantidad, Prestamos.observaciones FROM Prestamos INNER JOIN Usuarios ON Prestamos.id_usuarios = Usuarios.id_usuarios INNER JOIN Libros ON Prestamos.id_libros = Libros.id_libros";

        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

    public function reporteLibros()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT id_libros, titulo, fecha, autor, categoria, descripcion, (ejemplares - (SELECT sum(cantidad) FROM prestamos WHERE id_libros = L.id_libros and fecha_devolucion = '')) as 'ejemplares' FROM libros L";
        $datos = mysqli_query($con, $cadena);
        return $datos;
        $con->close();
    }

}

