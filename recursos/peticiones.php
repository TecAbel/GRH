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
        include('SED.php');
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
                    
                    <td><a href='datos-empleadores.php?XQR=".SED::encryption($filas_emp['num_emp'])."'< class='boton'><i class='fas fa-edit'></i></a></td>
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
                <option value=''>Sin empleadores</option>
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
        include('SED.php');
        session_start();
        $correo = $_SESSION['usuario'];
        $texto='';
        $sql = "SELECT calculos.num_cal,date_format(calculos.fecha,'%d/%m/%y') AS fecha , empleadores.nombre_emp, actividades.nombre_act FROM calculos
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
                <td><a href='datos-actividades.php?RXQ=".SED::encryption($fila['num_cal'])."' class='boton'><i class='fas fa-search'></i></a></td>
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
    function getDatosActividades($correo,$actividad){
        include('sql.php');
        $texto='';
        $sql = "SELECT  date_format(fecha,'%d/%m/%y') AS fecha, empleadores.nombre_emp,actividades.nombre_act, horas_tra,descripcion,transporte FROM calculos
        INNER JOIN actividades ON calculos.num_actividad = actividades.num_actividad
        INNER JOIN empleadores ON calculos.num_emp = empleadores.num_emp
        WHERE (SELECT num_usuario FROM usuarios WHERE correo = '$correo') and calculos.num_cal='$actividad';";
        $resultado = $conn->query($sql);
        if(mysqli_num_rows($resultado)>0){
            $texto = mysqli_fetch_assoc($resultado);
        }else{
            $texto = "
                Hay un error con su usuario
            ";
        }
        
        
        return $texto;
        mysqli_close($conn);
    }
    function getReporteXHacer($correo){
        include('sql.php');
        include('SED.php');
        session_start();
        $correo = $_SESSION['usuario'];
        $texto = '';
        $sql = "
            SELECT  empleadores.num_emp,empleadores.nombre_emp as empleador , SUM(calculos.total_cal) as monto_total
            FROM empleadores 
            INNER JOIN calculos ON calculos.num_emp = empleadores.num_emp
            WHERE calculos.num_usuario = (SELECT num_usuario FROM usuarios WHERE correo = '$correo')
            group by empleadores.nombre_emp
            ORDER BY total_cal DESC;
        ";
        $resultado = mysqli_query($conn, $sql);
        if(mysqli_num_rows($resultado)){
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $texto .= "
                <tr>
                <td>".$fila['empleador']."</td>
                <td>$".$fila['monto_total']."</td>
                <td><a href='recursos/reportes-gen.php?QWEC=".SED::encryption($fila['num_emp'])."' class='boton' target='_blank' rel='noopener noreferrer'><i class='fas fa-money-check-alt'></i></a></td>
                <td><button id='btnEliminar' class='boton'><i class='fas fa-check-circle'></i></button></td>
                </tr>
                ";
            }
        }else{
            $texto = "
            <tr>
                <td colspan='3'>Aún no ha registrado ninguna actividad</td>
            <tr>
            ";
        }
        return $texto;
        mysqli_close($conn);
    }

    function getInfoReporte($numEmpleador){
        include('sql.php');
        session_start();
        $correo = $_SESSION['usuario'];
        $sql = "
        SELECT date_format(calculos.fecha,'%d/%m/%y') as fecha, actividades.nombre_act, calculos.descripcion, calculos.total_cal
        FROM calculos
        INNER JOIN actividades ON actividades.num_actividad = calculos.num_actividad
        WHERE calculos.num_emp='$numEmpleador' AND calculos.num_usuario=(SELECT num_usuario FROM usuarios WHERE correo = '$correo');
        ";
        $resultado = mysqli_query($conn,$sql);
        if(mysqli_num_rows($resultado)){
            while ($fila = mysqli_fetch_assoc($resultado)){
                $texto .= "
                    <tr>
                        <td>".$fila['fecha']."</td>
                        <td>".$fila['nombre_act']."</td>
                        <td>".$fila['descripcion']."</td>
                        <td>$ ".$fila['total_cal']."</td>
                    </tr>
                ";
            }
        }
        else{
            $texto = 'Error: '. mysqli_error($conn);
        }
        mysqli_close($conn);
        return $texto;
    }

    function getTotalReporte($numEmpleador){
        include('sql.php');
        session_start();
        $total='';
        $correo = $_SESSION['usuario'];
        $sql="SELECT sum(calculos.total_cal) as total
        FROM calculos
        WHERE calculos.num_usuario = (SELECT num_usuario FROM usuarios WHERE correo ='$correo') 
        AND calculos.num_emp = '$numEmpleador';";
        $resultado = mysqli_query($conn, $sql);
        if(mysqli_num_rows($resultado)){
            $resultado_array = mysqli_fetch_assoc($resultado);
            $total = $resultado_array['total'];
        }
        else{
            $total ="Error ". mysqli_error($conn);
        }
        mysqli_close($conn);
        return $total;
    }

    function getNombreUsuario(){
        include('sql.php');
        session_start();
        $correo = $_SESSION['usuario'];
        $nombre = '';
        $sql = "SELECT nombre_user 
        FROM usuarios
        WHERE correo = '$correo'";
        $resultado = mysqli_query($conn, $sql);
        if(mysqli_num_rows($resultado)){
            $resultado_array = mysqli_fetch_assoc($resultado);
            $nombre = $resultado_array['nombre_user'];
        }else{
            $nombre = 'Error '. mysqli_error($conn);
        }
        mysqli_close($conn);
        return $nombre;
    }

    function getEmpeldorYEmpresa($numEmpleador){
        include('sql.php');
        session_start();
        $correo = $_SESSION['usuario'];
        $texto = '';
        $sql = "SELECT nombre_emp, nombre_emp_emp 
        FROM empleadores
        WHERE num_usuario = (SELECT num_usuario FROM usuarios WHERE correo = '$correo')
        AND num_emp = '$numEmpleador';";
        $consulta = mysqli_query($conn, $sql);
        if(mysqli_num_rows($consulta)>0){
            $texto = mysqli_fetch_assoc($consulta);
        }
        else{
            $texto = 'Hay problemas con su usuario';
        }
        return $texto;
        mysqli_close($conn);
    }
?>