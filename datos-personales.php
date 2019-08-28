<?php
    header('Content-Type: text/html; charset=utf-8');
    include('recursos\repetitivo.php');
    include('recursos\peticiones.php');
    include('recursos\validaciones.php');
    $usuario = $_SESSION['usuario'];
    validarInicio($usuario);
    $datosPersonales = getDatosPersonales($usuario);
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

    <title>GRH | Datos personales</title>

    <script>
        $(document).ready(function(){
            $("#btnRegresar").click(function(){
                location.href = "menu-principal.php";
            });
            $("#txtNumero").val('<?php echo $datosPersonales['numero'] ?>');
            $("#txtNumeroEmpleado").val('<?php echo $datosPersonales['num_empleado'] ?>');
            $("#txtRfc").val('<?php echo $datosPersonales['rfc'] ?>');
            
        });
    </script>
</head>
<body>
    <div class="hero">
        <div class="contenedor-hero">
            <h1>Datos Personales</h1>
        </div>
    </div>
    <form method="post" onsubmit="javascript:return false;">
        <div class="contenedor">
            <p class="eslogan">Tu mejor manera de cobrar</p>
            <div class="contenedor-campos">
                <p class="importante">
                    Aquí podrás ver tus datos personales y editar algunos, excepto correo y tu nombre como se te notificó en el momento en el que te registraste.
                </p>
                <p>Propietario de la cuenta: <strong><?php echo  $datosPersonales['nombre_user'] ?>.</strong></p>
                <div class="campo">
                    <p>Cuenta ligada al correo: <strong><?php echo $usuario?></strong></p>
                </div>
                <div class="campo">
                    <label for="txtNumero">Numero: </label>
                    <input type="text" id="txtNumero">
                </div>
                <div class="campo">
                    <label for="txtNumeroEmpleado">Numero de empleado: </label>
                    <input type="text" id="txtNumeroEmpleado">
                </div>
                <div class="campo w-100">
                    <label for="txtRfc">RFC: </label>
                    <input type="text" id="txtRfc">
                </div>
                <div class="campo guardar w-100">
                    <input class="boton" id="btnEditar" name="btnEditar" type="submit" value="Editar">
                </div>
                <div class="campo guardar w-100">
                    <input class="boton" id="btnRegresar" name="btnRegresar" type="button" value="Regresar">
                </div>                   
            </div>
        </div>
    </form>

    <?php echo getFooter(); ?>
</body>
</html>