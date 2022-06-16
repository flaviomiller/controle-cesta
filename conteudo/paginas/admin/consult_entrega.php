<?php

session_start();
include_once("../../src/conexoes/conexao.php");

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../../src/style/main.css">
    <link rel="stylesheet" type="text/css" href="../../src/style/responsive.css">
    <link rel="stylesheet" type="text/css" href="../../src/bootstrap/css/bootstrap.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donation Report</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="nav-link" href="cad_presenca.php"><i class="fa-solid fa-gift"></i></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-align-justify"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../admin/cad_presenca.php">Presence check</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../admin/cad_usuario.php">Registration</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../admin/consult_usuarios.php">Beneficiary’s report</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../admin/consult_entrega.php">Donation Report</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <?php

    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }

    ?>
    <main class="container">
        <div>
            <form action="" method="post">
                <input style="margin-top: 10px;" id="date" name="date" type="date">
                <input type="submit" name="seleciona_data" value="Select">
            </form>
        </div>

        <?php
        $data = filter_input(INPUT_POST, 'date');

        if ($data == '') {

            echo "<p style='margin-top: 10px;'>Select the date for generating report  </p>";
        } else {

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

            if ($conta_registro == 0) {

                echo "<p style='margin-top: 10px;'>There are no records for $data</p>";
            } else {
                echo "<p style='margin-top: 10px;'>Lincoln Amazing Grace SDA church - " . $data . "</p>";
                echo "<table class='table'>
                                    <thead>
                                        <tr>
                                            <th>Lastname</th>
                                            <th>Name</th>
                                            <th>How many Adults?</th>
                                            <th>How many Children?</th>
                                        </tr>
                                    </thead>
                                    <tbody>";

                while ($rows_entrega = mysqli_fetch_assoc($resultado_entregas)) {
                    $total_adultos += intval($rows_entrega['qtd_adultos']);
                    $total_criancas += intval($rows_entrega['qtd_criancas']);
                    echo "<tr>";
                    echo "<td>" . $rows_entrega['snome'] . "</td>"
                        . "<td>" . $rows_entrega['nome'] . "</td>"
                        . "<td>" . $rows_entrega['qtd_adultos'] . "</td>"
                        . "<td>" . $rows_entrega['qtd_criancas'] . "</td>";
                    echo "</tr>";
                }
                echo "<tr>" .
                    "<td>Total adults</td>" .
                    "<td>Total children</td>" .
                    "<td>Total families</td>" .
                    "</tr>" .
                    "<tr>" .
                    "<td>" . $total_adultos . "</td>" .
                    "<td>" . $total_criancas . "</td>" .
                    "<td>" . $conta_registro . "</td>" .
                    "</tr>";
                echo "</tbody>
                                    </table>";
            }
        }
        ?>
    </main>
    <script src="https://kit.fontawesome.com/cd2d859a93.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../../src/js/scripts.js"></script>
    <script src="../../src/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>