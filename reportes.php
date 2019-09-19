<?php

    include('recursos/repetitivo.php');
    include('recursos/validaciones.php');   
    include('recursos/peticiones.php');
    if(isset($_SESSION['usuario'])){
        $usuario = $_SESSION['usuario'];
        validarInicio($usuario);
    }
    else{
        header("Location: index.php");
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GRH | Reportes</title>
    <link rel="stylesheet" href="css\normalize.css">
    <link rel="stylesheet" href="css\estilos.css">

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
    <script>
        $(document).ready(function(){
            $("#btnRegresar").click(function(){
                location.href="menu-principal.php";
            });
            $("a.confirmacion").click(function(){
                var link = $(this).attr('href');
                alertify.confirm('Se requiere confirmación','¿Está seguro? Esto eliminará las actividades que tenga con este empleador.',function(){location.href=link;},function(){alertify.error('Acción cancelada')});
                return false;
            });
        });
    </script>

</head>

<body>
    <div class="hero">
        <div class="contenedor-hero">
            <h1>Reportes</h1>
        </div>
    </div>
    <div class="contenedor">
    <p class="eslogan">Tu mejor manera de cobrar</p>
        <p class="importante">
            Aquí puedes ver aquellos empleadores a los cuales no les has generado un reporte de cobro y el monto por cobrar de dichas actividades              
        </p>
        <form action="" id="formulario" method="post" onsubmit="javascript:return false;">
            <table class="actividades">
                <thead>
                    <th colspan="3">Actividades por cobrar</th>
                </thead>   
                <thead>
                    <th>Empleador</th>
                    <th>Monto</th>
                    <th>Generar reporte</th>
                    <th>Terminar reporte</th>
                </thead>
                <?php echo getReporteXHacer($usuario); ?>
            </table>
            <div class="campo guardar w-100">
                <input class="boton" id="btnRegresar" name="btnRegresar" type="button" value="Menú principal">
            </div>
        </form>
        
    </div>
    
    <?php echo getFooter() ?>
</body>
</html>