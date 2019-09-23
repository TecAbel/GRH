<?php
    include("sql.php");
    $correo = $_POST['txtCorreo'];
    $correo1 = $_POST['txtCorreo1'];
    $nombre = $_POST['txtNombre'];
    $telefono = $_POST['txtTelefono'];
    $pase = $_POST['txtPass'];
    $pase1 = $_POST['txtPass1'];
    $asunto = "Bienvendo(a) $nombre ";
    $carta = "¡Nos alegramos de tenerte con nosotros!\n \n \n";
    $carta .="Te damos una cordial bienvenida a GRH, y esperamos que te vaya de lo mejor usando nuestra app.\n";
    $carta.="!Mucho éxito, $nombre!\n";
    $carta.="Atte: Abelardo Aqui. Director.\n \nCorreo de contacto: abelardo96.work@gmail.com\n \n \nGRH: https://grh-beta.000webhostapp.com/";
    
    $pass_crypt = password_hash($pase, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios(correo,nombre_user,numero,pase) VALUES('$correo','$nombre','$telefono','$pass_crypt');";
    
        if($conn->query($sql)){
            mail($correo, $asunto, $carta);
            echo "Bienvenido/a $nombre";
        }
        else{
            echo "Este correo ya ha sido registrado";
        }
    
        mysqli_close($conn);
?>
