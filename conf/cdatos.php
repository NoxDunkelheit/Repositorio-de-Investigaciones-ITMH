<?php

class cdatos {
   /* private $cadenaConexion = 'mysql:host=127.0.0.1;dbname=investigacion'; 
    private $user = 'root';
    private $password = '';
    private $objetoConexion;
    */
    private $cadenaConexion = 'mysql:host=127.0.0.1;dbname=investigacion'; 
    private $user = 'root';
    private $password = '';
    private $objetoConexion;
    
    public function __construct() {}
    
    public function conectar(){
        try{
            $this->objetoConexion = new PDO($this->cadenaConexion,$this->user,$this->password);
        }catch(PDOException $ex){
            echo "Error al conectar con la base de datos";
        }
    }
    
    public function desconectar(){
        $this->objetoBaseDatos = null;
    }
    
    public function ejecutar($comando){
        try{
            $ejecutar = $this->objetoConexion->prepare($comando);
            $ejecutar->execute();
            $rows = $ejecutar->fetchAll();
            return $rows;
        }catch(PDOException $ex){
            throw $ex;
        }
    }
 
}
?>