<?php

session_start();
include_once ("../../src/conexoes/conexao.php");

/*Variável recebe valor enviado pelo botão submit. 
O If verifica se há valores na variavel $valida_post, caso positivo ele tenta
realizar o cadastro, e em caso de falha ele chama a função que retorna para a página de cadastro*/

$valida_post = filter_input(INPUT_POST, 'CadUsuarioAdm', FILTER_UNSAFE_RAW);

    if ($valida_post) {

        //recebe dados do formulário e atribui a variaveis
        $usuarioAdm = filter_input(INPUT_POST, 'user', FILTER_UNSAFE_RAW);
        $emailAdm = filter_input(INPUT_POST, 'email', FILTER_UNSAFE_RAW);
        $senhaInAdm = filter_input(INPUT_POST, 'senha', FILTER_UNSAFE_RAW);

        $senha = password_hash($senhaInAdm, PASSWORD_DEFAULT);


/*        
        echo "Nome: $usuarioAdm <br>";
        echo "E-mail: $emailAdm <br>";
        echo "Password: $senha <br>";
*/        

        //Cria a query e atribui a variável que será utilizada para realizar a inserção no BD
        $var_query = "INSERT INTO usuario (usuario, email, senha, criado) VALUES ('$usuarioAdm', '$emailAdm', '$senha', NOW())";

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