<?php

session_start();
include_once("../../src/conexoes/conexao.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="../../src/style/main.css">
    <link rel="stylesheet" type="text/css" href="../../src/style/responsive.css">
    <link rel="stylesheet" type="text/css" href="../../src/bootstrap/css/bootstrap.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Presence check</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="nav-link" href="cad_presenca.php"><i class="fa-solid fa-clipboard-check"></i></a>
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
        <?php

        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }

        ?>
        <div class="mb-3" style="margin-top: 10px;">
            <input type="text" class="form-control" id="pesquisa" placeholder="Search by card code or name">
        </div>

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