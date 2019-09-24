<?php
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
    $filename = "GRH $nombre a $empelador $fechaarchivo .pdf" ;
    $data = '<body style="font-family: arial;">
    
    <H1 style="text-align:center">Recibo de honorarios a '. $fecha .'</H1>        
    <div style="width: 80%; margin: 0 auto; padding: 10px" >
        <p style="text-align: justify text-justify: inter-word;">
            Quien suscribe el presente documento <strong>'. getNombreUsuario(). ' </strong>, manifiesta haber recibido a su entera satisfacción la cantidad de <strong>$'. getTotalReporte($numEmpleador).'</strong> MXN, misma que es entregada por <strong>'. $empelador .'</strong> '.$textoEmpresa.', en efectivo, por concepto de:
        <p>
    </div>
    <div style="margin-top:20px; width: 85%; margin:0 auto;">
        <table style="margin: 0 auto; width: 100%; border-collapse:separate; border-spacing: 0px 10px;">
            <thead style="text-align: center; color: white; background-color:#343a40; line-height:30px;">
                <tr>
                    <th scope="col">Fecha</th>
                    <th scope="col">Concepto</th>
                    <th scope="col">Detalle</th>
                    <th scope="col">Monto</th>
                </tr>
            </thead>
            <tbody style="text-align:center;border-collapse:separate;">
                
                '.getInfoReporte($numEmpleador).'
                <tr>
                    <td colspan="4"><hr width="100%" /></td>
                </tr>
                <tr>
                    <th colspan="3" style="color: #28a745;">Total</th>
                    <th style="color: #28a745;">$ '.getTotalReporte($numEmpleador).'</th>
                </tr>
            </tbody>
            
            
        </table>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div style="width:200px; margin: 0 auto; text-align: center;" >
    
        <td colspan="4"><hr width="30%" /></td>
    
        <br>
        <strong>'.getNombreUsuario().'</strong>
    </div>
    <div  style="font-size: 10px; width: 80%; margin: 10px auto;">
        <p style="text-align:center;">
        <strong>Documento generado en https://grh-beta.000webhostapp.com/ </strong>   
        <br> GRH solo genera estos reportes <strong>con los datos que el usuario haya ingresado</strong>, con el fin de ayudar en la administración de reportes de actividades de un usuario que labore por honorarios.
        <br>
        Por lo anterior, GRH no se hace responsable de la información que el mismo usuario haya ingresado y presente en este documento.
    </p>
        
    </div>
    <img align="center" src="../img/logocompleto.png"  width="350px">
</body>';
?>

<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>
        <link rel="stylesheet" href="../css/normalize.css">
        <link href="https://fonts.googleapis.com/css?family=Maven+Pro|Monoton|Paytone+One|Yellowtail&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body style="font-family: arial;">
    
        <H1 style="text-align:center">Recibo de honorarios a 24/09/19</H1>        
        <div style="width: 80%; margin: 0 auto; padding: 10px" >
            <p style="text-align: justify text-justify: inter-word;">
                Quien suscribe el presente documento <strong>Abelardo Aqui Arroyo </strong>, manifiesta haber recibido a su entera satisfacción la cantidad de <strong>$400</strong> MXN, misma que es entregada por <strong>Alfredo Gutiérrez</strong>  , en efectivo, por concepto de:
            <p>
        </div>
        <div style='margin-top:20px; width: 85%; margin:0 auto;'>
            <table style='margin: 0 auto; width: 100%; border-spacing: 0px 10px;'>
                <thead style="text-align: center; color: white; background-color:#343a40; line-height:30px;">
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">Concepto</th>
                        <th scope="col">Detalle</th>
                        <th scope="col">Monto</th>
                    </tr>
                </thead>
                <tbody style="text-align:center;">
                    
                    
                    <tr  style='color:#6c757d;'>
                        <td >11/09/19</td>
                        <td >Servicio</td>
                        <td >Servicio semanal</td>
                        <td >$ 200</td>
                    </tr>
                
                    <tr  style='color:#6c757d;'>
                        <td >20/09/19</td>
                        <td >Servicio</td>
                        <td >Módem estaba en banda 2.4, se cambió a 5. Problemas con cobro de Google.</td>
                        <td >$ 200</td>
                    </tr>
                    <tr>
                        <td colspan="4"><hr width="100%" /></td>
                    </tr>
                    <tr>
                        <th colspan="3" style="color: #28a745;">Total</th>
                        <th style="color: #28a745;">$ 400</th>
                        <hr width="100%" />
                    </tr>
                </tbody>
                
                
            </table>
        </div>
        <br>
        <br>
        <br>
        <br>
        <div class='firma' align = 'center'>
            <hr width="30%" style="color: black; padding:0;">
            <br>
            <strong>Abelardo Aqui Arroyo</strong>
        </div>
        <div align='center' style='font-size: 10px; width: 80%; margin: 10px auto'>
            <p class='text-center'>
            <strong>Documento generado en https://grh-beta.000webhostapp.com/ </strong>   
            <br> GRH solo genera estos reportes <strong>con los datos que el usuario haya ingresado</strong>, con el fin de ayudar en la administración de reportes de actividades de un usuario que labore por honorarios.
            Por lo anterior, GRH no se hace responsable de la información que el mismo usuario haya ingresado y presente en este documento.
        </p>
            <img src='../img/logocompleto.png'  width='350px'>
        </div>

    </body>
    </html>


    

<?php
    require( '../dompdf/autoload.inc.php');
    require_once '../dompdf/lib/html5lib/Parser.php';
    require_once '../dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
    require_once '../dompdf/lib/php-svg-lib/src/autoload.php';
    require_once '../dompdf/src/Autoloader.php';
    Dompdf\Autoloader::register();
    use Dompdf\Dompdf;
    
    
   

    $dompdf = new Dompdf();
    $dompdf->loadHtml(ob_get_clean());
    $dompdf->setPaper('letter', 'portrait');
    $dompdf->render();
    $pdf = $dompdf->output();
    
    $dompdf->stream($filename);

    exit;
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
    /*
    require_once '../vendor/autoload.php';
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($data);
    #$mpdf->Output($filename, 'D'); 
    $mpdf->Output();*/
?>