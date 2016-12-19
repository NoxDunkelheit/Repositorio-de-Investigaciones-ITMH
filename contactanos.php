    <head>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body>
<div class="row">
    <h1>&nbsp;CONTACTANOS!</h1>
    <form action="conf/validacion-email.php" method="post">
        <div class="col-md-4">
        Nombre:
        <input name="nombre" type="text" class="form-control" REQUIRED>
        Correo:
        <input name="correo" type="email" class="form-control" REQUIRED>
        </div>
        <div class="col-md-8">
        Asunto:
        <input name="asunto" type="text" class="form-control" REQUIRED>
        Mensaje:
        <textarea name="mensaje" class="form-control" rows="10" REQUIRED></textarea>
        <div class="g-recaptcha" data-sitekey="6LdamAsUAAAAAPsvC-NgpVC2FUwYEsbHVLrZLKHg"></div>
        <input class="btn btn-primary" type="submit" value="Enviar Mensaje" name="guardar">
        </div> 
        </form>
   </div><br>
   </body>
<!--
   <script>
   function validar(){
       var inp_nombre=document.getElementsByName("nombre")[0].value;
       var inp_correo=document.getElementsByName("correo")[0].value;
       var inp_asunto=document.getElementsByName("asunto")[0].value;
       var inp_mensaje=document.getElementsByName("mensaje")[0].value;
       var inp_codigo=document.getElementsByName("codigo")[0].value;
       var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

       if(inp_nombre == ""){
                 alert("CAMPO DE NOMBRE OBLIGATORIO");
                 document.getElementsByName("nombre")[0].focus();
       }else if(inp_correo == ""){
                 alert("CAMPO DE CORREO OBLIGATORIO");
                 document.getElementsByName("correo")[0].focus();
       }else if(!expr.test(inp_correo)){
                 alert("ERROR: EN LA DIRECCIÓN DE CORREO");
                 document.getElementsByName("correo")[0].focus();
       }else if(inp_asunto == ""){
                 alert("CAMPO DE ASUNTO OBLIGATORIO");
                 document.getElementsByName("asunto")[0].focus();
       }else if(inp_mensaje == ""){
                 alert("CAMPO DE MENSAJE OBLIGATORIO");
                 document.getElementsByName("mensaje")[0].focus();
       }else if(inp_codigo == ""){
                 alert("ESCRIBA EL CODIGO DE SEGURIDAD");
                 document.getElementsByName("codigo")[0].focus();
       }else if(inp_codigo != ""){
                 document.getElementsByName("codigo")[0].focus();

       }
   }
   </script>
   -->