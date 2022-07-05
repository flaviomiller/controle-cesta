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
        $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_NUMBER_INT);
        $cidade = filter_input(INPUT_POST, 'cidade', FILTER_UNSAFE_RAW);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $qtdAdultos = filter_input(INPUT_POST, 'qtd_adultos', FILTER_SANITIZE_NUMBER_INT);
        $qtdCriancas = filter_input(INPUT_POST, 'qtd_criancas', FILTER_SANITIZE_NUMBER_INT);
        $oracao = filter_input(INPUT_POST, 'oracao', FILTER_UNSAFE_RAW);
        $estudoBiblico = filter_input(INPUT_POST, 'estudo_biblico', FILTER_UNSAFE_RAW);
        $familia = filter_input(INPUT_POST, 'familia', FILTER_UNSAFE_RAW);
        $saude = filter_input(INPUT_POST, 'saude', FILTER_UNSAFE_RAW);
        $financas = filter_input(INPUT_POST, 'financas', FILTER_UNSAFE_RAW);
        $educacaoCriancas = filter_input(INPUT_POST, 'educacao_criancas', FILTER_UNSAFE_RAW);
        $temperaturaEspiritual = filter_input(INPUT_POST, 'temperatura_espiritual', FILTER_UNSAFE_RAW);
        $notas = filter_input(INPUT_POST, 'notas', FILTER_UNSAFE_RAW);


        if($oracao == "on"){
            $oracao = "checked";
        }

        if($estudoBiblico == "on"){
            $estudoBiblico = "checked";
        }
    
        if($familia == "on"){
            $familia = "checked";
        }
    
        if($saude == "on"){
            $saude = "checked";
        }
    
        if($financas == "on"){
            $financas = "checked";
        }
    
        if($educacaoCriancas == "on"){
            $educacaoCriancas = "checked";
        }

/*        
        echo "Nome: $nome <br> "Sobre Nome: $snome <br> Telefone: $telefone <br> Cidade: $cidade <br> E-Mail: $email <br> Qtd Adultos: $qtdAdultos <br> Qtd Crianças: $qtdCriancas <br> Número de Cartão: $numeroCartao <br>";
*/      
        $data = date("Y-m-d H:i:s");

        $var_query = "UPDATE `beneficiarios` SET `nome` = '$nome', `telefone` = '$telefone', `cidade` = '$cidade', `email` = '$email', `qtd_adultos` = '$qtdAdultos', `qtd_criancas` = '$qtdCriancas', `oracao` = '$oracao', `estudo_biblico` = '$estudoBiblico', `familia` = '$familia', `saude` = '$saude', `financas` = '$financas', `educacao_criancas` = '$educacaoCriancas', `temperatura_espiritual` = '$temperaturaEspiritual', `notas` = '$notas', `modificado` = '$data' WHERE `beneficiarios`.`beneficiario_id` = '$id'";

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

        $_SESSION['msg'] = "<p style = 'color:red;'> Error accessing page!</p>";
        header("Location: consult_usuarios.php");

    }
