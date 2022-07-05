<?php

session_start();
include_once("../../src/conexoes/conexao.php");

$instituicao = $_SESSION['instituicao_id'];

if (empty($instituicao)) {
    header("Location: ../login/login.php");
}

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" href="../../src/img/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../../src/style/main.css">
    <link rel="stylesheet" type="text/css" href="../../src/style/personalizado.css">
    <link rel="stylesheet" type="text/css" href="../../src/bootstrap/css/bootstrap.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CareCount - Search by Name</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="nav-link" href="cad_presenca.php"><img src="../../src/img/Logo_CareCount_Fonte_Lateral.png" width="181px" height="50px"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-align-justify"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="../admin/cad_presenca.php"><i class="fa-solid fa-clipboard-check"></i> Presence check</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../admin/cad_usuario.php"><i class="fa-solid fa-file-circle-plus"></i> Registration</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../admin/consult_usuarios.php"><i class="fa-solid fa-file-lines"></i> Beneficiary’s report</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../admin/consult_entrega.php"><i class="fa-solid fa-box"></i> Donation Report</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../login/sair.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                            </li>
                        </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container">
        <div>
            <p style="padding-top: 10px; color: rgb(47,85,127); font-weight: bold; font-size: 18px;"><?php echo $_SESSION['instituicao'] ?></p>
        </div>
        <form action="" method="post">
            <input type="text" name="nome" placeholder="Search by Name">
            <input type="submit" name="SendPesqUser" value=" Search ">
        </form>
        <?php

        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }

        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $result_usuarios = "SELECT * FROM beneficiarios WHERE nome LIKE '%$nome%'";
        $resultado_usuarios = mysqli_query($conn, $result_usuarios);

        if ($nome == '') {
            echo "<p style='margin-top: 10px;'><i class='fa-solid fa-square-caret-up'></i> &nbsp;Enter the name in the search field</p>";
        } else if ($resultado_usuarios->num_rows == 0) {
            echo "<p style='margin-top: 10px;'><i class='fa-solid fa-square-xmark'></i> &nbsp;No record found with that name</p>";
        } else {
            echo "<table class='table table-striped'>" .
                "<thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>City</th>
                                    <th>E-mail</th>
                                    <th>Adult</th>
                                    <th>Children</th>
                                    <th>...</th>
                                </tr>
                            </thead>
                            <tbody>";



            while ($rows_usuario = mysqli_fetch_assoc($resultado_usuarios)) {
                echo "<tr>";
                echo "<td>" . $rows_usuario['beneficiario_id'] . "</td>"
                    . "<td>" . $rows_usuario['nome'] . "</td>"
                    . "<td>" . $rows_usuario['telefone'] . "</td>"
                    . "<td>" . $rows_usuario['cidade'] . "</td>"
                    . "<td>" . $rows_usuario['email'] . "</td>"
                    . "<td>" . $rows_usuario['qtd_adultos'] . "</td>"
                    . "<td>" . $rows_usuario['qtd_criancas'] . "</td>"
                    . "<td><a href='edit_usuario.php?beneficiario_id=" . $rows_usuario['beneficiario_id'] . "'/><i class='fa-solid fa-file-pen'></i></td>"
                    . "<td><a href='proc_apaga_usuario.php?id=" . $rows_usuario['beneficiario_id'] . "' onclick=\"return confirm('Are you sure you want to delete this record?'); return false;\"><i class='fa-solid fa-trash-can'></i></td>";
                echo "</tr>";
            }
        }

        ?>
        </tbody>
        </table>
        <script src="https://kit.fontawesome.com/cd2d859a93.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="../../src/js/scripts.js"></script>
        <script src="../../src/bootstrap/js/bootstrap.min.js"></script>
    </main>
</body>

</html>