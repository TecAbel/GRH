<?php
    include('sql.php');
    session_start();
    $correo = $_SESSION['usuario'];
    $numero = $_POST['txtNumero'];
    $num_empleado = $_POST['txtNumeroEmpleado'];
    $rfc = $_POST['txtRfc'];
    $sql = "UPDATE usuarios SET numero = '$numero', num_empleado = '$num_empleado', rfc='$rfc'	where correo = '$correo';";
    
?>