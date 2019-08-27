<?php
    
    //$conn = conectar();
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
    <!-- google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Maven+Pro|Monoton|Paytone+One|Yellowtail&display=swap" rel="stylesheet">
    <title>GRH | Login</title>

    
</head>
<body>
    <div class="hero">
        <div class="contenedor-hero">
            <h1>Generador de Reporte de Honorarios</h1>
        </div>
    </div>
    <div class="contenedor">
        <h3>Inicie sesión</h3>
        <p class="eslogan">Tu mejor manera de cobrar</p>
        <form method="POST">
        <script>
            $(document).ready(function(){
                $('#btnRegistro').click(function(){
                    window.location= 'registro-usuario.php';
                });
            });
        </script>
            <div class="contenedor-campos">
                <div class="campo w-100">
                    <label for="txtUsuario">Usuario: </label>
                    <input type="email" placeholder="ejemplo@mail.com" id="txtUsuario" name="txtUsuario" required>
                </div>
                <div class="campo w-100">
                    <label for="txtPass">Contraseña: </label>
                    <input type="password" id="txtPass" name="txtPass" required>
                </div>
                <div class="contenedor-botones">
                    <div class="guardar">
                        <input type="submit" name="btnEntrar" id="btnEntrar" value="Entrar" class="boton">
                        <!--<a class="boton" href="menu-principal.php">Entrar</a>-->
                    </div>
                    <div class="guardar">
                        <input type="button" name="btnRegistro" id="btnRegistro"  value="Regístrate" class="boton">
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>

<!--onclick="window.location.href='registro-usuario.php'"-->