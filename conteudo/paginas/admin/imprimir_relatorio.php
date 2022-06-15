<?php

session_start();
include_once ("../../src/conexoes/conexao.php");

//$data = filter_input(INPUT_POST, 'date');
$data = "2022-06-13";
                 
        
        $result_entrega = "SELECT
        beneficiarios.beneficiario_id, beneficiarios.snome, beneficiarios.nome, beneficiarios.qtd_adultos, beneficiarios.qtd_criancas, entrega.criado
        FROM beneficiarios 
        INNER JOIN 
        entrega ON beneficiarios.beneficiario_id = entrega.beneficiario_id 
        WHERE entrega.criado LIKE '%$data%'";
        $resultado_entregas = mysqli_query($conn, $result_entrega);
        $conta_registro = mysqli_num_rows($resultado_entregas);
        $total_adultos = 0;
        $total_criancas = 0;

        /*while ($rows_entrega = mysqli_fetch_assoc($resultado_entregas)){
        $total_adultos += intval($rows_entrega['qtd_adultos']);
        $total_criancas += intval($rows_entrega['qtd_criancas']);*/



$html = '';
$html .= '<DOCTYPE html>';
$html .= '    <html>';
$html .= '    <head>';
$html .= '    <meta charset="utf-8">';
$html .= '    <meta name="viewport" content="width=device-width, initial-scale=1">';
$html .= '        <title>Food distribution manager</title>';
$html .= '        <link rel="stylesheet" type="text/css" href="../../src/style/relatorios.css">';
$html .= '    </head>';
$html .= '    <body>';
$html .= '    <div class"container">';
$html .= '        <header style="padding-left: 30px; padding-right: 30px;">';
$html .= '            <table class="table">';
$html .= '                <thead>';
$html .= '                    <tr>';
$html .= '                        <th style="text-align: left;"><img src="../../src/img/log_iasd_azul.png" width="100" height="100"></th>';
$html .= '                        <th style="text-align: right;"><h4>Food distribution report</h4></th>';
$html .= '                    </tr>';
$html .= '                    <tr>';
$html .= '                        <th style="text-align: left;"><h3>Lincoln Amazing Grace SDA church</h3></th>';
$html .= '                        <th style="text-align: right;"><h5>06-22-2022</h5></th>';
$html .= '                    </tr>';
$html .= '                </thead>';
$html .= '            </table>';
$html .= '        </header>';
$html .= '        <main style="padding-left: 30px; padding-right: 30px;">';
$html .= '             <table class="table">';
$html .= '                <thead>';
$html .= '                    <tr>';
$html .= '                        <th style="text-align: left;">Name</th>';
$html .= '                        <th style="text-align: left;">Adults</th>';
$html .= '                        <th style="text-align: left;">Children</th>';
$html .= '                    </tr>';
$html .= '                </thead>';
    while ($rows_entrega = mysqli_fetch_assoc($resultado_entregas)){
    $total_adultos += intval($rows_entrega['qtd_adultos']);
    $total_criancas += intval($rows_entrega['qtd_criancas']);
$html .= '                 <tbody>';
$html .= '                     <tr>';
$html .= '                         <td>' . $rows_entrega['snome'] . ', ' . $rows_entrega['nome'] . "</td>";
$html .= '                         <td style="padding-left: 5px;">' . $rows_entrega['qtd_adultos'] . "</td>";
$html .= '                         <td style="padding-left: 5px;">' . $rows_entrega['qtd_criancas'] . "</td>";
$html .= '                     </tr>';
    }
$html .= '                     <tr>';
$html .= '                         <th style="text-align: left; padding-top: 10px;">Total adults</th>';
$html .= '                         <th style="text-align: left; padding-top: 10px;">Total children</th>';
$html .= '                         <th style="text-align: left; padding-top: 10px;">Total families</th>';
$html .= '                     </tr>';
$html .= '                     <tr>';
$html .= '                         <td>' . $total_adultos . "</td>";
$html .= '                         <td>' . $total_criancas . "</td>";
$html .= '                         <td>' . $conta_registro . "</td>";
$html .= '                     </tr>';
$html .= '                 </tbody>';
$html .= '             </table>';
$html .= '         </main>';
$html .= '       </div>';
$html .= '      </body>';
$html .= '    </html>';


use Dompdf\Dompdf;

require_once ("dompdf/autoload.inc.php");

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
     
$output = $dompdf->output();
file_put_contents("teste.pdf", $output);

$dompdf->stream("teste.pdf",array("Attachment"=> false));

?>