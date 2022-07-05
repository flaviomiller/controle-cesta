<?php

session_start();
include_once ("../../src/conexoes/conexao.php");

/*Variável recebe valor enviado pelo botão submit. 
O If verifica se há valores na variavel $valida_post, caso positivo ele tenta
realizar o cadastro, e em caso de falha ele chama a função que retorna para a página de cadastro*/

$valida_post = filter_input(INPUT_POST, 'CadUsuario', FILTER_UNSAFE_RAW);
$instituicao = $_SESSION['instituicao_id'];

    if ($valida_post) {

        //recebe dados do formulário e atribui a variaveis
        $nome = filter_input(INPUT_POST, 'nome', FILTER_UNSAFE_RAW);
        $snome = filter_input(INPUT_POST, 'snome', FILTER_UNSAFE_RAW);
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
                
        $nomeCompleto = $snome .", " . $nome;

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
        echo "Nome: $nome <br>Sobre Nome: $snome <br> Telefone: $telefone <br> Cidade: $cidade <br> E-Mail: $email <br> Qtd Adultos: $qtdAdultos <br>";
        echo "Qtd Crianças: $qtdCriancas <br> Oração: $oracao <br> Estudo Biblico: $estudoBiblico <br> Familia: $familia <br> Saude: $saude <br>";
        echo "Financas: $financas <br> Educacao Criancas: $educacaoCriancas <br> Temperatura Espiritual: $temperaturaEspiritual <br> Nota: $notas <br>";
*/        
        $data = date("Y-m-d H:i:s");

        //Cria a query e atribui a variável que será utilizada para realizar a inserção no BD
        $var_query = "INSERT INTO beneficiarios (instituicao_id, nome, telefone, cidade, email, qtd_adultos, qtd_criancas, oracao, estudo_biblico, familia, saude, financas, educacao_criancas, temperatura_espiritual, notas, criado) VALUES ('$instituicao', '$nomeCompleto', '$telefone', '$cidade', '$email', '$qtdAdultos', '$qtdCriancas', '$oracao', '$estudoBiblico', '$familia', '$saude', '$financas', '$educacaoCriancas', '$temperaturaEspiritual', '$notas', '$data')";

        //Executa a query criada na variavel anterior
        $insert_query = mysqli_query($conn, $var_query);

        /*Chama a função que verifica se um ID novo foi criado, caso positivo
        retorna a página de cadastro informando que o registro foi corretamente inserido;
        Caso contrário retorna a página de cadastro informando que o registro não foi inserido*/
        if(mysqli_insert_id($conn)){

            $retornaId = mysqli_insert_id($conn);
            
            header("Location: proc_cad_presenca.php?user_id=$retornaId");

            $_SESSION['msg'] = "<p style = 'color:green;'> Registro inserido com sucesso!!</p>";
            header("Location: cad_presenca.php");


        } else {

            $_SESSION['msg'] = "<p style = 'color:red;'> Erro ao salvar dados</p>";
            header("Location: cad_usuario.php");

        }

        

    } else {

        $_SESSION['msg'] = "<p style = 'color:red;'> Error accessing page!</p>";
        header("Location: cad_presenca.php");

    }
