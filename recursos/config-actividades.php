<?php
    include('sql.php');
    session_start();
    
    $actividad = $_GET['CDE'];
    $texto = '';

    $sql = "DELETE FROM calculos 
    WHERE num_cal = '$actividad';";
    if($conn->query($sql) === TRUE){
        $texto = true;
    }
    else{
        $texto = "Error: " . mysqli_error($conn);
    }
    
    echo $texto;
    mysqli_close($conn);
?>