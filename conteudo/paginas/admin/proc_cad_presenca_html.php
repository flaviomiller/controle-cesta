<?php

session_start();
include_once ("../../src/conexoes/conexao.php");

$usuarios = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);

    $result_user = "SELECT * FROM beneficiarios WHERE nome LIKE '%$usuarios%' LIMIT 30";
    $resultado_user = mysqli_query($conn, $result_user);

    if (($resultado_user) AND ($resultado_user->num_rows != 0)){

        echo "<table class='table'>" .
                "<thead>" .
                    "<tr>" .
                        "<th>Name</th>" .
                        "<th style='text-align: center;'>Check</th>" .
                    "</tr>" .
                "</thead>" .
                "<tbody>";

        while($row_user = mysqli_fetch_assoc($resultado_user)){
            echo "<tr>"
                  . "<td>" . $row_user['nome'] . "</td>"
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
