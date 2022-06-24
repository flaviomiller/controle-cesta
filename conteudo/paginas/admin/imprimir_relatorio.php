<?php

session_start();
include_once ("../../src/conexoes/conexao.php");

$data = filter_input(INPUT_GET, 'dateprint');
$instituicao = $_SESSION['instituicao_id'];

        if(empty($instituicao)){
            header("Location: ../login/login.php");
        }     
        
        $result_entrega = "SELECT
        beneficiarios.beneficiario_id, beneficiarios.instituicao_id,  beneficiarios.nome, beneficiarios.telefone, beneficiarios.email, beneficiarios.qtd_adultos, beneficiarios.qtd_criancas, entrega.criado
        FROM beneficiarios 
        INNER JOIN 
        entrega ON beneficiarios.beneficiario_id = entrega.beneficiario_id 
        WHERE entrega.instituicao_id = $instituicao AND entrega.criado LIKE '%$data%'" ;
        $resultado_entregas = mysqli_query($conn, $result_entrega);
        $conta_registro = mysqli_num_rows($resultado_entregas);
        $total_adultos = 0;
        $total_criancas = 0;

        /*while ($rows_entrega = mysqli_fetch_assoc($resultado_entregas)){
        $total_adultos += intval($rows_entrega['qtd_adultos']);
        $total_criancas += intval($rows_entrega['qtd_criancas']);*/



$html = '';
$html .= '        <link rel="stylesheet" type="text/css" href="../../src/style/relatorios.css">';
$html .= '            <table class="table">';
$html .= '                <thead>';
$html .= '                    <tr>';
$html .= '                        <th><img src="../../src/img/Logo_CareCount_Imp_Lateral.png" width="181px" height="50px"></th>';
$html .= '                        <th</th>';
$html .= '                        <th></th>';
$html .= '                        <th></th>';
$html .= '                        <th></th>';
$html .= '                    </tr>';
$html .= '                    <tr>';
$html .= '                        <th><h3>' . $_SESSION['instituicao']. '</h3></th>';
$html .= '                        <th></th>';
$html .= '                        <th></th>';
$html .= '                        <th></th>';
$html .= '                        <th><h4>'. $data .'</h4></th>';
$html .= '                    </tr>';
$html .= '                    <tr>';
$html .= '                        <th style="text-align: left; padding-top: 10px; border-top: 1px solid rgb(47,85,127);">Name</th>';
$html .= '                        <th style="text-align: left; padding-top: 10px; border-top: 1px solid rgb(47,85,127);">Phone</th>';
$html .= '                        <th style="text-align: left; padding-top: 10px; border-top: 1px solid rgb(47,85,127);">Email</th>';
$html .= '                        <th style="text-align: left; padding-top: 10px; border-top: 1px solid rgb(47,85,127);">Adults</th>';
$html .= '                        <th style="text-align: left; padding-top: 10px; border-top: 1px solid rgb(47,85,127);">Children</th>';
$html .= '                    </tr>';
$html .= '                </thead>';
    while ($rows_entrega = mysqli_fetch_assoc($resultado_entregas)){
    $total_adultos += intval($rows_entrega['qtd_adultos']);
    $total_criancas += intval($rows_entrega['qtd_criancas']);
$html .= '                 <tbody>';
$html .= '                     <tr>';
$html .= '                         <td>' . $rows_entrega['nome'] . "</td>";
$html .= '                         <td style="padding-left: 5px;">' . $rows_entrega['telefone'] . "</td>";
$html .= '                         <td style="padding-left: 5px;">' . $rows_entrega['email'] . "</td>";
$html .= '                         <td style="padding-left: 5px;">' . $rows_entrega['qtd_adultos'] . "</td>";
$html .= '                         <td style="padding-left: 5px;">' . $rows_entrega['qtd_criancas'] . "</td>";
$html .= '                     </tr>';
    }
$html .= '                     <tr>';
$html .= '                         <td style="text-align: left; padding-top: 10px"><b>Total families: ' . $conta_registro . "</b></td>";
$html .= '                         <td style="text-align: left; padding-top: 10px"><b>Total adults: ' . $total_adultos . "</b></td>";
$html .= '                         <td style="text-align: left; padding-top: 10px"><b>Total children: ' . $total_criancas . "</b></td>";
$html .= '                     </tr>';
$html .= '                 </tbody>';
$html .= '             </table>';



use Dompdf\Dompdf;

require_once ("dompdf/autoload.inc.php");

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
     
$output = $dompdf->output();
//file_put_contents($data."_report_donation.pdf", $output);

$dompdf->stream($data."_report_donation.pdf",array("Attachment"=> true));

?>