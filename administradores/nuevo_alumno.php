<?php 
//PARA INICIAR SESIONES
error_reporting(0);
session_start();
require_once('cnegocios_administradores.php');
if(empty($_SESSION)){
  session_destroy();
	header("location: ../index.php");
}else{
    $objetoNegocios = new cnegocios_administradores( $_SESSION['usuario'],
						$_SESSION['pass']);
 
            $tipo_usuario = $objetoNegocios->tipo_usuario();
//PREGUNTA POR EL ROL DEL USUARIO
            if($tipo_usuario != "ADMINISTRADOR"){
                 session_destroy();
                 header("location: ../index.php");   
            }

            $id_administrador = $objetoNegocios->buscarIdAdministrador();
}
 ?>
<h1>?</h1>