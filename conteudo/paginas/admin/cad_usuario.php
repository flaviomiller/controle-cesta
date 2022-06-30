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
    <title>CareCount - Registration</title>
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
        <?php

        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }

        ?>
        <form class="row g-3" method="post" action="proc_cad_usuario.php" enctype="multipart/form-data">
            <div class="col-md-6">
                <input type="text" class="form-control" name="nome" placeholder="First name" aria-label="First name">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="snome" placeholder="Last name" aria-label="Last name">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="telefone" placeholder="Phone" aria-label="Phone">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="cidade" placeholder="City" aria-label="City">
            </div>
            <div class="col-md-12">
                <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="Email" aria-label="Email">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="qtd_adultos" placeholder="How many adults " aria-label="How many adults ">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="qtd_criancas" placeholder="How many children" aria-label="How many children">
            </div>

            <div class="col-12">
                <button type="submit" name="CadUsuario" value="Register" class="btn btn-primary">Register</button>
                <a href="cad_presenca.php" value="Cancel" class="btn btn-danger">Cancel</a>
            </div>

        </form>

        <script src="https://kit.fontawesome.com/cd2d859a93.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="../../src/js/scripts.js"></script>
        <script src="../../src/bootstrap/js/bootstrap.min.js"></script>
    </main>
</body>

</html>