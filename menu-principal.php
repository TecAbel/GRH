<?php
    header('Content-Type: text/html; charset=utf-8');
    include('recursos\conexion.php');
    include('recursos\validaciones.php');
    
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
    <title>GRH | Menú</title>
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
    </div>
</body>
</html>