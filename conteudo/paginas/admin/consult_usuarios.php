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
    <title>Registration</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="nav-link" href="cad_presenca.php"><i class="fa-solid fa-address-book"></i></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-align-justify"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
    <main class="container">
        <div style="margin: 10px;"><i class="fa-solid fa-magnifying-glass"></i><a href="consulta_usuarios_nome.php" > Search by beneficiay's name</a></div>
        <?php

        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }

        ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>City</th>
                    <th>E-mail</th>
                    <th>Adult</th>
                    <th>Children</th>
                    <th>Card Number</th>
                    <th>...</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $SendPesqUser = filter_input(INPUT_POST, 'SendPesqUser', FILTER_SANITIZE_STRING);
                if ($SendPesqUser) {
                    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
                    $result_usuario = "SELECT * FROM beneficiarios WHERE nome LIKE '%$nome%'";
                    $resultado_usuario = mysqli_query($conn, $result_usuario);
                    while ($row_usuario = mysqli_fetch_assoc($resultado_usuario)) {
                        echo "Name: " . $row_usuario['nome'] . "<br>";
                    }
                }


                $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);

                $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

                $qtd_result_pg = 10;

                $inicio = ($qtd_result_pg * $pagina) - $qtd_result_pg;

                $result_usuarios = "SELECT * FROM beneficiarios ORDER BY beneficiario_id DESC LIMIT $inicio, $qtd_result_pg";
                $resultado_usuarios = mysqli_query($conn, $result_usuarios);

                while ($rows_usuario = mysqli_fetch_assoc($resultado_usuarios)) {
                    echo "<tr>";
                    echo "<td>" . $rows_usuario['snome'] . ", " . $rows_usuario['nome'] . "</td>"
                        . "<td>" . $rows_usuario['telefone'] . "</td>"
                        . "<td>" . $rows_usuario['cidade'] . "</td>"
                        . "<td>" . $rows_usuario['email'] . "</td>"
                        . "<td>" . $rows_usuario['qtd_adultos'] . "</td>"
                        . "<td>" . $rows_usuario['qtd_criancas'] . "</td>"
                        . "<td>" . $rows_usuario['numero_cartao'] . "</td>"
                        . "<td><a href='edit_usuario.php?beneficiario_id=" . $rows_usuario['beneficiario_id'] . "'/><i class='fa-solid fa-file-pen'></i></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <?php
        $result_pg = "SELECT COUNT(beneficiario_id) AS num_result FROM beneficiarios";
        $resultado_pg = mysqli_query($conn, $result_pg);
        $row_pg = mysqli_fetch_assoc($resultado_pg);
        $quantidade_pg = ceil($row_pg['num_result'] / $qtd_result_pg);
        $max_links = 1;

        //echo  $row_pg['num_result'];

        echo "<a href='consult_usuarios.php?pagina=1'>First page</a> ";

        for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
            if ($pag_ant >= 1) {
                echo "<a href='consult_usuarios.php?pagina=$pag_ant'>$pag_ant</a> ";
            }
        }

        echo " $pagina ";

        for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
            if ($pag_dep <= $quantidade_pg) {
                echo "<a href='consult_usuarios.php?pagina=$pag_dep'>$pag_dep</a> ";
            }
        }

        echo "<a href='consult_usuarios.php?pagina=$quantidade_pg'> Last page</a> ";
        ?>
    </main>
    <script src="https://kit.fontawesome.com/cd2d859a93.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../../src/js/scripts.js"></script>
    <script src="../../src/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>