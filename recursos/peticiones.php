<?php
    function getDatosPersonales($correo){
        include('sql.php');
        $texto='';
        $sql = "SELECT nombre_user, numero, rfc, pase FROM usuarios WHERE correo = '$correo';";
        $consulta = mysqli_query($conn,$sql);
        if(mysqli_num_rows($consulta)>0){
            $texto = mysqli_fetch_assoc($consulta);
        }
        else{
            $texto = 'Hay problemas con su usuario';
        }
        return $texto;
        mysqli_close();
    }
    function getUserid($correo){
        include('sql.php');
        $texto='';
        $sql = "SELECT num_usuario from usuarios WHERE correo = '$correo';";
        $consulta = mysqli_query($conn,$sql);
        if(mysqli_num_rows($consulta)>0){
            $texto = mysqli_fetch_assoc($consulta);
        }
        else{
            $texto = 'Hay problemas con su usuario';
        }
        return $texto;
        mysqli_close();
    }
?>