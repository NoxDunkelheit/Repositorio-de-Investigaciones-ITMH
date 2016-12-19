<?php   
include_once ("../conf/cnegocios_registros_alumnos.php");

$nom_usuario = $_POST["nom_usuario"];
$pass_usuario = $_POST["pass_usuario"];
$tipo_usuario = "ALUMNO";
$status_usuario = "EN PROCESO"; 

//echo "".$nom_usuario." - ".$pass_usuario." - ".$tipo_usuario;
      $objetoNegocios = new cnegocios_registros_alumnos( $nom_usuario,
						$pass_usuario,$tipo_usuario,$status_usuario);

//VERIFICAR SI EL USUARIO EXISTE
$existe = $objetoNegocios->existeUsuario();

if($existe != 0){
   echo "<h4>Intenta con otro nombre de usuario,<br>al parecer ya existe un usuario<br>con el mismo nombre.<h4>";
}else{
      
   echo "<h4>Cuenta creada con exito!<h4>";
   //INSERTA NUEVO ALUMNO
$existe = $objetoNegocios->insertar_NuevoAlumno();
}

?>
</script>