<?php
    include('recursos\repetitivo.php');
    include('recursos\validaciones.php');   
    include('recursos\peticiones.php');
    $usuario = $_SESSION['usuario'];
    
    validarInicio($usuario);
    $user_Array = getUserid($usuario);
    $userU =  $user_Array['num_usuario'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
                location.href= "menu-principal.php";
            });
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
                    $.ajax({
                        url: "recursos/nuevoEmpleador.php",
                        type: "post",
                        data: $("#formulario").serialize(),
                        success: function(d){
                            if(d==true){
                                alertify.message("Empleador registrado");
                                setTimeout(function(){
                                        location.reload();
                                    }, 1000);
                            }
                            /*alert(d);*/
                        }
                    });
                }
            }
            $("#btnRegistrar").click(function(){
                validarForm();
            });
        });
    </script>
    <title>GRH | Empleadores</title>
</head>
<body>
    <div class="hero">
        <div class="contenedor-hero">
            <h1 id="titulo" class="">Empleadores</h1>
        </div>
    </div>
    
        <div class="contenedor">
            <p class="eslogan">Tu mejor manera de cobrar</p>
            <p class="importante">
                Aquí se va a registrar únicamente los <strong>datos del empleador</strong>, que servirán para llevar un control de su información de contacto que usaremos para generar tu reporte de cobro.                
            </p>

            <table class="empleadores">
                <thead>
                    <th colspan="3">Nuevo empleador</th>
                    <th><button class="boton" id="btn-abrir-popup"><i class="fas fa-user-plus"></i></button></th>
                </thead>
                <thead>
                    <th colspan="4">Empleadores registrados</th>
                </thead>
                <!--<tr>
                    <td colspan="4"><i class="fas fa-user-circle usuario-tb"></i></td>
                <tr>
                    <td>Carlos Enrique Sosa Dávalos</td>
                    <td>Grupo Columbia</td>
                    <td>5522113344</td>
                    <td><button class="boton"><i class="fas fa-edit "></i></button></td>
                </tr>
                <tr>
                    <td colspan="4"><i class="fas fa-user-circle usuario-tb"></i></td>
                <tr>
                    <td>Carlos Enrique Sosa Dávalos</td>
                    <td>Grupo Columbia</td>
                    <td>5522113344</td>
                    <td><button class="boton"><i class="fas fa-edit "></i></button></td>
                </tr>-->
                <?php
                    echo getEmpleadores($userU);
                ?>
            </table>
            <div class="campo guardar w-100">
                <input class="boton" id="btnRegresar" name="btnRegresar" type="button" value="Menú principal">
            </div>
            <div class="overlay" id="overlay">
                <div class="popup" id="popup">
                    <div class="contenedor-campos">
                        
                        <form action="" id="formulario" method="post" onsubmit="javascript:return false;">
                        <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class='fas fa-times'></i></a>
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
                            <div class="campo">
                                <label for="txtNumEmp">Número de empleado: </label>
                                <input type="text" id="txtNumEmp" name="txtNumEmp">
                            </div>
                            <div class="campo">
                                <label for="txtRfcEmpleador">RFC: </label>
                                <input type="text" id="txtRfcEmpleador" name="txtRfcEmpleador">
                            </div>
                            <div class="campo">
                                <label for="txtCuota">Cuota/h: $</label>
                                <input class="obligatorio" type="text" step="0.01" id="txtCuota" name="txtCuota">
                            </div>
                            <p class="importante">
                            Los campos de <span class="nota-amarilla"><strong>línea amarilla</span> son obligatorios.</strong> 
                            </p>
                            <div class="campo guardar w-100">
                                <input class="boton" id="btnRegistrar" name="btnRegistrar" type="submit" value="Registrar empleador">
                            </div>
                                    
                        </form>                    
                    </div>
                </div>
            </div>
        </div>

   

    <?php echo getFooter();  ?>
    <script src="recursos\formEmergenteEmpeladores.js"></script>
</body>
</html>