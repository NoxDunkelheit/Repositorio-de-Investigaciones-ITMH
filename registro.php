<body>
<div class="row">
    <form>
        <div id="mensajes" class="col-md-4"></div>
        <div class="col-md-4">
        <center><h1>REGISTRATE!</h1></center>
        <hr>
        <input type="text" name="nom_usuario" class="form-control" placeholder=" NOMBRE DE USUARIO" REQUIRED><br>
        <input type="password" name="pass_usuario" class="form-control" placeholder=" ESCRIBA UNA CONTRASEÑA" REQUIRED><br>
        <input type="password" name="rpass_usuario" class="form-control" placeholder=" REPITA LA CONTRASEÑA" REQUIRED><br>
        <input type="password" name="permiso_pass" class="form-control" placeholder=" ESCRIBA LA CONTRASEÑA ESPECIAL" REQUIRED><br>
        <input type="button" onclick="Javascript: verificar()" class="btn btn-success btn-block" value="REGISTRARSE">
        </div> 
        <div class="col-md-4"></div>
    </form>
   </div><br>

   <script> 
   function verificar(){
       var nom_usuario=document.getElementsByName("nom_usuario")[0].value;
       var pass=document.getElementsByName("pass_usuario")[0].value;
       var rpass=document.getElementsByName("rpass_usuario")[0].value;
       var epass=document.getElementsByName("permiso_pass")[0].value;

if(nom_usuario != "" && pass != "" && rpass != "" && epass != ""){
    /*PASSWORD ESPECIAL PARA QUE NO CUALQUIERA PUEDA REGISTRARSE, CAMBIAR LA PALABRA SECRETA*/
    if(epass == "TECNOLOGICOMATEHUALA"){
       if(pass == rpass){
           recibe(nom_usuario,pass);
        //window.location="reg/registrar_alumno.php?nom_usuario="+nom_usuario+"&pass_usuario="+pass;
       }else{
         alert("No te coinciden");
       document.getElementsByName("pass_usuario")[0].value = "";
       document.getElementsByName("rpass_usuario")[0].value = "";
       }
    }else{
        alert("?");
        window.location = 'index.php';
    }
   }else{
         alert("No dejes los campos vacios");
   }
   
   }

   </script>


   <script>
	var xmlhttp;
function load(str, url, cfunc)
{

if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
	xmlhttp.onreadystatechange=cfunc;
	xmlhttp.open("POST",url,true); // AQUÍ LE DECIMOS QUE VAMOS A ENVIAR LOS DATOS POR POST
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(str);
}

function metodoAjax(datos, ruta) //METODO AJAX QUE RECIBE 2 PARAMETROS, LOS DATOS A ENVIAR Y EL ARCHIVO QUE LOS RECIBE
{
 load(datos, ruta, function()
 { 
   if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	document.getElementById("mensajes").innerHTML=xmlhttp.responseText; //MOSTRAMOS LOS DATOS EN EL DIV CON ID CUERPO
    }
 });
}
//------------------------------------------------------------------
function recibe(nom_usuario,pass_usuario){		//FUNCION QUE SE EJECUTA CUANDO PRESIONAMOS EL BOTON ENVIAR
		//var dato = document.getElementById('datos').value;//OBTENEMOS LOS DATOS DEL CAMPO DE TEXTO
		metodoAjax("nom_usuario="+nom_usuario+"&pass_usuario="+pass_usuario,"reg/registrar_alumno.php"); //EJECUTAMOS EL METODO AJAX Y LE PSASMOS LOS DATOS, Y LE DECIMOS QUE ARCHIVO ES EL QUE RECIBE LOS DATOS		
	}
</script>