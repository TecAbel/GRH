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
?>

<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>
        <link rel="stylesheet" href="../css/normalize.css">
        <style>
            :root{
                --fuentePrincipal: 'Maven Pro', sans-serif;
                --fuenteTitulos: 'Anton', sans-serif;
                

                --fuenteGRH: 'Paytone One', sans-serif;


                --primario:	rgb(22, 122, 181);
                --secundario: rgb(35, 136, 194);
                --leve: #dfe3ee;
                --blanco : #ffffff;
                --enfasis: rgb(233, 194, 66);
            }
            body{
                font-family: var(--fuentePrincipal);
                
                font-size: 1rem;
                
            }
            .contenedor{
                margin-top: 2rem;
                padding: 3rem;
                max-width: 1000px;
                margin: 2rem auto;
                width: 95%;
                background-color: var(--blanco);
                border-radius: 1rem;
                -webkit-box-shadow: 0px 0px 0px 1px rgba(0,0,0,0.89);
                -moz-box-shadow: 0px 0px 0px 1px rgba(0,0,0,0.89);
                box-shadow: 0px 0px 0px 1px rgba(0,0,0,0.89);
                font-size: 1rem;
            }
            .eslogan{
                font-family: 'Yellowtail', cursive;
                font-size: 1rem;
                text-align:center;
            }
            h1{
                font-family: var(--fuenteGRH);
                font-size: 1.5rem;
                text-align: center;
                text-transform: uppercase;
                position: relative;
                margin-bottom: 3rem;
            }
            .campo{
                display: flex;
                margin-bottom: 1rem;
                align-items: center;
            }
            table.actividades{
                margin: 0 auto;
                width: 100%;
                border-collapse: separate;
                
                text-align: center;
            }
            .nota{
                
                text-align: center;
                font-size: .5rem;
            }
            .total{
                color: #85bb65;
            }
            .firma{
                width: 30%;
                margin: 10px auto;
            }
        </style>
    </head>
    <body>
    
        <H1>Recibo de honorarios a <?php echo $fecha ?></H1>        
        
            <p>
                Quien suscribe el presente documento <strong><?php echo getNombreUsuario()?> </strong>, manifiesta haber recibido a su entera satisfacción la cantidad de <strong>$<?php echo getTotalReporte($numEmpleador)?></strong> MXN, misma que es entregada por <strong><?php echo $empelador ?></strong> <?php echo $textoEmpresa?> , en efectivo, por concepto de:
            <p>
        <div class="contenedor">
            <table class="actividades">
                <tr>
                    <th>Fecha</th>
                    <th>Concepto</th>
                    <th>Detalle</th>
                    <th>Monto</th>
                </tr>
                <tr>
                    <td colspan="4"><hr width="100%" /></td>
                </tr>
                <?php echo getInfoReporte($numEmpleador) ?>
                <tr>
                    <td colspan="4"><hr width="100%" /></td>
                </tr>
                <tr>
                    <th class="total" colspan="3">Total</th>
                    <th class="total">$ <?php echo getTotalReporte($numEmpleador) ?></th>
                </tr>
                <tr>
                    <td colspan="4"><hr width="100%" /></td>
                </tr>
            </table>
        </div>
        <br>
        <br>
        <br>
        <br>
        <div class="firma" align = "center">
            <hr>
            <br>
            <?php echo getNombreUsuario()?>
        </div>
        <div align="center">
            <p class="nota">
            <strong>Documento generado en grh.com </strong>   
            <br> GRH solo genera estos reportes <strong>con los datos que el usuario haya ingresado</strong>, con el fin de ayudar en la administración de reportes de actividades de un usuario que labore por honorarios.
            <br>
            Por lo anterior, GRH no se hace responsable de la información que el mismo usuario haya ingresado y presente en este documento.
        </p>
            <img src="../img/logocompleto.png"  width="350px">
        </div>

    </body>
    </html>

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
    $dompdf->setPaper('A3', 'landscape');
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
    $mpdf->WriteHTML(ob_get_clean());
    $mpdf->Output($filename, 'D'); 
?>