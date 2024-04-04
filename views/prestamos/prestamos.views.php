<?php require_once('../html/head2.php')  ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Basic Bootstrap Table -->
<div class="card">
    <button type="button" class="btn btn-outline-secondary" onclick="libros(); usuarios()" data-bs-toggle="modal" data-bs-target="#ModalPrestamos">Nuevo Prestamo</button>

    <h5 class="card-header">Lista de Prestamos</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Libro</th>
                    <th>Cliente</th>
                    <th>Fecha Salida</th>
                    <th>Fecha Devolución</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0" id="ListaPrestamos">

            </tbody>
        </table>
    </div>
</div>

<!-- Modal Prestamos-->
<style>
    .swal2-container {
        z-index: 999999;
    }
</style>

<div class="modal" tabindex="-1" id="ModalPrestamos">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModal">Insertar Prestamo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="form_prestamos" method="post">
                <input type="hidden" name="id_prestamos" id="id_prestamos">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_libros">Libro</label>
                        <select name="id_libros" id="id_libros" class="form-control"  required></select>
                    </div>
                    <div class="form-group">
                        <label for="id_usuarios">Cliente</label>
                        <select name="id_usuarios" id="id_usuarios" class="form-control"  required></select>
                    </div>
                    <div class="form-group">
                        <label for="fecha_salida">Fecha Salida</label>
                        <input type="text" name="fecha_salida" id="fecha_salida" class="form-control" placeholder="Ingrese la fecha de salida" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_devolucion">Fecha Devolución</label>
                        <input type="text" name="fecha_devolucion" id="fecha_devolucion" class="form-control" placeholder="Ingrese la fecha de devolución" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="LimpiarCajas()">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once('../html/scripts2.php') ?>

<script src="./prestamos.js"></script>
