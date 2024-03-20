function init() {
    $("#form_prestamos").on("submit", (e) => {
      GuardarEditar(e);
    });
  }
  
  var ruta = "../../controllers/prestamo.controllers.php?op=";
  
  $().ready(() => {
    CargaLista();
  });
  
  var CargaLista = () => {
    var html = "";
    $.get(ruta + "todos", (ListPrestamos) => {
      console.log(ListPrestamos);
      ListPrestamos = JSON.parse(ListPrestamos);
      $.each(ListPrestamos, (index, prestamo) => {
        html += `<tr>
              <td>${index + 1}</td>
              <td>${prestamo.titulo}</td>
              <td>${prestamo.nombre}</td>
              <td>${prestamo.fecha_salida}</td>
              <td>${prestamo.fecha_devolucion}</td>
              <td>
                <button class='btn btn-primary' onclick='uno(${prestamo.id_prestamos})' data-bs-toggle="modal" data-bs-target="#ModalPrestamos">Editar</button>
                <button class='btn btn-danger' onclick='eliminar(${prestamo.id_prestamos})'>Eliminar</button>
              `;
      });
      $("#ListaPrestamos").html(html);
    });
  };
  
  var GuardarEditar = (e) => {
    e.preventDefault();
    var DatosFormularioPrestamo = new FormData($("#form_prestamos")[0]);
    var accion = "";
  
    if (document.getElementById("id_prestamos").value != "") {
      accion = ruta + "actualizar";
    } else {
      accion = ruta + "insertar";
    }
  
    $.ajax({
      url: accion,
      type: "post",
      data: DatosFormularioPrestamo,
      processData: false,
      contentType: false,
      cache: false,
      success: (respuesta) => {
        console.log(respuesta);
        respuesta = JSON.parse(respuesta);
        if (respuesta == "ok") {
          Swal.fire({
            title: "Prestamos!",
            text: "Se guardó con éxito",
            icon: "success",
          });
          CargaLista();
          LimpiarCajas();
        } else {
          Swal.fire({
            title: "Prestamos!",
            text: "Error al guardar",
            icon: "error",
          });
        }
      },
    });
  };
  
  var uno = async (id_prestamos) => {
    await libros();
    await usuarios();
    document.getElementById("tituloModal").innerHTML = "Actualizar Prestamo";
    $.post(ruta + "uno", { id_prestamos: id_prestamos }, (prestamo) => {
      prestamo = JSON.parse(prestamo);
      document.getElementById("id_prestamos").value = prestamo.id_prestamos;
      document.getElementById("id_libros").value = prestamo.id_libros;
      document.getElementById("id_usuarios").value = prestamo.id_usuarios;
      document.getElementById("fecha_salida").value = prestamo.fecha_salida;
      document.getElementById("fecha_devolucion").value = prestamo.fecha_devolucion;
    });
  };
  
  var libros = () => {
    return new Promise((resolve, reject) => {
      var html = `<option value="0">Seleccione una opción</option>`;
      $.post(
        "../../controllers/libro.controllers.php?op=todos",
        async (ListaLibros) => {
            ListaLibros = JSON.parse(ListaLibros);
          $.each(ListaLibros, (index, libro) => {
            html += `<option value="${libro.id_libros}">${libro.titulo}</option>`;
          });
          await $("#id_libros").html(html);
          resolve();
        }
      ).fail((error) => {
        reject(error);
      });
    });
  };

  var usuarios = () => {
    return new Promise((resolve, reject) => {
      var html = `<option value="0">Seleccione una opción</option>`;
      $.post(
        "../../controllers/usuario.controllers.php?op=todos",
        async (ListaUsuarios) => {
            ListaUsuarios = JSON.parse(ListaUsuarios);
          $.each(ListaUsuarios, (index, usuario) => {
            html += `<option value="${usuario.id_usuarios}">${usuario.nombre}</option>`;
          });
          await $("#id_usuarios").html(html);
          resolve();
        }
      ).fail((error) => {
        reject(error);
      });
    });
  };

  var eliminar = (id_prestamos) => {
    Swal.fire({
      title: "Prestamos",
      text: "¿Está seguro que desea eliminar el préstamo?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Eliminar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.post(ruta + "eliminar", { id_prestamos: id_prestamos }, (respuesta) => {
          respuesta = JSON.parse(respuesta);
          if (respuesta == "ok") {
            CargaLista();
            Swal.fire({
              title: "Prestamos!",
              text: "Se eliminó con éxito",
              icon: "success",
            });
          } else {
            Swal.fire({
              title: "Prestamos!",
              text: "Error al eliminar",
              icon: "error",
            });
          }
        });
      }
    });
  };
  
  var LimpiarCajas = () => {
    document.getElementById("id_prestamos").value = "";
    document.getElementById("id_libros").value = "";
    document.getElementById("id_usuarios").value = "";
    document.getElementById("fecha_salida").value = "";
    document.getElementById("fecha_devolucion").value = "";
    document.getElementById("tituloModal").innerHTML = "Insertar Prestamo";
    $("#ModalPrestamos").modal("hide");
  };
  
  init();
  