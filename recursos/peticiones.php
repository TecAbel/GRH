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
    function getEmpleadores($numU){
        include('sql.php');
        $texto='';
        $sql = "SELECT num_emp,nombre_emp,nombre_emp_emp, tel_emp FROM empleadores WHERE num_usuario = '$numU' order by nombre_emp;";
        $resultado = $conn->query($sql);
        while ($filas_emp = $resultado->fetch_assoc()) {
            $texto= $texto.  "
            <tr>
                <td colspan='4'><i class='fas fa-user-circle usuario-tb'></i></td>
            <tr>
            <tr>
                <td>".$filas_emp['nombre_emp'] . "</td>
                <td>" .$filas_emp['nombre_emp_emp'] . "</td>
                
                <td><a href='datos-empleadores.php?XQR=".$filas_emp['num_emp']."'< class='boton'><i class='fas fa-edit'></i></a></td>
            </tr>";
        }
        return $texto;        
        mysqli_close();
    }
    function getDatosEmpleadores($numEmpleador, $numUsuario){
        include('sql.php');
        $texto='';
        $sql = "SELECT nombre_emp, nombre_emp_emp, correo_emp, tel_emp, num_empleado, rfc_emp, cuota FROM empleadores WHERE num_emp='$numEmpleador' and num_usuario='$numUsuario';";
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