<?php 
//clase Detalle
class DetalleModel{

    private $telefono;
    private $domicilio;
    private $email;
    private $pais;
    private $fk_id_cliente;

    /**
     * Get the value of telefono
     */ 
    public function getTelefono(){
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */ 
    public function setTelefono($telefono){
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get the value of domicilio
     */ 
    public function getDomicilio(){
        return $this->domicilio;
    }

    /**
     * Set the value of domicilio
     *
     * @return  self
     */ 
    public function setDomicilio($domicilio){
        $this->domicilio = $domicilio;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail(){
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email){
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of pais
     */ 
    public function getPais(){
        return $this->pais;
    }

    /**
     * Set the value of pais
     *
     * @return  self
     */ 
    public function setPais($pais){
        $this->pais = $pais;

        return $this;
    }

     /**
     * Get the value of fk_id_cliente
     */ 
    public function getFk_id_cliente()
    {
        return $this->fk_id_cliente;
    }

    /**
     * Set the value of fk_id_cliente
     *
     * @return  self
     */ 
    public function setFk_id_cliente($fk_id_cliente){
        $this->fk_id_cliente = $fk_id_cliente;

        return $this;
    }

    public function saveDetalle($detalle, $cnn){
        try {
			$sql = 'INSERT INTO detalle(telefono, domicilio, email, pais, fk_id_cliente)
 				    VALUES             (:telefono,:domicilio,:email,:pais,:fk_id_cliente)';
			$stmt = $cnn->prepare($sql);
			$stmt->execute(array(":telefono"     => $detalle->telefono, 
								 ":domicilio"    => $detalle->domicilio, 
								 ":email"        => $detalle->email,
								 ":pais"         => $detalle->pais,
                                 ":fk_id_cliente" => $detalle->fk_id_cliente 
								 ));            
            return 0;
		
		} catch (PDOException $e) {
			//throw $th;
			echo 'Mensaje : -> '.get_class($this).' - '.$e->getMessage();
            return 1 ;
			die();
		}
    }

    public function deleteDetalle($id, $cnn){
        try {
			try {
                $sql = 'DELETE FROM detalle WHERE id =:id';
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
		} catch (PDOException $e) {
			//throw $th;
			echo 'Mensaje : -> '.get_class($this).' - '.$e->getMessage();
            return 1 ;
			die();
		}

    }

    public function updateDetalle($detalle, $cnn){
        try {
            $data = [
                'telefono'  => $detalle->telefono,
                'domicilio' => $detalle->domicilio,
                'email'     => $detalle->email,
                'pais'      => $detalle->pais
            ];
            $sql = "UPDATE detalle SET telefono=:telefono, domicilio=:domicilio, email=:email  WHERE id=:id";
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

    public function getDetalleByID($id, $cnn){
        try {
			try {
                $sql = 'SELECT * FROM detalle WHERE fk_id_cliente =:id';
                $stmt = $cnn->prepare($sql);
                $stmt->bindParam(':fk_id_cliente', $id);
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
		} catch (PDOException $e) {
			//throw $th;
			echo 'Mensaje : -> '.get_class($this).' - '.$e->getMessage();
            return 1 ;
			die();
		}
    }

    public function getDetalleByCi($id, $cnn){
        try {
			try {
                $sql = 'SELECT * FROM detalle WHERE fk_id_cliente =:id';
                $stmt = $cnn->prepare($sql);
                $stmt->bindParam(':fk_id_cliente', $id);
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
		} catch (PDOException $e) {
			//throw $th;
			echo 'Mensaje : -> '.get_class($this).' - '.$e->getMessage();
            return 1 ;
			die();
		}

    }
}

?>