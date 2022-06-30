<?php

session_start();
include_once("../../src/conexoes/conexao.php");

/*Variável recebe valor enviado pelo botão submit. 
O If verifica se há valores na variavel $valida_post, caso positivo ele tenta
realizar o cadastro, e em caso de falha ele chama a função que retorna para a página de cadastro*/


//recebe dados do formulário e atribui a variaveis
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {
    $var_query = "DELETE FROM `beneficiarios` WHERE `beneficiarios`.`beneficiario_id` = $id";

    //Executa a query criada na variavel anterior
    $delete_query = mysqli_query($conn, $var_query);

    $resultado_usuario = mysqli_query($conn, $delete_query);
    if (mysqli_affected_rows($conn)) {
        $_SESSION['msg'] = "<p style = 'color:green;'>User deleted successfully!</p>";
        header("Location: consult_usuarios.php");
    } else {
        $_SESSION['msg'] = "<p style = 'color:red;'>User has not been deleted!</p>";
        header("Location: consult_usuarios.php");
    }
} else {
    $_SESSION['msg'] = "<p style = 'color:red;'>User has not been deleted!</p>";
    header("Location: consult_usuarios.php");
}
