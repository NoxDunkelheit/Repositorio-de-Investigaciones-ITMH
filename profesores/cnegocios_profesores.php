<?php
include_once ("../conf/cdatos.php");

class cnegocios_profesores {
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
   public function buscarIdProfesor(){
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

//funcion para insertar registro en el historial de sesiones del Profesor
   public function insertar_Historial_SesionProfesor($lat,$long){
       $id = $this->buscarIdProfesor();
       $fecha = $this->obtenerFecha();
       $this->objetoDato->conectar();
       $this->objetoDato->ejecutar("INSERT INTO historial_sesiones(id_usuario,
       latitud,longitud,fecha_inicio)
        VALUES('$id','$lat','$long','$fecha');");
       $this->objetoDato->desconectar();
   }

//funcion para buscar solo el nombre del usuario
   public function buscarNombreProfesor(){
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
   public function buscarStatusProfesor(){
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
    public function obtenerLatSesionesProfesor($buscarPosition){
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
    public function obtenerLongSesionesProfesor($buscarPosition){
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
    public function obtenerFechaSesionesProfesor($buscarPosition){
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

         //funcion para obtener datos del perfil exp.
public function data_perfilProfesor($id_usuario,$columna){
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
   public function existePerfilProfesor($id_usuario){
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
   public function actualizarPerfilProfesor($id_usuario,$nom_perfil,$ap_perfil,$am_perfil,$foto_perfil,
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

         //funcion para actualizar el status a ACTIVADO
   public function actualizarStatusProfesor(){
       $this->objetoDato->conectar();
       $this->objetoDato->ejecutar("UPDATE usuarios SET status_usuario = 'ACTIVADO' WHERE nom_usuario LIKE '$this->nom_usuario' AND pass_usuario LIKE '$this->pass_usuario'");
       $this->objetoDato->desconectar();
   }

//funcion para obtener el nombre de la foto
   public function obtenerFotoProfesor($id_usuario){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT foto_perfil AS foto FROM perfiles WHERE id_usuario = $id_usuario");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
                    return "../img/profesores/".$rs[$i]['foto'];
           }
       }
       if($rs[$i]['foto']==""){
       return "../img/default_perfil.jpg";
       }
       $this->objetoDato->desconectar();
   }
///////
   //Funcion para insertar la investigación
   public function insertarInvestigacionProfesor($titulo){
       $this->objetoDato->conectar();
       $this->objetoDato->ejecutar("INSERT INTO investigaciones(titulo_investigacion,fecha_investigacion,status_investigacion) 
       VALUES('$titulo',NOW(),'ACEPTADA');");
       $this->objetoDato->desconectar();
   }

    //funcion para el id de la investigación subida actualmente !!!Agrega un folio a la tabla de investigaciones
   public function id_investigacion(){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT id_investigacion FROM investigaciones ORDER BY id_investigacion DESC LIMIT 1");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['id_investigacion'];
           }
       }
       $this->objetoDato->desconectar();
   }
   
      //Funcion para insertar en la tabla intermedia tiene
   public function insertarInvestigacionProfesorTiene($id_usuario){
       $id_investigacion = $this->id_investigacion();
       $this->objetoDato->conectar();
       $this->objetoDato->ejecutar("INSERT INTO tiene(id_usuario,id_investigacion) VALUES($id_usuario,$id_investigacion)");
       $this->objetoDato->desconectar();
   }
///////

//funcion para encontrar el estatus del usuario
public function status_usuario(){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT status_usuario FROM usuarios WHERE nom_usuario LIKE '$this->nom_usuario' AND pass_usuario LIKE '$this->pass_usuario';");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['status_usuario'];
           }
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

//funcion para crear tabla de investigaciones en proceso
public function inv_proceso($id_usuario){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT DISTINCT i.status_investigacion AS status,i.folio_investigacion AS folio,i.id_investigacion AS id,i.titulo_investigacion AS inv,i.fecha_investigacion AS fecha  
FROM usuarios AS u 
INNER JOIN tiene AS t ON u.id_usuario = t.id_usuario 
INNER JOIN investigaciones AS i ON t.id_investigacion = i.id_investigacion 
WHERE (t.asesor_1 = $id_usuario OR t.asesor_2 = $id_usuario) AND i.status_investigacion LIKE 'EN REVISION';"); 
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               $folio = $rs[$i]['folio'];
               $usuario = $rs[$i]['usuario'];
               $estado = "";
               if($rs[$i]['status'] == "EN REVISION"){
                 $estado = "warning";
               }else if($rs[$i]['status'] == "ACEPTADA"){
                 $estado = "success";
               }
               echo "<tr class='$estado'>";
               echo "<td>".$rs[$i]['folio']."<br><center><b>".$rs[$i]['status']."</b><br></center></td>";
               ?>
               <td><a href="Javascript: cargar_var('#contenedor','info_inv.php','<?php echo $folio; ?>')"><?php echo $rs[$i]['inv']; ?></a><br><u class='pull-right'>Fecha: <?php echo $rs[$i]['fecha']; ?></u></td>
               <?php
               echo "</tr>";
           }
       } 
       $this->objetoDato->desconectar();
   }

//funcion para encontrar los integrantes de la investigacion
public function inte_inv($folio){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT CONCAT(p.ap_perfil,' ',p.am_perfil,',',p.nombre_perfil) AS autor FROM perfiles AS p INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario 
INNER JOIN tiene AS t ON u.id_usuario = t.id_usuario INNER JOIN investigaciones AS i 
ON t.id_investigacion = i.id_investigacion WHERE i.folio_investigacion LIKE '$folio';");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               echo "> ".$rs[$i]['autor']."<br>";
           }
       }
       $this->objetoDato->desconectar();
   }

//funcion para obtener el titulo de la investigacion
public function titulo_inv($folio){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT titulo_investigacion FROM investigaciones WHERE folio_investigacion LIKE '$folio';");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               echo $rs[$i]['titulo_investigacion'];
           }
       }
       $this->objetoDato->desconectar();
   }

   //funcion para encontrar los asesor1 de la investigacion
public function asesor1_inv($folio){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT DISTINCT CONCAT(p.ap_perfil,' ',p.am_perfil,',',p.nombre_perfil) AS autor FROM perfiles AS p INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario 
INNER JOIN tiene AS t ON u.id_usuario = t.asesor_1 INNER JOIN investigaciones AS i 
ON t.id_investigacion = i.id_investigacion WHERE i.folio_investigacion LIKE '$folio';");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               echo "> ".$rs[$i]['autor']."<br>";
           }
       }
       $this->objetoDato->desconectar();
   }

      //funcion para encontrar los asesor2 de la investigacion
public function asesor2_inv($folio){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT DISTINCT CONCAT(p.ap_perfil,' ',p.am_perfil,',',p.nombre_perfil) AS autor FROM perfiles AS p INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario 
INNER JOIN tiene AS t ON u.id_usuario = t.asesor_2 INNER JOIN investigaciones AS i 
ON t.id_investigacion = i.id_investigacion WHERE i.folio_investigacion LIKE '$folio';");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               echo "> ".$rs[$i]['autor']."<br>";
           }
       }
       $this->objetoDato->desconectar();
   }

      //funcion para encontrar los revisor1 de la investigacion
public function revisor1_inv($folio){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT DISTINCT u.id_usuario AS id_profesor,CONCAT(p.ap_perfil,' ',p.am_perfil,',',p.nombre_perfil) AS profesor FROM perfiles AS p INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario 
INNER JOIN tiene AS t ON u.id_usuario = t.revisor_1 INNER JOIN investigaciones AS i 
ON t.id_investigacion = i.id_investigacion WHERE i.folio_investigacion LIKE '$folio';");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
                 return '<option value="'.$rs[$i]['id_profesor'].'" SELECTED>'.$rs[$i]['profesor'].'</option>';               
           }
       }
       $this->objetoDato->desconectar();
   }

      //funcion para encontrar los revisor2 de la investigacion
public function revisor2_inv($folio){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT DISTINCT u.id_usuario AS id_profesor,CONCAT(p.ap_perfil,' ',p.am_perfil,',',p.nombre_perfil) AS profesor FROM perfiles AS p INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario 
INNER JOIN tiene AS t ON u.id_usuario = t.revisor_2 INNER JOIN investigaciones AS i 
ON t.id_investigacion = i.id_investigacion WHERE i.folio_investigacion LIKE '$folio';");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               return '<option value="'.$rs[$i]['id_profesor'].'" SELECTED>'.$rs[$i]['profesor'].'</option>';   
           }
       }
       $this->objetoDato->desconectar();
   }

   //funcion para buscar solo el status de la investigacion
   public function buscarStatusInvestigacion($folio){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT DISTINCT i.status_investigacion AS status FROM perfiles AS p INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario 
INNER JOIN tiene AS t ON u.id_usuario = t.id_usuario INNER JOIN investigaciones AS i 
ON t.id_investigacion = i.id_investigacion WHERE i.folio_investigacion LIKE '$folio';");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['status'];
           }
       }
       $this->objetoDato->desconectar();
   }

      //Funcion para actualizar en la tabla intermedia tiene
   public function actualizarStatusInvestigacion($status,$folio){
       $id_investigacion = $this->id_investigacion();
       $this->objetoDato->conectar();
       $this->objetoDato->ejecutar("UPDATE investigaciones SET status_investigacion = '$status' WHERE folio_investigacion = '$folio';");
       $this->objetoDato->desconectar();
   }

   //funcion para listar los profesores activos
   public function listarProfesoresActivos(){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT u.id_usuario AS id_profesor,CONCAT(p.nombre_perfil,' ',p.ap_perfil,' ',p.am_perfil) AS profesor FROM perfiles AS p 
        INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario WHERE u.tipo_usuario LIKE 'PROFESOR' AND u.status_usuario LIKE 'ACTIVADO'");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
               echo '<option value="'.$rs[$i]['id_profesor'].'">'.$rs[$i]['profesor'].'</option>';
           }
       }
       $this->objetoDato->desconectar();
   }

      //funcion para obtener el id de la investigacion
   public function obtenerIdInvestigacion($folio){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT id_investigacion FROM investigaciones WHERE folio_investigacion LIKE '$folio';");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['id_investigacion'];
           }
       }
       $this->objetoDato->desconectar();
   }

         //Funcion para actualiza en la tabla tiene revisores
   public function actualizarRevisoresInvestigacion($id_investigacion,$revisor_1,$revisor_2){
       $id_investigacion = $this->id_investigacion();
       $this->objetoDato->conectar();
       $this->objetoDato->ejecutar("UPDATE tiene SET revisor_1 = '$revisor_1',revisor_2 = '$revisor_2' WHERE id_investigacion = $id_investigacion;");
       $this->objetoDato->desconectar();
   }

         //funcion para contar investigaciones
   public function contarInvestigacion(){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT COUNT(i.folio_investigacion) AS total FROM perfiles AS p INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario 
INNER JOIN tiene AS t ON u.id_usuario = t.id_usuario INNER JOIN investigaciones AS i 
ON t.id_investigacion = i.id_investigacion WHERE u.nom_usuario LIKE '$this->nom_usuario' AND u.pass_usuario LIKE '$this->pass_usuario';");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['total'];
           }
       }
       $this->objetoDato->desconectar();
   }

          //funcion para contar investigaciones aceptadas
   public function contarInvestigacionAceptada($id_profesor){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT DISTINCT COUNT(i.folio_investigacion) AS total FROM perfiles AS p INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario 
INNER JOIN tiene AS t ON u.id_usuario = t.id_usuario INNER JOIN investigaciones AS i 
ON t.id_investigacion = i.id_investigacion WHERE (t.asesor_1 = $id_profesor OR t.asesor_2 = $id_profesor) AND i.status_investigacion LIKE 'ACEPTADA' ORDER BY i.fecha_investigacion");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['total'];
           }
       }
       $this->objetoDato->desconectar();
   }

             //funcion para contar investigaciones en revision
   public function contarInvestigacionRevision($id_profesor){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT DISTINCT COUNT(i.folio_investigacion) AS total FROM perfiles AS p INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario 
INNER JOIN tiene AS t ON u.id_usuario = t.id_usuario INNER JOIN investigaciones AS i 
ON t.id_investigacion = i.id_investigacion WHERE (t.asesor_1 = $id_profesor OR t.asesor_2 = $id_profesor) AND i.status_investigacion LIKE 'EN REVISION' ORDER BY i.fecha_investigacion");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['total'];
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

}//Se cierra la clase
?>