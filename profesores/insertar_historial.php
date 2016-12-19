<?php
session_start();
include_once ("cnegocios_profesores.php");

$_SESSION['lat'] = $_GET['lat'];
$_SESSION['long'] = $_GET['long'];

$lat = $_GET['lat'];
$long = $_GET['long'];


if(!empty($_SESSION)){
      $objetoNegocios = new cnegocios_profesores( $_SESSION['usuario'],
						$_SESSION['pass']);

						$objetoNegocios->insertar_Historial_SesionProfesor($lat,$long);
                        header('location:index.php');
						/*echo "Bandera de existencia: ".$flag;
						echo "<br>ID: ".$id;
						echo "<br>TIPO DE USUARIO: ".$tipo;
						echo "<br>ESTATUS DEL USUARIO: ".$status;*/
}
?>