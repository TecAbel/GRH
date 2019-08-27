<?php
    include("sql.php");
    $correo = $_POST['txtCorreo'];
    $correo1 = $_POST['txtCorreo1'];
    $nombre = $_POST['txtNombre'];
    $telefono = $_POST['txtTelefono'];
    $pase = $_POST['txtPass'];
    $pase1 = $_POST['txtPass1'];
    $sql = "INSERT INTO usuarios(correo,nombre_user,numero,pase) VALUES('$correo','$nombre','$telefono','$pase');";
    if($conn->query($sql)){
        mysqli_close($conn);
    }
    else{
        echo mysqli_error($conn);
    }
?>