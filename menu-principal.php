<?php
    header('Content-Type: text/html; charset=utf-8');
    
    include('recursos\validaciones.php');
    $usuario = $_SESSION['usuario'];
    validarInicio($usuario);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

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
    <title>GRH | Menú</title>

    <script>
        $(document).ready(function(){
            function cerrarSesion(){
                $.ajax({
                    url: "recursos/salir.php",
                    success:function(){
                        alertify.success("Hasta pronto");
                        setTimeout(function(){
                                location.href="index.php";
                            }, 2300);
                    }
                });
            }

            $("#btnCerrarSesion").click(function(){
                cerrarSesion();
            });

        });
    </script>

</head>
<body>
    <div class="hero">
        <div class="contenedor-hero">
            <h1>Menú principal</h1>
        </div>
    </div>
    <div class="contenedor">
        <div class="importante">
           Ingresa tus datos así como tu cuota por hora y tus jefes o destinatarios para tener una mejor experiencia de usuario.
           <br> <br>
           Tu mejor manera de cobrar
        </div>
        <div class="menu">
            <div class="seccion">
                <h3>Datos personales</h3>
                <div class="icono">
                    <i class="fas fa-user"></i>
                </div>
            </div>
            <div class="seccion">
                <h3>Destinatarios / Jefes</h3>
                <div class="icono">
                    <i class="fas fa-briefcase"></i>
                </div>
            </div>
            <div class="seccion">
                <h3>Reportes</h3>
                <div class="icono">
                    <i class="fas fa-cash-register"></i>
                </div>
            </div>
        </div>
        <div class="guardar">
            <input type="button" name="btnCerrarSesion" id="btnCerrarSesion"  value="Cerrar sesión" class="boton">
        </div>
    </div>
</body>
</html>