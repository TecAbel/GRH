<?php
if(!isset($_GET['QWEC'])){
    header("Location: ../menu-principal");
}
    include('peticiones.php');
    include('SED.php');
    ob_start();
    $numEmpleadorE = $_GET['QWEC'];
    $numEmpleador = SED::decryption($numEmpleadorE);
    $fecha_array  = getdate();
    /*$d = $fecha_array[mday];
    $m = $fecha_array[mon];
    $y = $fecha_array[year];*/
    $textoEmpresa = "";
    #$fecha = "$d/$m/$y";
    $fecha = date("d/m/y");
    #$fechaarchivo = "$d $m $y";
    $fechaarchivo = date("d m y");
    $empleador_array = getEmpeldorYEmpresa($numEmpleador);
    $empelador = $empleador_array['nombre_emp'];
    $empresa = $empleador_array['nombre_emp_emp'];
    $nombre = getNombreUsuario();
    if($empresa == null or $empresa == ''){
        $textoEmpresa = "";
    }
    else{
        $textoEmpresa = "de la empresa <strong>$empresa</strong>";
        
    }
    $qr = "";
    $filename = "GRH $nombre a $empelador $fechaarchivo .pdf" ;
    $totalReporte = getTotalReporte($numEmpleador);
    if($nombre==="Abelardo Aqui Arroyo"){
        $qr = "<div align='center' style=' width=80%; margin: 10px auto;'>
        <p>Si desea hacer su pago con <strong>PayPal</strong> puede hacerlo leyendo este código QR o ingresando el link <strong> htttps://paypal.me/AbelardoAqui</strong>. No olvide notificar a $nombre en caso de que escoja este medio.</p>
        <img src='../img/paypal-qr.jpg'  width='100px'>
    </div>";
    } 
    $html = "";
    $html = "
    
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>
        
        
        <style>
            
        </style>
    </head>
    <body style='font-family: arial;'>
    
        
        <H1 style='text-align:center;'>Recibo de honorarios a $fecha</H1> 
            
        <div style='width: 80%; margin: 0 auto; padding: 15px' >
            <p style='text-align: justify text-justify: inter-word;'>
                Quien suscribe el presente documento <strong> $nombre  </strong>, manifiesta haber recibido a su entera satisfacción la cantidad de <strong>$ $totalReporte </strong> MXN, misma que es entregada por <strong> $empelador </strong> $textoEmpresa, en efectivo, por concepto de:
            <p>
        </div>
        <div>
            <table style='margin: 0 auto; width: 100%; border-spacing: 0px 10px; border-radious: 10px;'>
                
                
                <thead style='text-align: center; '>
                    <tr style='background-color: #343a40;'>
                        <th scope='col' style=' color:white; padding: 15px 10px 5px 10px; !important;'>Fecha</th>
                        <th scope='col' style=' color:white; padding: 15px 10px 5px 10px; !important;'>Concepto</th>
                        <th scope='col' style=' color:white; padding: 15px 10px 5px 10px; !important;'>Detalle</th>
                        <th scope='col' style=' color:white; padding: 15px 10px 5px 10px; !important;'>Monto</th>
                    </tr>
                </thead>
                <tbody style='text-align:center;'>
                    
                        
                    
                    
                    ".getInfoReporte($numEmpleador)."
                    
                        
                    
                    <tr style='background-color: #28a745; '>
                        <th colspan='3' style='color: white; padding: 15px 10px 5px 10px; !important;'>Total</th>
                        <th style='color: white; padding: 15px 10px 5px 10px; !important;'>$ $totalReporte</th>
                    </tr>
                    
                </tbody>
                
                
            </table>
        </div>
        <br>
        <br>
        <br>
        <br>
        <div style='text-align:center; width:300px; margin: 0 auto; color:black;'>
        <tr>
            <td><hr width='30%'/></td>
        </tr>
            <strong><span style='color: black'> $nombre </span></strong>
        </div>
        <div align='center' style='font-size: 10px; width: 80%; margin: 10px auto; color:#6c757d;'>
            <p style='text-align: center'>
            <strong>Documento generado en https://grh-beta.000webhostapp.com/ </strong>   
            <br> GRH solo genera estos reportes <strong>con los datos que el usuario haya ingresado</strong>, con el fin de ayudar en la administración de reportes de actividades de un usuario que labore por honorarios.
            Por lo anterior, GRH no se hace responsable de la información que el mismo usuario haya ingresado y presente en este documento.
        </p>
            <img src='../img/logocompleto.png'  width='350px'>
        </div>
        $qr

    </body>
    </html>


    
    ";
?>



<?php
    /*require( '../dompdf/autoload.inc.php');
    require_once '../dompdf/lib/html5lib/Parser.php';
    require_once '../dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
    require_once '../dompdf/lib/php-svg-lib/src/autoload.php';
    require_once '../dompdf/src/Autoloader.php';
    Dompdf\Autoloader::register();
    use Dompdf\Dompdf;
    
    
   
    $dompdf = new Dompdf();
    $dompdf->loadHtml(ob_get_clean());
    $dompdf->setPaper('A3', 'portrait');
    $dompdf->render();
    $pdf = $dompdf->output();
    
    $dompdf->stream($filename);
    /*use Dompdf\Dompdf;
                    array("Attachment" => false)
    // instantiate and use the dompdf class
    $dompdf = new Dompdf();
    $dompdf->loadHtml('hello world');
    $dompdf->setPaper('A4', 'landscape');
    // Render the HTML as PDF
    $dompdf->render();
    // Output the generated PDF to Browser
    $dompdf->stream();*/
    #usando mpdf composer 
    
    require_once '../vendor/autoload.php';
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);
    $mpdf->Output($filename, 'I'); 

?>