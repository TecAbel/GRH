<?php
    #remoto Cloud Server
    
    $host = 'bq3oadgcinqgtheapl8t-mysql.services.clever-cloud.com';
    $usuario = 'uyhggn0wb7rpbrtb';
    $password = 'MBbS3jkyMR00YNsgeoOK';
    $db = 'bq3oadgcinqgtheapl8t';
    #local
    /*
    $host = 'localhost';
    $usuario = 'grh_god';
    $password = 'God_G*7';
    $db = 'grh_db';*/
    $conn = mysqli_connect($host, $usuario, $password,$db) or die("Conexión falló" . mysqli_connect_error());  
?>