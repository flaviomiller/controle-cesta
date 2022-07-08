<?php

session_start();
include_once("../../src/conexoes/conexao.php");

$instituicao = $_SESSION['instituicao_id'];

if (empty($instituicao)) {
    header("Location: ../login/login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="../../src/img/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../../src/style/main.css">
    <link rel="stylesheet" type="text/css" href="../../src/style/personalizado.css">
    <link rel="stylesheet" type="text/css" href="../../src/bootstrap/css/bootstrap.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CareCount - Donation Report</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="nav-link" href="presenca"><img src="../../src/img/Logo_CareCount_Fonte_Lateral.png" width="181px" height="50px"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-align-justify"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../admin/presenca"><i class="fa-solid fa-clipboard-check"></i> Presence check</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../admin/cadastro-usuario"><i class="fa-solid fa-file-circle-plus"></i> Registration</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../admin/consulta-usuarios"><i class="fa-solid fa-file-lines"></i> Beneficiary’s report</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../admin/consulta-entrega"><i class="fa-solid fa-box"></i> Donation Report</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../login/sair.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
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

    $data = filter_input(INPUT_POST, 'date');
    $instituicao = $_SESSION['instituicao_id'];

    ?>
    <main class="container">
        <div>
            <p style="padding-top: 10px; color: rgb(47,85,127); font-weight: bold; font-size: 18px;"><?php echo $_SESSION['instituicao'] ?></p>
        </div>
        <div>
            <form action="" method="post">
                <input id="date" name="date" type="date">
                <input type="submit" name="seleciona_data" value=" Select ">
            </form>
        </div>

        <?php
        $data = filter_input(INPUT_POST, 'date');

        if ($data == '') {

            echo "<p style='margin-top: 10px;'><i class='fa-solid fa-square-caret-up'></i> &nbsp;Select the date for generating report  </p>";
        } else {

            $result_entrega = "SELECT
                        beneficiarios.beneficiario_id, beneficiarios.instituicao_id, beneficiarios.nome, beneficiarios.qtd_adultos, beneficiarios.qtd_criancas, entrega.criado
                        FROM beneficiarios 
                        INNER JOIN 
                        entrega ON beneficiarios.beneficiario_id = entrega.beneficiario_id 
                        WHERE entrega.instituicao_id = $instituicao AND entrega.criado LIKE '%$data%'";

            $resultado_entregas = mysqli_query($conn, $result_entrega);

            $conta_registro = mysqli_num_rows($resultado_entregas);

            $total_adultos = 0;
            $total_criancas = 0;

            if ($conta_registro == 0) {

                echo "<p style='margin-top: 10px;'><i class='fa-solid fa-square-xmark'></i> &nbsp;There are no records for: $data</p>";
            } else {
                echo "<p style='margin-top: 10px;'><i class='fa-solid fa-print'></i>  <a href='imprimir_relatorio.php?dateprint=$data' target='_blank'> Print report</a> | " . $data . "</p>";
                echo "<table class='table table-striped'>
                                    <thead>
                                        <tr>
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
                    echo "<td>"  . $rows_entrega['nome'] . "</td>"
                        . "<td>" . $rows_entrega['qtd_adultos'] . "</td>"
                        . "<td>" . $rows_entrega['qtd_criancas'] . "</td>";
                    echo "</tr>";
                }
                echo "<tr>" .
                    "<th>Total families</th>" .
                    "<th>Total adults</th>" .
                    "<th>Total children</th>" .
                    "</tr>" .
                    "<tr>" .
                    "<td>" . $conta_registro . "</td>" .
                    "<td>" . $total_adultos . "</td>" .
                    "<td>" . $total_criancas . "</td>" .
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