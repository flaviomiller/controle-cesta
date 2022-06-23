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
    <link rel="stylesheet" type="text/css" href="../../src/style/main.css">
    <link rel="stylesheet" type="text/css" href="../../src/style/personalizado.css">
    <link rel="stylesheet" type="text/css" href="../../src/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Presence check</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="nav-link" href="cad_presenca.php"><img src="../../src/img/Logo_CareCount.png" style="border-radius:20%;" width="60px" height="60px"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-align-justify"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
        <?php

        if (isset($_SESSION['msg'])) {
            echo "<div class='alert alert-success' role='alert'>" . $_SESSION['msg'] . "</div>";
            unset($_SESSION['msg']);
            header("Refresh: 1");
        }

        ?>
        <form class="row g-3">
            <div class="row" style="margin-top: 10px;">
                <div class="col-11">
                    <input type="text" class="form-control" id="pesquisa" placeholder="Search by card code or name">
                </div>
                <div class="col-1" style="padding-top: 8px;">
                    <a href="../admin/cad_usuario.php"><i class="fa-solid fa-file-circle-plus"></i></a>
                </div>
            </div>

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