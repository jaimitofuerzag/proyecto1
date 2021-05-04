<?php
//clase Maestra
class ClienteModel{

    private $nombre;
    private $apellido;
    private $cedula;
    private $estado;

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of apellido
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set the value of apellido
     *
     * @return  self
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get the value of cedula
     */
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * Set the value of cedula
     *
     * @return  self
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;

        return $this;
    }

    /**
     * Get the value of estado
     */
    public function getEstado(){
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */
    public function setEstado($estado){
        $this->estado = $estado;

        return $this;
    }

    public function saveCliente($cliente, $cnn){
        try {
            $sql = 'INSERT INTO cliente(nombre, apellido, cedula, estado)
 				    VALUES             (:nombre,:apellido,:cedula,:estado)';
            $stmt = $cnn->prepare($sql);
            $stmt->execute(array(
                ":nombre"   => $cliente->nombre,
                ":apellido" => $cliente->apellido,
                ":cedula"   => $cliente->cedula,
                ":estado"   => $cliente->estado
            ));

            return $last_id = $cnn->lastInsertId();
        } catch (PDOException $e) {
            //throw $th;
            echo 'Mensaje : -> ' . $e->getMessage();
            return 0;
            die();
        }
    }

    public function deleteCliente($id, $cnn){
        try {
            $sql = 'DELETE FROM cliente WHERE id =:id';
            $stmt = $cnn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            if (!$stmt->rowCount()){
                echo "Deletion failed";
                return 0;
            } 
            
        } catch (PDOException $e) {
            //throw $th;
            echo 'Mensaje : -> ' . $e->getMessage();
            return 0;
            die();
        }
    }

    public function updateCliente($cliente, $cnn){
        try {
            $data = [
                'nombre'    => $cliente->nombre,
                'apellido'  => $cliente->apellido,
                'cedula'    => $cliente->cedula,
                'estado'    => $cliente->estado
            ];
            $sql = "UPDATE cliente SET nombre=:nombre, apellido=:apellido,  estado=:estado  WHERE cedula=:cedula";
            $stmt= $cnn->prepare($sql);
            $stmt->execute($data);

            if ($stmt->rowCount()>0){                
                return 0;
            } 
            
        } catch (PDOException $e) {
            //throw $th;
            echo 'Mensaje : -> ' . $e->getMessage();
            return 0;
            die();
        }
    }

    function getAllCliente($cnn){
        try {
            $sql = 'SELECT * FROM cliente order by id desc';
            $stmt = $cnn->prepare($sql);
            $stmt->execute();

            return $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            //throw $th;
            echo 'Mensaje : -> ' . $e->getMessage();
            return 0;
            die();
        }
    }
}
