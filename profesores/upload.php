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
}

// A list of permitted file extensions
$allowed = array('pdf');
$nombre = $_POST['nombre'];

if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

	$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

	if(!in_array(strtolower($extension), $allowed)){
		echo '{"status":"error"}';
		exit;
	}

	if(move_uploaded_file($_FILES['upl']['tmp_name'], '../archivos/'.$nombre.".pdf")){
		echo '{"status":"success"}';
		//INSERTAMOS EN LA TABLA DE INVESTIGACIONES
		 $objetoNegocios->insertarInvestigacionProfesor($nombre);

		 //INSERTAMOS EN LA TABLA INTERMEDIA TIENE
		 $objetoNegocios->insertarInvestigacionProfesorTiene($id_profesor);
		header("location: index.php");
	}
}else{
echo '{"status":"error"}';
exit;
}
?> 