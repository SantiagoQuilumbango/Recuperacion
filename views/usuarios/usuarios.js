function init() {
  $("#form_usuarios").on("submit", (e) => {
    GuardarEditar(e);
  });
}

var ruta = "../../controllers/usuario.controllers.php?op=";

$().ready(() => {
  CargaLista();
});

var CargaLista = () => {
  var html = "";
  $.get(ruta + "todos", (ListUsuarios) => {
    console.log(ListUsuarios);
    ListUsuarios = JSON.parse(ListUsuarios);
    $.each(ListUsuarios, (index, usuario) => {
      html += `<tr>
            <td>${index + 1}</td>
            <td>${usuario.nombre}</td>
            <td>${usuario.apellido_paterno}</td>
            <td>${usuario.apellido_materno}</td>
            <td>${usuario.domicilio}</td>
            <td>${usuario.telefono}</td>
            <td>
              <button class='btn btn-primary' onclick='uno(${usuario.id_usuarios})' data-bs-toggle="modal" data-bs-target="#ModalUsuarios">Editar</button>
              <button class='btn btn-danger' onclick='eliminar(${usuario.id_usuarios})'>Eliminar</button>
            `;
    });
    $("#ListaUsuarios").html(html);
  });
};

var GuardarEditar = (e) => {
  e.preventDefault();
  var DatosFormularioUsuario = new FormData($("#form_usuarios")[0]);
  var accion = "";

  if (document.getElementById("id_usuarios").value != "") {
    accion = ruta + "actualizar";
  } else {
    accion = ruta + "insertar";
  }

  $.ajax({
    url: accion,
    type: "post",
    data: DatosFormularioUsuario,
    processData: false,
    contentType: false,
    cache: false,
    success: (respuesta) => {
      console.log(respuesta);
      respuesta = JSON.parse(respuesta);
      if (respuesta == "ok") {
        Swal.fire({
          title: "Usuarios",
          text: "Se guardó con éxito",
          icon: "success",
        });
        CargaLista();
        LimpiarCajas();
      } else {
        Swal.fire({
          title: "Usuarios",
          text: "Error al guardar",
          icon: "error",
        });
      }
    },
  });
};

var uno = async (id_usuarios) => {
  document.getElementById("tituloModal").innerHTML = "Actualizar Usuario";
  $.post(ruta + "uno", { id_usuarios: id_usuarios }, (usuario) => {
    usuario = JSON.parse(usuario);
    document.getElementById("id_usuarios").value = usuario.id_usuarios;
    document.getElementById("nombre").value = usuario.nombre;
    document.getElementById("apellido_paterno").value = usuario.apellido_paterno;
    document.getElementById("apellido_materno").value = usuario.apellido_materno;
    document.getElementById("domicilio").value = usuario.domicilio;
    document.getElementById("telefono").value = usuario.telefono;
  });
};

var unoconDomicilio = () => {
  var domicilio = document.getElementById("domicilio").value;
  $.post(ruta + "unoconDomicilio", { domicilio: domicilio }, (usuario) => {
    usuario = JSON.parse(usuario);
    if (parseInt(usuario.numero) > 0) {
      Swal.fire({
        title: "Usuarios!",
        text: "Ya existe un usuario con ese domicilio",
        icon: "error",
      });
      document.getElementById("domicilio").value = "";
    }
  });
};
var unoconTelefono = () => {
  var telefono = document.getElementById("telefono").value;
  $.post(ruta + "unoconTelefono", { telefono: telefono }, (usuario) => {
    usuario = JSON.parse(usuario);
    if (parseInt(usuario.numero) > 0) {
      Swal.fire({
        title: "Usuarios!",
        text: "Ya existe un usuario con ese telefono",
        icon: "error",
      });
      document.getElementById("telefono").value = "";
    }
  });
};

var eliminar = (id_usuarios) => {
  Swal.fire({
    title: "Usuarios",
    text: "¿Está seguro que desea eliminar el usuario?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(ruta + "eliminar", { id_usuarios: id_usuarios }, (respuesta) => {
        respuesta = JSON.parse(respuesta);
        if (respuesta == "ok") {
          CargaLista();
          Swal.fire({
            title: "Usuarios",
            text: "Se eliminó con éxito",
            icon: "success",
          });
        } else {
          Swal.fire({
            title: "Usuarios",
            text: "Error al eliminar",
            icon: "error",
          });
        }
      });
    }
  });
};

var LimpiarCajas = () => {
  document.getElementById("id_usuarios").value = "";
  document.getElementById("nombre").value = "";
  document.getElementById("apellido_paterno").value = "";
  document.getElementById("apellido_materno").value = "";
  document.getElementById("domicilio").value = "";
  document.getElementById("telefono").value = "";
  document.getElementById("tituloModal").innerHTML = "Insertar Usuario";
  $("#ModalUsuarios").modal("hide");
};

init();
