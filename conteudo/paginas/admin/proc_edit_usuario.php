<?php

session_start();
include_once ("../../src/conexoes/conexao.php");

/*Variável recebe valor enviado pelo botão submit. 
O If verifica se há valores na variavel $valida_post, caso positivo ele tenta
realizar o cadastro, e em caso de falha ele chama a função que retorna para a página de cadastro*/

$valida_post = filter_input(INPUT_POST, 'AltUsuario', FILTER_UNSAFE_RAW);

    if ($valida_post) {

        //recebe dados do formulário e atribui a variaveis
        $id = filter_input(INPUT_POST, 'id', FILTER_UNSAFE_RAW);
        $nome = filter_input(INPUT_POST, 'nome', FILTER_UNSAFE_RAW);
        $snome = filter_input(INPUT_POST, 'snome', FILTER_UNSAFE_RAW);
        $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_NUMBER_INT);
        $cidade = filter_input(INPUT_POST, 'cidade', FILTER_UNSAFE_RAW);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $qtdAdultos = filter_input(INPUT_POST, 'qtd_adultos', FILTER_SANITIZE_NUMBER_INT);
        $qtdCriancas = filter_input(INPUT_POST, 'qtd_criancas', FILTER_SANITIZE_NUMBER_INT);
        $numeroCartao = filter_input(INPUT_POST, 'numero_cartao', FILTER_SANITIZE_NUMBER_INT);

/*        
        echo "Nome: $nome <br>";
        echo "Sobre Nome: $snome <br>";
        echo "Telefone: $telefone <br>";
        echo "Cidade: $cidade <br>";
        echo "E-Mail: $email <br>";
        echo "Qtd Adultos: $qtdAdultos <br>";
        echo "Qtd Crianças: $qtdCriancas <br>";
        echo "Número de Cartão: $numeroCartao <br>";
*/                

        $var_query = "UPDATE `beneficiarios` SET `nome` = '$nome', `snome` = '$snome', `telefone` = '$telefone', `cidade` = '$cidade', `email` = '$email', `qtd_adultos` = '$qtdAdultos', `qtd_criancas` = '$qtdCriancas', `numero_cartao` = '$numeroCartao', `modificado` = NOW() WHERE `beneficiarios`.`beneficiario_id` = '$id'";

        //Executa a query criada na variavel anterior
        $insert_query = mysqli_query($conn, $var_query);

        $resultado_usuario = mysqli_query($conn, $insert_query);
        if(mysqli_affected_rows($conn)){
            $_SESSION['msg'] = "<p style = 'color:green;'>User updated successfully!</p>";
            header("Location: consult_usuarios.php");
        } else {
            $_SESSION['msg'] = "<p style = 'color:red;'>User has not been updated!</p>";
            header("Location: consult_usuarios.php?beneficiario_id=$id");
        }

    } else {

        $_SESSION['msg'] = "<p style = 'color:red;'> <b>Não</b> acesse diretamente por Links, preencha os dados do formulário e <b>Clique</b> no botão cadastrar!</p>";
        header("Location: consult_usuarios.php");

    }

?>