<?php
    include("sql.php");
    $nombreEmpleador = $_POST['txtNombreEmpleador'];
    $nombreEmpresa = $_POST['txtEmpresaEmpleador'];
    $correoEmpleador = $_POST['txtCorreoEmpleador'];
    $telEmpleador = $_POST['txtTelEmpleador'];
    $rfcEmpleador = $_POST['txtRfcEmpleador'];
    $msg = '';
    $sql = "INSERT INTO empleadores(nombre_emp,correo_emp,tel_emp,rfc_emp,nombre_emp_emp) VALUES ('$nombreEmpleador','$correoEmpleador','$telEmpleador','$rfcEmpleador','$nombreEmpresa');";
    if($conn->query($sql)){
        mysqli_close($conn);
        $msg = true;
    }else{
        $msg = mysqli_error();
    }

    echo $msg;
?>