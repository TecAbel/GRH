<?php
    include('recursos\repetitivo.php');
    include('recursos\validaciones.php');   
    include('recursos\peticiones.php');
    $usuario = $_SESSION['usuario'];
    
    validarInicio($usuario);
    $numU_array = getUserid($usuario);
    $numU = $numU_array['num_usuario'];
    $actividadesReg = completarActividad($numU);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GRH | Actividades</title>
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
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
    <!-- google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Maven+Pro|Monoton|Paytone+One|Yellowtail&display=swap" rel="stylesheet">

    
    <script>
        $(document).ready(function(){
            $("#btnRegresar").click(function(){
                location.href = "menu-principal.php";
            });
            function validarForm(){
                var validator = $("#frmActividadNueva").validate({
                    rules:{
                        txtFecha:{
                            required: true
                        },
                        txtInicio:{
                            required: true
                        },
                        txtFin:{
                            required: true
                        },
                        txtActividad:{
                            required: true
                        },
                        txtTransporte:{
                            number: true,
                            min:1
                        }
                    },
                    messages:{
                        txtFecha:{
                            required:"<i class='fas fa-times error-msg'></i>"
                        },
                        txtInicio:{
                            required: "<i class='fas fa-times error-msg'></i>"
                        },
                        txtFin:{
                            required: "<i class='fas fa-times error-msg'></i>"
                        },
                        txtActividad:{
                            required: "<i class='fas fa-times error-msg'></i>"
                        },
                        txtTransporte:{
                            number: "Solo números <i class='fas fa-times error-msg'></i>",
                            min: "Si no hay gasto en transporte borre este campo <i class='fas fa-times error-msg'></i>"
                        }
                    }
                });
                if(validator.form()){
                    alertify.confirm('Se requiere confirmación','¿La información es correcta? El registro de actividades no se podrá editar posteriormente, solo eliminar.',
                    function(){
                        $.ajax({
                        url: "recursos/nueva-actividad.php",
                        type: "post",
                        data: $("#frmActividadNueva").serialize(),
                        success: function(d){
                                if(d==true){
                                    alertify.message("Registrando actividad");
                                    setTimeout(function(){
                                            location.reload();
                                        }, 1000);
                                }else{
                                    alertify.error(d);
                                }
                            /*alert(d);*/
                            }
                        });
                    },
                    function(){
                        alertify.error('Registro cancelado');
                    }
                    
                    );
                }
            }
            $("#btnRegistrar").click(function(){
                validarForm();
            });
        });
    </script>
</head>
<body>
    <div class="hero">
        <div class="contenedor-hero">
            <h1 id="titulo">Actividades</h1>
        </div>
    </div>
    <div class="contenedor">
        <p class="eslogan">Tu mejor manera de cobrar</p>
        <p class="importante">
            Aquí puedes registrar <strong>tus actividades</strong>, el detalle de la actividad, y cuánto tiempo te requirió dicha actividad, así podremos generar tus reportes de cobro.                
        </p>
        <p class="importante"><strong>¡Éxito!</strong></p>

        <table class="actividades">
            <thead>
                <th colspan="3">Nueva actividad</th>
                <th><button class="boton" id="btn-abrir-popup"><i class="fas fa-user-plus"></i></button></th>
            </thead>
            <thead>
                <th colspan="4">Actividades registrados</th>
            </thead>
            <thead>
                <th>Fecha</th>
                <th>Empleador</th>
                <th>Actividad</th>
                <th>Ver / editar</th>
            </thead>
            
            <?php echo getActividadesTabla() ?>
        </table>
        <div class="campo guardar w-100">
            <input class="boton" id="btnRegresar" name="btnRegresar" type="button" value="Menú principal">
        </div>
        <div class="overlay" id="overlay">
            <div class="popup" id="popup">
                <div class="contenedor-campos">
                    <form id="frmActividadNueva" method="post" onsubmit="javascript:return false;">
                        <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class='fas fa-times'></i></a>
                        <div class="campo">
                            <label for="txtFecha">Fecha: </label>
                            <input class="obligatorio" type="date" id="txtFecha" name="txtFecha">
                        </div>
                        <div class="campo">
                            <label for="txtInicio">Inició: </label>
                            <input class="obligatorio" type="time" id="txtInicio" name="txtInicio">
                        </div>
                        <div class="campo">
                            <label for="txtFin">Terminó: </label>
                            <input class="obligatorio" type="time" id="txtFin" name="txtFin">
                        </div>
                        <div class="campo">
                            <label for="txtEmpleador">Empleador: </label>
                            <select class="obligatorio" name="txtEmpleador" id="txtEmpleador">
                                <?php echo getEmpleadoresSelect($numU); ?>
                            </select>
                        </div>
                        <div class="campo">
                            <label for="txtActividad">Actividad: </label>
                            <input class="obligatorio" type="text" name="txtActividad" list="actividadesRegistradas" id="txtActividad" autocomplete="off">
                            <datalist id="actividadesRegistradas">
                                <?php echo $actividadesReg ?>
                            </datalist>
                        </div>
                        <div class="campo">
                            <label for="txtActDetalle">Detalle: </label>
                            <textarea name="txtActDetalle" id="txtActDetalle" cols="30" rows="10"></textarea>
                        </div>
                        <div class="campo">
                            <label for="txtTransporte">Transporte: $</label>
                            <input type="number" step="00.01" min="1" id="txtTransporte" name="txtTransporte">
                        </div>
                        <div class="campo">
                            <input type="submit" class="boton"  name="btnRegistrar" id="btnRegistrar" value="Registrar actividad">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php echo getFooter()?>
    <script src="recursos\formEmergente.js"></script>
</body>
</html>