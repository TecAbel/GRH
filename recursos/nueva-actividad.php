<?php
    include('sql.php');
    include('peticiones.php');
    session_start();
    $correo = $_SESSION['usuario'];
    $numU_Array =  getUserid($correo);
    $numU = $numU_Array['num_usuario'];
    $numEmpleador = $_POST['txtEmpleador'];
    $actividad = $_POST['txtActividad'];
    $inicio =  $_POST['txtInicio'];
    $termino = $_POST['txtFin'];
    $inicioF = strtotime($inicio);
    $terminoF = strtotime($termino);
    $fecha = $_POST['txtFecha'];
    $descripcion = $_POST['txtActDetalle'];
    $transporte = $_POST['txtTransporte'];
    $intervalo = $terminoF - $inicioF;
    $horas = $intervalo / 3600;
    $redondeo = round($horas, 0, PHP_ROUND_HALF_UP);
    $texto = '';
    $sqlActividad = "
        INSERT  INTO actividades(nombre_act, num_usuario) 
        SELECT * FROM( SELECT '$actividad','$numU') AS tmp
        WHERE NOT EXISTS (
            SELECT nombre_act FROM actividades WHERE nombre_act = '$actividad'
        ) limit 1;
    ";
    $sqlCalculo = "INSERT INTO calculos(num_usuario,num_emp,num_actividad,fecha,hora_ent,hora_sal,horas_tra,descripcion,transporte)
    VALUES('$numU', '$numEmpleador',(SELECT num_actividad FROM actividades WHERE nombre_act = '$actividad'),'$fecha','$inicio', '$termino','$redondeo','$descripcion','$transporte');";
    if($numEmpleador!=null){
        if($conn->query($sqlActividad)){
            if($conn->query($sqlCalculo)){
                $texto = true;
            }
            else{
                $texto = "Error : ". mysqli_error($conn);
            }
        }
        else{
            $texto = "Error " . mysqli_error($conn);
        }
    }
    else{
        $texto = "Error: Debe de existir un empleador";
    }
    echo $texto;
    mysqli_close($conn);
    #print_r($_POST);
?>