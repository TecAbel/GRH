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
    $sqlSubtotal="
        UPDATE calculos 
        SET subtotal_cal =  (
            horas_tra*(
            SELECT cuota 
            FROM empleadores 
            where num_usuario = (
                SELECT num_usuario 
                FROM usuarios 
                WHERE correo = '$correo'
                ) 
            AND num_emp = '$numEmpleador'
            )
        )
        WHERE calculos.num_emp = '$numEmpleador' AND calculos.num_usuario = '$numU';
    ";
    $sqlTotal = "
        UPDATE calculos
        SET total_cal = (
            subtotal_cal + transporte
        )
        WHERE calculos.num_emp = '$numEmpleador' AND calculos.num_usuario = '$numU';
    ";
    if($numEmpleador!=null){
        if($conn->query($sqlActividad)){
            if($conn->query($sqlCalculo)){
                if($conn->query($sqlSubtotal)){
                    if($conn->query($sqlTotal)){
                        $conn->query($sqlTotal);
                        $texto = true;
                    }else{
                        $texto = "Error : ". mysqli_error($conn); 
                    }
                }else{
                    $texto = "Error : ". mysqli_error($conn); 
                }
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