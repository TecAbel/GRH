<?php
    session_start();
    
    function validarInicio($sesion){
		if($sesion == null || $sesion == ''){
        header('Location: index.php');
	    }
    }

    function setSession($usuario, $pase){
        $_SESSION['usuario'] = $usuario;
        $_SESSION['pase'] = $pase;
    }

?>