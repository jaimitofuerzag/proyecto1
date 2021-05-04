<?php
require_once '../db/Conexion.php';
require_once '../model/DetalleModel.php';

//instancio conexion
$con = new Conexion();
$cnn = $con->connect();

//instancio Detalle
$detalle = new DetalleModel();

//recibo parametro del form, variable tipo hidde con propiedad save o de lo que se envie desde el form, DEL por defecto
@$_REQUEST['action'];

if (isset($_REQUEST['action'])) {

    switch ($_REQUEST['action']) {
        case 'add':
            # code...
            if (isset($_REQUEST['nombre']) && isset($_REQUEST['apellido']) && isset($_REQUEST['cedula'])) {
                echo 'Guardando detalle';
                //los parametros deben ser recibido por get o post desde el form $_REQUEST['nombre']
                $detalle->setTelefono(  $_REQUEST['telefono']);          
                $detalle->setDomicilio( $_REQUEST['domicilio']);   
                $detalle->setEmail(     $_REQUEST['email']);   
                $detalle->setPais(      $_REQUEST['pais']);
                $detalle->setFk_id_cliente($_REQUEST['id']);           

                //guardo detalle
                $last_id = $detalle->saveDetalle($detalle, $cnn);

                //si retorna 0 se inserta el detalle
                if ($last_id != 0) {
                    //base obtengo la cantidad de elementos que viene en el detalle del cliente 
                    $base       = $_REQUEST['telefono'];
                    $direccion  = $_REQUEST['direccion'];
                    $email      = $_REQUEST['email'];
                    $pais       = $_REQUEST['pais'];
                    
                } else {
                    echo '<br><b>ERROR: -></b> al insertar detalle';
                }
            } else {
                echo 'Debe ingresar los datos en los campos obligatorios';
            }
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

            $detalle->setNombre('');          //los parametros deben ser recibido por get o post desde el form, ej, $_POST['nombre']
            $detalle->setApellido('');
            $detalle->setCedula();
            $detalle->setEstado(1);

            if ($cliente->updateDetalle($cliente, $cnn) == 0)
                echo 'Registro actualizado exitosamente ';

            break;

        case 'getAll':
            # code...
            $rsCliente = $detalle->getAllDetalle($cnn);

            break;

        case 'getById':
            # code...
            $rsDetalle = $detalle->getDetalleByID($cnn,$id);

            break;
        default:
            # code...
            break;
    }
}
