<?php
    header('Content-Type: text/html; charset=utf-8');
    session_start();
    function conectar(){
        $host = 'localhost';
        $usuario = 'grh_god';
        $password = 'God_G*7';
        $db = 'grh_db';
        $conn = mysqli_connect($host, $usuario, $password,$db) or die("Conexión falló" . mysqli_connect_error());
        
        return $conn;
    }
    
    function desconectar(){
        mysqli_close($conn);
    }
?>