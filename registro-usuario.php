<?php
    header('Content-type: text/html; charset=UTF-8'); 
    include("recursos/repetitivo.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css?family=Maven+Pro|Monoton|Paytone+One|Yellowtail&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

     <!-- JavaScript -->
     <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/alertify.min.js"></script>

    <!-- CSS alertify -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/css/themes/default.min.css"/>
    <!--ajax-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
    <!-- google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Maven+Pro|Monoton|Paytone+One|Yellowtail&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="img\logoSup64px.ico" type="image/x-icon">
    <title>GRH | Registro de usuario</title>
    <script>
        $(document).ready(function(){
            function login(){
                window.locationf='index.php';
            }
            function validarForm(){
                var validator = $("#formulario").validate({
                    rules:{
                        txtCorreo: {
                            required: true,
                            email: true
                        },
                        txtCorreo1:{
                            required:true,
                            email: true,
                            equalTo: "#txtCorreo"
                        },
                        txtNombre: {
                            required: true
                        },
                        txtTelefono: {
                            required: true,
                            number: true,
                            minlength: 8,
                            maxlength:10
                        },
                        txtPass: {
                            required: true
                        },
                        txtPass1:{
                            required: true,
                            equalTo: "#txtPass"
                        }
                    },
                    messages:{
                        txtCorreo:{
                            required: "<i class='fas fa-times error-msg'></i>",
                            email: "Ingrese un correo <i class='fas fa-times error-msg'></i>"
                        },
                        txtCorreo1:{
                            required: "<i class='fas fa-times error-msg'></i",
                            email: "Ingrese un correo <i class='fas fa-times error-msg'></i>",
                            equalTo: "El correo no coincide <i class='fas fa-times error-msg'></i>"
                        },
                        txtNombre:{
                            required: "<i class='fas fa-times error-msg'></i>"
                        },
                        txtTelefono:{
                            required: "<i class='fas fa-times error-msg'></i>",
                            number: "Solo números <i class='fas fa-times error-msg'></i>",
                            minlength: "Mínimo 8 dígitos <i class='fas fa-times error-msg'></i>",
                            maxlength: "Máximo 10 dígitos <i class='fas fa-times error-msg'></i>"                  
                        },
                        txtPass:{
                            required: "<i class='fas fa-times error-msg'></i>"
                        },
                        txtPass1:{
                            required: "<i class='fas fa-times error-msg'></i>",
                            equalTo: "Las contraseñas no coinciden <i class='fas fa-times error-msg'></i>"
                        }
                    }
                });

                if(validator.form()){
                    alertify.confirm('Atención', 'Una vez realice este registro no podrá editar ni cambiar su nombre ligado a esta cuenta pues este será constante para no tener problemas con sus reportes de cobro. ¿La información es correcta?',
                    function(){
                        $.ajax({
                            url:"recursos/nuevo_usuario.php",
                            type: "post",
                            data: $("#formulario").serialize(),
                            success:function(d){
                                /*alertify.success(d);*/
                                if(d=="Este correo ya ha sido registrado"){
                                    alertify.error(d);
                                }else{
                                    
                                    alertify.success(d);
                                    setTimeout(function(){
                                        location.href="index.php";
                                    }, 3000);
                                }
                                
                            }
                        });
                    },
                    function(){ 
                            alertify.error('Cancelado')}
                        );
                }
            }
            
            $("#btnGuardar").click(function(){
                validarForm();
                
            });    
            $("#btnRegresar").click(function(){
                window.location = "index.php";
            });
        });
    </script>
    <script>
        var pase = document.getElementById("txtPass"), pase1 = document.getElementById("txtPass1");
        function validatePass(){
            if(pase.value != pase1.value){
                pase1.setCustomValidity("¡Contraseñas no coinciden!");
            }
        }
    </script>
</head>
<body>
    <div class="hero">
        <div class="contenedor-hero">
            <h1>Bienvenido a GRH <small>&copy</small></h1>
        </div>
    </div>
    <div class="contenedor">
        <h3>Registro de nuevo usuario</h3>
        <p class="eslogan">Tu mejor manera de cobrar</p>
        <form method="post" id="formulario" onsubmit="javascript:return false;">
            <div class="contenedor-campos">
                <div class="campo">
                    <label for="txtCorreo">Correo: </label>
                    <input type="text" placeholder="ejemplo@dominio.com" id="txtCorreo" name="txtCorreo">
                </div>
                <div class="campo">
                    <label for="txtCorreo1">Confirma correo: </label>
                    <input type="text" placeholder="ejemplo@dominio.com" id="txtCorreo1" name="txtCorreo1" >
                </div>
                <div class="campo">
                    <label for="txtNombre">Nombre: </label>
                    <input type="text" id="txtNombre" placeholder="Paterno - Materno - Nombres" name="txtNombre">
                </div>
                <div class="campo">
                    <label for="txtTelefono">Teléfono: </label>
                    <input type="tel" placeholder="10 dígitos" id="txtTelefono" name="txtTelefono" maxlength="10">
                </div>
                
                <div class="campo">
                    <label for="txtPass">Contraseña: </label>
                    <input type="password" id="txtPass" name="txtPass">
                </div>
                <div class="campo">
                    <label for="txtPass1">Confirme contraseña: </label>
                    <input type="password" id="txtPass1" name="txtPass1">
                </div>
                <div class="importante">
                    <p>Tu información será usada únicamente con el objetivo principal de GRH &copy, el cual es ayudarte a generar tus reportes de cobro.</p>
                </div>
               
                <div class="campo guardar w-100">
                    <input type="submit" name="btnGuardar" id="btnGuardar"  value="Registrarme" class="boton">
                    <!--<a class="boton"  href="menu-principal.php">Guardar</a>-->
                </div>
                <div class="campo guardar w-100">
                    <input type="button" name="btnRegresar" id="btnRegresar" value="Regresar" class="boton">
                    <!--<a class="boton" href="index.php">Regresar</a>-->
                </div>
                
            </div>
        </form>

    </div>
    <?php echo getFooter() ?>
</body>
</html>