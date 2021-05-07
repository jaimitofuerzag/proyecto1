// para agregar un detalle mas, una fila
function agregarDetalle() {
  var htmlTags =
    "<tr>" +
    '<td><input type="text" name="telefono[]"     id="telefono[]"   class="form-control"></td>' +
    '<td><input type="text" name="direccion[]"    id="direccion[]"  class="form-control"</td>' +
    '<td><input type="text" name="email[]"        id="email[]"      class="form-control"</td>' +
    '<td><input type="text" name="pais[]"         id="pais[]"       class="form-control"</td>' +
    '<td><button type="button" class="btn btn-danger btn-sm" onclick="removerDetalle()">Delete</button></td>' +
    "</tr>";
  $("#detalle tbody").append(htmlTags);
  //$('#telefono[]').focus();
}

//funcion para elimnar una fila
function removerDetalle() {
  $("#detalle tr:last").remove();
}

//funcion para borrar cliente
$(function () {
  $(document).on("click", ".borrar", function (event) {
    event.preventDefault();
    var mensaje;
    var opcion = confirm("Desea borrar el registro ?");
    if (opcion == true) {
      var val = $(this).val();
      $.ajax({
        type: "POST",
        url: '../controller/ClienteController.php',
        data: {id:val, action:'del'},
        beforeSend: function () {
          //antes de enviar
          $('#mensaje').html('procesando ...');
        },
        success: function (data) {
          //si hubo exito
          // if (append) {
          //   $(placeholder).append(data);
          // } else {
          //   $(placeholder).html(data);
          // }
        },
      });

      $(this).closest("tr").remove();
    } else {
      mensaje = "Has clickado Cancelar";
    }
  });
});

function saveCabeceraDetalle() {
  if (
    $("#nombre").val().length < 1 ||
    $("#apellido").val().length < 1 ||
    $("#cedula").val().length < 1
  ) {
    $("#mensaje").show();
    $("#mensaje").html(
      "Ingrese datos, todos los campos del cliente son obligatorios ..."
    );
    $("#mensaje").fadeOut(4000);
    return false; // equals to exit or break
  }

  $("#formCab").submit();
}

//ver detalle del cliente
function verDetalle(id) {
  $("#detalleModal").modal("show");

  $.ajax({
    url: "../controller/DetalleController.php",
    type: "POST",
    data: { id: id, action: "getById" },
    beforeSend: function () {
      $("#mensaje").html("Procesando peticion...");
    },
    success: function (data) {
      $("#mensaje").html("");
      data = JSON.parse(data);
      $("#table-detalle td").remove();
      data.forEach(function (dat, index) {
        $("#table-detalle").append(
          '<tr class="table"><td>' +
            dat.telefono +
            "</td><td>" +
            dat.domicilio +
            "</td><td>" +
            dat.email +
            "</td><td>" +
            dat.pais +
            '</td><td><button class="btn btn-danger btn-sm">Borrar</button></td> </tr>'
        );
      });
    },
  });
}
