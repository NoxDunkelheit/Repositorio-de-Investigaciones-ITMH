<?php 
error_reporting(0);
    $nombre = $_GET["nombre"];
    $correo = $_GET["correo"];
    $asunto = $_GET["asunto"];
    $msg = $_GET["mensaje"];
 
	$para  = 'dark.reyes@live.com'; 
	$titulo = ''.$asunto;
	$mensaje ="".$msg;
	$cabeceras  = "MIME-Version: 1.0\n";;
	$cabeceras .= "Content-type: text/plain; charset=iso-8859-1\n";
	$cabeceras .= "X-Priority: 3\n";
    $cabeceras .= "X-MSMail-Priority: Normal\n";
    $cabeceras .= "X-Mailer: php\n";
	
	$tipocorreos=explode($de,$para);

if ($tipocorreos['1']=='gmail.com'){
	
	// Cabeceras adicionales para gmail
	$cabeceras .= "From: \"".$nombre."\" <".$correo.">\n";
}
else {
    // Cabeceras adicionales para hotmail y demas
    $cabeceras .= "From: \"".$nombre."\" <".$correo.">\n";
}
	
	mail($para, $titulo, $mensaje, $cabeceras);
    echo " 
                <script language='JavaScript'> 
                alert('Tu mensaje se a enviado al administrador.'); 
                window.location = '../index.php';
                </script>";  
?>