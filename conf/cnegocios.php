<?php
include_once ("cdatos.php");

 class cnegocios {
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
     
   //funcion para encontrar la existencia de la cuenta
   public function existeCuenta(){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT COUNT(*) AS existe FROM usuarios WHERE nom_usuario LIKE '$this->nom_usuario' AND pass_usuario LIKE '$this->pass_usuario';");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['existe'];
           }
       }
       $this->objetoDato->desconectar();
   }

      //funcion para encontrar encontrar el id del usuario
   public function buscarId(){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT id_usuario FROM usuarios WHERE nom_usuario LIKE '$this->nom_usuario' AND pass_usuario LIKE '$this->pass_usuario';");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['id_usuario'];
           }
       }
       $this->objetoDato->desconectar();
   }

         //funcion para encontrar encontrar el tipo de usuario
   public function buscarTipoUsuario(){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT tipo_usuario FROM usuarios WHERE nom_usuario LIKE '$this->nom_usuario' AND pass_usuario LIKE '$this->pass_usuario';");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['tipo_usuario'];
           }
       }
       $this->objetoDato->desconectar();
   }

            //funcion para encontrar encontrar el status del usuario
   public function statusUsuario(){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT status_usuario FROM usuarios WHERE nom_usuario LIKE '$this->nom_usuario' AND pass_usuario LIKE '$this->pass_usuario';");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['status_usuario'];
           }
       }
       $this->objetoDato->desconectar();
   }

   public function insertar_docempleado($id_nempleado,$antecedentes,$acta,$cartilla,$comprobante,$ife,$imss,$c_curp,$num_fotos,$recomendacion){
       $this->objetoDato->conectar();
       $this->objetoDato->ejecutar("INSERT INTO documentos_empleado(id_empleado,
       carta_antecedentes,acta_nacimiento,cartilla_militar,comprobante_domicilio,
       copia_ife,copia_imss,copia_curp,foto_tam_infantil,carta_recomendacion) VALUES($id_nempleado,'$antecedentes','$acta','$cartilla','$comprobante','$ife','$imss','$c_curp',$num_fotos,$recomendacion);");
       $this->objetoDato->desconectar();
   }

//funcion para listar investigaciones
   public function listarInvestigaciones(){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT DISTINCT i.folio_investigacion AS folio,i.id_investigacion AS id,i.titulo_investigacion AS inv FROM perfiles AS p INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario 
INNER JOIN tiene AS t ON u.id_usuario = t.id_usuario INNER JOIN investigaciones AS i 
ON t.id_investigacion = i.id_investigacion WHERE i.status_investigacion LIKE 'ACEPTADA' ORDER BY i.fecha_investigacion DESC LIMIT 6;");
       if(count($rs)){
           echo "<div class='row'>";
           for($i=0; $i<count($rs); $i++){
               $folio = $rs[$i]['folio'];
               $integrantes = $this->presentadoInvestigaciones($folio);
               $aceptacion = $this->fechaAceptacionInvestigacion($folio);
               echo "<a id='inves' href='visor.php?inv=".$folio."' target='_blank' ><div class='col-md-12'>";

               echo "<div class='col-md-2'>";
                    echo "<p id='folio'>".$rs[$i]['folio']."</p>";
                    echo "<center><img id='icono-inv' src='img/elementos/icono_investigacion.png' class='img-responsive img-circle' alt='Investigacion'><center>";
               echo "</div>";

               echo "<div class='col-md-6'>";
                    echo "<br><b>".$rs[$i]['inv']."</b><br>PRESENTADO POR <b>".$integrantes."</b><br>";
               echo "</div>";

               echo "<div class='col-md-4'>";
                    echo "<br>FECHA: <b>".$aceptacion."</b></a>";
                    ?>
                    <a href="Javascript: cargar_var('#contenedor','info_investigacion.php','<?php echo $folio; ?>');"><button class='btn btn-info btn-block btn-lg'>Información</button></a><hr>
                    <?php
               echo "</div>";

               echo "</div></a>";
           }
           echo "</div><hr>";
       }
       $this->objetoDato->desconectar();
   }

   //funcion para buscar los autores de las investigaciones
   public function presentadoInvestigaciones($folio){
$this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT CONCAT(p.ap_perfil,' ',p.am_perfil,',',p.nombre_perfil,'; ') AS autor FROM perfiles AS p INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario 
INNER JOIN tiene AS t ON u.id_usuario = t.id_usuario INNER JOIN investigaciones AS i 
ON t.id_investigacion = i.id_investigacion WHERE i.status_investigacion LIKE 'ACEPTADA' AND i.folio_investigacion LIKE '$folio';
");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
               $cadena = $cadena.$rs[$i]['autor'];
           }
       }
       return $cadena;
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
       $rs=$this->objetoDato->ejecutar("SELECT DISTINCT CONCAT(p.ap_perfil,' ',p.am_perfil,',',p.nombre_perfil) AS autor FROM perfiles AS p INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario 
INNER JOIN tiene AS t ON u.id_usuario = t.revisor_1 INNER JOIN investigaciones AS i 
ON t.id_investigacion = i.id_investigacion WHERE i.folio_investigacion LIKE '$folio';");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               echo "> ".$rs[$i]['autor']."<br>";
           }
       }
       $this->objetoDato->desconectar();
   }

      //funcion para encontrar los revisor2 de la investigacion
public function revisor2_inv($folio){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT DISTINCT CONCAT(p.ap_perfil,' ',p.am_perfil,',',p.nombre_perfil) AS autor FROM perfiles AS p INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario 
INNER JOIN tiene AS t ON u.id_usuario = t.revisor_2 INNER JOIN investigaciones AS i 
ON t.id_investigacion = i.id_investigacion WHERE i.folio_investigacion LIKE '$folio';");
       if(count($rs)){ 
           for($i=0; $i<count($rs); $i++){
               echo "> ".$rs[$i]['autor']."<br>";
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

      //funcion para obtener la fecha de aceptacion
   public function fechaAceptacionInvestigacion($folio){
       $this->objetoDato->conectar();
       $rs=$this->objetoDato->ejecutar("SELECT t.fecha_aceptacion AS aceptacion FROM perfiles AS p INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario 
INNER JOIN tiene AS t ON u.id_usuario = t.id_usuario INNER JOIN investigaciones AS i 
ON t.id_investigacion = i.id_investigacion WHERE i.folio_investigacion LIKE '$folio' 
ORDER BY aceptacion DESC LIMIT 1;");
       if(count($rs)){
           for($i=0; $i<count($rs); $i++){
               return $rs[$i]['aceptacion'];
           }
       }
       $this->objetoDato->desconectar();
   }



}//Se cierra la clase
?>