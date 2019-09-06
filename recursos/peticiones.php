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
        mysqli_close($conn);
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
        mysqli_close($conn);
    }
    function getEmpleadores($numU){
        include('sql.php');
        $texto='';
        $sql = "SELECT num_emp,nombre_emp,nombre_emp_emp, tel_emp FROM empleadores WHERE num_usuario = '$numU' order by nombre_emp;";
        $resultado = $conn->query($sql);
        if(mysqli_num_rows($resultado)>0){
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
        }else{
            $texto = "
            <tr>
                <td colspan='4'>Aún no ha registrado ningún empleador</td>
            <tr>
            ";
        }
        
        
        return $texto;        
        mysqli_close($conn);
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
        mysqli_close($conn);
    }
    function getEmpleadoresSelect($numU){
        include('sql.php');
        $texto='';
        $sql = "SELECT num_emp,nombre_emp FROM empleadores WHERE num_usuario = '$numU' order by nombre_emp;";
        $resultado = $conn->query($sql);
        if(mysqli_num_rows($resultado)>0){
            while ($filas_emp = $resultado->fetch_assoc()) {
                $texto = $texto . "
                    <option value='" . $filas_emp['num_emp'] . "'>".  $filas_emp['nombre_emp'] ."</option>
                ";
            }
        }else{
            $texto = "
                <option>Sin empleadores</option>
            ";
        }
        
        
        return $texto;
        mysqli_close($conn);
    }
    function completarActividad($correo){
        include('sql.php');
        $texto = '';
        $sql = "SELECT num_actividad,nombre_act from actividades WHERE num_usuario='$correo';";
        $resultado = mysqli_query($conn, $sql); 
        
        if (mysqli_num_rows($resultado) > 0){ 

            while($fila = mysqli_fetch_assoc($resultado)){ 
                // se recoge la información según la vamos a pasar a la variable de javascript
                $texto .= "
                    <option value='".$fila['nombre_act']."'>".$fila['nombre_act']."</option>
                " ;
                }
        
        }   
        return $texto;
        mysqli_close($conn);
    }
    function getActividadesTabla(){
        include('sql.php');
        session_start();
        $correo = $_SESSION['usuario'];
        $texto='';
        $sql = "SELECT calculos.fecha, empleadores.nombre_emp, actividades.nombre_act FROM calculos
        INNER JOIN empleadores ON calculos.num_emp = empleadores.num_emp
        INNER JOIN actividades ON calculos.num_actividad = actividades.num_actividad
        WHERE empleadores.num_usuario = (SELECT num_usuario FROM usuarios WHERE correo = '$correo')
        ORDER BY fecha DESC
        ;";
        $resultado = mysqli_query($conn, $sql);
        if(mysqli_num_rows($resultado)){
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $texto.="
                <tr>
                    <td>".$fila['fecha']."</td>
                    <td>".$fila['nombre_emp']."</td>
                    <td>".$fila['nombre_act']."</td>
                <td><a href='#' class='boton'><i class='fas fa-edit'></i></a></td>
            </tr>
                ";
            }
        }else{
            $texto = "
            <tr>
                <td colspan='4'>Aún no ha registrado ninguna actividad</td>
            <tr>
            ";
        }
        return $texto;
        mysqli_close($conn);
    }
?>