<?php
include_once ("../conf/cdatos.php");

class cnegocios_administradores {
   //declaracion de atributos
   public $nom_usuario;
   public $pass_usuario;

   //declaracion del objeto
   public $objetoDato;

   //metodo constructor
   public function __construct($nom_usuario,$pass_usuario) {
            $this->nom_usuario = $nom_usuario;
            $this->pass_usuario = $pass_usuario;

            //Declaración del objeto de la clase capaDatos
    $this->objetoDato = new cdatos();
   }//se cierra el metodo constructor
     
   //funcion para buscar solo el id del usuario
   public function buscarIdAdministrador(){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT id_usuario FROM usuarios WHERE nom_usuario LIKE '$this->nom_usuario' AND pass_usuario LIKE '$this->pass_usuario'");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['id_usuario'];
           }
       } 
       $this->objetoDato->desconectar();
   }

//funcion para obtener la fecha actual
   public function obtenerFecha(){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT (NOW()) AS fecha;");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['fecha'];
           }
       }
       $this->objetoDato->desconectar();
   }

//funcion para insertar registro en el historial de sesiones del alumno
   public function insertar_Historial_SesionAdministrador($lat,$long){
       $id = $this->buscarIdAdministrador();
       $fecha = $this->obtenerFecha();
       $this->objetoDato->conectar();
       $this->objetoDato->ejecutar("INSERT INTO historial_sesiones(id_usuario,
       latitud,longitud,fecha_inicio)
        VALUES('$id','$lat','$long','$fecha');");
       $this->objetoDato->desconectar();
   }

//funcion para buscar solo el nombre del usuario
   public function buscarNombreAdministrador(){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT nom_usuario FROM usuarios WHERE nom_usuario LIKE '$this->nom_usuario' AND pass_usuario LIKE '$this->pass_usuario'");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['nom_usuario'];
           }
       }
       $this->objetoDato->desconectar();
   }

//funcion para buscar solo el status del usuario
   public function buscarStatusAdministrador(){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT status_usuario FROM usuarios WHERE nom_usuario LIKE '$this->nom_usuario' AND pass_usuario LIKE '$this->pass_usuario'");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['status_usuario'];
           }
       }
       $this->objetoDato->desconectar();
   }

//funcion para obtener latitud de los ultimos inicios de sesion del usuario
    public function obtenerLatSesionesAdministrador($buscarPosition){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT latitud FROM usuarios AS u 
INNER JOIN historial_sesiones AS hs 
ON u.id_usuario = hs.id_usuario 
WHERE nom_usuario LIKE '$this->nom_usuario' AND pass_usuario LIKE '$this->pass_usuario' 
ORDER BY fecha_inicio DESC LIMIT $buscarPosition,1;");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['latitud'];
           }
       }
       $this->objetoDato->desconectar();
   }
//funcion para obtener longitud de los ultimos inicios de sesion del usuario
    public function obtenerLongSesionesAdministrador($buscarPosition){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT longitud FROM usuarios AS u 
INNER JOIN historial_sesiones AS hs 
ON u.id_usuario = hs.id_usuario 
WHERE nom_usuario LIKE '$this->nom_usuario' AND pass_usuario LIKE '$this->pass_usuario' 
ORDER BY fecha_inicio DESC LIMIT $buscarPosition,1;");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['longitud'];
           }
       }
       $this->objetoDato->desconectar();
   }

//funcion para obtener la fecha de los ultimos inicios de sesion del usuario
    public function obtenerFechaSesionesAdministrador($buscarPosition){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT (hs.fecha_inicio) AS fecha FROM usuarios AS u 
INNER JOIN historial_sesiones AS hs 
ON u.id_usuario = hs.id_usuario 
WHERE u.nom_usuario LIKE '$this->nom_usuario' AND u.pass_usuario LIKE '$this->pass_usuario' 
ORDER BY hs.fecha_inicio DESC LIMIT $buscarPosition,1;");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['fecha'];
           }
       }
       $this->objetoDato->desconectar();
   }

   //funcion para obtener latitud de los ultimos inicios de sesion de todos los usuarios
    public function obtenerSesionesTodos(){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT (u.nom_usuario) AS nombre,(hs.latitud) AS lat, (hs.longitud) AS lng, 
       (hs.fecha_inicio) AS fecha, (u.tipo_usuario) AS tipo, (u.status_usuario) AS estado FROM usuarios AS u 
INNER JOIN historial_sesiones AS hs 
ON u.id_usuario = hs.id_usuario  
ORDER BY fecha_inicio DESC LIMIT 15;");
echo "<table class='table'>";
echo "<thead><tr><td></td><td>Usuario</td><td>Ubicación</td><td>Fecha</td><td>Tipo</td><td>Estado</td></tr></thead>";
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
               $count = $i +1;
               $estado = $rs[$i]['estado'];
               
               if($estado == "ACTIVADO"){
                 $color = "success";
               }else if($estado == "DESACTIVADO"){
                 $color = "danger";
               }else if($estado == "EN PROCESO"){
                 $color = "warning";
               }

               echo "<tr class=".$color.">";
               echo "<td># ".$count."</td>";
               echo "<td>".$rs[$i]['nombre']."</td>";
               echo "<td>".$rs[$i]['lat'].", ".$rs[$i]['lng']."</td>";
               echo "<td>".$rs[$i]['fecha']."</td>";
               echo "<td>".$rs[$i]['tipo']."</td>";
               echo "<td>".$rs[$i]['estado']."</td>";
               echo "</tr>";
           }
       }
echo "</table>";
       $this->objetoDato->desconectar();
   }

      //funcion para obtener datos del perfil exp.
   public function data_perfilAdministrador($id_usuario,$columna){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT $columna FROM perfiles WHERE id_usuario = $id_usuario");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
               return $rs[$i][$columna];
           }
       }
       $this->objetoDato->desconectar();
   }

   //funcion para saber la existencia del perfil creado
   public function existePerfilAdministrador($id_usuario){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT COUNT(id_usuario) AS usuario FROM perfiles WHERE id_usuario LIKE '$id_usuario'");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['usuario'];
           }
       }
       $this->objetoDato->desconectar();
   }

   //funcion para actualizar el perfil creado
   public function actualizarPerfilAdministrador($id_usuario,$nom_perfil,$ap_perfil,$am_perfil,$foto_perfil,
   $calle_perfil,$num_perfil,$col_perfil,$cp_perfil,$cd_perfil,$estado_perfil,$nacionalidad_perfil,$tel_perfil,$correo_perfil,$rfc_perfil,$num_control){
       $this->objetoDato->conectar();
       $this->objetoDato->ejecutar("UPDATE perfiles SET nombre_perfil='$nom_perfil',
       nombre_perfil='$nom_perfil',
       ap_perfil='$ap_perfil',
       am_perfil='$am_perfil',
       foto_perfil='$foto_perfil',
       calle_perfil='$calle_perfil',
       num_perfil='$num_perfil',
       col_perfil='$col_perfil',
       cp_perfil='$cp_perfil',
       cd_perfil='$cd_perfil',
       estado_perfil='$estado_perfil',
       nacionalidad_perfil='$nacionalidad_perfil',
       tel_perfil='$tel_perfil',
       correo_perfil='$correo_perfil',
       rfc_perfil='$rfc_perfil',
       num_control='$num_control' 
       WHERE id_usuario = $id_usuario");
       $this->objetoDato->desconectar();
   }

      //funcion para actualizar el status a ACTIVADO
   public function actualizarStatusAdministrador(){
       $this->objetoDato->conectar();
       $this->objetoDato->ejecutar("UPDATE usuarios SET status_usuario = 'ACTIVADO' WHERE nom_usuario LIKE '$this->nom_usuario' AND pass_usuario LIKE '$this->pass_usuario'");
       $this->objetoDato->desconectar();
   }

      //funcion para insertar en la tabla perfil
   public function InsertarPerfil($id_usuario,$nom_perfil,$ap_perfil,$am_perfil,$foto_perfil,
   $calle_perfil,$num_perfil,$col_perfil,$cp_perfil,$cd_perfil,$estado_perfil,$nacionalidad_perfil,$tel_perfil,$correo_perfil,$rfc_perfil,$num_control){
       $this->objetoDato->conectar();
       $this->objetoDato->ejecutar("INSERT INTO perfiles(id_usuario,
       nombre_perfil,ap_perfil,am_perfil,foto_perfil,calle_perfil,
       num_perfil,col_perfil,cp_perfil,cd_perfil,estado_perfil,
       nacionalidad_perfil,tel_perfil,correo_perfil,rfc_perfil,
       num_control) VALUES($id_usuario,'$nom_perfil','$ap_perfil','$am_perfil','$foto_perfil',
   '$calle_perfil','$num_perfil','$col_perfil','$cp_perfil','$cd_perfil','$estado_perfil','$nacionalidad_perfil','$tel_perfil',
   '$correo_perfil','$rfc_perfil','$num_control');");
       $this->objetoDato->desconectar();
   }

   //funcion para obtener el nombre de la foto
   public function obtenerFotoAdministrador($id_usuario){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT foto_perfil AS foto FROM perfiles WHERE id_usuario = $id_usuario");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
                    return "../img/administradores/".$rs[$i]['foto'];
           }
       }
       if($rs[$i]['foto']==""){
       return "../img/default_perfil.jpg";
       }
       $this->objetoDato->desconectar();
   }

   //funcion para encontrar el tipo de usuario
public function tipo_usuario(){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT tipo_usuario FROM usuarios WHERE nom_usuario LIKE '$this->nom_usuario' AND pass_usuario LIKE '$this->pass_usuario';");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['tipo_usuario'];
           }
       }
       $this->objetoDato->desconectar();
   }

      //funcion para obtener la latitud con el id de sesion
public function latitud_sesion($id_sesion){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT latitud FROM historial_sesiones WHERE id_historial = $id_sesion");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['latitud'];
           }
       }
       $this->objetoDato->desconectar();
   }
   
   //funcion para obtener la longitud con el id de sesion
public function longitud_sesion($id_sesion){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT longitud FROM historial_sesiones WHERE id_historial = $id_sesion");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['longitud'];
           }
       }
       $this->objetoDato->desconectar();
   }

      //funcion para obtener la fecha con el id de sesion
public function fecha_sesion($id_sesion){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT fecha_inicio FROM historial_sesiones WHERE id_historial = $id_sesion");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['fecha_inicio'];
           }
       }
       $this->objetoDato->desconectar();
   }

         //funcion para obtener el total de profesores activos
public function total_Profesores(){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT COUNT(*) AS total 
FROM usuarios 
WHERE status_usuario LIKE 'ACTIVADO' AND tipo_usuario LIKE 'PROFESOR'");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['total'];
           }
       }
       $this->objetoDato->desconectar();
   }

            //funcion para obtener el total de alumnos activos
public function total_Alumnos(){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT COUNT(*) AS total 
FROM usuarios 
WHERE status_usuario LIKE 'ACTIVADO' AND tipo_usuario LIKE 'ALUMNO'");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['total'];
           }
       }
       $this->objetoDato->desconectar();
   }

               //funcion para obtener el total de administradores activos
public function total_Administradores(){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT COUNT(*) AS total 
FROM usuarios 
WHERE status_usuario LIKE 'ACTIVADO' AND tipo_usuario LIKE 'ADMINISTRADOR'");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['total'];
           }
       }
       $this->objetoDato->desconectar();
   }

}//Se cierra la clase
?>