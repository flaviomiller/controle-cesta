<?php

session_start();
include_once ("../../src/conexoes/conexao.php");

$usuarios = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);
$instituicao = $_SESSION['instituicao_id'];

    $result_user = "SELECT * FROM beneficiarios WHERE instituicao_id = $instituicao AND nome LIKE '%$usuarios%' LIMIT 50";
    $resultado_user = mysqli_query($conn, $result_user);

    if (($resultado_user) AND ($resultado_user->num_rows != 0)){

        echo "<table class='table'>" .
                "<thead>" .
                    "<tr>" .
                        "<th>Name</th>" .
                        "<th>Phone</th>" .
                        "<th style='text-align: center;'>Check</th>" .
                    "</tr>" .
                "</thead>" .
                "<tbody>";

        while($row_user = mysqli_fetch_assoc($resultado_user)){
            echo "<tr>"
                  . "<td>" . $row_user['nome'] . "</td>"
                  . "<td>" . $row_user['telefone'] . "</td>"
                  . "<td style='text-align: center;'>"
                  . "<a class='link-primary' href='proc_cad_presenca.php?user_id=". $row_user['beneficiario_id'] . 
                      "'> <i class='fa-solid fa-square-plus'></i> </a>
                      </td>
                  </tr>";
        }

        echo "</tbody>";

    }else{
        echo "Not find";
    }
