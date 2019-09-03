<?php
    include("sql.php");
    include('peticiones.php');
    session_start();
    $usuario = $_SESSION['usuario'];
    $num_uArray = getUserid($usuario);
    $numUsuario = $num_uArray['num_usuario'];
    $nombreEmpleador = $_POST['txtNombreEmpleador'];
    $nombreEmpresa = $_POST['txtEmpresaEmpleador'];
    $correoEmpleador = $_POST['txtCorreoEmpleador'];
    $telEmpleador = $_POST['txtTelEmpleador'];
    $numEmpleado = $_POST['txtNumEmp'];
    $rfcEmpleador = $_POST['txtRfcEmpleador'];
    $cuota = $_POST['txtCuota'];
    $msg = '';
    $sql = "INSERT INTO empleadores(num_usuario,nombre_emp,nombre_emp_emp,correo_emp,tel_emp,num_empleado,rfc_emp,cuota) VALUES ('$numUsuario','$nombreEmpleador','$nombreEmpresa','$correoEmpleador','$telEmpleador','$numEmpleado','$rfcEmpleador','$cuota');";
    if($conn->query($sql)){
        mysqli_close($conn);
        $msg = true;
    }else{
        $msg = mysqli_error();
    }

    echo $msg;
    #print_r($_POST);
?>