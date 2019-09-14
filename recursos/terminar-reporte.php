<?php
 include('SED.php');
 $empleadorE = $_GET['EWER'];
 $empleador = SED::decryption($empleadorE);
 print_r("$empleador");
?>