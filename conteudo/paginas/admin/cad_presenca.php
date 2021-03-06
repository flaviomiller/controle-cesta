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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CareCounter - Presence check</title>
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
                            <a class="nav-link" href="../admin/consulta-usuarios"><i class="fa-solid fa-file-lines"></i> Beneficiary???s report</a>
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
    <main class="container">
        <div>
            <p style="padding-top: 10px; color: rgb(47,85,127); font-weight: bold; font-size: 18px;"><?php echo $_SESSION['instituicao'] ?></p>
        </div>
        <?php

        $instituicao = $_SESSION['instituicao_id'];

        $data = date('Y-m-d');
        //$data2 = date('Y-m-d H:i');
        $result_entrega = "SELECT * FROM `entrega` WHERE `instituicao_id` =  $instituicao AND `criado` LIKE '%$data%'";
        $resultado_entregas = mysqli_query($conn, $result_entrega);
        $conta_registro = mysqli_num_rows($resultado_entregas);

        ?>
        <form class="row g-3">
            <div class="row" style="margin-top: 10px;">
                <div class="input-group">
                    <input type="text" class="form-control" id="pesquisa" placeholder="Search by first or last name">

                    <?php
                    if ($conta_registro !== 0) {
                        echo "<span class='input-group-text'><b>" . $conta_registro . "</b> </span>";
                    }
                    ?>

                </div>
                &nbsp;&nbsp;
                <div class="col-1" style="padding-top: 8px;">
                    <a href="../admin/cadastro-usuario"><i class="fa-solid fa-file-circle-plus"></i></a>
                </div>
                    <?php

                    if (isset($_SESSION['msg'])) {
                        //echo "<div class='alert alert-success' role='alert'>" . $_SESSION['msg'] . "</div>";

                        echo "<div class='col-7' style='padding-top: 8px;'>" . $_SESSION['msg'] . "</div>";

                        unset($_SESSION['msg']);
                        header("Refresh: 0.5");
                    } ?>
            </div>

            <!-- <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>-->

        </form>

        <div class="resultado">

        </div>
    </main>
    <footer>
    </footer>
    <script src="https://kit.fontawesome.com/cd2d859a93.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../../src/js/scripts.js"></script>
    <script src="../../src/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>