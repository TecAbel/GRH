<?php
    include("sql.php");
    
    $correo = $_POST['txtUsuario'];
    $pase = $_POST['txtPass'];
    $sql = "SELECT pase, nombre_user FROM usuarios WHERE correo = '$correo';";
    if($consulta = mysqli_query($conn,$sql)){
        $pase_db_array = $consulta->fetch_assoc();
        $pase_db = $pase_db_array['pase'];
        $nombre = $pase_db_array['nombre_user'];
        if(password_verify($pase,$pase_db)){
            session_start();
            $_SESSION['usuario'] = $correo;
            
            echo "Bienvenido $nombre";
        }
        else{
            echo false;
        }
    }
    else{
        echo mysqli_error();
    }
    mysqli_close($conn);
?>

