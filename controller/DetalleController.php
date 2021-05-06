<?php
require_once '../db/Conexion.php';
require_once '../model/DetalleModel.php';

//instancio conexion
$con = new Conexion();
$cnn = $con->connect();

//instancio Detalle
$detalle = new DetalleModel();

//recibo parametro del form, variable tipo hidde con propiedad save o de lo que se envie desde el form, DEL por defecto
@   $id = $_REQUEST['id'];
@$_REQUEST['action'];

if (isset($_REQUEST['action'])) {

    switch ($_REQUEST['action']) {
        case 'add':
            # code...
            
            break;

        case 'del':
            # code...
            echo 'Borrando Cliente y detalle';
            $id = $_REQUEST['id'];

            if ($cliente->deleteDetalle($id, $cnn) == 0)
                echo 'Registro borrado exitosamente';

            break;

        case 'update':
            # code...
            echo 'Actualizando Detalle <br>';

            break;

        case 'getAll':
            # code...
            $rsCliente = $detalle->getAllDetalle($cnn);

            break;

        case 'getById':
            # code...
            $data = $detalle->getDetalleByID($id,$cnn);
                echo json_encode($data);

            break;
        default:
            # code...
            break;
    }
}
