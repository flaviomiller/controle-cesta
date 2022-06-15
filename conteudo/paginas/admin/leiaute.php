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


?>

<DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Food distribution manager</title>
        <link rel="stylesheet" type="text/css" href="../../src/style/main.css">
    </head>
    <body>
        <header style="padding-left: 30px; padding-right: 30px;">
            <table class="table">
                <thead>
                    <tr>
                        <th style="text-align: left;"><img src="../../src/img/log_iasd_azul.png" width="100" height="100"></th>
                        <th style="text-align: right;"><h4>Food distribution report</h4></th>
                    </tr>
                    <tr>
                        <th style="text-align: left;"><h3>Lincoln Amazing Grace SDA church</h3></th>
                        <th style="text-align: right;"><h5>06-22-2022</h5></th>
                    </tr>
                </thead>
            </table>
        </header>
        <main style="padding-left: 30px; padding-right: 30px;">
             <table class="table">
                <thead>
                    <tr>
                        <th style="text-align: left">Name</th>
                        <th style="text-align: left">Adults</th>
                        <th style="text-align: left">Children</th>
                    </tr>
                </thead>
<?php
    while ($rows_entrega = mysqli_fetch_assoc($resultado_entregas)){
    $total_adultos += intval($rows_entrega['qtd_adultos']);
    $total_criancas += intval($rows_entrega['qtd_criancas']);
                echo "<tbody>"
                    . "<tr>"
                        . "<td>" . $rows_entrega['snome'] . ", " . $rows_entrega['nome'] . "</td>"
                        . "<td style='padding-left: 5px;'>" . $rows_entrega['qtd_adultos'] . "</td>"
                        . "<td style='padding-left: 5px;'>" . $rows_entrega['qtd_criancas'] . "</td>"
                    . "</tr>";
    }
                    echo "<tr>"
                        . "<th style='text-align: left; padding-top: 10px;'>Total adults</th>"
                        . "<th style='text-align: left; padding-top: 10px;'>Total children</th>"
                        . "<th style='text-align: left; padding-top: 10px;'>Total families</th>"
                    . "</tr>"
                    . "<tr>"
                       . "<td>" . $total_adultos . "</td>"
                       . "<td>" . $total_criancas . "</td>"
                       . "<td>" . $conta_registro . "</td>"
                    ."</tr>"
                ."</tbody>";
?>
            </table>
        </main>
    </body>
    </html>