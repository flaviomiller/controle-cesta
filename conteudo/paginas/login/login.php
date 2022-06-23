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
    <title>Login</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="nav-link" href="login.php"><img src="../../src/img/Logo_CareCount.png" style="border-radius:20%;" width="60px" height="60px"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-align-justify"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="login_adm.php"><i class="fa-solid fa-house-lock"></i> Administrative</a>
                            </li>
                        </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container" style="margin-top: 10px;">
        <?php

        if (isset($_SESSION['msg'])) {
            echo "<div class='alert alert-success' role='alert'>" . $_SESSION['msg'] . "</div>";
            unset($_SESSION['msg']);
            header("Refresh: 1");
        }

        ?>
        <form class="row g-3" method="post" action="valida_login_instituicao.php" enctype="multipart/form-data">

            <div class="col-md-12">
                <label for="inputState" class="form-label">Select the church</label>
                <select name="instituicao" class="form-select">
                    <option selected>Choose...</option>
                    <?php
                    $results_instituicao = "SELECT * FROM instituicao ORDER BY nome_instituicao";
                    $resultado_instituicao = mysqli_query($conn, $results_instituicao);
                    while ($row_instituicao = mysqli_fetch_assoc($resultado_instituicao)) { ?>
                        <option value="<?php echo $row_instituicao['instituicao_id']; ?>"><?php echo $row_instituicao['nome_instituicao']; ?>
                        </option><?php
                                }
                    ?>
                </select>
            </div>
            <div class="col-md-12">
                <input type="password" class="form-control" name="senha" placeholder="Password" aria-label="Password">
            </div>
            <div class="col-12">
                <button type="submit" name="btnLogin" value="access" class="btn btn-primary">Access</button>
            </div>

        </form>

        <script src="https://kit.fontawesome.com/cd2d859a93.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="../../src/js/scripts.js"></script>
        <script src="../../src/bootstrap/js/bootstrap.min.js"></script>
    </main>
</body>

</html>