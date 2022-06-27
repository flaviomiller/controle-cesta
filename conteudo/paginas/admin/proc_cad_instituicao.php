<?php

session_start();
include_once ("../../src/conexoes/conexao.php");

/*Variável recebe valor enviado pelo botão submit. 
O If verifica se há valores na variavel $valida_post, caso positivo ele tenta
realizar o cadastro, e em caso de falha ele chama a função que retorna para a página de cadastro*/

$valida_post = filter_input(INPUT_POST, 'CadInstituicao', FILTER_UNSAFE_RAW);

    if ($valida_post) {

        //recebe dados do formulário e atribui a variaveis
        $instituicao = filter_input(INPUT_POST, 'instituicao', FILTER_UNSAFE_RAW);
        $senhaIn = filter_input(INPUT_POST, 'senha', FILTER_UNSAFE_RAW);

        $senha = password_hash($senhaIn, PASSWORD_DEFAULT);


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
        $var_query = "INSERT INTO instituicao (nome_instituicao, senha, criado) VALUES ('$instituicao', '$senha', NOW())";

        //Executa a query criada na variavel anterior
        $insert_query = mysqli_query($conn, $var_query);

        /*Chama a função que verifica se um ID novo foi criado, caso positivo
        retorna a página de cadastro informando que o registro foi corretamente inserido;
        Caso contrário retorna a página de cadastro informando que o registro não foi inserido*/
        if(mysqli_insert_id($conn)){
            
            $_SESSION['msg'] = "<p style = 'color:green;'> Registration successfully!</p>";
            header("Location: menu_adm.php");

        } else {

            $_SESSION['msg'] = "<p style = 'color:red;'> Error saving data!</p>";
            header("Location: cad_instituicao.php");

        }

        

    } else {

        $_SESSION['msg'] = "<p style = 'color:red;'> Error accessing page!</p>";
        header("Location: cad_instituicao.php");

    }

?>