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

//OBTENER ASESORES
$id_alumno = $objetoNegocios->buscarIdAlumno();
$id_investigacion = $objetoNegocios->id_investigacion_p($_GET['folio']);
$id_asesor1 = $objetoNegocios->id_asesor_1($id_investigacion);
$id_asesor2 = $objetoNegocios->id_asesor_2($id_investigacion);

$objetoNegocios->insertarInvestigacionTiene_U($id_alumno,$id_investigacion,$id_asesor1,$id_asesor2);

echo "<h4><b>Te unistes a esta investigación</b></h4>";
?>