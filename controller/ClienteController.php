<?php
require_once '../db/Conexion.php';
require_once '../model/ClienteModel.php';
require_once '../model/DetalleModel.php';

//instancio conexion
$con = new Conexion();
$cnn = $con->connect();

//instancio Cliente
$cliente = new ClienteModel();

//recibo parametro del form, variable tipo hidde con propiedad save o de lo que se envie desde el form, DEL por defecto
@$_REQUEST['action'];

if (isset($_REQUEST['action'])) {

    switch ($_REQUEST['action']) {
        case 'add':
            # code...
            if (isset($_REQUEST['nombre']) && isset($_REQUEST['apellido']) && isset($_REQUEST['cedula'])) {
                echo 'Guardando Cliente y detalle';
                //los parametros deben ser recibido por get o post desde el form $_REQUEST['nombre']
                $cliente->setNombre(    $_REQUEST['nombre']);   // $cliente->setNombre($_REQUEST['nombre']);       
                $cliente->setApellido(  $_REQUEST['apellido']); // $cliente->setApellido($_REQUEST['Apellido']);  
                $cliente->setCedula(    $_REQUEST['cedula']);   // $cliente->setCedula($_REQUEST['cedula']);
                $cliente->setEstado(1);                       // $cliente->setEstado($_REQUEST['estado']);

                //guardo cabecera cliente
                $last_id = $cliente->saveCliente($cliente, $cnn);

                //si retorna 0 se inserta el detalle
                if ($last_id != 0) {
                    //base obtengo la cantidad de elementos que viene en el detalle del cliente 
                    $base       = $_REQUEST['telefono'];
                    $direccion  = $_REQUEST['direccion'];
                    $email      = $_REQUEST['email'];
                    $pais       = $_REQUEST['pais'];
                    
                    for ($c = 0; $c < count($base); $c++) {
                        //instancio Detalle
                        $detalle = new DetalleModel();
                        //los parametros deben ser recibido por get o post desde el form $_POST['telefono'], etc
                        @$detalle->setTelefono($base[$c]);
                        @$detalle->setDomicilio($direccion[$c]);
                        @$detalle->setEmail($email[$c]);
                        @$detalle->setPais($pais[$c]);
                        @$detalle->setFk_id_cliente($last_id);

                        //guardo el detalle
                        if ($detalle->saveDetalle($detalle, $cnn) == 0)
                            echo 'Registro guardado exitosamente';   
                    }
                    header('Location: http://localhost/lwp/cab_det/view/listarClientes.php?action=getAll');
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

            if ($cliente->deleteCliente($id, $cnn) == 0)
                echo 'Registro borrado exitosamente';

            break;

        case 'update':
            # code...
            echo 'Actualizando Cliente <br>';

            $cliente->setNombre('');          //los parametros deben ser recibido por get o post desde el form, ej, $_POST['nombre']
            $cliente->setApellido('');
            $cliente->setCedula(0);
            $cliente->setEstado(1);

            if ($cliente->updateCliente($cliente, $cnn) == 0)
                echo 'Registro actualizado exitosamente ';

            break;

        case 'getAll':
            # code...
            
            $rsCliente = $cliente->getAllCliente($cnn);
            
            break;
        default:
            # code...
            break;
    }
}
