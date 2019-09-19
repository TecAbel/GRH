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
                /*background-color: var(--primario);*/
                /*background-image: linear-gradient(to top, #09203f 0%, #537895 100%);*/
                background-image: linear-gradient(-225deg, #22E1FF 0%, #1D8FE1 48%, #625EB1 100%);
                min-height: 100%;
                font-size: 1.6rem;
                background-image: linear-gradient(15deg, #13547a 0%, #80d0c7 100%);
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
                color: var(--blanco);
                position: relative;
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
                font-size: .5rem;
            }
            
        </style>
    </head>
    <body>
    
        <H1>Recibo de honorarios a <?php echo $fecha ?></H1>        
        <div class="contenedor">
            <p>
                Quien suscribe el presente documento <strong><?php echo getNombreUsuario()?> </strong>, manifiesta haber recibido a su entera satisfacción la cantidad de <strong>$<?php echo getTotalReporte($numEmpleador)?></strong> MXN, misma que es entregada por <strong><?php echo $empelador ?></strong> <?php echo $textoEmpresa?> , en efectivo, por concepto de:
            <p>
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
                    <th colspan="3">Total</th>
                    <th>$ <?php echo getTotalReporte($numEmpleador) ?></th>
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
        <div align = "center">
            <hr width = "30%" />
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
    require( '../dompdf/autoload.inc.php');
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
    $filename = "reporte de honorarios $nombre a $empelador $fechaarchivo .pdf" ;
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
?>