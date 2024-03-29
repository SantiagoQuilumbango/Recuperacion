function init() {
  $("#form_libros").on("submit", (e) => {
    GuardarEditar(e);
  });
}

var ruta = "../../controllers/libro.controllers.php?op=";

$().ready(() => {
  CargaLista();
});

var CargaLista = () => {
  var html = "";
  $.get(ruta + "todos", (ListLibros) => {
    console.log(ListLibros);
    ListLibros = JSON.parse(ListLibros);
    $.each(ListLibros, (index, libro) => {
      html += `<tr>
            <td>${index + 1}</td>
            <td>${libro.titulo}</td>
            <td>${libro.fecha}</td>
            <td>${libro.autor}</td>
            <td>${libro.categoria}</td>
            <td>${libro.descripcion}</td>
            <td>${libro.ejemplares}</td>
            <td>
              <button class='btn btn-primary' onclick='uno(${libro.id_libros})' data-bs-toggle="modal" data-bs-target="#ModalLibros">Editar</button>
              <button class='btn btn-danger' onclick='eliminar(${libro.id_libros})'>Eliminar</button>
            `;
    });
    $("#ListaLibros").html(html);
  });
};

var GuardarEditar = (e) => {
  e.preventDefault();
  var DatosFormularioLibro = new FormData($("#form_libros")[0]);
  var accion = "";

  if (document.getElementById("id_libros").value != "") {
    accion = ruta + "actualizar";
  } else {
    accion = ruta + "insertar";
  }

  $.ajax({
    url: accion,
    type: "post",
    data: DatosFormularioLibro,
    processData: false,
    contentType: false,
    cache: false,
    success: (respuesta) => {
      console.log(respuesta);
      respuesta = JSON.parse(respuesta);
      if (respuesta == "ok") {
        Swal.fire({
          title: "Libros!",
          text: "Se guardó con éxito",
          icon: "success",
        });
        CargaLista();
        LimpiarCajas();
      } else {
        Swal.fire({
          title: "Libros!",
          text: "Error al guardar",
          icon: "error",
        });
      }
    },
  });
};

var uno = async (id_libros) => {
  document.getElementById("tituloModal").innerHTML = "Actualizar Libro";
  $.post(ruta + "uno", { id_libros: id_libros }, (libro) => {
    libro = JSON.parse(libro);
    document.getElementById("id_libros").value = libro.id_libros;
    document.getElementById("titulo").value = libro.titulo;
    document.getElementById("fecha").value = libro.fecha;
    document.getElementById("autor").value = libro.autor;
    document.getElementById("categoria").value = libro.categoria;
    document.getElementById("descripcion").value = libro.descripcion;
    document.getElementById("ejemplares").value = libro.ejemplares;
    
  });
};

var eliminar = (id_libros) => {
  Swal.fire({
    title: "Libros",
    text: "¿Está seguro que desea eliminar el libro?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(ruta + "eliminar", { id_libros: id_libros }, (respuesta) => {
        respuesta = JSON.parse(respuesta);
        if (respuesta == "ok") {
          CargaLista();
          Swal.fire({
            title: "Libros!",
            text: "Se eliminó con éxito",
            icon: "success",
          });
        } else {
          Swal.fire({
            title: "Libros!",
            text: "Error al eliminar",
            icon: "error",
          });
        }
      });
    }
  });
};

var LimpiarCajas = () => {
  document.getElementById("id_libros").value = "";
  document.getElementById("titulo").value = "";
  document.getElementById("fecha").value = "";
  document.getElementById("autor").value = "";
  document.getElementById("categoria").value = "";
  document.getElementById("descripcion").value = "";
  document.getElementById("ejemplares").value = "";
  document.getElementById("tituloModal").innerHTML = "Insertar Libro";
  $("#ModalLibros").modal("hide");
};

init();

