<?php

session_start();
include_once("../../src/conexoes/conexao.php");

$instituicao = $_SESSION['instituicao_id'];

if (empty($instituicao)) {
    header("Location: ../login/login.php");
}

$id = filter_input(INPUT_GET, 'beneficiario_id', FILTER_SANITIZE_NUMBER_INT);

$result_edit_user = "SELECT * FROM beneficiarios WHERE beneficiario_id = '$id'";
$resultado_edit_user = mysqli_query($conn, $result_edit_user);
$row_edit_user = mysqli_fetch_assoc($resultado_edit_user);

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
    <title>CareCounter - Edit Record</title>
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
                            <a class="nav-link" href="../admin/sair.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
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
        <form class="row g-3" method="post" action="proc_edit_usuario.php" enctype="multipart/form-data">

            <div class="col-md-6">
                <input type="hidden" class="form-control" name="id" value="<?php echo $row_edit_user['beneficiario_id'] ?>" placeholder="id" aria-label="id">
                <input type="text" class="form-control" name="nome" value="<?php echo $row_edit_user['nome'] ?>" placeholder="First name" aria-label="First name">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="telefone" value="<?php echo $row_edit_user['telefone'] ?>" placeholder="Phone" aria-label="Phone">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="cidade" value="<?php echo $row_edit_user['cidade'] ?>" placeholder="City" aria-label="City">
            </div>
            <div class="col-md-6">
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row_edit_user['email'] ?>" placeholder="Email" aria-label="Email">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="qtd_adultos" value="<?php echo $row_edit_user['qtd_adultos'] ?>" placeholder="How many adults " aria-label="How many adults ">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="qtd_criancas" value="<?php echo $row_edit_user['qtd_criancas'] ?>" placeholder="How many children" aria-label="How many children">
            </div>

            <div class="col-md-12">
                <div>
                    <label class="form-label">Assessments</label>
                </div>
                <div class="form-check-inline form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" name="oracao" <?php echo $row_edit_user['oracao'] ?>>
                    <label class="form-check-label" for="flexSwitchCheckDefault">Prayer</label>
                </div>
                <div class="form-check-inline form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" name="estudo_biblico" <?php echo $row_edit_user['estudo_biblico'] ?>>
                    <label class="form-check-label" for="flexSwitchCheckDefault">Bible&nbsp;Study</label>
                </div>

                <div class="form-check-inline form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" name="familia" <?php echo $row_edit_user['familia'] ?>>
                    <label class="form-check-label" for="flexSwitchCheckDefault">Family</label>
                </div>
                <div class="form-check-inline form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" name="saude" <?php echo $row_edit_user['saude'] ?>>
                    <label class="form-check-label" for="flexSwitchCheckDefault">Health</label>
                </div>
                <div class="form-check-inline form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" name="financas" <?php echo $row_edit_user['financas'] ?>>
                    <label class="form-check-label" for="flexSwitchCheckDefault">Finances</label>
                </div>
                <div class="form-check-inline form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" name="educacao_criancas" <?php echo $row_edit_user['educacao_criancas'] ?>>
                    <label class="form-check-label" for="flexSwitchCheckDefault">Kids&nbsp;education </label>
                </div>

            </div>

            <div class="col-md-12">
                <label for="customRange1" class="form-label">Spiritual Temperature</label>
                <div class="simbol" style="display:flex;">
                    <div style="width:50%; text-align: left; background-image: linear-gradient(to left, rgba(255,0,0,0), rgb(47,85,127,1)); border-radius: 10px; color: white; max-height: 5px;">&nbsp;</div>
                    <div style="width:50%; text-align: right;background-image: linear-gradient(to right, rgba(255,0,0,0), rgb(220,53,69,1)); border-radius: 10px; color: white; max-height: 5px;">&nbsp;</div>
                </div>
                <input type="range" class="form-range" min="1" max="5" name="temperatura_espiritual" value="<?php echo $row_edit_user['temperatura_espiritual'] ?>">
            </div>

            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" name="notas"><?php echo $row_edit_user['notas'] ?></textarea>
                <label for="floatingTextarea">Notes</label>
            </div>


            <div class="col-12">
                <button type="submit" name="AltUsuario" value="Save" class="btn btn-primary">Edit</button>
                <a href="consult_usuarios.php" value="Cancel" class="btn btn-danger">Cancel</a>
            </div>

        </form>

        <script src="https://kit.fontawesome.com/cd2d859a93.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="../../src/js/scripts.js"></script>
        <script src="../../src/bootstrap/js/bootstrap.min.js"></script>
    </main>
    <footer class="container">
        <br><br>
    </footer>
</body>

</html>