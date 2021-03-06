<?php

session_start();
include_once("../../src/conexoes/conexao.php");

$usuarioCheck = $_SESSION['usuario_id'];

if (empty($usuarioCheck)) {
    header("Location: ../login/login.php");
}

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../../src/style/main.css">
    <link rel="stylesheet" type="text/css" href="../../src/style/personalizado.css">
    <link rel="stylesheet" type="text/css" href="../../src/bootstrap/css/bootstrap.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration admin</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="nav-link" href="administracao"><img src="../../src/img/Logo_CareCount_Fonte_Lateral.png" width="181px" height="50px"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-align-justify"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="administracao"><i class="fa-solid fa-house-lock"></i> Administrative</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../login/acesso"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                            </li>
                        </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container" style="margin-top: 10px;">
        <?php

        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }

        ?>
        <form class="row g-3" method="post" action="proc_cad_usuario_adm.php" enctype="multipart/form-data">

            <div class="col-md-6">
                <input type="text" class="form-control" name="user" placeholder="Username" aria-label="Username">
            </div>
            <div class="col-md-6">
                <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="Email" aria-label="Email">
            </div>
            <div class="col-md-6">
                <input type="password" class="form-control" name="senha" placeholder="Password" aria-label="Password">
            </div>
            <div class="col-md-6">
                <input type="password" class="form-control" name="confere_senha" placeholder="Repeat the password" aria-label="Repeat the password">
            </div>
            <div class="col-12">
                <button type="submit" name="CadUsuarioAdm" value="Register" class="btn btn-primary">Register</button>
                <a href="menu_adm.php" value="Cancel" class="btn btn-danger">Cancel</a>
            </div>

        </form>

        <script src="https://kit.fontawesome.com/cd2d859a93.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="../../src/js/scripts.js"></script>
        <script src="../../src/bootstrap/js/bootstrap.min.js"></script>
    </main>
</body>

</html>