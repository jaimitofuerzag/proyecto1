<?php
require_once '../head.php';
require_once '../controller/ClienteController.php';
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
<!-- <button class="btn btn-success btn-sm">+ Cliente </button> -->
<div class="table-responsive-xl">
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col" style="display: none;">cedula</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Cedula</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
      </tr>
      <?php
      foreach ($rsCliente as $key => $value) {
        echo '<tr>';
        echo '<td style="display: none">' . $value->id . '</td>';
        echo '<td>' . $value->nombre . '</td>';
        echo '<td>' . $value->apellido . '</td>';
        echo '<td>' . $value->cedula . '</td>';
        echo '<td>
        <button class="btn btn-warning btn-sm" onclick="editar(' . $value->id . ');">Editar</button>
        <button class="btn btn-danger btn-sm borrar" id="boton" value="'.$value->id.'">Borrar</button>
        <button class="btn btn-success btn-sm" onclick="verDetalle(' . $value->id . ');">ver detalle</button>        
              </td>';
        echo '</tr>';
      }
      ?>
    </tbody>
  </table>
</div>

<?php
if ($rsCliente == null)
  echo 'no exisen registros';
?>

<!-- Modal -->
<div id="detalleModal" name="detalleModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Contenido del modal -->
    <div class="modal-content">
      <div class="modal-header">
        Detalle del Cliente
        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>
      <div class="modal-body">

        <table class="table table-striped table-hover responsive" id="table-detalle">

          <thead>
            <tr>
              <th>Telefono</th>
              <th>Domicilio</th>
              <th>Email</th>
              <th>Pais</th>
            </tr>
          </thead>
        </table>

      </div>

      <div class="modal-footer">
        <div id="mensaje"></div> <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>