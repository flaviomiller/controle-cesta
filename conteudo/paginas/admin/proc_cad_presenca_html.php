<?php

session_start();
include_once ("../../src/conexoes/conexao.php");

$usuarios = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);

$v = is_numeric ($usuarios) ? true : false;

//var_dump ($v);

if ($v == true) {
    $result_user = "SELECT * FROM beneficiarios WHERE numero_cartao LIKE '%$usuarios%' LIMIT 30";
    $resultado_user = mysqli_query($conn, $result_user);

    if (($resultado_user) AND ($resultado_user->num_rows != 0)){
        
        echo "<table class='table'>" .
                "<thead>" .
                    "<tr>" .
                        "<th>Card Number</th>" .
                        "<th>Lastname</th>" .
                        "<th>Name</th>" .
                        "<th>Check</th>" .
                    "</tr>" .
                "</thead>" .
                "<tbody>";
        
        while($row_user = mysqli_fetch_assoc($resultado_user)){
            echo "<tr>"
                . "<td>" . $row_user['numero_cartao'] . "</td>" 
                . "<td>" . $row_user['snome'] . "</td>"
                . "<td>" . $row_user['nome'] . "</td>"
                . "<td>"
                . "<a href='proc_cad_presenca.php?user_id=". $row_user['beneficiario_id'] . "'> <i class='fa-solid fa-square-check'></i> </a></td></tr>";
        }

        echo "</tbody>";

    }else{
        echo "Not find";
    }

} elseif ($v == false){
    $result_user = "SELECT * FROM beneficiarios WHERE nome LIKE '%$usuarios%' LIMIT 30";
    $resultado_user = mysqli_query($conn, $result_user);

    if (($resultado_user) AND ($resultado_user->num_rows != 0)){

        echo "<table class='table'>" .
                "<thead>" .
                    "<tr>" .
                        "<th>Card Number</th>" .
                        "<th>Lastname</th>" .
                        "<th>Name</th>" .
                        "<th>Check</th>" .
                    "</tr>" .
                "</thead>" .
                "<tbody>";

        while($row_user = mysqli_fetch_assoc($resultado_user)){
            echo "<tr>"
                . "<td>" . $row_user['numero_cartao'] . "</td>" 
                . "<td>" . $row_user['snome'] . "</td>"
                . "<td>" . $row_user['nome'] . "</td>"
                . "<td>"
                . "<a class='link-primary' href='proc_cad_presenca.php?user_id=". $row_user['beneficiario_id'] . "'> <i class='fa-solid fa-square-check'></i> </a></td></tr>";
        }

        echo "</tbody>";

    }else{
        echo "Not find";
    }

}

?>