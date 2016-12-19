<?php
include_once ("cdatos.php");

 class cnegocios_registros_alumnos {
   //declaracion de atributos
   public $nom_usuario;
   public $pass_usuario;
   public $tipo_usuario;
   public $status_usuario;

   //declaracion del objeto
   public $objetoDato;

   //metodo constructor
   public function __construct($nom_usuario,$pass_usuario,$tipo_usuario,$status_usuario) {
            $this->nom_usuario = $nom_usuario;
            $this->pass_usuario = $pass_usuario;
            $this->tipo_usuario = $tipo_usuario;
            $this->status_usuario = $status_usuario;

            //Declaración del objeto de la clase capaDatos
    $this->objetoDato = new cdatos();
   }//se cierra el metodo constructor
     
   //funcion para buscar solo el nombre del usuario
   public function existeUsuario(){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT COUNT(*) AS existe FROM usuarios WHERE nom_usuario LIKE '$this->nom_usuario'");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['existe'];
           }
       }
       $this->objetoDato->desconectar();
   }

//funcion para insertar un nuevo alumno
   public function insertar_NuevoAlumno(){
       $this->objetoDato->conectar();
       $this->objetoDato->ejecutar("INSERT INTO usuarios(nom_usuario,
       pass_usuario,tipo_usuario,status_usuario,fecha_creacion_usuario)
        VALUES('$this->nom_usuario','$this->pass_usuario','$this->tipo_usuario','$this->status_usuario',NOW());");
       $this->objetoDato->desconectar();
   }

}//Se cierra la clase
?>