<?php
    include('recursos\repetitivo.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/estilos.css">
    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/alertify.min.js"></script>

    <!-- CSS alertify -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/css/themes/default.min.css"/>
    <!--ajax-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
    <!-- google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Maven+Pro|Monoton|Paytone+One|Yellowtail&display=swap" rel="stylesheet">


    <title>GRH | Login</title>

    <script>
        $(document).ready(function(){
            $('#btnRegistro').click(function(){
                window.location= 'registro-usuario.php';
            });
            function validarForm(){
                var validator = $("#formulario").validate({
                    rules:{
                        txtUsuario:{
                            required: true,
                            email:true
                        },
                        txtPass:{
                            required: true
                        }
                    },
                    messages:{
                        txtUsuario:{
                            required: "<i class='fas fa-times error-msg'></i>",
                            email:"Ingrese un correo electrónico <i class='fas fa-times error-msg'></i>"
                        },
                        txtPass:{
                            required: "<i class='fas fa-times error-msg'></i>"
                        }
                    }
                });
                if(validator.form()){
                    $.ajax({
                        url: "recursos/ingreso.php",
                        type: "post",
                        data: $("#formulario").serialize(),
                        success: function(d){
                            if(d==false){
                                    alertify.error("Correo y contraseña incorrectos");
                                }else{
                                    
                                    alertify.message(d);
                                    setTimeout(function(){
                                        location.href="menu-principal.php";
                                    }, 1500);
                                }
                        }
                    });
                }
            }

            $("#btnEntrar").click(function(){
                validarForm();
            });
        });
    </script>
    
</head>
<body>
    <div class="hero-index">
        <div class="contenedor-hero">
            <h1>Generador de Reporte de Honorarios</h1>
        </div>
    </div>
    <div class="contenedor">
        <h3>Inicie sesión</h3>
        <p class="eslogan">Tu mejor manera de cobrar</p>
        <form method="post" id="formulario" onsubmit="javascript:return false;">
        
            <div class="contenedor-campos">
                <div class="campo w-100 animado">
                    
                    <input type="email" placeholder="Correo" id="txtUsuario" name="txtUsuario" >
                </div>
                <div class="campo w-100 animado">
                    <!--<label for="txtPass">Contraseña: </label>-->
                    <input type="password" id="txtPass" placeholder="Contraseña" name="txtPass">
                    
                </div>
                
                <div class="campo guardar w-100">
                    <input type="submit" name="btnEntrar" id="btnEntrar" value="Entrar" class="boton">
                    <!--<a class="boton" href="menu-principal.php">Entrar</a>-->
                </div>
                <div class="campo w-100">
                    <!--<input type="button" name="btnRegistro" id="btnRegistro"  value="Regístrate" class="boton">-->
                    <p>¿Aún no tienes una cuenta? <a href="registro-usuario.php"  rel="noopener noreferrer">Regístrate</a></p>
                </div>
                
            </div>
        </form>
    </div>
    <?php echo getFooter(); ?>
</body>
</html>

<!--onclick="window.location.href='registro-usuario.php'"-->