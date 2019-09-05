<?php
    include('sql.php');
    include('peticiones.php');
    session_start();
    $correo = $_SESSION['usuario'];
    $numUsuario_array=  getUserId($correo);
    $numUsuario = $numUsuario_array['num_usuario'];
    $numEmp = $_GET['XQR'];
    
    $nombreEmpleador = $_POST['txtNombreEmpleador'];
    $nombreEmpresa = $_POST['txtEmpresaEmpleador'];
    $correoEmpleador = $_POST['txtCorreoEmpleador'];
    $telEmpleador = $_POST['txtTelEmpleador'];
    $rfcEmpleador = $_POST['txtRfcEmpleador'];
    $numEmpleado = $_POST['txtNumEmp'];
    $cuota = $_POST['txtCuota'];
    $sql = "UPDATE empleadores SET nombre_emp = '$nombreEmpleador', nombre_emp_emp = '$nombreEmpresa', correo_emp = '$correoEmpleador',
    tel_emp = '$telEmpleador', num_empleado='$numEmpleado', rfc_emp='$rfcEmpleador', cuota='$cuota' WHERE num_emp = '$numEmp' and num_usuario='$numUsuario';";
    if($conn->query($sql)){
        echo true;
    }
    else{
        echo "Algo ha salido mal, verifica tu información";
    }
?>