<?php

session_start();
include_once ("../../src/conexoes/conexao.php");

/*Variável recebe valor enviado pelo botão submit. 
O If verifica se há valores na variavel $valida_post, caso positivo ele tenta
realizar o cadastro, e em caso de falha ele chama a função que retorna para a página de cadastro*/

$valida_post = filter_input(INPUT_POST, 'CadUsuario', FILTER_UNSAFE_RAW);

    if ($valida_post) {

        //recebe dados do formulário e atribui a variaveis
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

        //Cria a query e atribui a variável que será utilizada para realizar a inserção no BD
        $var_query = "INSERT INTO beneficiarios (nome, snome, telefone, cidade, email, qtd_adultos, qtd_criancas, numero_cartao, criado) VALUES ('$nome', '$snome', '$telefone', '$cidade', '$email', '$qtdAdultos', '$qtdCriancas', '$numeroCartao', NOW())";

        //Executa a query criada na variavel anterior
        $insert_query = mysqli_query($conn, $var_query);

        /*Chama a função que verifica se um ID novo foi criado, caso positivo
        retorna a página de cadastro informando que o registro foi corretamente inserido;
        Caso contrário retorna a página de cadastro informando que o registro não foi inserido*/
        if(mysqli_insert_id($conn)){
            
            $_SESSION['msg'] = "<p style = 'color:green;'> Registro inserido com sucesso!!</p>";
            header("Location: cad_presenca.php");

        } else {

            $_SESSION['msg'] = "<p style = 'color:red;'> Erro ao salvar dados</p>";
            header("Location: cad_usuario.php");

        }

        

    } else {

        $_SESSION['msg'] = "<p style = 'color:red;'> <b>Não</b> acesse diretamente por Links, preencha os dados do formulário e <b>Clique</b> no botão cadastrar!</p>";
        header("Location: cad_presenca.php");

    }

?>