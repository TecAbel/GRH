<?php
    header('Content-Type: text/html; charset=utf-8');
    include('recursos/repetitivo.php');
    include('recursos/peticiones.php');
    include('recursos/validaciones.php');
    if(isset($_SESSION['usuario'])){
        $usuario = $_SESSION['usuario'];
        validarInicio($usuario);
    }
    else{
        header("Location: index.php");
    }
    
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
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
    <!-- google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Maven+Pro|Monoton|Paytone+One|Yellowtail&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="img\logoSup64px.ico" type="image/x-icon">
    <title>GRH | Datos personales</title>

    <script>
        $(document).ready(function(){
            $("#btnRegresar").click(function(){
                location.href = "menu-principal.php";
            });
            $("#txtNumero").val('<?php echo $datosPersonales['numero'] ?>');
            /*$("#txtNumeroEmpleado").val('<?php echo $datosPersonales['num_empleado'] ?>');*/
            $("#txtRfc").val('<?php echo $datosPersonales['rfc'] ?>');
            
            function validarForm(){
                var validator = $("#formulario").validate({
                    rules:{
                        txtNumero:{
                            required: true,
                            number: true,
                            minlength: 8,
                            maxlength:10
                        },
                        txtRfc:{
                            maxlength: 13,
                            minlength: 13
                        }
                    },
                    messages:{
                        txtNumero:{
                            required: "<i class='fas fa-times error-msg'></i>",
                            number: "Solo números <i class='fas fa-times error-msg'></i>",
                            minlength: "Mínimo 8 dígitos <i class='fas fa-times error-msg'></i>",
                            maxlength: "Máximo 10 dígitos <i class='fas fa-times error-msg'></i>"
                        },
                        txtRfc:{
                            maxlength: "Máximo 13 <i class='fas fa-times error-msg'></i>",
                            minlength: "Mínimo 13 <i class='fas fa-times error-msg'></i>"
                        } 
                    }
                });

                if(validator.form()){
                    alertify.confirm('Se require confirmación','¿Está seguro de realizar estos cambios?',
                    function(){
                        $.ajax({
                            url: "recursos/config-datos-personales.php",
                            type:"post",
                            data:$('#formulario').serialize(),
                            success: function(d){
                                if(d== true){
                                    alertify.message("Trabajando...");
                                    setTimeout(function(){
                                        location.reload();
                                    }, 1500);
                                }
                                else{
                                    alertify.error(d);
                                }
                            }
                        });
                    },
                    function(){
                        alertify.error("Acción cancelada");
                    });
                }
            }

            $("#btnEditar").click(function(){
                validarForm();
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
            <h1 id="titulo">Datos Personales</h1>
        </div>
    </div>
    <?php echo getHeader() ?>
    <form method="post" id="formulario" onsubmit="javascript:return false;">
        <div class="contenedor">
            <p class="eslogan">Tu mejor manera de cobrar</p>
            <div class="contenedor-campos">
                <p class="importante">
                    Aquí podrás ver tus datos personales y editar algunos, excepto correo y tu nombre como se te notificó en el momento en el que te registraste.
                </p>
                <p>Propietario: <strong><?php echo  $datosPersonales['nombre_user'] ?></strong>.</p>
                <p>Correo: <strong><?php echo $usuario?></strong></p>
                <br>
                <div class="campo">
                    <label for="txtNumero">Teléfono: </label>
                    <input class="obligatorio" type="text" id="txtNumero" name="txtNumero" pattern="[0-9]{10}">
                </div>
                <!--<div class="campo">
                    <label for="txtNumeroEmpleado">Número de empleado: </label>
                    <input type="text" id="txtNumeroEmpleado" name="txtNumeroEmpleado">
                </div>-->
                <div class="campo ">
                    <label for="txtRfc">RFC: </label>
                    <input type="text" id="txtRfc" style="text-transform:uppercase;" name="txtRfc">
                </div>
                <p class="importante">
                    Los campos de <span class="nota-amarilla"><strong>línea amarilla</span> son obligatorios.</strong> 
                </p>
                <div class="campo guardar w-100">
                    <input class="boton" id="btnEditar" name="btnEditar" type="submit" value="Editar">
                </div>
                <div class="campo guardar w-100">
                    <input class="boton" id="btnRegresar" name="btnRegresar" type="button" value="Menú principal">
                </div>                   
            </div>
        </div>
    </form>

    <?php echo getFooter(); ?>
    <script src="recursos/nav.js"></script>
</body>
</html>