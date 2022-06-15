<?php

session_start();
include_once ("../../src/conexoes/conexao.php");

/*Variável recebe valor enviado pelo botão submit. 
O If verifica se há valores na variavel $valida_post, caso positivo ele tenta
realizar o cadastro, e em caso de falha ele chama a função que retorna para a página de cadastro*/

$valida_post = filter_input(INPUT_GET, 'user_id', FILTER_UNSAFE_RAW);

//echo "User ID: $valida_post <br>";


    if ($valida_post) {

        //Cria a query e atribui a variável que será utilizada para realizar a inserção no BD
       $var_query = "INSERT INTO entrega (beneficiario_id, criado) VALUES ('$valida_post', NOW())";

        //Executa a query criada na variavel anterior
        $insert_query = mysqli_query($conn, $var_query);

        /*Chama a função que verifica se um ID novo foi criado, caso positivo
        retorna a página de cadastro informando que o registro foi corretamente inserido;
        Caso contrário retorna a página de cadastro informando que o registro não foi inserido*/
        if((mysqli_affected_rows($conn)) > 0) {
            
            $_SESSION['msg'] = "<p style = 'color:green;'> Registro inserido com sucesso!!</p>";
            header("Location: cad_presenca.php");

        } else {

            $_SESSION['msg'] = "<p style = 'color:red;'> Erro ao salvar dados</p>";
            header("Location: cad_presenca.php");

        }

        

    } else {

        $_SESSION['msg'] = "<p style = 'color:red;'> <b>Não</b> acesse diretamente por Links, preencha os dados do formulário e <b>Clique</b> no botão cadastrar!</p>";
        header("Location: cad_presenca.php");

    }

?>