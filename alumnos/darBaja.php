<?php  
//PARA INICIAR SESIONES
//error_reporting(0);
session_start();
require_once('cnegocios_alumnos.php');
if(empty($_SESSION)){
  session_destroy();
	header("location: ../index.php");
}else{
    $objetoNegocios = new cnegocios_alumnos( $_SESSION['usuario'],
						$_SESSION['pass']);
}

//DELETE FROM WHERE TIENE
$id_alumno = $objetoNegocios->buscarIdAlumno();
$id_investigacion = $objetoNegocios->id_investigacion_p($_GET['folio']);

$objetoNegocios->eliminarInvestigacionTiene_U($id_alumno,$id_investigacion);

echo "<h4><b>Te distes de baja en esta investigación</b></h4>";
?>