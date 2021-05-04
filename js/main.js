// para agregar un detalle mas, una fila
  function agregarDetalle(){
    var htmlTags = '<tr>'+
        '<td><input type="text" name="telefono[]"     id="telefono[]"   class="form-control"></td>'+
        '<td><input type="text" name="direccion[]"    id="direccion[]"  class="form-control"</td>'+
        '<td><input type="text" name="email[]"        id="email[]"      class="form-control"</td>'+
        '<td><input type="text" name="pais[]"         id="pais[]"       class="form-control"</td>'+
        '<td><button type="button" class="btn btn-danger btn-sm" onclick="removerDetalle()">Delete</button></td>'+
      '</tr>';
      $('#detalle tbody').append(htmlTags);
      //$('#telefono[]').focus();
  }

  //funcion para elimnar una fila
  function removerDetalle(){
    $('#detalle tr:last').remove();
  }

  function saveCabeceraDetalle(){

      if($('#nombre').val().length < 1 || $('#apellido').val().length < 1 || $('#cedula').val().length < 1){
        $('#mensaje').show();
        $('#mensaje').html('Ingrese datos, todos los campos del cliente son obligatorios ...');
        $('#mensaje').fadeOut(4000);
        return false; // equals to exit or break
      }     

      $("#formCab").submit();
  }
