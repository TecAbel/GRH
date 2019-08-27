<?php
    include("sql.php");
    $correo = $_POST['txtCorreo'];
    $correo1 = $_POST['txtCorreo1'];
    $nombre = $_POST['txtNombre'];
    $telefono = $_POST['txtTelefono'];
    $pase = $_POST['txtPass'];
    $pase1 = $_POST['txtPass1'];
    $pass_crypt = password_hash($pase, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios(correo,nombre_user,numero,pase) VALUES('$correo','$nombre','$telefono','$pass_crypt');";
    
        if($conn->query($sql)){
            mysqli_close($conn);
            echo "Bienvenido/a $nombre";
        }
        else{
            echo "Este correo ya ha sido registrado";
        }
    
    
?>
