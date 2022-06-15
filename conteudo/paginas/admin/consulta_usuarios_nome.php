<?php

session_start();
include_once ("../../src/conexoes/conexao.php");

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h2><a href="../login/login.php">Home</a></h2>
        <h3>Registered receiver</h3>
        <form action="" method="post">
            <label>Search by Name</label>
            <input type="text" name="nome">
            <input type="submit" name="SendPesqUser" value="Search">
        </form>
            <?php

                if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                
                $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
                $result_usuarios = "SELECT * FROM beneficiarios WHERE nome LIKE '%$nome%'";
                $resultado_usuarios = mysqli_query($conn, $result_usuarios);

                if($nome == ''){
                    echo "Enter the name in the search field";
                } else if($resultado_usuarios->num_rows == 0){
                    echo "No record found with that name";
                } else {
                    echo "<table class='table'>" .
                            "<thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Lastname</th>
                                    <th>Phone</th>
                                    <th>City</th>
                                    <th>E-mail</th>
                                    <th>Adult</th>
                                    <th>Children</th>
                                    <th>Card Number</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                            <tbody>";

                        

                        while ($rows_usuario = mysqli_fetch_assoc($resultado_usuarios)){
                            echo "<tr>";
                            echo "<td>" .$rows_usuario['beneficiario_id']. "</td>"
                                . "<td>" .$rows_usuario['nome']. "</td>"
                                . "<td>" .$rows_usuario['snome']. "</td>"
                                . "<td>" .$rows_usuario['telefone']. "</td>"
                                . "<td>" .$rows_usuario['cidade']. "</td>"
                                . "<td>" .$rows_usuario['email']. "</td>"
                                . "<td>" .$rows_usuario['qtd_adultos']. "</td>"
                                . "<td>" .$rows_usuario['qtd_criancas']. "</td>"
                                . "<td>" .$rows_usuario['numero_cartao']. "</td>"
                                . "<td><a href='edit_usuario.php?beneficiario_id=" .$rows_usuario['beneficiario_id']. "'/>Editar</td>";
                            echo "</tr>";
                        }
                    }
                    
                    ?>
                </tbody>
            </table>
    </body>
</html>
