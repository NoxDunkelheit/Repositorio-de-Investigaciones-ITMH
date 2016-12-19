<?php
include_once ("../conf/cdatos.php");

class cnegocios_alumnos {
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
   public function buscarIdAlumno(){ 
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
   public function insertar_Historial_SesionAlumno($lat,$long){
       $id = $this->buscarIdAlumno();
       $fecha = $this->obtenerFecha();
       $this->objetoDato->conectar();
       $this->objetoDato->ejecutar("INSERT INTO historial_sesiones(id_usuario,
       latitud,longitud,fecha_inicio)
        VALUES('$id','$lat','$long','$fecha');");
       $this->objetoDato->desconectar();
   }

//funcion para buscar solo el nombre del usuario
   public function buscarNombreAlumno(){
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
   public function buscarStatusAlumno(){
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
    public function obtenerLatSesionesAlumno($buscarPosition){
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
    public function obtenerLongSesionesAlumno($buscarPosition){
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
    public function obtenerFechaSesionesAlumno($buscarPosition){
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

//funcion para saber la existencia del perfil creado
   public function existePerfilAlumno($id_usuario){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT COUNT(id_usuario) AS usuario FROM perfiles WHERE id_usuario LIKE '$id_usuario'");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['usuario'];
           }
       }
       $this->objetoDato->desconectar();
   }

//funcion para obtener el nombre de la foto
   public function obtenerFotoAlumno($id_usuario){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT foto_perfil AS foto FROM perfiles WHERE id_usuario = $id_usuario");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
                    return "../img/alumnos/".$rs[$i]['foto'];
           }
       }
       if($rs[$i]['foto']==""){
       return "../img/default_perfil.jpg";
       }
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

   //funcion para actualizar el perfil creado
   public function actualizarPerfilAlumno($id_usuario,$nom_perfil,$ap_perfil,$am_perfil,$foto_perfil,
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
   public function actualizarStatusAlumno(){
       $this->objetoDato->conectar();
       $this->objetoDato->ejecutar("UPDATE usuarios SET status_usuario = 'ACTIVADO' WHERE nom_usuario LIKE '$this->nom_usuario' AND pass_usuario LIKE '$this->pass_usuario'");
       $this->objetoDato->desconectar();
   }

      //funcion para obtener datos del perfil exp.
   public function data_perfilAlumno($id_usuario,$columna){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT $columna FROM perfiles WHERE id_usuario = $id_usuario");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
               return $rs[$i][$columna];
           }
       }
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

   //funcion para listar los tipos de investigacion
   public function listarTiposInvestigaciones(){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT id_tipo,tipo_investigacion FROM tipos");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
               echo '<option value="'.$rs[$i]['id_tipo'].'">'.$rs[$i]['tipo_investigacion'].'</option>';
           }
       }
       $this->objetoDato->desconectar();
   }

   ///////
   //Funcion para la creacion del folio
   public function crear_folio(){
       $id_alumno = $this->buscarIdAlumno();
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT CONCAT(YEAR(NOW()),p.num_control,p.rfc_perfil,'_',COUNT(*)) AS folio FROM usuarios AS u INNER JOIN tiene AS t 
ON u.id_usuario = t.id_usuario INNER JOIN investigaciones AS i 
ON t.id_investigacion = i.id_investigacion INNER JOIN perfiles AS p 
ON u.id_usuario = p.id_usuario WHERE u.id_usuario = $id_alumno;");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['folio'];
           }
       }
       $this->objetoDato->desconectar();
   }
   //Funcion para insertar la investigación
   public function insertarInvestigacion($id_tipo,$titulo){
       $folio = $this->crear_folio();
       $this->objetoDato->conectar();
       $this->objetoDato->ejecutar("INSERT INTO investigaciones(id_tipo,titulo_investigacion,fecha_investigacion,status_investigacion,folio_investigacion) 
       VALUES($id_tipo,'$titulo',NOW(),'EN REVISION','$folio');");
       $this->objetoDato->desconectar();
   }
       //funcion para el id de la investigación subida actualmente
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
   public function insertarInvestigacionTiene($id_usuario,$asesor_1,$asesor_2){
       $id_investigacion = $this->id_investigacion();
       $this->objetoDato->conectar(); 
       $this->objetoDato->ejecutar("INSERT INTO tiene(id_usuario,id_investigacion,asesor_1,asesor_2,revisor_1,revisor_2,fecha_aceptacion) 
       VALUES($id_usuario,$id_investigacion,'$asesor_1','$asesor_2',null,null,NOW())");
       $this->objetoDato->desconectar();
   }
///////

       //funcion para listar investigaciones
   public function listarInvestigacion(){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT i.status_investigacion AS status,i.folio_investigacion AS folio,i.id_investigacion AS id,i.titulo_investigacion AS inv,i.fecha_investigacion AS fecha 
       FROM perfiles AS p INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario 
INNER JOIN tiene AS t ON u.id_usuario = t.id_usuario INNER JOIN investigaciones AS i 
ON t.id_investigacion = i.id_investigacion WHERE u.nom_usuario LIKE '$this->nom_usuario' AND u.pass_usuario LIKE '$this->pass_usuario' 
ORDER BY i.fecha_investigacion DESC LIMIT 12;");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               $estado = "";
               if($rs[$i]['status'] == "EN REVISION"){
                 $estado = "warning";
               }else if($rs[$i]['status'] == "ACEPTADA"){
                 $estado = "success";
               }
               echo "<tr class='$estado'>";
               echo "<td>".$rs[$i]['folio']."<br><center><b>".$rs[$i]['status']."</b></center></td>";
               echo "<td>".$rs[$i]['inv']."<br><u class='pull-right'>Fecha: ".$rs[$i]['fecha']."</u></td>";
               echo "</tr>";
           }
       }
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
   public function contarInvestigacionAceptada(){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT COUNT(i.folio_investigacion) AS total FROM perfiles AS p INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario 
INNER JOIN tiene AS t ON u.id_usuario = t.id_usuario INNER JOIN investigaciones AS i 
ON t.id_investigacion = i.id_investigacion WHERE i.status_investigacion LIKE 'ACEPTADA' AND u.nom_usuario LIKE '$this->nom_usuario' AND u.pass_usuario LIKE '$this->pass_usuario';");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['total'];
           }
       }
       $this->objetoDato->desconectar();
   }

             //funcion para contar investigaciones en revision
   public function contarInvestigacionRevision(){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT COUNT(i.folio_investigacion) AS total FROM perfiles AS p INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario 
INNER JOIN tiene AS t ON u.id_usuario = t.id_usuario INNER JOIN investigaciones AS i 
ON t.id_investigacion = i.id_investigacion WHERE i.status_investigacion LIKE 'EN REVISION' AND u.nom_usuario LIKE '$this->nom_usuario' AND u.pass_usuario LIKE '$this->pass_usuario';");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['total'];
           }
       }
       $this->objetoDato->desconectar();
   }

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

//funcion para encontrar el id de la investigacion
public function id_investigacion_p($folio_investigacion){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT id_investigacion FROM investigaciones WHERE folio_investigacion LIKE '$folio_investigacion';");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['id_investigacion'];
           }
       }
       $this->objetoDato->desconectar();
   }

//funcion para obtener el id del asesor 1
public function id_asesor_1($id_investigacion){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT asesor_1 FROM tiene WHERE id_investigacion LIKE '$id_investigacion';");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['asesor_1'];
           }
       }
       $this->objetoDato->desconectar();
   }

//funcion para obtener el id del asesor 2
public function id_asesor_2($id_investigacion){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT asesor_2 FROM tiene WHERE id_investigacion LIKE '$id_investigacion';");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['asesor_2'];
           }
       }
       $this->objetoDato->desconectar();
   }

//Funcion para insertar en la tabla intermedia tiene para union
public function insertarInvestigacionTiene_U($id_usuario,$id_investigacion,$asesor_1,$asesor_2){
       $this->objetoDato->conectar(); 
       $this->objetoDato->ejecutar("INSERT INTO tiene(id_usuario,id_investigacion,asesor_1,asesor_2,revisor_1,revisor_2,fecha_aceptacion) 
       VALUES($id_usuario,$id_investigacion,'$asesor_1','$asesor_2',null,null,NOW())");
       $this->objetoDato->desconectar();
   }

      //funcion para buscar los autores de las investigaciones
   public function presentadoInvestigaciones($folio){
$this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT CONCAT(p.ap_perfil,' ',p.am_perfil,',',p.nombre_perfil,'; ') AS autor FROM perfiles AS p INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario 
INNER JOIN tiene AS t ON u.id_usuario = t.id_usuario INNER JOIN investigaciones AS i 
ON t.id_investigacion = i.id_investigacion WHERE i.folio_investigacion LIKE '$folio';
");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
               $cadena = $cadena.$rs[$i]['autor'];
           }
       }
       return $cadena;
$this->objetoDato->desconectar();
   }

   //funcion para verificar si tiene relacion el usuario con la investigacion
public function relacion_inv($id_usuario,$folio_inv){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT COUNT(*) AS existe FROM usuarios AS u INNER JOIN tiene AS t 
ON u.id_usuario = t.id_usuario 
INNER JOIN investigaciones AS i 
ON t.id_investigacion = i.id_investigacion WHERE u.id_usuario = $id_usuario AND i.folio_investigacion LIKE '$folio_inv';");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['existe'];
           }
       }
       $this->objetoDato->desconectar();
   }

   //funcion para verificar el estatus con la investigacion
public function estatus_inv($id_usuario,$folio_inv){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT i.status_investigacion AS estado FROM usuarios AS u INNER JOIN tiene AS t 
ON u.id_usuario = t.id_usuario 
INNER JOIN investigaciones AS i 
ON t.id_investigacion = i.id_investigacion WHERE u.id_usuario = $id_usuario AND i.folio_investigacion LIKE '$folio_inv';");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['estado'];
           }
       }
       $this->objetoDato->desconectar();
   }

   //Funcion para darse de baja en investigacion
public function eliminarInvestigacionTiene_U($id_usuario,$id_investigacion){
       $this->objetoDato->conectar(); 
       $this->objetoDato->ejecutar("DELETE FROM tiene WHERE id_usuario = $id_usuario AND id_investigacion = $id_investigacion");
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

         //funcion para obtener el estatus de la investigacion
public function obtener_estatusinv($folio){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT status_investigacion FROM investigaciones WHERE folio_investigacion LIKE '$folio'");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['status_investigacion'];
           }
       }
       $this->objetoDato->desconectar();
   }

}//Se cierra la clase
?>