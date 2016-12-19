<?php 
//PARA INICIAR SESIONES
error_reporting(0);
session_start();
require_once('cnegocios_alumnos.php');
if(empty($_SESSION)){
  session_destroy();
	header("location: ../index.php");
}else{
    $objetoNegocios = new cnegocios_alumnos( $_SESSION['usuario'],
						$_SESSION['pass']);
	
	$id_alumno = $objetoNegocios->buscarIdAlumno();
}

// A list of permitted file extensions
$allowed = array('pdf');
$nombre = $_POST['nombre'];
$tipo_inv = $_POST['tipo_inv'];
$asesor_1 = $_POST['asesor_1'];
$asesor_2 = $_POST['asesor_2'];

if($asesor_1 == $asesor_2){
    echo '<script>alert("Escoge diferentes asesores");
	              window.history.back();</script>';
}else{

if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

	$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

	if(!in_array(strtolower($extension), $allowed)){
		echo '{"status":"error"}';
		exit;
	}

//obtener el folio
		 $folio = $objetoNegocios->crear_folio();

	if(move_uploaded_file($_FILES['upl']['tmp_name'], '../archivos/'.$folio.".pdf")){
		//echo '{"status":"success"}';
		
		//INSERTAMOS EN LA TABLA DE INVESTIGACIONES
		$objetoNegocios->insertarInvestigacion($tipo_inv,$nombre); 

		 //INSERTAMOS EN LA TABLA INTERMEDIA TIENE
		$objetoNegocios->insertarInvestigacionTiene($id_alumno,$asesor_1,$asesor_2);
		
		header("location: index.php");
	}
}else{
echo '{"status":"error"}';
exit;
}

}
?> 