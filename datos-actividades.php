<?php
    header('Content-Type: text/html; charset=utf-8');
    include('recursos/repetitivo.php');
    include('recursos/peticiones.php');
    include('recursos/validaciones.php');
    include('recursos/SED.php');
    if(isset($_SESSION['usuario'])){
        $usuario = $_SESSION['usuario'];
        validarInicio($usuario);
    }
    else{
        header("Location: index.php");
    }
    
    $actividadE = $_GET['RXQ'];
    $actividad = SED::decryption($actividadE);
    $actividadRegistrada = getDatosActividades($usuario,$actividad);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GRH | Actividades Registradas</title>
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
                location.href = "actividades.php";
            });
            $("#txtEmpleador").val('<?php echo $actividadRegistrada['nombre_emp'] ?>');
            $("#txtHoras").val('<?php echo $actividadRegistrada['horas_tra'] ?>');
            $("#txtActividad").val('<?php echo $actividadRegistrada['nombre_act'] ?>');
            $("#txtTransporte").val('<?php echo $actividadRegistrada['transporte'] ?>');
            $("#txtActDetalle").val('<?php echo $actividadRegistrada['descripcion'] ?>');

            $("#btnEliminar").click(function(){
                alertify.confirm('Se requiere confirmación','¿Está seguro de querer eliminar esta actividad?',
                function(){
                    $.ajax({
                        url: "recursos/config-actividades.php?CDE= <?php echo $actividad ?>",
                        type: "post",
                        data: $("#formulario").serialize(),
                        success: function(d){
                            if(d==true){
                                alertify.message('Eliminando actividad...');
                                setTimeout(function(){
                                    location.href = "actividades.php";
                                }, 1000);
                            }else{
                                alertify.error(d);
                            }
                        }
                    });
                },
                function(){
                    alertify.error('Acción cancelada')
                } );
            });
        });
    </script>
</head>
<body>
    <div class="hero">
    <div class="contenedor-hero">
            <h1 id="titulo" class="">Actividades registradas</h1>
        </div>
    </div>
    <div class="contenedor">
    <form action="" id="formulario" method="post" onsubmit="javascript:return false;">
        <p class="eslogan">Tu mejor manera de cobrar</p>
        <div class="contenedor-campos">
            
                <p class="importante">
                    Aquí podrás avisualizar y/o eliminar los datos que ingresaste de tus actividades realizadas <strong>si es que aún no has realizado tu corte</strong>.
                </p>
                <div class="campo w-100">
                <p>
                    <h3>Fecha : <?php echo $actividadRegistrada['fecha'] ?></h3>
                </p>
                </div>
                <div class="campo">
                    <label for="txtEmpleador">Empleador: </label>
                    <input type="text" readonly id="txtEmpleador">
                </div>
                <div class="campo">
                    <label for="txtHoras">Horas trabajadas: </label>
                    <input  type="text" id="txtHoras" name="txtHoras" readonly>
                </div>
                <div class="campo">
                    <label for="txtActividad">Actividad: </label>
                    <input readonly  type="text" name="txtActividad"  id="txtActividad">                    
                </div>
                
                <div class="campo">
                    <label for="txtTransporte">Transporte: $</label>
                    <input readonly type="number" step="00.01" min="1" id="txtTransporte" name="txtTransporte">
                </div>
                <div class="campo w-100">
                    <label for="txtActDetalle">Detalle: </label>
                    <textarea readonly name="txtActDetalle" id="txtActDetalle" cols="30" rows="10"></textarea>
                </div>
                <div class="campo guardar w-100">
                    <input class="boton eliminar" id="btnEliminar" name="btnEliminar" type="submit" value="Eliminar">
                </div>
                <div class="campo guardar w-100">
                    <input class="boton" id="btnRegresar" name="btnRegresar" type="submit" value="Regresar">
                </div>
            
        </div>
        </form>
    </div>
    <?php echo getFooter(); ?>
</body>
</html>