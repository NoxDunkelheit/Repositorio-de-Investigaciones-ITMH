<?php
error_reporting(0);

$archivo = "archivos/".$_GET['inv'].".pdf";
header("location: ".$archivo);
?>