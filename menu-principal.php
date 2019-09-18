<?php
    header('Content-Type: text/html; charset=utf-8');
    
    include('recursos/repetitivo.php');
    include('recursos/validaciones.php');
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
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
    <!-- google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Maven+Pro|Monoton|Paytone+One|Yellowtail&display=swap" rel="stylesheet">
    <title>GRH | Menú</title>

    <script>
        $(document).ready(function(){
            $('#btnDatosPersonales').click(function(){
                window.location= 'datos-personales.php';
            });

            $('#btnEmpleadores').click(function(){
                window.location= 'empleadores.php';
            });

            $('#btnReportes').click(function(){
                window.location= 'reportes.php';
            });
            $('#btnActividades').click(function(){
                window.location= 'actividades.php';
            });

            function cerrarSesion(){
                $.ajax({
                    url: "recursos/salir.php",
                    success:function(){
                        alertify.message("Hasta pronto");
                        setTimeout(function(){
                                location.href="index.php";
                            }, 1500);
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
    <form method="post" onsubmit="javascript:return false;">
        <div class="contenedor">
            <p class="eslogan">Tu mejor manera de cobrar</p>
            <div class="importante">
            Ingresa tus datos así como tu cuota por hora y tus jefes o destinatarios para tener una mejor experiencia de usuario.
            
            </div>
            <div class="menu">
                <div class="seccion">
                    <h3>Datos personales</h3>
                    <div class="icono">
                        <button class="menu-boton" id="btnDatosPersonales" name="btnDatosPersonales"><i class="fas fa-user"></i></button>
                    </div>
                </div>
                <div class="seccion">
                    <h3>Empleadores / jefes</h3>
                    <div class="icono">
                        <button class="menu-boton" id="btnEmpleadores"><i class="fas fa-briefcase"></i></button>
                    </div>
                </div>
                <div class="seccion">
                    <h3>Actividades</h3>
                    <div class="icono">
                        <button class="menu-boton" id="btnActividades"><i class="far fa-check-square"></i></button>
                    </div>
                </div>
                <div class="seccion">
                    <h3>Reportes</h3>
                    <div class="icono">
                        <button class="menu-boton" id="btnReportes"><i class="fas fa-cash-register"></i></button>
                    </div>
                </div>
            </div>
            <div class="campo guardar w-100">
                <input type="button" name="btnCerrarSesion" id="btnCerrarSesion"  value="Cerrar sesión" class="boton">
            </div>
        </div>
    </form>

    <?php echo getFooter();?>
</body>
</html>