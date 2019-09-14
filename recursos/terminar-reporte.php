<?php
 include('SED.php');
 include('sql.php');
 $empleadorE = $_GET['EWER'];
 $empleador = SED::decryption($empleadorE);
 $sql="DELETE FROM calculos 
 WHERE num_emp = '$empleador';";
 if($conn->query($sql)=== TRUE){
     header('Location: ../reportes.php');
 }else{
     print_r('Error'.mysqli_error($conn));
 }
 mysqli_close($conn);
?>