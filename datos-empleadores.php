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
    
    $numUsuario = getUserid($usuario);
    $empleadorE = $_GET['XQR'];
    $empleador = SED::decryption($empleadorE);
    
    $datosEmpleador = getDatosEmpleadores($empleador,$numUsuario['num_usuario']);
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
                location.href="empleadores.php";
            });
            $("#txtNombreEmpleador").val('<?php echo $datosEmpleador['nombre_emp'] ?>');
            $("#txtEmpresaEmpleador").val('<?php echo $datosEmpleador['nombre_emp_emp'] ?>');
            $("#txtCorreoEmpleador").val('<?php echo $datosEmpleador['correo_emp'] ?>');
            $("#txtTelEmpleador").val('<?php echo $datosEmpleador['tel_emp'] ?>');
            $("#txtRfcEmpleador").val('<?php echo $datosEmpleador['rfc_emp'] ?>');
            $("#txtNumEmp").val('<?php echo $datosEmpleador['num_empleado'] ?>');
            $("#txtCuota").val('<?php echo $datosEmpleador['cuota'] ?>');
            function validarForm(){
                var validator = $("#formulario").validate({
                    rules:{
                        txtNombreEmpleador:{
                            required: true,
                        },
                        txtCorreoEmpleador:{
                            email: true
                        },
                        txtTelEmpleador:{
                            number:true,
                            minlength: 8,
                            maxlength:10
                        },
                        txtRfcEmpleador:{
                            maxlength: 13,
                            minlength: 13
                        },
                        txtCuota:{
                            required: true,
                            digits:true
                        }
                    },
                    messages:{
                        txtNombreEmpleador:{
                            required: "<i class='fas fa-times error-msg'></i>"
                        },
                        txtCuota:{
                            required: "<i class='fas fa-times error-msg'></i>",
                            digits:"Solo números <i class='fas fa-times error-msg'></i>"
                        }
                    }
                });
                if(validator.form()){
                    alertify.confirm('Se requiere confirmación','¿Está seguro de realizar estos cambios?',
                    function(){
                        $.ajax({
                            url: "recursos/config-empleador.php?XQR=<?php echo $empleador ?>",
                            type: "post",
                            data: $("#formulario").serialize(),
                            success: function(d){
                                if(d==true){
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
                        alertify.error('Acción cancelada')
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
    <?php echo getHeader() ?>
    <div class="hero">
        <div class="contenedor-hero">
            <h1 id="titulo" class="">Empleadores</h1>
        </div>
        
    </div> 
    <div class="contenedor">
    <form action="" id="formulario" method="post" onsubmit="javascript:return false;">
        <p class="eslogan">Tu mejor manera de cobrar</p>
        <div class="contenedor-campos">
            
                <p class="importante">
                    Aquí podrás actualizar o cambiar los datos que ingresaste de tu empleador. A pesar de que puedas editar el nombre y diversos elementos del empelador aquellos reportes que hayas hecho no cambiarán.
                </p>
                <div class="campo">
                    <label for="txtNombreEmpleador">Nombre del empleador: </label>
                    <input class="obligatorio" type="text" id="txtNombreEmpleador" name="txtNombreEmpleador">
                </div>
                <div class="campo">
                    <label for="txtEmpresaEmpleador">Nombre de la empresa: </label>
                    <input type="text" id="txtEmpresaEmpleador" name="txtEmpresaEmpleador">
                </div>
                <div class="campo">
                    <label for="txtCorreoEmpleador">Correo: </label>
                    <input type="text" id="txtCorreoEmpleador" name="txtCorreoEmpleador">
                </div>
                <div class="campo">
                    <label for="txtTelEmpleador">Teléfono: </label>
                    <input type="text" id="txtTelEmpleador" name="txtTelEmpleador">
                </div>
                <div class="campo w-100">
                    <label for="txtRfcEmpleador">RFC: </label>
                    <input type="text" id="txtRfcEmpleador" name="txtRfcEmpleador">
                </div>
                <div class="campo">
                    <label for="txtNumEmp">Número de empleado: </label>
                    <input type="text" id="txtNumEmp" name="txtNumEmp">
                </div>
                <div class="campo">
                    <label for="txtCuota">Cuota/h: $</label>
                    <input class="obligatorio" type="number" step="0.01" id="txtCuota" name="txtCuota">
                </div>
                <div class="campo w-100">
                    <p class="importante">
                    Los campos de <span class="nota-amarilla"><strong>línea amarilla</span> son obligatorios.</strong> 
                    </p>
                </div>
                <div class="campo guardar w-100">
                    <input class="boton" id="btnEditar" name="btnEditar" type="submit" value="Actualizar datos">
                </div>
                <div class="campo guardar w-100">
                    <input class="boton" id="btnRegresar" name="btnRegresar" type="submit" value="Regresar">
                </div>
            
        </div>
        </form>
    </div>
    <?php echo getFooter(); ?>
    <script src="recursos\nav.js"></script>
</body>

</html>