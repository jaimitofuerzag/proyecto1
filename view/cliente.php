<?php 
require_once '../head.php';
?> 
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="../css/bootstrap.min.css">

<!-- jQuery library -->
<script src="../js/jquery.min.js"></script>

<!-- Popper JS -->
<script src="../js/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="../js/bootstrap.min.js"></script>

<!-- Main funciones JavaScript -->
<script src="../js/main.js"></script>

<div class="container-sm border p-3 my-3 ">

<p>Datos de cliente</p>
<div id="mensaje" class="alert alert-warning" role="alert" style="display: none;"></div>
<form class="form-inline" action="../controller/ClienteController.php" method="POST" name="formCab" id="formCab">

  <input type="hidden" name="action" id="action" value="add"><!-- por default add -->
  <label for="nombre">Nombre: &nbsp;</label>
  <input type="nombre" class="form-control" id="nombre"  name="nombre" required>
  &nbsp;
  <label for="apellido">Apellido: &nbsp;</label>
  <input type="text" class="form-control" id="apellido"  name="apellido" required>
  &nbsp;
  <label for="cedula">Cedula: &nbsp;</label>
  <input type="text" class="form-control" id="cedula"  name="cedula" required>
  &nbsp;<br>&nbsp;<br>
  
<!-- detalle -->
<div class="container border">
  <table class="table" id="detalle" name="detalle">
    <thead class="thead-dark ">
      <tr >
        <th>Telefono</th>
        <th>Direccion</th>
        <th>Email</th>
        <th>Pais</th>
        <th>Accion</th>
      </tr>
      <br>      
    </thead>
    <tbody>
    </tbody>
  </table>
  <button type="button" class="btn btn-primary btn-sm" onclick="agregarDetalle();">+ Detalle</button>
  &nbsp<button type="button" class="btn btn-success btn-sm" onclick="saveCabeceraDetalle();" style="float: right;" >Save</button>
</form>
</div>
</div>