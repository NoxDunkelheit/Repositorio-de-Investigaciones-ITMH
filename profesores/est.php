<?php 
//PARA INICIAR SESIONES
error_reporting(0);
session_start();
require_once('cnegocios_profesores.php');
if(empty($_SESSION)){
  session_destroy();
	header("location: ../index.php");
}else{
    $objetoNegocios = new cnegocios_profesores( $_SESSION['usuario'],
						$_SESSION['pass']);
    
$id_profesor = $objetoNegocios->buscarIdProfesor();
$folio = $_GET['folio'];
}

$id_investigacion = $objetoNegocios->obtenerIdInvestigacion($folio);
$revisor_1 = $_GET['revisor_1'];
$revisor_2 = $_GET['revisor_2'];

if($revisor_1 == "" || $revisor_2 == "" ){
echo "SELECCIONA A LOS REVISORES DE LA INVESTIGACIÓN";
}else if($revisor_1 == $revisor_2){
echo "SELECCIONA DIFERENTES REVISORES";
}else{

//ACTUALIZAR INVESTIGACION EN EL ESTATUS
$objetoNegocios->actualizarStatusInvestigacion($_GET['est'],$folio);

//ACTUALIZAR TIENE AGREGAMOS A LOS REVISORES
$objetoNegocios->actualizarRevisoresInvestigacion($id_investigacion,$revisor_1,$revisor_2);

echo "LA INVESTIGACIÓN SE ENCUENTRA ACTUALMENTE <b>".$objetoNegocios->buscarStatusInvestigacion($folio)."</b>";

}
 ?>