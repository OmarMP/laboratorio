<?php
class baseDeDatos {
    protected $conexion;
    protected $isConnected=false;

    public function conectar() {
        $this->conexion= new mysqli("localhost","root","catolica","REGISTRO_omar");
        if ($this->conexion->connect_error) {
            echo "Error de conexion".
            $this->conexion->connect_error;
            $this->isConnected=false;
        } else {
            $this->isConnected=true;
        }
        return $this->isConnected;       
        
    }
    public function getArrayfromResult($result) {
        $records=array();
        while($row=$result->fetch_assoc()) {
            $records[]=$row;
        }
        return $records;
    }
}