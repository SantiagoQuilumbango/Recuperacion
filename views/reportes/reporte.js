function init() {
    $("#form_prestamos").on("submit", (e) => {
      GuardarEditar(e);
    });
  }

  

  $('#id_libros').change(function() {
    //var nombreLibro = $(this).text();
  //console.log('The option with value ' + $(this).val() + ' and text ' + $(this).text() + ' was selected.');
  $.ajax({
    url: "../../controllers/prestamo.controllers.php?op=stock",
    type: "post",
    data: "id_libro=" + $(this).val(),
    dataType: "json",
    cache: false,
    success: function(respuesta)  {
      var totalEjemplar=respuesta.ejemplares;
      var nombreLibro=respuesta.titulo;

      if(totalEjemplar==0) {
        alert("Todos los libros " + nombreLibro +" estan alquilados");
        $("#cantidad")
      .attr("min", 0)
      .attr("max", totalEjemplar)
      .val(totalEjemplar);
      $("#guardar").attr("disabled","disabled");
      }
      else{
        $("#cantidad")
        .attr("min", 1)
        .attr("max", totalEjemplar)
        .val(totalEjemplar);
        $("#guardar").removeAttr("disabled");
      }
      
      
    },
  });
  
  });
  
  var ruta = "../../controllers/reporte.controllers.php?op=";
  
  $().ready(() => {
    CargaLista();
  });
  
  var CargaLista = () => {
    
    var html = "";
    $.get(ruta + "reporteLibrosPrestados", (ListPrestamos) => {
      console.log(ListPrestamos);
      ListPrestamos = JSON.parse(ListPrestamos);
      $.each(ListPrestamos, (index, prestamo) => {
        html += `<tr>
              <td>${index + 1}</td>
              <td>${prestamo.titulo}</td>
              <td>${prestamo.nombre}</td>
              <td>${prestamo.fecha_salida}</td>
              <td>${prestamo.fecha_devolucion}</td>
              <td>${prestamo.cantidad}</td>
              <td>${prestamo.observaciones}</td>
             
                
                
              `;
      });
      $("#ListaPrestamos").html(html);
    });
  };
  
  var GuardarEditar = (e) => {
    e.preventDefault();
    var DatosFormularioPrestamo = new FormData($("#form_prestamos")[0]);
    var accion = "";
    $("#guardar").removeAttr("disabled");
  
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
      document.getElementById("cantidad").value = prestamo.cantidad;
      document.getElementById("observaciones").value = prestamo.observaciones;
    });
    $("#guardar").removeAttr("disabled");
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
    document.getElementById("cantidad").value = 1;
    document.getElementById("observaciones").value = "";
    document.getElementById("tituloModal").innerHTML = "Insertar Prestamo";
    $("#ModalPrestamos").modal("hide");
  };
 
  
  init();
  