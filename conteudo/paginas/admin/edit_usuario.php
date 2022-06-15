<?php

session_start();
include_once ("../../src/conexoes/conexao.php");

$id = filter_input(INPUT_GET, 'beneficiario_id', FILTER_SANITIZE_NUMBER_INT);

$result_edit_user = "SELECT * FROM beneficiarios WHERE beneficiario_id = '$id'";
$resultado_edit_user = mysqli_query($conn, $result_edit_user);
$row_edit_user = mysqli_fetch_assoc($resultado_edit_user);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h2><a href="../login/login.php">Home</a></h2>
        <h3>Edit register receiver</h3>
            <?php

                if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
            
            ?>
            <form method="post" action="proc_edit_usuario.php" enctype="multipart/form-data">

                <input type="hidden" id="id" name="id" value="<?php echo $row_edit_user['beneficiario_id'] ?>"></input><br><br>
                <label>Name *</label>
                <input type="text" required="required" id="nome" name="nome" value="<?php echo $row_edit_user['nome'] ?>"></input><br><br>

                <label>Lastname *</label>
                <input type="text" required="required" id="snome" name="snome" value="<?php echo $row_edit_user['snome'] ?>"></input><br><br>

                <label>Phone *</label>
                <input type="text" required="required" id="telefone" name="telefone" value="<?php echo $row_edit_user['telefone'] ?>"></input><br><br>

                <label>City </label>
                <input type="text" id="cidade" name="cidade" value="<?php echo $row_edit_user['cidade'] ?>"></input><br><br>

                <label>E-Mail </label>
                <input type="email" id="email" name="email" value="<?php echo $row_edit_user['email'] ?>"></input><br><br>

                <label>How many adults *</label>
                <input type="text" required="required" id="qtd-adultos" name="qtd_adultos" value="<?php echo $row_edit_user['qtd_adultos'] ?>"></input><br><br>

                <label>How many children *</label>
                <input type="text" required="required" id="qtd-criancas" name="qtd_criancas" value="<?php echo $row_edit_user['qtd_criancas'] ?>"></input><br><br>

                <label>Card Number *</label>
                <input type="text" required="required" id="numero-cartao" name="numero_cartao" value="<?php echo $row_edit_user['numero_cartao'] ?>"></input><br><br>

                <input type="submit" name="AltUsuario" value="Save">

            </form>
    </body>
</html>

